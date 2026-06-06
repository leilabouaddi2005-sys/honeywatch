@extends('layouts.honeywatch')

@section('title', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-cyan-400">Tableau de bord</h1>
    <p class="text-slate-400 mt-1">Surveillance des pièges et tentatives d'intrusion en temps réel</p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="rounded-xl border border-cyan-500/20 bg-slate-900/60 p-5 hover:border-cyan-500/40 transition">
        <p class="text-slate-400 text-sm">Intrusions totales</p>
        <p class="text-3xl font-bold text-cyan-300 mt-2">{{ $stats['total_intrusions'] }}</p>
    </div>
    <div class="rounded-xl border border-cyan-500/20 bg-slate-900/60 p-5 hover:border-emerald-500/40 transition">
        <p class="text-slate-400 text-sm">Aujourd'hui</p>
        <p class="text-3xl font-bold text-emerald-400 mt-2">{{ $stats['today_intrusions'] }}</p>
    </div>
    <div class="rounded-xl border border-cyan-500/20 bg-slate-900/60 p-5 hover:border-amber-500/40 transition">
        <p class="text-slate-400 text-sm">Pièges actifs</p>
        <p class="text-3xl font-bold text-amber-400 mt-2">{{ $stats['active_honeypots'] }}</p>
    </div>
    <div class="rounded-xl border border-cyan-500/20 bg-slate-900/60 p-5 hover:border-rose-500/40 transition">
        <p class="text-slate-400 text-sm">IPs uniques</p>
        <p class="text-3xl font-bold text-rose-400 mt-2">{{ $stats['unique_ips'] }}</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="rounded-xl border border-cyan-500/20 bg-slate-900/60 p-5">
        <h2 class="text-lg font-semibold text-cyan-300 mb-4">Attaques (24 h)</h2>
        <canvas id="attacksChart" height="120"></canvas>
    </div>
    <div class="rounded-xl border border-cyan-500/20 bg-slate-900/60 p-5">
        <h2 class="text-lg font-semibold text-cyan-300 mb-4">Dernières intrusions</h2>
        @forelse($recentIntrusions as $log)
            <div class="flex justify-between items-center py-2 border-b border-slate-800 text-sm">
                <span class="text-cyan-200 font-mono">{{ $log->ip_address }}</span>
                <span class="text-slate-500">{{ $log->honeypot?->name ?? '—' }}</span>
                <span class="text-slate-500">{{ $log->timestamp?->format('d/m H:i') }}</span>
            </div>
        @empty
            <p class="text-slate-500 text-sm">
                Aucune intrusion pour l'instant.
                Testez le piège : <a href="{{ url('/admin') }}" target="_blank" class="text-cyan-400 underline">/admin</a>
            </p>
        @endforelse
    </div>
</div>

<script>
new Chart(document.getElementById('attacksChart'), {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Attaques',
            data: @json($chartData),
            borderColor: '#22d3ee',
            backgroundColor: 'rgba(34, 211, 238, 0.1)',
            fill: true,
            tension: 0.3,
            pointBackgroundColor: '#22d3ee',
        }]
    },
    options: {
        plugins: { legend: { labels: { color: '#94a3b8' } } },
        scales: {
            x: { ticks: { color: '#64748b' }, grid: { color: 'rgba(148,163,184,0.1)' } },
            y: { ticks: { color: '#64748b', stepSize: 1 }, grid: { color: 'rgba(148,163,184,0.1)' }, beginAtZero: true }
        }
    }
});
</script>
@endsection
