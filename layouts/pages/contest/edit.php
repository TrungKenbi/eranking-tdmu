<?php

const CONTEST_INDEX = '/contest.php?action=index';

if (!isset($_GET['id'])) {
    header('Location: ' . CONTEST_INDEX);
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM `contests` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows <= 0) {
    header('Location: ' . CONTEST_INDEX);
    exit;
}

$contest = $result->fetch_assoc();

if (isset($_GET['delete'])) {
    $stmt = $conn->prepare("DELETE FROM `contests` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    unlink(BASE_PATH . '/data/' . $contest['elearning_id'] . '.json');
    header('Location: ' . CONTEST_INDEX);
    exit;
}

if (isset($_POST['elearning_id'])) {
    $message = [
        'type' => 'warning',
        'content' => ''
    ];
    
    $elearningId = $_POST['elearning_id'];
    
    
    /**** VALIDATE ****/
    
    if ($elearningId <= 0) {
        $message['content'] = 'Mã bài tập không hợp lệ !!!';
        goto PROCESS_END;
    }
    
    $stmt = $conn->prepare("SELECT * FROM `contests` WHERE `elearning_id` = ?");
    $stmt->bind_param("i", $elearningId);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result->num_rows > 0) {
        $message['content'] = 'Cuộc thi đã tồn tại, không thể thêm nữa !';
        goto PROCESS_END;
    }
    
    if (!get_contest_result_by_json($elearningId)) {
        $message['content'] = 'Hệ thống không thể lấy danh sách thí sinh dự thi, vui lòng thử lại sau !';
        goto PROCESS_END;
    }
    
    $title = get_title_contest($elearningId);
    if (!$title) {
        $message['content'] = 'Hệ thống không thể lấy tên cuộc thi, vui lòng thử lại sau !';
        goto PROCESS_END;
    }
    
    /**** END VALIDATE ****/
    
    $stmt = $conn->prepare("UPDATE `contests` SET `elearning_id` = ?, `title` = ? WHERE `id` = ?");
    $stmt->bind_param("isi", $elearningId, $title, $id);
    $stmt->execute();
    $stmt->close();
    
    $message['type'] = 'success';
    $message['content'] = 'Sửa cuộc thi thành công !';
    
    $contest['elearning_id'] = $elearningId;
    
    PROCESS_END:
}
    
?>

<div class="row" style="padding-top: 20px">
    <div class="col-md">
        <h2>CHỈNH SỬA CUỘC THI</h2>
        <form method="POST">
            <div class="form-group">
                <?php if (isset($message)): ?>
                    <div class="alert alert-<?=$message['type']?>">
                        <?=$message['content']?>
                    </div>
                <?php endif; ?>
                <label for="elearning_id">Elearning ID:</label>
                <input type="number"
                    class="form-control"
                    id="elearning_id"
                    placeholder="Nhập mã bài tập trên Elearning"
                    name="elearning_id"
                    value="<?=$contest['elearning_id']?>"
                >
            </div>
            <button type="submit" class="btn btn-primary">Chỉnh sửa cuộc thi</button>
        </form>
    </div>
</div>