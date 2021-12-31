<?php 
session_start();
include 'apl/conn.php';
if(!$_SESSION['id']){
    $id = $_SESSION['id'];
    header('location: login.php');
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if (!preg_match('/^[0-9]*$/', $id)){
        header('location: index.php');
    }else{
       $admin = $id;
    }
}
$id_admin = $_SESSION['id'];
$query = "SELECT * FROM `category` WHERE id = '$admin' AND user_id = '$id_admin'";
$conn = mysqli_query($db,$query);
$co = (mysqli_num_rows($conn));
if($co){

}else{
   header('location: index.php');
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
    <div class="container">
        <header class="header">
            <a href="index.php" class="logo">Som <span class="logo-color">photo</span></a>
            <i class="fas fa-bars menu"></i>
        </header>
        <input type="hidden" name="admin_id" id="admin_id" value="<?php echo $admin;?>">
        <div class="home">
               <div class="title-home">
               <h2>images</h2>
               <button id="button">Aad photo</button>
               </div>
               <div class="photo-container">

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
        <form id="from">
            <div class="from-group">
                <label>Image</label>
                <input type="file" name="image" id="image">
                <input type="hidden" name="admin" id="admin" value="<?php echo $admin;?>">
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
        <div class="photo-e hide">
            <div class="som">

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
    <script src="photo.js"></script>
</body>
</html>