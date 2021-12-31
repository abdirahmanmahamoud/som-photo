<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register - somphoto</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="container">
        <div class="box">
            <h2>Register</h2>
            <div class="error hide">

            </div>
            <div class="suss hide">
            
            </div>

            <div class="form-container">
            <form id="from" enctype="multipart/form-data">
            <label>Full name</label>
            <input type="text" name="fullname" id="fullname" required>
            <label>Username</label>
            <input type="text" name="username" id="username" required>
            <label>email</label>
            <input type="email" name="email" id="email" required>
            <label>password</label>
            <input type="password" name="password" id="password" required>
            <label>confirm password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <label>Profile image</label>
            <input type="file" name="image" id="image" required>
            <input type="submit" name="submit" value="Register">
            </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
     <script src="register.js"></script>
</body>
</html>