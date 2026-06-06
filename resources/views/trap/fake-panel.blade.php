<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel — Secure Area</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:linear-gradient(135deg,#1a1a2e,#16213e,#0f3460); display:flex; justify-content:center; align-items:center; height:100vh; font-family:Arial,sans-serif; }
        .box { background:rgba(255,255,255,0.05); backdrop-filter:blur(10px); border:1px solid rgba(255,255,255,0.1); padding:40px; border-radius:12px; width:380px; }
        .title { text-align:center; margin-bottom:8px; }
        .title h1 { color:white; font-size:22px; }
        .title p { color:#94a3b8; font-size:13px; margin-top:4px; }
        .shield { text-align:center; font-size:48px; margin-bottom:20px; }
        .error { background:rgba(239,68,68,0.15); border:1px solid #ef4444; color:#ef4444; padding:10px; border-radius:6px; margin-bottom:16px; font-size:13px; text-align:center; }
        label { color:#94a3b8; font-size:12px; display:block; margin-bottom:6px; text-transform:uppercase; letter-spacing:1px; }
        input { width:100%; padding:12px; background:rgba(255,255,255,0.08); border:1px solid rgba(255,255,255,0.15); border-radius:6px; color:white; font-size:14px; margin-bottom:16px; }
        input:focus { outline:none; border-color:#3b82f6; }
        button { width:100%; padding:12px; background:linear-gradient(90deg,#3b82f6,#8b5cf6); color:white; border:none; border-radius:6px; cursor:pointer; font-size:15px; font-weight:bold; letter-spacing:1px; }
        .warning { text-align:center; margin-top:16px; font-size:11px; color:#64748b; }
    </style>
</head>
<body>
    <div class="box">
        <div class="shield">🔐</div>
        <div class="title">
            <h1>SECURE ADMIN PANEL</h1>
            <p>Authorized Personnel Only</p>
        </div>
        <br>
        <div class="error">⚠ Authentication Failed — Access Denied</div>
        <form method="POST">
            @csrf
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username">
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password">
            <label>Security Code</label>
            <input type="text" name="code" placeholder="2FA Code">
            <button type="submit">🔓 AUTHENTICATE</button>
        </form>
        <p class="warning">⚠ Unauthorized access attempts are logged and monitored</p>
    </div>
</body>
</html>
