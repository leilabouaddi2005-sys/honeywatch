<?php
namespace App\Http\Controllers;

use App\Models\Honeypot;
use App\Models\IntrusionLog;
use App\Models\GeolocationCache;
use App\Models\Alert;
use App\Mail\IntrusionAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class TrapController extends Controller
{
    public function capture(Request $request, string $slug)
    {
        // Ignore favicon
        if ($slug === 'favicon.ico') return response('', 204);

        $honeypot = Honeypot::where('url_slug', $slug)
                            ->where('is_active', true)
                            ->first();

        if (!$honeypot) abort(404);

        $ip      = $request->ip();
        $payload = $request->except(['_token']);

        // Enregistre seulement si c'est un POST avec données OU un GET
        // Évite les doublons en vérifiant si même IP + même honeypot + dernière seconde
        $recent = IntrusionLog::where('ip_address', $ip)
                              ->where('honeypot_id', $honeypot->id)
                              ->where('created_at', '>=', now()->subSeconds(2))
                              ->exists();

        if (!$recent) {
            $geo = GeolocationCache::where('ip_address', $ip)->first();
            if (!$geo) {
                try {
                    $response = Http::timeout(3)->get("http://ip-api.com/json/{$ip}");
                    $data = $response->json();
                    if (isset($data['status']) && $data['status'] === 'success') {
                        $geo = GeolocationCache::create([
                            'ip_address' => $ip,
                            'country'    => $data['country'] ?? 'Inconnu',
                            'city'       => $data['city'] ?? 'Inconnu',
                            'isp'        => $data['isp'] ?? 'Inconnu',
                            'lat'        => $data['lat'] ?? 0,
                            'lng'        => $data['lon'] ?? 0,
                        ]);
                    }
                } catch (\Exception $e) {}
            }

            IntrusionLog::create([
                'honeypot_id'  => $honeypot->id,
                'ip_address'   => $ip,
                'user_agent'   => $request->userAgent(),
                'payload'      => json_encode($payload),
                'country'      => $geo->country ?? 'Inconnu',
                'city'         => $geo->city ?? 'Inconnu',
                'danger_score' => 1,
            ]);

            $honeypot->increment('hit_count');

            // Alertes email
            $totalIntrusions = IntrusionLog::count();
            $alerts = Alert::where('email_sent', false)->get();
            foreach ($alerts as $alert) {
                if ($totalIntrusions >= $alert->threshold) {
                    try {
                        $email = $alert->email ?? 'admin@honeywatch.com';
                        Mail::to($email)->send(new IntrusionAlert($totalIntrusions, $alert->threshold));
                        $alert->update(['email_sent' => true]);
                    } catch (\Exception $e) {}
                }
            }
        }

        $views = [
            'wp-admin'    => 'trap.fake-wordpress',
            'phpmyadmin'  => 'trap.fake-phpmyadmin',
            'admin-panel' => 'trap.fake-panel',
        ];

        $view = $views[$slug] ?? 'trap.fake-login';
        return view($view);
    }
}
