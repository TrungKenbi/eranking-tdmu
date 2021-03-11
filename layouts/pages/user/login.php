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

    <title>Đăng Nhập - <?=$settings['title']?></title>

    </head>
    <body>
        <div class="container">
          <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
              <div class="card card-signin my-5">
                <div class="card-body">
                  <h5 class="card-title text-center">Đăng Nhập Hệ Thống</h5>
                  <?php
                    if (isset($errors)):
                        foreach($errors as $error):
                  ?>
                    <div class="alert alert-warning"><?=$error?></div>
                  <?php
                        endforeach;
                    endif;
                  ?>
                  <form class="form-signin" action="" method="POST">
                    <div class="form-label-group">
                      <input name="username" type="text" id="inputUsername" class="form-control" placeholder="Tài khoản" value="<?=(isset($_POST['username']) ? strip_tags($_POST['username']) : '')?>" required autofocus>
                      <label for="inputUsername">Tài khoản</label>
                    </div>
      
                    <div class="form-label-group">
                      <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Mật khẩu" required>
                      <label for="inputPassword">Mật khẩu</label>
                    </div>
      
                    <div class="custom-control custom-checkbox mb-3">
                      <input name="remember" type="checkbox" class="custom-control-input" id="customCheck1">
                      <label class="custom-control-label" for="customCheck1">Nhớ mật khẩu</label>
                    </div>
                    <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Đăng Nhập</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </body>
</html>