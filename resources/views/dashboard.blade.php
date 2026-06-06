<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HoneyWatch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background:#0a0e1a;color:white;font-family:Arial,sans-serif;">

<nav style="background:#111827;padding:16px 32px;display:flex;justify-content:space-between;align-items:center;">
    <span style="color:#00d4aa;font-size:20px;font-weight:bold;">HONEYWATCH</span>
    <div style="display:flex;gap:20px;align-items:center;">
        <span style="color:#9ca3af;">{{ auth()->user()->name }}</span>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" style="background:#ef4444;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">Déconnexion</button>
        </form>
    </div>
</nav>

<div style="padding:24px 32px;">
    <h1 style="color:#00d4aa;font-size:24px;margin-bottom:8px;">Tableau de bord</h1>
    <p style="color:#9ca3af;margin-bottom:24px;">Surveillance en temps réel</p>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
        <div style="background:#1f2937;padding:20px;border-radius:10px;border-left:4px solid #00d4aa;">
            <p style="font-size:12px;color:#9ca3af;">Intrusions totales</p>
            <p style="font-size:36px;font-weight:bold;color:#00d4aa;">{{ $totalIntrusions }}</p>
        </div>
        <div style="background:#1f2937;padding:20px;border-radius:10px;border-left:4px solid #3b82f6;">
            <p style="font-size:12px;color:#9ca3af;">Aujourd'hui</p>
            <p style="font-size:36px;font-weight:bold;color:#3b82f6;">{{ $todayIntrusions }}</p>
        </div>
        <div style="background:#1f2937;padding:20px;border-radius:10px;border-left:4px solid #10b981;">
            <p style="font-size:12px;color:#9ca3af;">Pièges actifs</p>
            <p style="font-size:36px;font-weight:bold;color:#10b981;">{{ $activeHoneypots }}</p>
        </div>
        <div style="background:#1f2937;padding:20px;border-radius:10px;border-left:4px solid #ef4444;">
            <p style="font-size:12px;color:#9ca3af;">IPs blacklistées</p>
            <p style="font-size:36px;font-weight:bold;color:#ef4444;">{{ $blacklistedIPs }}</p>
        </div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">
        <div style="background:#1f2937;padding:20px;border-radius:10px;">
            <h3 style="color:#00d4aa;margin-bottom:16px;">Attaques (24h)</h3>
            <canvas id="attackChart"></canvas>
        </div>
        <div style="background:#1f2937;padding:20px;border-radius:10px;">
            <h3 style="color:#00d4aa;margin-bottom:16px;">Dernières intrusions</h3>
            @forelse($latestIntrusions as $log)
            <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid #374151;font-size:13px;">
                <span>{{ $log->ip_address }}</span>
                <span style="color:#8b5cf6;">{{ $log->honeypot->url_slug ?? '-' }}</span>
                <span style="color:#9ca3af;">{{ \Carbon\Carbon::parse($log->created_at)->format('d/m H:i') }}</span>
            </div>
            @empty
            <p style="color:#6b7280;">Aucune intrusion</p>
            @endforelse
        </div>
    </div>

    <div style="margin-top:20px;">
        <a href="/honeypots/create" style="background:#00d4aa;color:#0a0e1a;padding:12px 24px;border-radius:8px;font-weight:bold;text-decoration:none;">+ Créer un Honeypot</a>
    </div>
</div>

<script>
const hours = @json($attacksByHour->pluck('hour'));
const totals = @json($attacksByHour->pluck('total'));
const labels = Array.from({length:24},(_,i)=>String(i).padStart(2,'0')+':00');
const data = Array(24).fill(0);
hours.forEach((h,i)=>{ data[h]=totals[i]; });
new Chart(document.getElementById('attackChart'),{
    type:'line',
    data:{
        labels:labels,
        datasets:[{label:'Attaques',data:data,borderColor:'#00d4aa',backgroundColor:'rgba(0,212,170,0.1)',tension:0.3,fill:true}]
    },
    options:{
        plugins:{legend:{labels:{color:'#9ca3af'}}},
        scales:{
            x:{ticks:{color:'#9ca3af'},grid:{color:'#374151'}},
            y:{ticks:{color:'#9ca3af'},grid:{color:'#374151'}}
        }
    }
});
</script>
</body>
</html>
