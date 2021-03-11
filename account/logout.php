<?php

define('TRUNGKENBI', true);
require_once('../includes/core.php');

if (isset($_SESSION['id']))
{
    session_destroy();
}

header('Location: ' . $settings['base_url'] . '/account/login.php');