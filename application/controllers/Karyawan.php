<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('username')) || empty($this->session->userdata('level')) || empty($this->session->userdata('id_pengguna'))){
			redirect(base_url().'pekamasuk');
		}
		$this->load->model('karyawan_model', 'km');
	}

	public function bio($nip, $opsi)
	{
		$this->load->helper('other');
		$this->load->helper('url');
		$this->load->model('karyawan_model');
		$this->load->library('pdfGenerator');
		$karyawan = $this->karyawan_model->get_by_nip($nip);
		$kar = $karyawan;
		$kar['title'] = 'Bio Karyawan';
		if($opsi=='pdf'){
			$html = $this->load->view('rekap/biokaryawan'.$opsi, $kar, true);
			$this->pdfgenerator->generate($html, 'biokaryawan');
		}else{
			$this->load->view('rekap/biokaryawan'.$opsi, $kar);
		}
	}

	public function index()
	{
		ceklevel();
		$karyawan = $this->GajiModel->view('karyawan');
		$oper = array('kar'=>$karyawan);
		$this->myview->view('karyawan/karyawan', $oper);
	}

	public function tambah()
	{
		ceklevel();
		if($this->input->post('simpan')){
			$this->postKaryawan();
		}else{
			$jabatan 	= $this->GajiModel->view('jabatan');
			$oper 		= [
				'action'	=> base_url().'karyawan/tambah', 
				'jab'		=> $jabatan
			];
			$this->load->view('karyawan/karyawantambah', $oper);
		}
	}

	private function postKaryawan($aksi='insert', $nip=null){
		ceklevel();
		$data['nip_karyawan'] 			= $this->input->post('nip_karyawan');
		$data['nama_karyawan'] 			= $this->input->post('nama_karyawan');
		$data['nik'] 					= $this->input->post('nik');
		$data['no_telp'] 				= $this->input->post('no_telp');
		$data['jk_karyawan'] 			= $this->input->post('jk_karyawan');
		$data['status_karyawan'] 		= $this->input->post('status_karyawan');
		$data['id_jabatan'] 			= $this->input->post('id_jabatan');
		if($aksi === 'update'){
			$hasil = $this->GajiModel->update('karyawan', $data, array('nip_karyawan'=>$nip));
		}else if($aksi === 'delete'){
			$tbl = ['karyawan', 'absensi', 'pinjaman', 'penggajian'];
			foreach ($tbl as $t) {
				$hasil = $this->GajiModel->delete($t, array('nip_karyawan'=>$nip));
			}
		}else{
			$hasil = $this->GajiModel->insert('karyawan', $data);
		}
		if($hasil){
			redirect(base_url().'karyawan');
		}
	}

	public function ubah($nip){
		ceklevel();
		if($this->input->post('simpan')){
			$this->postKaryawan('update', $nip);
		}else{
			$jabatan 	= $this->GajiModel->view('jabatan');
			$oper 		= [
				'kar'		=> $this->km->get_by_nip($nip), 
				'action'	=> base_url().'karyawan/ubah/'.$nip, 
				'jab'		=> $jabatan
			];
			$this->load->view('karyawan/karyawanubah', $oper);
		}
	}

	public function rinci($nip)
	{
		ceklevel();
		$oper 		= [
			'kar'		=> $this->km->get_by_nip($nip), 
		];
		$this->load->view('karyawan/karyawanrinci', $oper);
	}

	public function hapus($nip)
	{
		ceklevel();
		if($this->input->post('simpan')){
			$this->postKaryawan('delete', $nip);
		}else{
			$oper = array(
				'action'	=> base_url().'karyawan/hapus/'.$nip
			);
			$this->load->view('karyawan/karyawanhapus', $oper);
		}
	}


	private function uploadfotokaryawan($fl = null){
		$this->ceklevel();
		$path = './images/karyawan';
		if(file_exists($path.'/'.$fl)){
			unlink($path.'/'.$fl);
		}
		$config['upload_path']          = $path;
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 1000;
		$config['max_width']            = 2000;
		$config['max_height']           = 2000;
		$this->load->library('upload', $config);
		$upload = $this->upload->do_upload('foto_karyawan');
	}

}
