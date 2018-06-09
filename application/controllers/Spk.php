<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('username')) || empty($this->session->userdata('level')) || empty($this->session->userdata('id_pengguna'))){
			redirect(base_url().'pekamasuk');
		}
		$this->load->library('myview');
		$this->load->model('GajiModel');
	}

	public function index()
	{
		$datamaster = ['jabatan', 'karyawan', 'pinjaman', 'absensi', 'penggajian'];
		foreach ($datamaster as $d) {
			$oper[$d] = $this->GajiModel->count($d);
		}
		$oper['kar'] = $this->GajiModel->karyawanbaru();
		if($this->session->userdata('level')==3){
			$nip = $this->session->userdata('username');
			$parameter = array(
				'nip_karyawan' 		 => $nip, 
				'status_absensi'	 => 'Masuk', 
				'month(tgl_absensi)' => blnskrng(), 
				'year(tgl_absensi)'  => thnskrng());
			$oper['absensi']	= $this->GajiModel->count('absensi', $parameter);
			$oper['pinjaman']	= $this->GajiModel->totalpinjaman($nip, blnskrng(), thnskrng());
			$bln = blnskrng();
			if($bln==1){
				$bln = 12;
			}else{
				$bln -=1;
			}
			$gaji = $this->GajiModel->view('penggajian', array('penggajian.nip_karyawan'=>$nip, 'bulan_penggajian'=>$bln, 'tahun_penggajian'=>thnskrng()));
			$gajikemarin = 0;
			foreach ($gaji as $key) {
				$gajikemarin = $key->gaji_bersih;
			}
			// $oper['total_jam_lembur']	= $this->GajiModel->totallembur($nip, blnskrng(), thnskrng())['total_jam_lembur'];
			$oper['gajikemarin'] 		= $gajikemarin;
			$jabatan = $this->GajiModel->view('karyawan', array('nip_karyawan'=>$nip));
			// foreach ($jabatan as $key) {
			// 	$oper['hrg_lembur']		= $key->lembur;
			// }
		}
		$this->myview->view('beranda', $oper);
	}

}