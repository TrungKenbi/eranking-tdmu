<?php
define('TRUNGKENBI', true);
require_once('includes/core.php');

require_once('layouts/pages/index.php');

$content = ob_get_contents();
ob_clean();
ob_end_flush();

require_once('layouts/main.php');