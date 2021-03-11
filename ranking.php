<?php


// URL GET DATA: https://elearning.tdmu.edu.vn/mod/quiz/report.php?download=json&mode=overview&id=267228

// error_reporting(E_ALL);

function showLogoRank($exp)
{
	$exp *= 65;
    $lv = (((int)sqrt(1+($exp*50)/125))>>1);
    return ($lv >= 8 ? 8 : $lv);
}

function statusIcon($time)
{
    $icon = array(
        '0' => '<i class="fas fa-smile text-success"></i>',
        
        '1' => '<i class="fas fa-smile text-success"></i>',
        '2' => '<i class="fas fa-smile text-success"></i>',
        '3' => '<i class="fas fa-smile text-success"></i>',
        '4' => '<i class="fas fa-smile text-success"></i>',
        
        '5' => '<i class="fas fa-meh text-primary"></i>',
        '6' => '<i class="fas fa-meh text-primary"></i>',
        '7' => '<i class="fas fa-meh text-primary"></i>',
        
        '8' => '<i class="fas fa-frown text-warning"></i>',
        '9' => '<i class="fas fa-frown text-warning"></i>',
        '10' => '<i class="fas fa-frown text-warning"></i>',
        
        '11' => '<i class="fas fa-dizzy text-danger"></i>'
    );
    
    $day = (time() - $time) / (60 * 60 * 24);
    
    return $icon[$day > 11 ? 11 : $day];
    
}


function tinhLvRank($exp_user)
{
    $exp_user *= 65;
    $exp = array(
		0 => '0',
		1 => '8',
		2 => '38',
		3 => '88',
		4 => '158',
		5 => '248',
		6 => '358',
		7 => '488',
		8 => '638',
		9 => '808',
		10 => '998',
		11 => '1208',
		12 => '1438',
		13 => '1688',
		14 => '1958',
		15 => '2248',
		16 => '2558',
		17 => '2888',
		18 => '3238',
		19 => '3608',
		20 => '3998',
		21 => '4408',
		22 => '4838',
		23 => '5288',
		24 => '5758',
		25 => '6248',
		26 => '6758',
		27 => '7288',
		28 => '7838',
		29 => '8408',
		30 => '8998',
		31 => '9608'
    );

    if ($exp_user == 0)
        return 0;
    
    $lv = (((int)sqrt(1+($exp_user*50)/125))>>1);
    
    if ($lv >= 8)
        return 3;
    
    $step = ($exp[$lv + 1] - $exp[$lv]) / 3;
    return (int)(($exp_user - $exp[$lv]) / $step) + 1;
    
}


class Student {
	public $name;
	public $point;
	public $anwsers;
	public $finishedTime;
	function __construct($name, $point, $anwsers, $finishedTime) {
		$this->name = $name;
		$this->point = (float)$point;
		$this->anwsers = $anwsers;
		$this->finishedTime = $finishedTime;
	}
}

function cmp($a, $b) {
	if ($b->point == 0)
		return false;
	if (abs(($a->point-$b->point)/$b->point) < 0.00001) { // point a same point b
		if ($a->finishedTime == 0 || $b->finishedTime == 0)
			return ($a->finishedTime == 0);
		return $a->finishedTime > $b->finishedTime;
	}
	return $a->point < $b->point;
}

function equalsFloat($a, $b) {
    $a = floatval(str_replace(",", ".", $a));
    $b = floatval(str_replace(",", ".", $b));
    if (abs(($a - $b) / $b) < 0.00001)
        return true;
    return false;
}


$id = isset($_GET['id']) ? intval($_GET['id']) : 'demo';
$filename = 'data/' . $id . '.json';

if (!file_exists($filename))
	exit('DATA NOT FOUND!');

// Read data from file JSON
$data = json_decode(file_get_contents($filename));

if (!is_array($data))
	exit('DATA ERROR!');

// Process data
$students = [];
for($i = 0; $i < count($data) - 1; $i++) {
	$name = $data[$i][0] . ' ' . $data[$i][1];
	$point = 0;
	for($j = 9; $j < count($data[$i]); $j++) {
		if ($data[$i][$j] != '-') {
			$point += floatval(str_replace(",", ".", $data[$i][$j]));
		}
	}
	$students[] = new Student($name, $point, array_slice($data[$i], 9, count($data[$i]) - 1), strtotime($data[$i][6]));
}

