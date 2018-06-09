<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penggajian extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(empty($this->session->userdata('username')) || empty($this->session->userdata('level')) || empty($this->session->userdata('id_pengguna'))){
			redirect(base_url().'pekamasuk');
		}
	}

	public function index()
	{
		ceklevel(3);
		$penggajian = $this->GajiModel->view('penggajian');
		if($this->session->userdata('level')==3){
			$penggajian = $this->GajiModel->view('penggajian', array(
				'penggajian.nip_karyawan' => $this->session->userdata('username')
			));
		}
		$oper = array(
			'gaji'	=> $penggajian
		);
		$this->myview->view('penggajian/penggajian', $oper);
	}

	#START DATA PENGGAJIAN

	public function cekperiode($nip, $bln, $thn){
		$totaldata = $this->GajiModel->count('penggajian', array('penggajian.nip_karyawan'=>$nip, 'bulan_penggajian'=>$bln, 'tahun_penggajian'=>$thn));
		echo $totaldata;
	}

	public function cek($nip, $bln, $thn){
		$kar = $this->GajiModel->view('karyawan', array('karyawan.nip_karyawan'=>$nip));
		$oper = array();
		$gaji_pokok=0; 
		$tunjangan=0;
		foreach ($kar as $k) {
			$gaji_pokok 	= $k->gaji_pokok;
			$tunjangan		= $k->tunjangan;
		}
		$this->load->model('karyawan_model', 'km');
		$karyawan = $this->km->get_by_nip($nip);
		$abs = $this->GajiModel->absensi($nip, $bln, $thn);
		$pinjaman 					= $this->GajiModel->totalpinjaman($nip, $bln, $thn);
		$gaji_kotor 				= $gaji_pokok+$tunjangan+$karyawan['pulsa']+$karyawan['transportasi']-$pinjaman;
		// $pph 						= $gaji_kotor * $this->config->item('pph') / 100;
		// $bpjs_ketenagakerjaan		= $gaji_kotor * $this->config->item('bpjs') / 100;
		$gaji_bersih				= $gaji_kotor;
		 // - $bpjs_ketenagakerjaan - $pph;
		$oper = array(
			'gaji_pokok'			=> rupiah($gaji_pokok, null),
			'tunjangan'				=> rupiah($tunjangan, null),
			'pinjaman'				=> rupiah($pinjaman, null),
			'gaji_kotor'			=> rupiah($gaji_kotor, null),
			// 'pph'					=> rupiah($pph, null),
			// 'bpjs_ketenagakerjaan'	=> rupiah($bpjs_ketenagakerjaan, null),
			'gaji_bersih'			=> rupiah($gaji_bersih, null),
			'masuk'					=> $abs['Masuk'],
			'ijin'					=> $abs['Ijin'],
			'cuti'					=> $abs['Cuti'],
			'alpa'					=> $abs['Alpa'],
			'transportasi'			=> $karyawan['transportasi'] ? $karyawan['transportasi'] : 0,
			'pulsa'			=> $karyawan['pulsa'] ? $karyawan['pulsa'] : 0,
		);
		echo json_encode($oper);
	}

	private function postpenggajian($aksi='insert', $id=null){
		$data['nip_karyawan'] 			= $this->input->post('nip_karyawan');
		$data['tgl_penggajian'] 		= $this->input->post('tgl_penggajian');
		$data['pinjaman'] 				= duit($this->input->post('pinjaman'));
		$data['gaji_kotor'] 			= duit($this->input->post('gaji_kotor'));
		// $data['pph'] 					= duit($this->input->post('pph'));
		// $data['bpjs_ketenagakerjaan'] 	= duit($this->input->post('bpjs_ketenagakerjaan'));
		$data['gaji_bersih'] 			= duit($this->input->post('gaji_bersih'));
		$data['bulan_penggajian'] 		= $this->input->post('bulan_penggajian');
		$data['tahun_penggajian'] 		= $this->input->post('tahun_penggajian');
		if($aksi === 'update'){
			$hasil = $this->GajiModel->update('penggajian', $data, array('id_penggajian'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('penggajian', array('id_penggajian'=>$id));
		}else{
			$hasil = $this->GajiModel->insert('penggajian', $data);
		}
		if($hasil){
			redirect(base_url().'penggajian');
		}
	}

	public function tambah(){
		ceklevel();
		if($this->input->post('simpan')){
			$this->postpenggajian();
		}else{
			$karyawan = $this->db->order_by('nip_karyawan')->get('karyawan')->result();
			$oper = array(
				'action' => base_url().'penggajian/tambah', 
				'kar'    => $karyawan
			);
			$this->load->view('penggajian/penggajiantambah', $oper);
		}
	}

	public function ubah($id, $nip){
		ceklevel();
		if($this->input->post('simpan')){
			$this->postpenggajian('update', $id);
		}else{
			$this->load->model('karyawan_model', 'km');
			$karyawan = $this->km->get_by_nip($nip);
			$gaji = []; $gaji_pokok = 0; $tunjangan = 0;
			$gaji_pokok			= rupiah($karyawan['gaji_pokok'], null);
			$tunjangan			= rupiah($karyawan['tunjangan'], null);
			$pulsa			= rupiah($karyawan['pulsa'], null);
			$transportasi			= rupiah($karyawan['transportasi'], null);
			$penggajian = $this->GajiModel->view('penggajian', array('id_penggajian'=>$id));
			$gaji = array();
			foreach ($penggajian as $j) {
				$gaji['nip_karyawan'] 			= $j->nip_karyawan;
				$gaji['bulan_penggajian'] 		= $j->bulan_penggajian;
				$gaji['tahun_penggajian'] 		= $j->tahun_penggajian;
				$gaji['tgl_penggajian'] 		= $j->tgl_penggajian;
				$gaji['pinjaman'] 				= rupiah($j->pinjaman, null);
				$gaji['gaji_kotor'] 			= rupiah($j->gaji_kotor, null);
				$gaji['pph']					= rupiah($j->pph, null);
				$gaji['bpjs_ketenagakerjaan']	= rupiah($j->bpjs_ketenagakerjaan, null);
				$gaji['gaji_bersih'] 			= rupiah($j->gaji_bersih, null);
			}
			$gaji['gaji_pokok'] = $gaji_pokok;
			$gaji['tunjangan']	= $tunjangan;
			$gaji['pulsa'] = $pulsa;
			$gaji['transportasi']	= $transportasi;
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array(
				'gaji' 		=> $gaji, 
				'action' 	=> base_url().'penggajian/ubah/'.$id.'/'.$nip, 
				'kar'		=> $karyawan
			);
			$this->load->view('penggajian/penggajianubah', $oper);
		}
	}

	public function hapus($id){
		ceklevel();
		if($this->input->post('simpan')){
			$this->postpenggajian('delete', $id);
		}else{
			$oper = array('action'=>base_url().'penggajian/hapus/'.$id);
			$this->load->view('penggajian/penggajianhapus', $oper);
		}
	}
	#END DATA PENGGAJIAN

}