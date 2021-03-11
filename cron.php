<?php

define('TRUNGKENBI', true);
require_once('includes/core.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : false;

if ($id) {
    $filename = BASE_PATH . '/data/' . $id . '.json';
    if(!file_exists($filename) OR (filemtime($filename) < (time() - 30))) {
        get_contest_result_by_json($id);
    	echo $id . ': OK <br>';
    }
	exit();
}

$stmt = $conn->prepare("SELECT * FROM `contests` WHERE `enable` = '1' ORDER BY `id` DESC LIMIT 10");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
while($row = $result->fetch_assoc()) {
    // Anti spam request
    $filename = BASE_PATH . '/data/' . $row['elearning_id'] . '.json';
    if(!file_exists($filename) OR (filemtime($filename) < (time() - 30))) {
		get_contest_result_by_json($row['elearning_id']);
		echo $row['elearning_id'] . ': OK <br>';
	}
}

echo 'Done !';