usort($students, "cmp");

?><!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <meta http-equiv="refresh" content="30">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/assets/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
    
    <style>
	th {
		font-family: 'Bungee', cursive;
	}
	
    img {
        display:inline-block;
    }
    </style>
    
    <title>Ranking TDMU Coder</title>
  </head>
  <body>
    
    
    
    <h2 class="text-center display-4" style="font-family: 'Bungee', cursive; padding-top: 30px;">Bảng Vàng Cao Thủ</h2>
    
    <div class="container">
	<div class="row">
	<div class="col-12">
    <div class="table-responsive-xl">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="text-center">Thứ hạng</th>
          <th scope="col" class="text-left" style="padding-left: 40px">Danh xưng</th>
          <th scope="col" class="text-center">Huy hiệu</th>
		  <th scope="col" class="text-center">Kết quả</th>
          <th scope="col" class="text-center">Điểm số</th>
		  <th scope="col" class="text-center">Hoàn thành</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $i = 1;
        $rank = array('1' => 'danger', '2' => 'success', '3' => 'primary');
        
        foreach($students as $student): ?>
        <tr>
			<th class="text-center align-middle" scope="row">
				<?=($i <= 3 ? '<h' . $i . '>' : '<h5>')?>
					<span class="badge badge-<?=($i <= 3 ? $rank[$i] : 'info')?> rounded-circle">
						<?=$i++;?>
					</span>
				<?=($i <= 3 ? '</h' . $i . '>' : '</h5>')?>
			</th>
			<td class="text-left align-middle">
				<h6><span style="color:black;"><?=$student->name?></span></h6>
			</td>
			<td class="text-center align-middle">
			  <img src="./assets/rank/<?=(showLogoRank($student->point))?>.png" class="img" width="35"> 
				<br>
				<?php for($j = 0; $j < tinhLvRank($student->point); $j++): ?>
					<img src="./assets/rank/star.png">
				<?php endfor; ?>

			</td>
			<td class="align-middle">
				<table class="table table-bordered">
					<?php $numQuestion = count($student->anwsers); ?>
					<?php for($k = 1; $k <= $numQuestion; $k++): ?>
                    <?php $point = $student->anwsers[$k - 1]; ?>
					<?=$k % 10 == 1 ? '<tr>' : '' ?>
					<td>
						<span class="badge badge-<?=$point != '-' ? (!equalsFloat($point, 10.0 / $numQuestion) ? 'warning' : 'success') : 'danger' ?>">
                            <?=$k?>: <i class="fas fa-<?=$point != '-' ? 'check' : 'times' ?>"></i>
						</span>
					</td>
					<?=$k % 10 == 0 ? '</tr>' : '' ?>
					<?php endfor; ?>
				</table>
			</td>
			<td class="text-center align-middle" style="font-family: 'Bungee', cursive;"><?=$student->point?></td>
			<td class="text-center align-middle"><?=($student->finishedTime != 0 ? date("H:i d/m/Y", $student->finishedTime) : '-')?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
      <tfoot class="thead-dark">
        <tr>
          <th scope="col" class="text-center">Thứ hạng</th>
          <th scope="col" class="text-left">Danh xưng</th>
          <th scope="col" class="text-center">Huy hiệu</th>
		  <th scope="col" class="text-center">Kết quả</th>
          <th scope="col" class="text-center">Điểm số</th>
		  <th scope="col" class="text-center">Hoàn thành</th>
        </tr>
      </tfoot>
    </table>
	</div>
	</div>
	</div>
	</div>

    
    <hr>
    <footer>
      <div class="text-center"
        <p>© <?=date("Y")?> Ranking TDMU Coder design and development by <span class="badge badge-danger">Innovation Lab TDMU</span> with ❤️</p>
      </div>
    </footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
        setInterval(function() {
            fetch('/cron.php?id=<?=$id?>')
            .then(function() {
                console.log('Updated');
            });
        }, 10000);
    </script>
  </body>
</html>