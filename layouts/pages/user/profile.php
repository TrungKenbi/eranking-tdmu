<?php

$status = [
    '<span class="badge badge-danger">OFF</span>',
    '<span class="badge badge-success">ON</span>',
];


?><div class="row text-left" style="padding-top:20px">
    <div class="col-md-3">
        
    </div>
    <div class="col-md-6">
        <h2>Thông tin tài khoản</h2>
        <table class="table table-bordered">
        <tbody>
          <tr>
            <td>ID</td>
            <td><b><?=$_user['id']?></b></td>
          </tr>
          <tr>
            <td>Tài khoản</td>
            <td><b><?=$_user['username']?></b></td>
          </tr>
        </tbody>
        </table>
    </div>
</div>
