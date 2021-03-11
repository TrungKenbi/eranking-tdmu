<?php
define('TRUNGKENBI', true);
require_once('../includes/core.php');

if (isset($_SESSION['partner_id'])) {
    header('Location: ' . $settings['base_url']);
    exit;
}
    

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $isRemember = (boolean)isset($_POST['remember']) ? $_POST['remember'] : false;
    
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `username` = ? AND `password` = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result->num_rows === 0)
    {
        $errors[] =  ' Tài khoản hoặc mật khẩu không chính xác !!!! ';
    } else {
        $user = $result->fetch_assoc();
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        
        if ($isRemember) {
            setcookie('id', $user['id'], time() + (86400 * 30), "/");
            setcookie('username', $user['username'], time() + (86400 * 30), "/");
        }
        
        header('Location: ../admin.php');
    }
}

require_once('../layouts/pages/user/login.php');