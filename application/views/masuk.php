<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Sistem Penggajian Karyawan">
  <meta name="author" content="Hairul Anam">
  <meta name="keyword" content="Sistem Penggajian Karyawan berbasis web menggunakan bahasa pemrograman PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk Sistem Penggajian Karyawan</title>
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/css/plugins/animate.min.css"/>
  <link href="<?= base_url() ?>asset/css/style.css" rel="stylesheet">
  <link rel="shortcut icon" type="images/icon" href="<?= base_url() ?>images/app/<?=$this->config->item('favicon')?>">
  <style type="text/css">
  .form-signin-wrapper {
    background: #dd2233 !important
  }
  .form-signin .panel {
    background: #EE3322;
    color: #fff;
    padding: 10px;
    border: none !important;
    box-shadow: 0 7px 16px #EE5555, 0 4px 5px #EE3322;
  }
  .form-signin .panel-heading2 {
    padding: 2px;
    border-bottom: 1px solid #ff3333;
    text-align: center;
    margin-bottom: 0;
  }
</style>
</head>
<body id="mimin" class="dashboard form-signin-wrapper">
  <div class="container">
    <form style="margin-top: 20px;" class="form-signin" action="<?= base_url()?>pekamasuk/cek" method="post">
      <h3 style="margin-bottom: 50px; font-size: 20px;" class="text-center text-white"><?=$this->config->item('nama_pt')?></h3>
      <div class="panel periodic-login">
        <div class="panel-heading2" style="margin-bottom: 20px;">
          <div style="float: left; width: 100px; border: 5px solid #EE3333; box-shadow: 1px 1px 10px black; border-radius: 10px;">
            <img style="border-radius: 5px;" src="<?=base_url().'images/app/'.$this->config->item('logo') ?>" width="90px" height="90px">
          </div>
          <div style="margin-top: 20px !important; font-size: 16px; font-weight: bold;">
            PENGGAJIAN KARYAWAN
          </div>
        </div>
        <div class="panel-body text-center">
          <?php 
          if($this->session->flashdata('error')){
            echo '<font color="red">'.$this->session->flashdata('error').'</font>';
          }
          ?>
          <div class="form-group form-animate-text" style="margin-top:40px !important;">
            <input type="text" class="form-text" required name="username">
            <span class="bar"></span>
            <label>Nama Pengguna</label>
          </div>
          <div class="form-group form-animate-text" style="margin-top:40px !important;">
            <input type="password" class="form-text" required name="password">
            <span class="bar"></span>
            <label>Kata sandi</label>
          </div>
          <input type="submit" class="btn" style="width: 100%;" value="Masuk"/>
        </div>
      </div>
    </form>
  </div>
</body>
</html>