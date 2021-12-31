<?php
header('content-type: application/json');
include 'conn.php';
session_start();

function register($db){
    $data =array();
    $er = array();
    $file_name = $_FILES['image']['name'];
    $file_type = $_FILES['image']['type'];
    $file_size = $_FILES['image']['size'];
    $all_inage = ['image/jpg','image/jpeg','image/png'];
    $max_size = 5 * 1024 * 1024;

    if(in_array($file_type,$all_inage)){
        if($file_size > $max_size){
            $er[]='file size lama hugala'; 
        }
    }else{
        $er[]='nuuca fileka lama hugala';
    }

    $new_id = new_id($db);
    $save_name = $new_id . '.png';
    //extract($_POST);
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(count($er) <= 0){
        $s = "INSERT INTO `users`(`id`, `fullname`, `username`, `email`, `password`, `image`) VALUES ('$new_id','$fullname','$username','$email',md5('$password'),'$save_name')";
        $r = $db->query($s);
        if($r){
            move_uploaded_file($_FILES['image']['tmp_name'],'../images/user/'.$save_name);
            $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
    
        }else{
            $data = array('status' => false, 'data' => $db->error);
        }
    }else{
        $data = array('status' => false, 'data' => $er);
    }
    echo json_encode($data);
}

function new_id($db){
    $new_id ='';
    $data = array();
    $mess = array();
    $s = "SELECT * FROM `users` order by users.id desc limit 1";
    $r = $db->query($s);
    if($r){
            $row = $r->fetch_assoc();
            if($row > 0){
                $new_id = ++$row['id'];
            }
            else{
                $new_id = '1';
            }
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    return $new_id;
}

function login($db){
    extract($_POST);
    $data = array();
    $query = "SELECT * FROM `users` WHERE users.username = '$username' AND users.password = md5('$password')";
    $conn = mysqli_query($db,$query);
    $sax = (mysqli_num_rows($conn));
    if($sax){
        $row = $conn->fetch_assoc();
        $_SESSION['id'] = $row['id'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['image'] = $row['image'];
        $data = array('status' => true,'data' => 'sax');
    }else{
        $data = array('status' => false,'data' => 'username and password is not match');
    }
    echo json_encode($data);
}


if(isset($_POST['action'])){
    $action = $_POST['action'];
    $action($db);
}
else{
    echo json_encode(array('status' => false, 'data' => 'action ma jiro'));
}
?>