<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:#0d1117; display:flex; justify-content:center; align-items:center; height:100vh; font-family:Arial,sans-serif; }
        .box { background:#161b22; padding:40px; border-radius:8px; border:1px solid #30363d; width:360px; }
        .header { background:#e94560; padding:12px; text-align:center; border-radius:4px; margin-bottom:24px; color:white; font-weight:bold; font-size:16px; letter-spacing:2px; }
        .error { color:#e94560; font-size:13px; margin-bottom:16px; }
        label { color:#8b949e; font-size:13px; display:block; margin-bottom:6px; }
        input { width:100%; padding:10px; margin-bottom:16px; background:#0d1117; border:1px solid #30363d; border-radius:4px; color:white; font-size:14px; }
        input:focus { outline:none; border-color:#e94560; }
        button { width:100%; padding:12px; background:#e94560; color:white; border:none; border-radius:4px; cursor:pointer; font-size:15px; font-weight:bold; letter-spacing:1px; }
    </style>
</head>
<body>
<div class="box">
    <div class="header">ADMIN LOGIN</div>
    <p class="error">Invalid credentials. Try again.</p>
    <form method="POST">
        @csrf
        <label>Username</label>
        <input type="text" name="username" autocomplete="off">
        <label>Password</label>
        <input type="password" name="password">
        <button type="submit">[ LOGIN ]</button>
    </form>
</div>
</body>
</html>
