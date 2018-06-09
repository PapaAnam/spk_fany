<style>
@media print {
	body {
		-webkit-print-color-adjust: exact;
	}
}
.tlogo{
	overflow: hidden;
}
.tlogo .logo{
	position: absolute;
	left: 10px;
}
.logo img{
	width: 70px;
	height: 70px;
}
.judul{
	padding: 5px;
}

h2 {
	text-align: center;
}
</style>
<div class="tlogo">
	<div class="logo">
		<img src="<?=base_url().'images/app/'.$this->config->item('logo') ?>">
	</div>
	<div class="judul">
		<h2><?= $this->config->item('nama_pt') ?></h2>
	</div>
</div>
<hr>