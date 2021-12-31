<?php
session_start();
if(!$_SESSION['id']){
    $id = $_SESSION['id'];
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>somphoto</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <input type="hidden"  name="id" id="id_admin" value="<?php echo $_SESSION['id']?>">
    <div class="container">
        <header class="header">
            <a href="index.php" class="logo">Som <span class="logo-color">photo</span></a>
            <i class="fas fa-bars menu"></i>
        </header>
        <div class="home">
               <div class="title-home">
               <h2>Category images</h2>
               <button id="button">Aad folder</button>
               </div>
               <div class="box-container">
                   
               </div>
        </div>
    </div>
    <div class="menu-bg hide">
        <i class="fas fa-times clone"></i>
        <div class="por">
            <img src="images/user/<?php echo $_SESSION['image']?>">
            <div class="title-por">
                <p>Name: <span class="text"><?php echo $_SESSION['fullname']?></span></p>
                <p>Username: <span class="text"><?php echo $_SESSION['username']?></span></p>
            </div>
            <div class="menu-por">
                <ul>
                    <li><a href="log_out.php"><i class="fas fa-sign-in-alt"> log out</i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="reg hide">
        <div class="header">
        <h2>Add folder</h2>
        <i class="fas fa-times clone2"></i>
        </div>
        </hr>
        <form id="from" enctype="multipart/form-data">
            <div class="from-group">
                <label>Name folder</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="from-group">
                <label>Image</label>
                <input type="file" name="image" id="image">
            </div>
            <input type="hidden"  name="user_id" id="user_id" value="<?php echo $_SESSION['id']?>">
            <input type="hidden"  name="box_id" id="box_id">
            <button type="submit">Submit</button>
        </form>
    </div>
    <div class="delete hide">
        <div class="box">
        <i class="fas fa-times clone3"></i>
            <span id="span"></span>
            <button id="button_delete">delete</button>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
    <script src="main.js"></script>
</body>
</html>