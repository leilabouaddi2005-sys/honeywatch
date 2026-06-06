<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HoneyWatch — Alertes</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background:#0a0e1a;color:white;font-family:Arial,sans-serif;">

<nav style="background:#111827;padding:16px 32px;display:flex;justify-content:space-between;align-items:center;">
    <span style="color:#00d4aa;font-size:20px;font-weight:bold;">🛡 HONEYWATCH</span>
    <div style="display:flex;gap:20px;align-items:center;">
        <a href="/dashboard" style="color:#9ca3af;text-decoration:none;">Dashboard</a>
        <a href="/alerts" style="color:#00d4aa;text-decoration:none;">Alertes</a>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" style="background:#ef4444;color:white;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">Déconnexion</button>
        </form>
    </div>
</nav>

<div style="padding:24px 32px;">
    <h1 style="color:#f59e0b;font-size:24px;margin-bottom:8px;">🔔 Alertes Email</h1>
    <p style="color:#9ca3af;margin-bottom:24px;">Configurez les seuils d'alerte automatique</p>

    <!-- Formulaire créer alerte -->
    <div style="background:#1f2937;padding:24px;border-radius:10px;border:1px solid #374151;margin-bottom:24px;max-width:500px;">
        <h3 style="color:#f59e0b;margin-bottom:16px;">+ Nouvelle règle d'alerte</h3>
        <form method="POST" action="/alerts">
            @csrf
            <label style="color:#9ca3af;font-size:13px;display:block;margin-bottom:6px;">SEUIL D'ATTAQUES</label>
            <input type="number" name="threshold" value="10" min="1"
                style="width:100%;padding:12px;background:#111827;border:1px solid #374151;border-radius:6px;color:white;font-size:14px;margin-bottom:16px;">
            <label style="color:#9ca3af;font-size:13px;display:block;margin-bottom:6px;">EMAIL DE NOTIFICATION</label>
            <input type="email" name="email" placeholder="admin@honeywatch.com"
                style="width:100%;padding:12px;background:#111827;border:1px solid #374151;border-radius:6px;color:white;font-size:14px;margin-bottom:16px;">
            <button type="submit" style="width:100%;padding:12px;background:#f59e0b;color:#0a0e1a;border:none;border-radius:6px;font-weight:bold;cursor:pointer;font-size:14px;">
                🔔 Activer l'alerte
            </button>
        </form>
    </div>

    <!-- Liste des alertes -->
    <div style="background:#1f2937;border-radius:10px;overflow:hidden;">
        <div style="padding:16px 20px;background:#111827;border-bottom:1px solid #374151;">
            <h3 style="color:#f59e0b;">Règles d'alerte actives</h3>
        </div>
        <table style="width:100%;border-collapse:collapse;font-size:13px;">
            <thead>
                <tr style="color:#9ca3af;text-align:left;">
                    <th style="padding:12px 16px;">Seuil</th>
                    <th style="padding:12px 16px;">Email</th>
                    <th style="padding:12px 16px;">Statut</th>
                    <th style="padding:12px 16px;">Créée le</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alerts as $alert)
                <tr style="border-top:1px solid #374151;">
                    <td style="padding:12px 16px;">
                        <span style="color:#f59e0b;font-weight:bold;">{{ $alert->threshold }}</span>
                        <span style="color:#9ca3af;"> attaques</span>
                    </td>
                    <td style="padding:12px 16px;color:#e2e8f0;">{{ $alert->email ?? 'admin@honeywatch.com' }}</td>
                    <td style="padding:12px 16px;">
                        @if($alert->email_sent)
                            <span style="background:#10b981;padding:3px 10px;border-radius:20px;font-size:12px;color:white;">✅ Email envoyé</span>
                        @else
                            <span style="background:#374151;padding:3px 10px;border-radius:20px;font-size:12px;color:#9ca3af;">⏳ En attente</span>
                        @endif
                    </td>
                    <td style="padding:12px 16px;color:#6b7280;">{{ \Carbon\Carbon::parse($alert->created_at)->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding:32px;text-align:center;color:#6b7280;">
                        Aucune règle d'alerte configurée
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
