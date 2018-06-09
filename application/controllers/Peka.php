<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peka extends CI_Controller {
	protected $folderAdmin = '';
	protected function burl(){
		return base_url();
	}
	private function lvl()
	{
		return $this->session->userdata('level');
	}
	protected function url(){
		return $this->burl().'peka/';
	}
	protected function view($v, $o = array()){
		$this->load->view($v, $o);
	}
	protected function post($v){
		return $this->input->post($v);
	}
	protected function atas(){
		$pengguna = $this->GajiModel->view('pengguna', array('id_pengguna'=>$this->session->userdata('id_pengguna')));
		$foto = '';
		$myprofil = $this->url().'penggunaubah/'. $this->session->userdata('id_pengguna');
		foreach ($pengguna as $p) {
			$foto = base_url().'images/pengguna/'.$p->foto_pengguna;
			$nickname = $p->nama_pengguna;
		}
		if($this->session->userdata('level')!=3){
	        // $nickname = $this->session->userdata('username');
		}else{
			$karyawan = $this->GajiModel->view('karyawan',array('nip_karyawan'=>$this->session->userdata('username')));
			foreach ($karyawan as $key) {
				$nickname 	= $key->nama_karyawan;
				// $foto 		= base_url().'images/karyawan/'.$key->foto_karyawan;
			}
			$myprofil = $this->url().'karyawanrinci/'. $this->session->userdata('username');
		}
		$oper = array(
			'burl'				=> base_url(), 
			'url'				=> $this->url(), 
			// 'foto_pengguna'		=> $foto,
			'nickname'			=> $nickname,
			'myprofil'			=> $myprofil,
			'lvl'				=> $this->session->userdata('level')
		);
		$this->view($this->folderAdmin.'head', $oper);
		$this->view($this->folderAdmin.'header');
	}
	protected function bawah(){
		$this->view($this->folderAdmin.'mobile');
		$this->view($this->folderAdmin.'foot');
	}
	private function ceklevel($optional = null){
		if($this->session->userdata('level')!='1' and $optional==null){
			redirect(base_url().'peka/eror404');
		}
	}
	function __construct(){
		parent::__construct();
		if(empty($this->session->userdata('username')) || empty($this->session->userdata('level')) || empty($this->session->userdata('id_pengguna'))){
			redirect(base_url().'pekamasuk');
		}
		$this->load->helper('other');
		// $this->load->library('PdfGenerator');
		zonawaktu();
	}
	public function ubahsandi()
	{
		if($this->post('simpan')){
			$data = array(
				'sandi_pengguna'	=> md5($this->post('sandibaru'))
			);
			$this->GajiModel->update('pengguna', $data, array('nama_pengguna'=>$this->session->userdata('username')));
			$this->session->set_flashdata('msg_password', 'sandi berhasil diubah');
			redirect(base_url().'peka/');
		}
		$nip=$this->session->userdata('username');
		$this->view('ubahsandi', array('action'=>$this->url().'ubahsandi'));
	}
	private function isiberanda(){
		$datamaster = ['divisi', 'jabatan', 'karyawan', 'pinjaman', 'absensi', 'lembur', 'penggajian'];
		foreach ($datamaster as $d) {
			$oper[$d] = $this->GajiModel->count($d);
		}
		$oper['kar'] = $this->GajiModel->karyawanbaru();
		if($this->session->userdata('level')==3){
			$nip = $this->session->userdata('username');
			$parameter = array('nip_karyawan'=>$nip, 'status_absensi'=>'Masuk', 'month(tgl_absensi)'=>blnskrng(), 'year(tgl_absensi)'=>thnskrng());
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
			$oper['total_jam_lembur']	= $this->GajiModel->totallembur($nip, blnskrng(), thnskrng())['total_jam_lembur'];
			$oper['gajikemarin'] 		= $gajikemarin;
			$jabatan = $this->GajiModel->view('karyawan', array('nip_karyawan'=>$nip));
			foreach ($jabatan as $key) {
				$oper['hrg_lembur']		= $key->lembur;
			}
		}
		$this->atas();
		$this->view($this->folderAdmin.'beranda', $oper);
		$this->bawah();
	}

	public function index(){
		$this->isiberanda();
	}
	public function beranda()
	{
		$this->isiberanda();
	}
	#ERROR 404
	function error404(){
		$this->view($this->folderAdmin.'404');
	}

	#START DATA PENGGUNA
	function cekusername($u){
		echo $pengguna = $this->db->get_where('pengguna', array('nama_pengguna'=>$u))->num_rows();
	}
	private function uploadfotopengguna($fl = null){
		$path = './images/pengguna';
		if(file_exists($path.'/'.$fl)){
			unlink($path.'/'.$fl);
		}
		$config['upload_path']          = $path;
		$config['allowed_types']        = 'jpg|png|jpeg';
		$config['max_size']             = 1000;
		$config['max_width']            = 2000;
		$config['max_height']           = 2000;
		$this->load->library('upload', $config);
		$upload = $this->upload->do_upload('foto_pengguna');
	}
	private function postpengguna($aksi='insert', $id=null){
		if(isset($_FILES['foto_pengguna'])){
			$pengguna = $this->GajiModel->view('pengguna', array('id_pengguna'=>$id));
			$fotolama = "";
			foreach ($pengguna as $p) {
				$fotolama = $p->foto_pengguna;
			}
			$suffix = getsuffix($_FILES['foto_pengguna']['type']);
			$data['foto_pengguna']			= date('YmdHis').$suffix;
			$_FILES['foto_pengguna']['name'] = date('YmdHis').$suffix;
			$this->uploadfotopengguna($fotolama);
		}
		if($aksi === 'update'){
			if($this->post('sandi_pengguna')){
				$data['sandi_pengguna'] 		= md5($this->post('sandi_pengguna'));
			}
			$hasil = $this->GajiModel->update('pengguna', $data, array('id_pengguna'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('pengguna', array('id_pengguna'=>$id));
		}else{
			$data['nama_pengguna'] 			= $this->post('nama_pengguna');
			$data['level_pengguna'] 		= $this->post('level_pengguna');
			$data['sandi_pengguna'] 		= md5($this->post('nama_pengguna'));
			$hasil = $this->GajiModel->insert('pengguna', $data);
		}
		if($hasil){
			redirect(base_url());
		}
	}
	function pengguna(){
		$this->ceklevel();
		$pengguna = $this->GajiModel->view('pengguna');
		$oper = array('peng'=>$pengguna);
		$this->atas();
		$this->view($this->folderAdmin.'pengguna/pengguna', $oper);
		$this->bawah();
	}
	function penggunatambah(){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postpengguna();
		}else{
			$oper = array('action'=>$this->url().'penggunatambah');
			$this->view($this->folderAdmin.'pengguna/penggunatambah', $oper);
		}
	}
	function penggunaubah($id){
		if($this->post('simpan')){
			$this->postpengguna('update', $id);
		}else{
			$pengguna = $this->GajiModel->view('pengguna', array('id_pengguna'=>$id));
			foreach ($pengguna as $d) {
				$peng['nama_pengguna'] = $d->nama_pengguna;
				$peng['sandi_pengguna'] = $d->sandi_pengguna;
				$peng['level_pengguna'] = $d->level_pengguna;
				$peng['foto_pengguna'] = $d->foto_pengguna;
			}
			$oper = array('peng'=>$peng, 'action'=>$this->url().'penggunaubah/'.$id);
			$this->view($this->folderAdmin.'pengguna/penggunaubah', $oper);
		}
	}
	function penggunahapus($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postpengguna('delete', $id);
		}else{
			$oper = array('action'=>$this->url().'penggunahapus/'.$id);
			$this->view($this->folderAdmin.'pengguna/penggunahapus', $oper);
		}
	}
	#END DATA PENGGUNA

	#START DATA DIVISI
	private function postDivisi($aksi='insert', $id=null){
		$this->ceklevel();
		$data['nama_divisi'] 			= $this->post('nama_divisi');
		if($aksi === 'update'){
			$hasil = $this->GajiModel->update('divisi', $data, array('id_divisi'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('divisi', array('id_divisi'=>$id));
		}else{
			$hasil = $this->GajiModel->insert('divisi', $data);
		}
		if($hasil){
			redirect($this->url().'divisi');
		}
	}
	function divisi(){
		$this->ceklevel();
		$divisi = $this->GajiModel->view('divisi');
		$oper = array('div'=>$divisi);
		$this->atas();
		$this->view($this->folderAdmin.'divisi/divisi', $oper);
		$this->bawah();
	}
	function divisitambah(){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postDivisi();
		}else{
			$oper = array('action'=>$this->url().'divisitambah');
			$this->view($this->folderAdmin.'divisi/divisitambah', $oper);
		}
	}
	function divisiubah($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postDivisi('update', $id);
		}else{
			$divisi = $this->GajiModel->view('divisi', array('id_divisi'=>$id));
			foreach ($divisi as $d) {
				$div['nama_divisi'] = $d->nama_divisi;
			}
			$oper = array('div'=>$div, 'action'=>$this->url().'divisiubah/'.$id);
			$this->view($this->folderAdmin.'divisi/divisiubah', $oper);
		}
	}
	function divisihapus($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postDivisi('delete', $id);
		}else{
			$oper = array('action'=>$this->url().'divisihapus/'.$id);
			$this->view($this->folderAdmin.'divisi/divisihapus', $oper);
		}
	}
	#END DATA DIVISI

	#START DATA JABATAN
	private function postJabatan($aksi='insert', $id=null){
		$this->ceklevel();
		$data['nama_jabatan'] 	= $this->post('nama_jabatan');
		$data['gaji_pokok'] 	= duit($this->post('gaji_pokok'));
		$data['tunjangan'] 		= duit($this->post('tunjangan'));
		$data['pulsa'] 		= duit($this->post('pulsa'));
		$data['transportasi'] 		= duit($this->post('transportasi'));
		if($aksi === 'update'){
			$hasil = $this->GajiModel->update('jabatan', $data, array('id_jabatan'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('jabatan', array('id_jabatan'=>$id));
		}else{
			$hasil = $this->GajiModel->insert('jabatan', $data);
		}
		if($hasil){
			redirect($this->url().'jabatan');
		}
	}
	function jabatan(){
		$this->ceklevel();
		$jabatan = $this->GajiModel->view('jabatan');
		$oper = array('jab'=>$jabatan);
		$this->atas();
		$this->view($this->folderAdmin.'jabatan/jabatan', $oper);
		$this->bawah();
	}
	function jabatantambah(){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postJabatan();
		}else{
			$oper = array('action'=>$this->url().'jabatantambah');
			$this->view($this->folderAdmin.'jabatan/jabatantambah', $oper);
		}
	}
	function jabatanubah($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postJabatan('update', $id);
		}else{
			$jabatan = $this->GajiModel->view('jabatan', array('id_jabatan'=>$id));
			foreach ($jabatan as $j) {
				$jab['nama_jabatan'] 	= $j->nama_jabatan;
				$jab['gaji_pokok'] 		= rupiah($j->gaji_pokok, null);
				$jab['tunjangan'] 		= rupiah($j->tunjangan, null);
				$jab['pulsa'] 				= rupiah($j->pulsa, null);
				$jab['transportasi'] 				= rupiah($j->transportasi, null);
			}
			$oper = array('jab'=>$jab, 'action'=>$this->url().'jabatanubah/'.$id);
			$this->view($this->folderAdmin.'jabatan/jabatanubah', $oper);
		}
	}
	function jabatanhapus($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postJabatan('delete', $id);
		}else{
			$oper = array('action'=>$this->url().'jabatanhapus/'.$id);
			$this->view($this->folderAdmin.'jabatan/jabatanhapus', $oper);
		}
	}
	#END DATA JABATAN

	#START DATA ABSENSI
	private function postabsensi($aksi='insert', $id=null){
		$this->ceklevel();
		$data['nip_karyawan'] 		= $this->post('nip_karyawan');
		$data['status_absensi'] 	= $this->post('status_absensi');
		$data['tgl_absensi'] 		= $this->post('tgl_absensi');
		$data['jam_masuk_absensi'] 	= $this->post('jam_masuk_absensi');
		$data['jam_keluar_absensi'] = $this->post('jam_keluar_absensi');
		$data['keterangan_absensi'] = $this->post('keterangan_absensi');
		if($aksi === 'update'){
			if($data['status_absensi'] != 'Masuk'){
				$data['jam_masuk_absensi'] 	= '';
				$data['jam_keluar_absensi'] = '';
			}
			$hasil = $this->GajiModel->update('absensi', $data, array('id_absensi'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('absensi', array('id_absensi'=>$id));
		}else{
			// if(strtotime($this->post('jam_keluar_absensi'))>strtotime($this->config->item('jam_keluar'))){
			// 	$d = [
			// 		'tgl_lembur'	=> $this->post('tgl_absensi'),
			// 		'lama_lembur'	=> (strtotime($this->post('jam_keluar_absensi'))-strtotime($this->config->item('jam_keluar')))/3600,
			// 		'nip_karyawan'	=> $this->post('nip_karyawan'),
			// 	];
			// 	$this->GajiModel->insert('lembur', $d);
			// }
			$terlambat = strtotime($this->post('jam_masuk_absensi'))>=strtotime($this->config->item('jam_terlambat'));
			if($terlambat)
				$data['status_absensi'] = 'Terlambat';
			$hasil = $this->GajiModel->insert('absensi', $data);
		}
		if($hasil){
			redirect($this->url().'absensi');
		}
	}
	function absensi(){
		$this->ceklevel(3);
		$absensi = $this->GajiModel->view('absensi');
		if($this->session->userdata('level')==3){
			$absensi = $this->GajiModel->view('absensi', array('absensi.nip_karyawan'=>$this->session->userdata('username')));
		}
		$oper = array('abs'=>$absensi);
		$this->atas();
		$this->view($this->folderAdmin.'absensi/absensi', $oper);
		$this->bawah();
	}
	function absensitambah(){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postabsensi();
		}else{
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array('action'=>$this->url().'absensitambah', 'kar'=>$karyawan);
			$this->view($this->folderAdmin.'absensi/absensitambah', $oper);
		}
	}
	function absensiubah($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postabsensi('update', $id);
		}else{
			$absensi = $this->GajiModel->view('absensi', array('id_absensi'=>$id));
			foreach ($absensi as $j) {
				$abs['nip_karyawan'] 		= $j->nip_karyawan;
				$abs['status_absensi'] 		= $j->status_absensi;
				$abs['tgl_absensi'] 		= $j->tgl_absensi;
				$abs['jam_masuk_absensi'] 	= $j->jam_masuk_absensi;
				$abs['jam_keluar_absensi'] 	= $j->jam_keluar_absensi;
				$abs['keterangan_absensi'] 	= $j->keterangan_absensi;
			}
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array('abs'=>$abs, 'action'=>$this->url().'absensiubah/'.$id, 'kar'=>$karyawan);
			$this->view($this->folderAdmin.'absensi/absensiubah', $oper);
		}
	}
	function absensihapus($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postabsensi('delete', $id);
		}else{
			$oper = array('action'=>$this->url().'absensihapus/'.$id);
			$this->view($this->folderAdmin.'absensi/absensihapus', $oper);
		}
	}
	#END DATA ABSENSI

	#START DATA PINJAMAN
	private function postpinjaman($aksi='insert', $id=null){
		$this->ceklevel();
		$data['nip_karyawan'] 		= $this->post('nip_karyawan');
		$data['tgl_pinjaman'] 		= $this->post('tgl_pinjaman');
		$data['besar_pinjaman'] 	= duit($this->post('besar_pinjaman'));
		$data['status_pinjaman'] 	= $this->post('status_pinjaman');
		$data['keterangan_pinjaman'] = $this->post('keterangan_pinjaman');
		if($aksi === 'update'){
			$hasil = $this->GajiModel->update('pinjaman', $data, array('id_pinjaman'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('pinjaman', array('id_pinjaman'=>$id));
		}else{
			$hasil = $this->GajiModel->insert('pinjaman', $data);
		}
		if($hasil){
			redirect($this->url().'pinjaman');
		}
	}
	function pinjaman(){
		$this->ceklevel(3);
		$pinjaman = $this->GajiModel->view('pinjaman');
		if($this->session->userdata('level')==3){
			$pinjaman = $this->GajiModel->view('pinjaman', array('pinjaman.nip_karyawan'=>$this->session->userdata('username')));
		}
		$oper = array('pin'=>$pinjaman);
		$this->atas();
		$this->view($this->folderAdmin.'pinjaman/pinjaman', $oper);
		$this->bawah();
	}
	function pinjamantambah(){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postpinjaman();
		}else{
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array('action'=>$this->url().'pinjamantambah', 'kar'=>$karyawan);
			$this->view($this->folderAdmin.'pinjaman/pinjamantambah', $oper);
		}
	}
	function pinjamanubah($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postpinjaman('update', $id);
		}else{
			$pinjaman = $this->GajiModel->view('pinjaman', array('id_pinjaman'=>$id));
			foreach ($pinjaman as $j) {
				$pin['nip_karyawan'] 			= $j->nip_karyawan;
				$pin['status_pinjaman'] 		= $j->status_pinjaman;
				$pin['tgl_pinjaman'] 			= $j->tgl_pinjaman;
				$pin['besar_pinjaman'] 			= rupiah($j->besar_pinjaman, null);
				$pin['keterangan_pinjaman'] 	= $j->keterangan_pinjaman;
			}
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array('pin'=>$pin, 'action'=>$this->url().'pinjamanubah/'.$id, 'kar'=>$karyawan);
			$this->view($this->folderAdmin.'pinjaman/pinjamanubah', $oper);
		}
	}
	function pinjamanhapus($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postpinjaman('delete', $id);
		}else{
			$oper = array('action'=>$this->url().'pinjamanhapus/'.$id);
			$this->view($this->folderAdmin.'pinjaman/pinjamanhapus', $oper);
		}
	}
	#END DATA PINJAMAN

	#START DATA LEMBUR
	private function postlembur($aksi='insert', $id=null){
		$this->ceklevel();
		// $data['nip_karyawan'] 		= $this->post('nip_karyawan');
		// $data['tgl_lembur'] 		= $this->post('tgl_lembur');
		// $data['lama_lembur'] 		= titik($this->post('lama_lembur'));
		$data['keterangan_lembur'] 	= $this->post('keterangan_lembur');
		if($aksi === 'update'){
			$hasil = $this->GajiModel->update('lembur', $data, array('id_lembur'=>$id));
		}else if($aksi === 'delete'){
			$hasil = $this->GajiModel->delete('lembur', array('id_lembur'=>$id));
		}else{
			$hasil = $this->GajiModel->insert('lembur', $data);
		}
		if($hasil){
			redirect($this->url().'lembur');
		}
	}
	function lembur(){
		$this->ceklevel(3);
		$lembur = $this->GajiModel->view('lembur');
		if($this->session->userdata('level')==3){
			$lembur = $this->GajiModel->view('lembur', array('lembur.nip_karyawan'=>$this->session->userdata('username')));
		}
		$oper = array('lem'=>$lembur);
		$this->atas();
		$this->view($this->folderAdmin.'lembur/lembur', $oper);
		$this->bawah();
	}
	function lemburtambah(){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postlembur();
		}else{
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array('action'=>$this->url().'lemburtambah', 'kar'=>$karyawan);
			$this->view($this->folderAdmin.'lembur/lemburtambah', $oper);
		}
	}
	function lemburubah($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postlembur('update', $id);
		}else{
			$lembur = $this->GajiModel->view('lembur', array('id_lembur'=>$id));
			foreach ($lembur as $j) {
				$lem['nip_karyawan'] 		= $j->nip_karyawan;
				// $lem['tgl_lembur'] 			= $j->tgl_lembur;
				// $lem['lama_lembur'] 		= $j->lama_lembur;
				$lem['keterangan_lembur'] 	= $j->keterangan_lembur;
			}
			$karyawan = $this->GajiModel->view('karyawan');
			$oper = array('lem'=>$lem, 'action'=>$this->url().'lemburubah/'.$id, 'kar'=>$karyawan);
			$this->view($this->folderAdmin.'lembur/lemburubah', $oper);
		}
	}
	function lemburhapus($id){
		$this->ceklevel();
		if($this->post('simpan')){
			$this->postlembur('delete', $id);
		}else{
			$oper = array('action'=>$this->url().'lemburhapus/'.$id);
			$this->view($this->folderAdmin.'lembur/lemburhapus', $oper);
		}
	}
	#END DATA LEMBUR

	#START REKAP
	private function doRekap($modul, $whr=array()){
		$mod = $this->GajiModel->view($modul, $whr);
		$urlcetak = $this->burl().'rekap/'.$modul.'cetak';
		$urlpdf = $this->burl().'rekap/'.$modul.'pdf';
		$oper = array(substr($modul, 0, 3)=>$mod, 'urlcetak'=>$urlcetak, 'urlpdf'=>$urlpdf);
		if($modul=='karyawan'){
			// $oper['divisi'] = $this->GajiModel->view('divisi');
			$oper['jabatan'] = $this->GajiModel->view('jabatan');
			$oper['biocetak'] = $this->burl().'rekap/biokaryawancetak';
			$oper['biopdf'] = $this->burl().'rekap/biokaryawanpdf';
		}else if($modul=='penggajian'){
			$oper['slipcetak'] = $this->burl().'rekap/slipgajicetak';
			$oper['slippdf'] = $this->burl().'rekap/slipgajipdf';
		}
		$this->atas();
		$this->view($this->folderAdmin.'rekap/'.$modul, $oper);
		$this->bawah();
	}
	function rekapdivisi(){
		if($this->lvl()==2){
			$this->doRekap('divisi');
		}else{
			$this->view('404');
		}
	}
	function rekapjabatan(){
		if($this->lvl()==2){
			$this->doRekap('jabatan');
		}else{
			$this->view('404');
		}
	}
	function rekapkaryawan($jabatan='semua')
	{
		if($this->lvl()==2){
			// if($divisi!='semua' && $jabatan!='semua'){
			// 	$this->doRekap('karyawan', array('jabatan.id_jabatan'=>$jabatan, 'divisi.id_divisi'=>$divisi));
			// }else if($divisi!='semua'){
			// 	// $this->doRekap('karyawan', array('divisi.id_divisi' => $divisi));
			// }else 
			if($jabatan!='semua'){
				$this->doRekap('karyawan', array('jabatan.id_jabatan' => $jabatan));
			}else{
				$this->doRekap('karyawan');
			}
		}else{
			$this->view('404');
		}
	}
	private function filterwaktu($bln, $thn, $modul, $status='semua')
	{
		$field = "";
		if($modul=='absensi'){
			$field = 'tgl_absensi';
		}else if($modul=='pinjaman'){
			$field = 'tgl_pinjaman';
		}else if($modul=='lembur'){
			$field = 'tgl_lembur';
		}
		$filter = null;
		$whr = null;
		if($bln!='semua'){
			$filter['month('.$field.')'] = $bln;
			$whr['bulan_penggajian'] = $bln;
		}
		if($thn!='semua'){
			$filter['year('.$field.')'] = $thn;
			$whr['tahun_penggajian'] = $thn;
		}
		if($status!='semua')
			$filter['status_absensi'] = $status;
		$modul=='penggajian'?$this->doRekap($modul, $whr):$this->doRekap($modul, $filter);
	}
	function rekapabsensi($bln='semua', $thn='semua', $status='semua')
	{
		if($this->lvl()==2){
			$this->filterwaktu($bln, $thn, 'absensi', $status);
		}else{
			$this->view('404');
		}
	}
	function rekappinjaman($bln='semua', $thn='semua')
	{
		if($this->lvl()==2){
			$this->filterwaktu($bln, $thn, 'pinjaman');
		}else{
			$this->view('404');
		}
	}
	function rekaplembur($bln='semua', $thn='semua')
	{
		if($this->lvl()==2){
			$this->filterwaktu($bln, $thn, 'lembur');
		}else{
			$this->view('404');
		}
	}
	function rekapgaji($bln='semua', $thn='semua')
	{
		if($this->lvl()==2){
			$this->filterwaktu($bln, $thn, 'penggajian');
		}else{
			$this->view('404');
		}
	}
	#END REKAP

	#KELUAR
	function keluar(){
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->unset_userdata('id_pengguna');
		redirect(base_url().'pekamasuk');
	}
}
