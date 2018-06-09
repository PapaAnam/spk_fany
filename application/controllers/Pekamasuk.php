<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pekamasuk extends CI_Controller {
	protected function inP($v){
		return $this->input->post($v);
	}
	function __construct(){
		parent::__construct();
		if(!empty($this->session->userdata('username')) || !empty($this->session->userdata('level')) || !empty($this->session->userdata('id_pengguna'))){
			redirect(base_url().'peka');
		}
		$this->load->helper('security');
	}
	public function index(){
		$this->load->view('masuk');
	}
	function cek(){
		$u = $this->inP('username');
		$p = do_hash($this->inP('password'), 'md5');
		$cek = $this->GajiModel->cekuser($u, $p);
		if(is_numeric($cek)){
			$pengguna = $this->GajiModel->view('pengguna', array('nama_pengguna'=>$u));
			foreach ($pengguna as $p) {
				$level = $p->level_pengguna;
				$id_pengguna = $p->id_pengguna;
				$foto_pengguna = $p->foto_pengguna;
			}
			$this->session->set_userdata(array('username'=>$u, 'level'=>$level, 'id_pengguna'=>$id_pengguna, 'foto_pengguna'=>$foto_pengguna));
			redirect(base_url());
		}else{
			$this->session->set_flashdata('error', $cek);
			redirect(base_url().'pekamasuk');
		}
	}
}
