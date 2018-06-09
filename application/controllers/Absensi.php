<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi extends CI_Controller {

	// public function __construct()
	// {
	// 	$this->load->model('absensimodel');
	// }

	function absensi_masuk()
	{
		if(count($this->AbsensiModel->cek_absensi_hari_ini())>0)
			return redirect('peka');
		$this->AbsensiModel->set_jam_keluar(null);
		$this->AbsensiModel->absensi_masuk();
		return redirect('peka');
	}

	function absensi_keluar()
	{
		if($this->AbsensiModel->absensi_keluar())
			return redirect('peka');

	}
}