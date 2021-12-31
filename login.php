<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - somphoto</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <h2>Login</h2>
            <div class="error hide">

            </div>
            <div class="suss hide">
            </div>

            <div class="form-container">
            <form id="from">
            <label>Username</label>
            <input type="text" name="username" id="username" required>
            <label>password</label>
            <input type="password" name="password" id="password" required>
           <input type="submit" name="submit" value="login">
            </form>
            <div class="text">
                <a href="register.php">Register</a>
            </div>
            </div>
        </div>
    </div>
   <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="login.js"></script>
</body>
</html>