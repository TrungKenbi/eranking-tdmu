<?php
define('TRUNGKENBI', true);
require_once('../includes/core.php');

if (empty($_SESSION['id']))
{
    header('Location: ' . $settings['base_url']);
    exit;
}

require_once('../layouts/pages/user/profile.php');

$content = ob_get_contents();
ob_clean();
ob_end_flush();

require_once('../layouts/main.php');

