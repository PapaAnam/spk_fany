<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<link rel="shortcut icon" href="<?= base_url() ?>images/app/<?= $this->config->item('favicon') ?>">
	<link rel="stylesheet" href="<?= base_url().'asset/css/rekap.css' ?>">
	<style>
		*, table, body, thead, tr, th, td {
			font-family: <?= $this->config->item('font_rekap') ?> !important;
		}
		.atas {
			background-color: <?= $this->config->item('thead_bg') ?> !important;
		}
	</style>
</head>