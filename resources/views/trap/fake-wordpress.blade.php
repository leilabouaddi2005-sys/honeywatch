<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WordPress › Login</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:#f0f0f1; font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif; display:flex; flex-direction:column; align-items:center; padding-top:60px; }
        .logo { margin-bottom:20px; font-size:40px; }
        .box { background:white; padding:26px 24px; border-radius:4px; width:320px; box-shadow:0 1px 3px rgba(0,0,0,0.13); }
        label { display:block; font-size:14px; font-weight:600; color:#1d2327; margin-bottom:5px; }
        input { width:100%; padding:8px; border:1px solid #8c8f94; border-radius:4px; font-size:14px; margin-bottom:16px; }
        input:focus { border-color:#2271b1; outline:2px solid #2271b1; outline-offset:-1px; }
        button { width:100%; padding:10px; background:#2271b1; color:white; border:none; border-radius:4px; font-size:14px; cursor:pointer; font-weight:600; }
        .forgot { text-align:center; margin-top:16px; font-size:13px; }
        .forgot a { color:#2271b1; text-decoration:none; }
        .error { background:#fcf0f1; border:1px solid #d63638; border-left:4px solid #d63638; padding:10px 12px; margin-bottom:16px; font-size:13px; color:#d63638; border-radius:2px; }
    </style>
</head>
<body>
    <div class="logo">🔵</div>
    <div class="box">
        <div class="error">Nom d'utilisateur ou mot de passe incorrect.</div>
        <form method="POST">
            @csrf
            <label>Identifiant</label>
            <input type="text" name="username" placeholder="Identifiant ou adresse e-mail">
            <label>Mot de passe</label>
            <input type="password" name="password">
            <input type="checkbox" name="remember"> <span style="font-size:13px;">Se souvenir de moi</span>
            <br><br>
            <button type="submit">Se connecter</button>
        </form>
        <div class="forgot"><a href="#">Mot de passe oublié ?</a></div>
    </div>
    <p style="margin-top:20px;font-size:13px;color:#646970;">← Retour à Mon Site WordPress</p>
</body>
</html>
