<?php

$stmt = $conn->prepare("SELECT COUNT(*) AS total FROM `contests`");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$row = mysqli_fetch_assoc($result);

$total_records = $row['total'];

$current_page = isset($_GET['page']) ? abs(intval($_GET['page'])) : 1;
$config = array(
    'current_page'  => $current_page,
    'total_record'  => $total_records,
    'limit'         => 10,
    'link_full'     => '/contest.php?action=index&page={page}',
    'link_first'    => '/contest.php?action=index',
    'range'         => 9,
);

$paging = new Pagination();
$paging->init($config);
    
?>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Mã bài thi</th>
      <th scope="col">Mã môn học</th>
      <th scope="col">Tên môn học</th>
	  <th scope="col">Nhóm</th>
      <th scope="col">Giảng viên</th>
      <th scope="col">Thao tác</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $stmt = $conn->prepare("SELECT * FROM `contests` ORDER BY `id` DESC LIMIT " . $paging->_config['start'] . ", " . $paging->_config['limit']);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0)
        {
            while($row = $result->fetch_assoc()):
                $title = explode("_", $row['title']);
    ?>
            <tr>
              <th scope="row"><?=$row['id']?></th>
              <td><?=$row['elearning_id']?></td>
              <td><?=substr($title['0'], 0, 7)?></td>
              <td><?=(isset($title['1']) ? $title['1'] : '')?></td>
              <td><?=(isset($title['2']) ? $title['2'] : '')?></td>
              <td><?=(isset($title['3']) ? $title['3'] : '')?></td>
              <td>
                <a href="/contest.php?action=edit&id=<?=$row['id']?>">
                      <button class="btn btn-success btn-sm">
                      <i class="fas fa-edit"></i>
                    </button>
                </a>
                <a href="/contest.php?action=edit&delete=true&id=<?=$row['id']?>" onclick="return confirm('Bạn có muốn chắc chắn muốn cuộc thi này ? (XOÁ THẬT 100%, KHÔNG THỂ KHÔI PHỤC)')">
                      <button class="btn btn-danger btn-sm">
                      <i class="fas fa-trash"></i>
                    </button>
                </a>
              </td>
            </tr>
            <?php
            endwhile;
        }
        $conn->close();
    ?>
  </tbody>
</table>

<?php
echo $paging->html();