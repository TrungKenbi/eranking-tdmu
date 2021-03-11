<?php
define('TRUNGKENBI', true);
require_once('includes/core.php');

?><html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="/assets/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bungee" rel="stylesheet">
    
    
    <title>Ranking TDMU Coder</title>
  </head>
  <body>
    
    
    
    <h2 class="text-center display-4" style="font-family: 'Bungee', cursive; padding-top: 30px;">CÁC CUỘC THI</h2>
    
    <div class="container">
	<div class="row">
	<div class="col-12">
    <div class="table-responsive-xl">
    <table class="table table-striped">
      <thead class="thead-dark">
        <tr>
          <th scope="col" class="text-center">#</th>
          <th scope="col" class="text-left" style="padding-left: 40px">Mã bài thi</th>
          <th scope="col" class="text-center">Mã môn học</th>
          <th scope="col" class="text-center">Tên môn học</th>
		  <th scope="col" class="text-center">Nhóm</th>
          <th scope="col" class="text-center">Giảng viên</th>
        </tr>
      </thead>
      <tbody>
        <?php
        
            $stmt = $conn->prepare("SELECT * FROM `contests` WHERE `enable` = '1' ORDER BY `id` DESC LIMIT 10");
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            if ($result->num_rows > 0):
                while($row = $result->fetch_assoc()):
                    $title = explode("_", $row['title']);
        ?>
        <tr class="clickable-row" data-href="/ranking.php?id=<?=$row['elearning_id']?>">
			<th class="text-center align-middle" scope="row">
				<?=$row['id']?>
			</th>
			<td class="text-left align-middle" style="padding-left: 40px">
			    <?=$row['elearning_id']?>
			</td>
			<td class="text-center align-middle">
			    <?=substr($title['0'], 0, 7)?>
			</td>
			<td class="text-left align-middle">
			    <a href="/ranking.php?id=<?=$row['elearning_id']?>"><?=(isset($title['1']) ? $title['1'] : '')?></a>
			</td>
			<td class="text-center align-middle">
			    <?=(isset($title['2']) ? $title['2'] : '')?>
			</td>
			<td class="text-center align-middle">
			    <?=(isset($title['3']) ? $title['3'] : '')?>
			</td>
        </tr>
        <?php
		        endwhile;
		    endif;
		?>
      </tbody>
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
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>
  </body>
</html>