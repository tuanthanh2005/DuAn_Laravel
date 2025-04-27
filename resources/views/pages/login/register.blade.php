<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: linear-gradient(to right, #f6d365, #fda085, #a18cd1, #fbc2eb);
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, sans-serif;
    }

    .register-container {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 10px;
        text-align: center;
        width: 350px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .register-container h2 {
        margin-bottom: 20px;
        color: #6b4e71;
    }

    .register-container input {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        background: #eef2f3;
    }

    .register-container button {
        width: 100%;
        padding: 12px;
        background: #f7cac9;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
    }

    .register-container button:hover {
        background: #f2a2a2;
    }

    .register-container .login-link {
        margin-top: 15px;
        font-size: 14px;
    }

    .register-container .login-link a {
        color: white;
        text-decoration: none;
    }
</style>
<body>
    <div class="register-container">
        <h2>ĐĂNG KÝ</h2>
        <form action="{{ URL::to('/save-register') }}" method="post">
            @csrf
            <input type="text" name="fullname" placeholder="Họ tên" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mật khẩu" required>
            <input type="text" name="phone" placeholder="Số điện thoại" required>
            <button type="submit">ĐĂNG KÝ</button>
            <div class="login-link">
                <p>Đã có tài khoản? <a href="{{ URL::to('/login') }}">Đăng nhập</a></p>
            </div>
        </form>
    </div>
</body>
</html>
