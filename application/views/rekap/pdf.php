<link rel="shortcut icon" href="<?= base_url() ?>images/app/<?= $this->config->item('favicon') ?>">
<link rel="stylesheet" href="<?= base_url().'asset/css/pdf.css' ?>">
<style>
.atas {
	background-color: <?= $this->config->item('thead_bg') ?> !important;
}
</style>
<div class="tlogo">
    <div class="logo">
        <img src="<?=base_url().'images/app/'.$logo ?>">
    </div>
    <div class="judul">
        <h2><?= $title ?></h2>
    </div>
</div>
<hr>