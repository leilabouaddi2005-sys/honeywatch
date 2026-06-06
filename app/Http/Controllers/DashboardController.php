<?php
namespace App\Http\Controllers;

use App\Models\IntrusionLog;
use App\Models\Honeypot;
use App\Models\Blacklist;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalIntrusions  = IntrusionLog::count();
        $todayIntrusions  = IntrusionLog::whereDate('created_at', today())->count();
        $totalHoneypots   = Honeypot::count();
        $activeHoneypots  = Honeypot::where('is_active', true)->count();
        $blacklistedIPs   = Blacklist::count();

        $topCountries = IntrusionLog::select('country', DB::raw('count(*) as total'))
                                    ->groupBy('country')
                                    ->orderByDesc('total')
                                    ->limit(5)
                                    ->get();

        $attacksByHour = IntrusionLog::whereDate('created_at', today())
                                     ->select(
                                         DB::raw('HOUR(created_at) as hour'),
                                         DB::raw('count(*) as total')
                                     )
                                     ->groupBy('hour')
                                     ->orderBy('hour')
                                     ->get();

        $latestIntrusions = IntrusionLog::with('honeypot')
                                        ->orderByDesc('created_at')
                                        ->limit(10)
                                        ->get();

        $dangerousIPs = IntrusionLog::select(
                                        'ip_address',
                                        'country',
                                        DB::raw('MAX(danger_score) as max_score'),
                                        DB::raw('count(*) as attacks')
                                    )
                                    ->groupBy('ip_address', 'country')
                                    ->orderByDesc('max_score')
                                    ->limit(5)
                                    ->get();

        return view('dashboard', compact(
            'totalIntrusions', 'todayIntrusions',
            'totalHoneypots', 'activeHoneypots',
            'blacklistedIPs', 'topCountries',
            'attacksByHour', 'latestIntrusions',
            'dangerousIPs'
        ));
    }
}
