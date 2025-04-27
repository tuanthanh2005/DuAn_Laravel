<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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

.login-container {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    padding: 40px;
    border-radius: 10px;
    text-align: center;
    width: 300px;
    box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
}

.login-container h2 {
    margin-bottom: 20px;
    color: #6b4e71;
}

.login-container input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: none;
    border-radius: 5px;
    background: #eef2f3;
}

.login-container .options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 13px;
    margin-bottom: 20px;
}

.login-container .options a {
    text-decoration: none;
    color: #ffffff;
    font-weight: bold;
}

.login-container button {
    width: 100%;
    padding: 12px;
    background: #f7cac9;
    border: none;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    font-size: 16px;
}

.login-container button:hover {
    background: #f2a2a2;
}

.social-login {
    margin-top: 20px;
    font-size: 14px;
}

.social-login a {
    color: white;
    text-decoration: none;
}

</style>
<body>
    <div class="login-container">
        <h2>ĐĂNG NHẬP</h2>
        <?php
		use Illuminate\Support\Facades\Session;
		$message=Session::get('message');
		if($message){
			echo $message;
			Session::put('message',null);
		}
		?>
        <form action="{{ URL::to('/save-login') }}" method="post">
            @csrf
            <input type="email" name="user_email" placeholder="Email" required>
            <input type="password" name="user_password" placeholder="Mật khẩu" required>

            <div class="options">
                <a href="{{ URL::to('register') }}">Đăng Kí</a>
                <a href="{{ URL::to('password.request') }}">Quên mật khẩu</a>
            </div>
            <button type="submit">ĐĂNG NHẬP</button>
        </form>
    </div>
</body>

</html>
