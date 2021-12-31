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
    extract($_POST);

    if(count($er) <= 0){
        $s = "INSERT INTO `photo`(`id`, `image`, `folder_name_id`) VALUES ('$new_id','$save_name','$admin')";
        $r = $db->query($s);
        if($r){
            $ed = "SELECT * FROM category WHERE id='$admin'";
            $de = $db->query($ed);
            $row = $de->fetch_assoc();
            $number = $row['number'];
            $kuda = $number + 1;
            $query = "UPDATE `category` SET `number`='$kuda' WHERE id = '$admin'";
            $conn = $db->query($query);
            if($conn){
                 move_uploaded_file($_FILES['image']['tmp_name'],'../images/photo/'.$save_name);
                $data = array('status' => true,'data' => 'is sax hay ayaah u diwaangalisar');
            }
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
    $s = "SELECT * FROM `photo` order by photo.id desc limit 1";
    $r = $db->query($s);
    if($r){
            $row = $r->fetch_assoc();
            if($row > 0){
                $new_id = ++$row['id'];
            }
            else{
                $new_id = '1000';
            }
    }else{
        $data = array('status' => false, 'data' => $db->error);
    }
    return $new_id;
}

function khar($db){
    $date = array();
    $mess = array();
    $id = $_POST['id'];
    $s = "SELECT * FROM `photo` WHERE folder_name_id = '$id'";
    $r = $db->query($s);
    if($r){
        while($row = $r->fetch_assoc()){
            $date [] = $row;
        }
        $mess = array('status' => true,'data' => $date);
    }else{
        $mess = array('status' => false, 'data' => $db->error);
    }
    echo json_encode($mess);
}

function delete($db){
    $data = array();
    extract($_POST);

    $s = "DELETE FROM photo  WHERE id = '$id'";

    $r = $db -> query($s);
    if($r){
        $ed = "SELECT * FROM category WHERE id='$admin'";
        $de = $db->query($ed);
        $row = $de->fetch_assoc();
        $number = $row['number'];
        $kuda = $number - 1;
        $query = "UPDATE `category` SET `number`='$kuda' WHERE id = '$admin'";
        $conn = $db->query($query);
        if($conn){
        unlink('../images/photo/'.$id.'.png');
        $data = array('status' => true,'data' => 'Delete photo ');
        }
    }
    else{
        $data = array('status' => false, 'data' => $db->error);
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