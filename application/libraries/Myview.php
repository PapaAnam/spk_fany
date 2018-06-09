<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Myview {

	public function view($path_view, $data_oper)
	{
		$ci =& get_instance();
		$pengguna = $ci->GajiModel->view('pengguna', array('id_pengguna'=>$ci->session->userdata('id_pengguna')));
		$foto = '';
		$myprofil = base_url('penggunaubah/'. $ci->session->userdata('id_pengguna'));
		foreach ($pengguna as $p) {
			$foto = base_url().'images/pengguna/'.$p->foto_pengguna;
			$nickname = $p->nama_pengguna;
		}
		if($ci->session->userdata('level')!=3){
	        // $nickname = $ci->session->userdata('username');
		}else{
			$karyawan = $ci->GajiModel->view('karyawan',array('nip_karyawan'=>$ci->session->userdata('username')));
			foreach ($karyawan as $key) {
				$nickname 	= $key->nama_karyawan;
				// $foto 		= base_url().'images/karyawan/'.$key->foto_karyawan;
			}
			$myprofil = base_url().'karyawanrinci/'. $ci->session->userdata('username');
		}
		$oper = array(
			'burl'				=> base_url(), 
			'url'				=> base_url('peka/'), 
			'foto_pengguna'		=> $foto,
			'nickname'			=> $nickname,
			'myprofil'			=> $myprofil,
			'lvl'				=> $ci->session->userdata('level')
		);
		$ci->load->view('head', $oper);
		$ci->load->view('header');
		$ci->load->view($path_view, $data_oper);
		$ci->load->view('mobile');
		$ci->load->view('foot');
	}

}