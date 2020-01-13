<?php
$db = new PDO('mysql:host=127.0.0.1;dbname=s1080401;charset=utf8', 'root', '');

$sql = 'SELECT * FROM 01_account WHERE acc LIKE "'.$_POST['acc'].'"';
$rows = $db->query($sql)->fetchAll();

// if (empty($_SESSION['logincount'])) $_SESSION['logincount'] = 1;

if ($_POST['acc'] == $rows[0]['acc'] && $_POST['psw'] == $rows[0]['psw']) {
    session_start();
    $_SESSION['user'] = $rows[0]['acc'];
    echo "<script>
    alert('歡迎登入');
    document.location.href='explore.php';
    </script>";
    $_SESSION['logincount']++;
} else {
    echo "<script>alert('帳號或密碼錯誤');
    window.history.back();
    </script>";
}
?>
