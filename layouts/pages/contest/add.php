<?php

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
        $message['content'] = 'Hệ thống không thể tên cuộc thi, vui lòng thử lại sau !';
        goto PROCESS_END;
    }
    
    /**** END VALIDATE ****/
    
    $stmt = $conn->prepare("INSERT INTO `contests` (`elearning_id`, `title`) VALUES (?, ?)");
    $stmt->bind_param("is", $elearningId, $title);
    $stmt->execute();
    $stmt->close();
    
    $message['type'] = 'success';
    $message['content'] = 'Thêm cuộc thi thành công !';
    PROCESS_END:
}
    
?>

<div class="row" style="padding-top: 20px">
    <div class="col-md">
        <h2>THÊM CUỘC THI</h2>
        <form method="POST">
            <div class="form-group">
                <?php if (isset($message)): ?>
                    <div class="alert alert-<?=$message['type']?>">
                        <?=$message['content']?>
                    </div>
                <?php endif; ?>
                <label for="elearning_id">Elearning ID:</label>
                <input type="number" class="form-control" id="elearning_id" placeholder="Nhập mã bài tập trên Elearning" name="elearning_id">
            </div>
            <button type="submit" class="btn btn-primary">Thêm cuộc thi</button>
        </form>
    </div>
</div>

