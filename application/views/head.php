<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Sistem Penggajian Karyawan">
	<meta name="author" content="Hairul Anam">
	<meta name="keyword" content="Sistem Penggajian Karyawan berbasis web menggunakan bahasa pemrograman PHP">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Penggajian Karyawan</title>
  <!-- start: Css -->
  <link rel="stylesheet" type="text/css" href="<?= base_url('asset/css/bootstrap.min.css') ?>">
  <!-- plugins -->
  <link rel="stylesheet" type="text/css" href="<?= $burl ?>asset/css/plugins/font-awesome.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?= $burl ?>asset/css/plugins/simple-line-icons.css"/>
  <link rel="stylesheet" type="text/css" href="<?= $burl ?>asset/css/plugins/animate.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?= $burl ?>asset/css/plugins/datatables.bootstrap.min.css"/>
  <link rel="stylesheet" type="text/css" href="<?= $burl ?>asset/css/plugins/bootstrap-material-datetimepicker.css"/>
  <link rel="stylesheet" type="text/css" href="<?= $burl ?>asset/css/buttons.dataTables.min.css"/>
  <link href="<?= $burl ?>asset/css/style.css" rel="stylesheet">
  <!-- end: Css -->
  <link rel="shortcut icon" href="<?= base_url() ?>images/app/<?= $this->config->item('favicon') ?>">
  <style type="text/css">
  .lurus{
    display: table-row;
  }
  .key{
    display: table-cell;
    padding: 5px;
    padding-right: 30px;
  }
  .value{
    display: table-cell;
  }
  .mdl{
    cursor: pointer;
  }
  table{
    /*background-image: url('<?=base_url().'images/app/bg_table.png'?>')!important;  */
    background-position: center; 
    background-size: 300px 300px; 
    background-repeat: no-repeat;
  }
  @media only screen and (max-width: 900px){
    .search-nav{
      display: none;
    }
  }

  #content {
    margin-top: 0;
    overflow-x: hidden;
  }

  #mimin {
    overflow-x: hidden;
  }

  .navbar {
    height: 55px;
    background-color: #dd2233;
  }

  .btn-primary{
    background-color: #dd2233 !important;
  }

  .avatar {
    border: 4px solid #ee1111 !important;
  }

  .alert-danger, .bg-danger {
    background-color: #dd2233 !important;
  }

</style>
</head>