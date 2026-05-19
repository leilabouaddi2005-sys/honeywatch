<?php

namespace App\Http\Controllers;

use App\Models\Honeypot;
use App\Models\IntrusionLog;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HoneywatchDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_intrusions' => IntrusionLog::count(),
            'active_honeypots' => Honeypot::where('is_active', true)->count(),
            'unique_ips' => IntrusionLog::distinct('ip_address')->count('ip_address'),
            'today_intrusions' => IntrusionLog::whereDate('timestamp', today())->count(),
        ];

        $recentIntrusions = IntrusionLog::with('honeypot')
            ->latest('timestamp')
            ->limit(8)
            ->get();

        $attacksByHour = IntrusionLog::select(
            DB::raw('HOUR(timestamp) as hour'),
            DB::raw('COUNT(*) as total')
        )
            ->where('timestamp', '>=', now()->subDay())
            ->groupBy('hour')
            ->orderBy('hour')
            ->pluck('total', 'hour');

        $chartLabels = [];
        $chartData = [];
        for ($h = 0; $h < 24; $h++) {
            $chartLabels[] = sprintf('%02d:00', $h);
            $chartData[] = $attacksByHour[$h] ?? 0;
        }

        return view('honeywatch.dashboard', compact(
            'stats',
            'recentIntrusions',
            'chartLabels',
            'chartData'
        ));
    }
}