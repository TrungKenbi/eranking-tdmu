<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?=$settings['admin_url']?>"><?=$settings['title']?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/" target="_blank">Trang chủ <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Cuộc Thi
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/contest.php?action=index">Danh Sách Cuộc Thi</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/contest.php?action=add">Thêm Cuộc Thi Mới</a>
        </div>
      </li>
    </ul>  
	<ul class="navbar-nav">  
	  <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Xin chào, <?=$_user['username']?>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/account/profile.php">Thông Tin</a>
            <a class="dropdown-item" href="/account/changepassword.php">Đổi Mật Khẩu</a>
            <a class="dropdown-item" href="/account/logout.php">Thoát</a>
        </div>
    </li>
	  
	  
    </ul>
  </div>
</nav>