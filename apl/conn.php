<?php
$db = new mysqli('localhost','root','','somphoto');

if($db->connect_error){
    echo $db->error;
}else{
}

?>