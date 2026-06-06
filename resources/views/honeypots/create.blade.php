<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>HoneyWatch — Créer un Honeypot</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background:#0a0e1a;color:white;font-family:Arial,sans-serif;">

<nav style="background:#111827;padding:16px 32px;display:flex;justify-content:space-between;align-items:center;">
    <span style="color:#00d4aa;font-size:20px;font-weight:bold;">🛡 HONEYWATCH</span>
    <a href="/dashboard" style="color:#00d4aa;text-decoration:none;">← Dashboard</a>
</nav>

<div style="padding:40px;max-width:600px;margin:0 auto;">
    <h1 style="color:#00d4aa;font-size:24px;margin-bottom:8px;">+ Créer un Honeypot</h1>
    <p style="color:#9ca3af;margin-bottom:32px;">Déployez un nouveau piège numérique</p>

    <form method="POST" action="/honeypots">
        @csrf
        <div style="margin-bottom:20px;">
            <label style="color:#9ca3af;font-size:13px;display:block;margin-bottom:8px;">NOM DU PIÈGE</label>
            <input type="text" name="name" placeholder="Ex: Fake WordPress Admin"
                style="width:100%;padding:12px;background:#1f2937;border:1px solid #374151;border-radius:8px;color:white;font-size:14px;">
        </div>

        <div style="margin-bottom:20px;">
            <label style="color:#9ca3af;font-size:13px;display:block;margin-bottom:8px;">TYPE</label>
            <select name="type" style="width:100%;padding:12px;background:#1f2937;border:1px solid #374151;border-radius:8px;color:white;font-size:14px;">
                <option value="login">Login (page de connexion)</option>
                <option value="api">API (fausse API)</option>
                <option value="form">Form (formulaire)</option>
            </select>
        </div>

        <div style="margin-bottom:32px;">
            <label style="color:#9ca3af;font-size:13px;display:block;margin-bottom:8px;">URL DU PIÈGE</label>
            <div style="display:flex;align-items:center;gap:8px;">
                <span style="color:#6b7280;font-size:14px;">localhost:8000/</span>
                <input type="text" name="url_slug" placeholder="Ex: ssh-admin"
                    style="flex:1;padding:12px;background:#1f2937;border:1px solid #374151;border-radius:8px;color:white;font-size:14px;">
            </div>
            <p style="color:#6b7280;font-size:12px;margin-top:6px;">Sans espaces ni caractères spéciaux</p>
        </div>

        <button type="submit" style="width:100%;padding:14px;background:#00d4aa;color:#0a0e1a;border:none;border-radius:8px;font-size:16px;font-weight:bold;cursor:pointer;">
            🪤 Déployer le Honeypot
        </button>
    </form>
</div>

</body>
</html>
