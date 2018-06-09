<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="description" content="Sistem Penggajian Karyawan">
  <meta name="author" content="Hairul Anam">
  <meta name="keyword" content="Sistem Penggajian Karyawan berbasis web menggunakan bahasa pemrograman PHP">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$this->config->item('nama_pt')?></title>  
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>asset/css/plugins/animate.min.css"/>
  <link href="<?= base_url() ?>asset/css/style.css" rel="stylesheet">
  <link rel="shortcut icon" href="<?= base_url() ?>images/app/<?= $this->config->item('favicon') ?>">
</head>
<body id="mimin">
  <div class="col-md-12">
    <center>
      <div class="page-404 animated flipInX">
        <img src="<?= base_url() ?>asset/img/404.png" class="img-responsive"/>
        <a href="<?= base_url().'peka/' ?>"> 
          Ke Beranda
        </br>
        <span class="icons icon-arrow-down"></span>
      </a>
    </div>
  </center>
</div>
</body>
</html>
