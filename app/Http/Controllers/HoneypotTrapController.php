<?php

namespace App\Http\Controllers;

use App\Models\Honeypot;
use App\Models\IntrusionLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HoneypotTrapController extends Controller
{
    public function showLogin(): View|RedirectResponse
    {
        $honeypot = Honeypot::where('url_slug', 'admin')
            ->where('is_active', true)
            ->first();

        if (! $honeypot) {
            abort(404);
        }

        $this->recordIntrusion($honeypot, request(), null);

        return view('trap.admin-login');
    }

    public function capture(Request $request): RedirectResponse
    {
        $honeypot = Honeypot::where('url_slug', 'admin')
            ->where('is_active', true)
            ->first();

        if (! $honeypot) {
            abort(404);
        }

        $payload = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $this->recordIntrusion($honeypot, $request, $payload);

        return back()->with('trap_error', 'Invalid credentials. Try again.');
    }

    private function recordIntrusion(Honeypot $honeypot, Request $request, ?array $payload): void
    {
        IntrusionLog::create([
            'honeypot_id' => $honeypot->id,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'payload' => $payload,
            'country' => null,
            'city' => null,
            'risk_score' => $payload ? 40 : 10,
            'timestamp' => now(),
        ]);
    }
}