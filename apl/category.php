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
        $s = "INSERT INTO `category`(`id`, `name`, `image`, `user_id`,`number`) VALUES ('$new_id','$name','$save_name','$user_id','0 ')";
        $r = $db->query($s);
        if($r){
            move_uploaded_file($_FILES['image']['tmp_name'],'../images/category/'.$save_name);
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
    $s = "SELECT * FROM `category` order by category.id desc limit 1";
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

function khar($db){
    $date = array();
    $mess = array();
    $id = $_POST['id'];
    $s = "SELECT * FROM `category` WHERE user_id = '$id'";
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

function all($db){
    $date = array();
    $mess = array();
    $id = $_POST['id'];
    $s = "SELECT * FROM `category` WHERE id = '$id'";
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

function update($db){
    extract($_POST);
    $data =array();
    if($_FILES['image']['name']){
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
        extract($_POST);
        $save_name = $box_id . '.png';
    
        if(count($er) <= 0){
            $s = "UPDATE category SET name='$name' WHERE id= '$box_id'";
            $r = $db->query($s);
            if($r){
                move_uploaded_file($_FILES['image']['tmp_name'],'../images/category/'.$save_name);
                $data = array('status' => true,'data' => 'is sax hay ayaah loo updategareey');
        
            }else{
                $data = array('status' => false, 'data' => $db->error);
            }
        }else{
            $data = array('status' => false, 'data' => $er);
        }
    }
    else{
        extract($_POST);
        $s = "UPDATE category SET name='$name' WHERE id= '$box_id'";
        $r = $db -> query($s);
        if($r){
            $data = array('status' => true,'data' => 'is sax hay ayaah loo updategareey');
        }
        else{
            $data = array('status' => false, 'data' => $db->error);
        }
    }
    echo json_encode($data);
}
function delete($db){
    $data = array();
    extract($_POST);

    $s = "DELETE FROM category  WHERE id = '$id'";

    $r = $db -> query($s);
    if($r){
        unlink('../images/category/'.$id.'.png');
        $data = array('status' => true,'data' => 'Delete category ');
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