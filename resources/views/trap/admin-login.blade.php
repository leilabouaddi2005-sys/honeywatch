<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #1a1a2e;
            color: #eee;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .box {
            background: #16213e;
            padding: 2rem;
            border-radius: 8px;
            width: 320px;
            box-shadow: 0 0 20px rgba(0, 200, 255, 0.2);
        }
        h1 {
            text-align: center;
            color: #fff;
            background: #e94560;
            padding: 0.5rem;
            margin: -2rem -2rem 1.5rem;
            font-size: 1rem;
        }
        label {
            display: block;
            margin-bottom: 0.25rem;
            font-size: 0.85rem;
            color: #aaa;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            box-sizing: border-box;
            border: 1px solid #333;
            background: #0f0f23;
            color: #fff;
        }
        button {
            width: 100%;
            padding: 0.6rem;
            background: #e94560;
            border: none;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }
        .error {
            color: #ff6b6b;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>ADMIN LOGIN</h1>

        @if(session('trap_error'))
            <p class="error">{{ session('trap_error') }}</p>
        @endif

        <form method="POST" action="{{ url('/admin') }}">
            @csrf
            <label>Username</label>
            <input type="text" name="username" autocomplete="username">

            <label>Password</label>
            <input type="password" name="password" autocomplete="current-password">

            <button type="submit">[ LOGIN ]</button>
        </form>
    </div>
</body>
</html>