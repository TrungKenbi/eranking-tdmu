<?php
define('TRUNGKENBI', true);
require_once('../includes/core.php');
    

if (isset($_POST['password']) && isset($_POST['newpassword']) && isset($_POST['repassword']))
{
    $password = md5($_POST['password']);
    $newPassword = md5($_POST['newpassword']);
    $rePassword = md5($_POST['repassword']);
    
    
    if ($newPassword != $rePassword)
    {
        $messages[] = [
            'type' => 'warning',
            'content' => 'Nhập lại mật khẩu không chính xác !'
        ];
        goto viewHTML;
    }
    
    
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE `id` = ? AND `password` = ? LIMIT 1");
    $stmt->bind_param("is", $_partner['id'], $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result->num_rows === 0)
    {
        $messages[] = [
            'type' => 'warning',
            'content' => 'Mật khẩu cũ không chính xác !'
        ];
    } else {
        $stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `id` = ?");
        $stmt->bind_param("si", $newPassword, $_partner['id']);
        $stmt->execute();
        $stmt->close();
        $messages[] = [
            'type' => 'success',
            'content' => 'Đổi mật khẩu thành công !'
        ];
    }
}

viewHTML:
require_once('../layouts/pages/user/changepassword.php');