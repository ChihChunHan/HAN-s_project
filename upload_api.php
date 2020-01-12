<?php
// session
session_start();
// $_SESSION=$_POST;
// $_SESSION['photo']=$_FILES['photo']['name'];
print_r($_POST);
print_r($_SESSION);

// upload file
// copy($_FILES['photo']['tmp_name'],'file_img/'.$_FILES['photo']['name']);
// delete file
// unlink($_FILES['photo']['tmp_name']);
// 轉址
// header('location:preview.php');

?>