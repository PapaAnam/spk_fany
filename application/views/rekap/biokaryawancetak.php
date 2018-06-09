<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<link rel="shortcut icon" href="<?= base_url() ?>images/app/<?= $this->config->item('favicon') ?>">
	<?php 
	if(strrpos(uri_string(), 'pdf') === false){
		?>
		<style>
		*, table, body, thead, tr, th, td {
			font-family: <?= $this->config->item('font_rekap') ?> !important;
		}
	</style>
	<?php 
}else{
	?>
	<?php
}
?>
<style>
@media print {
    body {
        -webkit-print-color-adjust: exact;
    }
}
.kertas{
    /*width: 740px;*/
    margin-left: none;
}
.kertas .tlogo{
    /*width: 350px;*/
    overflow: hidden;
}
.kertas .tlogo .logo{
    position: absolute;
    left: 10px;
}
img{
    width: 70px;
    height: 70px;
}
.kertas .judul{
    padding: 5px;
}
h3 {
    text-align: center;
}

table {
    border-collapse: collapse;
    width: 100%;
}

td {
    border: 1px #777777 solid;
    padding: 5px;
}

.atas {
    background-color: #00aaff;
    font-weight: bold;
    text-align: center;
}
h2 {
    text-align: center;
}
.atas {
	background-color: <?= $this->config->item('thead_bg') ?> !important;
}
table, tr, td {
	border: none;
}
table {
	width: 75%;
}
.foto {
	position: absolute;
	top: 160px;
	right: 50px;
}
.foto img {
	border: 2px solid black;
	width: 100px;
	height: 125px;
	padding: 2px;
}
</style>
</head>
<body>
	<div class="kertas">
		<div class="tlogo">
			<div class="logo">
				<img src="<?=base_url().'images/app/'.$this->config->item('logo') ?>">
			</div>
			<div class="judul">
				<h2><?= $this->config->item('nama_pt') ?></h2>
			</div>
		</div>
		<hr>
		<h3>BIODATA KARYAWAN</h3>
		<div class="bio">
			<table>
				<tr>
					<td width="180px">NIP KARYAWAN</td>
					<td width="10px">:</td>
					<td><?= strtoupper($nip_karyawan)?></td>
				</tr>
				<tr>
					<td>NAMA KARYAWAN</td>
					<td>:</td>
					<td><?= strtoupper($nama_karyawan)?></td>
				</tr>
				<tr>
					<td>NIK</td>
					<td>:</td>
					<td><?= strtoupper($nik)?></td>
				</tr>
				<tr>
					<td>JENIS KELAMIN</td>
					<td>:</td>
					<td><?= strtoupper($jk_karyawan)?></td>
				</tr>
				<tr>
					<td>STATUS</td>
					<td>:</td>
					<td><?= strtoupper($status_karyawan)?></td>
				</tr>
				<tr>
					<td>NO TELP</td>
					<td>:</td>
					<td><?= strtoupper($no_telp)?></td>
				</tr>
				<tr>
					<td>JABATAN</td>
					<td>:</td>
					<td><?= strtoupper($nama_jabatan)?></td>
				</tr>
				<tr>
					<td>GAJI POKOK</td>
					<td>:</td>
					<td><?= strtoupper(rupiah($gaji_pokok))?></td>
				</tr>
				<tr>
					<td>TUNJANGAN</td>
					<td>:</td>
					<td><?= strtoupper(rupiah($tunjangan))?></td>
				</tr>
				<tr>
					<td>TRANSPORTASI</td>
					<td>:</td>
					<td><?= strtoupper(rupiah($transportasi))?></td>
				</tr>
				<tr>
					<td>PULSA</td>
					<td>:</td>
					<td><?= strtoupper(rupiah($pulsa))?></td>
				</tr>
			</table>
		</div>
	</div>
	<script>
		window.print();
	</script>
</body>
</html>