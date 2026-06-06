<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>phpMyAdmin</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:#e8e8e8; font-family:Arial,sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; }
        .container { background:white; border:1px solid #ccc; width:380px; }
        .header { background:#f5a623; padding:12px 20px; display:flex; align-items:center; gap:10px; }
        .header span { font-size:20px; font-weight:bold; color:#333; }
        .body { padding:24px; }
        .error { background:#f8d7da; border:1px solid #f5c6cb; padding:10px; border-radius:4px; margin-bottom:16px; font-size:13px; color:#721c24; }
        label { font-size:13px; color:#333; display:block; margin-bottom:4px; }
        input { width:100%; padding:8px; border:1px solid #ccc; border-radius:3px; margin-bottom:12px; font-size:13px; }
        select { width:100%; padding:8px; border:1px solid #ccc; border-radius:3px; margin-bottom:12px; font-size:13px; }
        button { background:#4a90d9; color:white; border:none; padding:8px 20px; border-radius:3px; cursor:pointer; font-size:13px; }
        .footer { background:#f5f5f5; padding:10px 20px; border-top:1px solid #ccc; font-size:11px; color:#666; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <span>phpMyAdmin</span>
        </div>
        <div class="body">
            <div class="error">Accès refusé — Identifiants incorrects.</div>
            <form method="POST">
                @csrf
                <label>Utilisateur:</label>
                <input type="text" name="username" value="root">
                <label>Mot de passe:</label>
                <input type="password" name="password">
                <label>Serveur:</label>
                <select name="server">
                    <option>127.0.0.1</option>
                    <option>localhost</option>
                </select>
                <button type="submit">Connexion</button>
            </form>
        </div>
        <div class="footer">phpMyAdmin 5.2.1 — MySQL 8.0.32</div>
    </div>
</body>
</html>
