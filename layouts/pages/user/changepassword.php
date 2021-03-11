<!DOCTYPE html>
<html>
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../assets/css/login.css">

    <title>Đổi Mật Khẩu - <?=$settings['title']?></title>

    </head>
    <body>
        <div class="container">
          <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
              <div class="card card-signin my-5">
                <div class="card-body">
                  <h5 class="card-title text-center">Đổi Mật Khẩu</h5>
                  <?php
                    if (isset($messages)):
                        foreach($messages as $message):
                  ?>
                    <div class="alert alert-<?=$message['type']?>"><?=$message['content']?></div>
                  <?php
                        endforeach;
                    endif;
                  ?>
                  <form class="form-signin" action="" method="POST">
                    <div class="form-label-group">
                      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required>
                      <label for="inputPassword">Mật khẩu</label>
                    </div>
                    <div class="form-label-group">
                      <input name="newpassword" type="password" id="inputNewPassword" class="form-control" placeholder="Mật khẩu mới" required>
                      <label for="inputNewPassword">Mật khẩu mới</label>
                    </div>
                    <div class="form-label-group">
                      <input name="repassword" type="password" id="inputRePassword" class="form-control" placeholder="Nhập lại mật khẩu" required>
                      <label for="inputRePassword">Nhập lại mật khẩu</label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Đổi Mật Khẩu</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
</html>