<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rekap extends CI_Controller
{
    protected $folderAdmin = '';
    function __construct()
    {
		parent::__construct();
		if(empty($this->session->userdata('username')) || empty($this->session->userdata('level')) || empty($this->session->userdata('id_pengguna'))){
			redirect(base_url().'pekamasuk');
		}
		$this->load->helper('other');
		$this->load->library('pdfGenerator');
		zonawaktu();
	}
	private function load($modul, $eks='cetak', $whr=array())
	{
		$data = $this->GajiModel->view($modul, $whr);
		$oper = array('title'=>$this->config->item('nama_pt'), 'logo'=>$this->config->item('logo_rekap'), 'style'=>base_url().'asset/css/rekap.css', 'data'=>$data);
		if($eks==='pdf')
		{
			$html = $this->load->view($this->folderAdmin.'rekap/pdf', $oper, true);
			$html .= $this->load->view($this->folderAdmin.'rekap/'.$modul.'pdf', $oper, true);
			// die(var_dump($html));
			$this->pdfgenerator->generate($html, $modul);
		}else
		{
			$this->load->view($this->folderAdmin.'rekap/icon', $oper);
			$this->load->view($this->folderAdmin.'rekap/'.$modul.'cetak');
		}
	}
	#START REKAP DIVISI
    public function divisicetak()
	{
		$this->load('divisi');
	}
	public function divisipdf()
	{
		$this->load('divisi', 'pdf');
	}
	#END REKAP DIVISI

	#START REKAP JABATAN
    public function jabatancetak()
	{
		$this->load('jabatan');
	}
	public function jabatanpdf()
	{
		$this->load('jabatan', 'pdf');
	}
	#END REKAP JABATAN

	#START REKAP KARYAWAN
    private function filterkaryawan($jab, $opsi)
    {
      // if($div=='semua'&&$jab=='semua'){
      //   $this->load('karyawan', $opsi);
      // }else if($div=='semua'){
      //   $this->load('karyawan', $opsi, array('jabatan.id_jabatan'=>$jab));
      // }else 
      if($jab=='semua'){
        $this->load('karyawan', $opsi
        	// , array('divisi.id_divisi'=>$div)
        );
      }else{
        $this->load('karyawan', $opsi, array('jabatan.id_jabatan'=>$jab
        	// , 'divisi.id_divisi'=>$div
        ));
      }
    }
  	public function karyawancetak($jab='semua')
	{
    $this->filterkaryawan($jab, 'cetak');
	}
	public function karyawanpdf($jab='semua')
	{
    $this->filterkaryawan($jab, 'pdf');
	}
	private function detailkaryawan($nip, $opsi)
	{
		$karyawan = $this->GajiModel->view('karyawan', array('karyawan.nip_karyawan'=>$nip));
		$kar = "";
		foreach ($karyawan as $k) {
			$kar['nip_karyawan'] 		= $k->nip_karyawan;
			$kar['nama_karyawan'] 		= $k->nama_karyawan;
			$kar['alamat_karyawan'] 	= $k->alamat_karyawan;
			$kar['agama_karyawan'] 		= $k->agama_karyawan;
			$kar['kota_lhr_karyawan']	= $k->kota_lhr_karyawan;
			if($k->tgl_lhr_karyawan === '0000-00-00'){
				$kar['tgl_lhr_karyawan']	= date('Y-m-d');
			}else{
				$kar['tgl_lhr_karyawan']	= $k->tgl_lhr_karyawan;
			}
			if($k->tgl_lhr_karyawan === '0000-00-00'){
				$kar['tgl_masuk_karyawan']	= date('Y-m-d');
			}else{
				$kar['tgl_masuk_karyawan']	= $k->tgl_masuk_karyawan;
			}
			$kar['jk_karyawan']			= $k->jk_karyawan;
			$kar['status_karyawan']		= $k->status_karyawan;
			$kar['pendidikan_karyawan']	= $k->pendidikan_karyawan;
			$kar['id_divisi']			= $k->id_divisi;
			$kar['id_jabatan']			= $k->id_jabatan;
			$kar['gaji_pokok']			= $k->gaji_pokok;
			$kar['tunjangan']			= $k->tunjangan;
			$kar['lembur']				= $k->lembur;
			$kar['foto_karyawan']		= $k->foto_karyawan;
			$kar['nama_divisi']			= $k->nama_divisi;
			$kar['nama_jabatan']		= $k->nama_jabatan;
			$kar['gaji_pokok']			= $k->gaji_pokok;
			$kar['tunjangan']			= $k->tunjangan;
			$kar['lembur']				= $k->lembur;
			$kar['jenis_karyawan']		= $k->jenis_karyawan;
		}
		if($opsi=='pdf'){
			$html = $this->load->view($this->folderAdmin.'rekap/biokaryawan'.$opsi, $kar, true);
			// end(var_dump($html));
			$this->pdfgenerator->generate($html, 'biokaryawan');
		}else{
			$this->load->view($this->folderAdmin.'rekap/biokaryawan'.$opsi, $kar);
		}
		
	}
	function biokaryawancetak($nip){
		$this->detailkaryawan($nip, 'cetak');
	}
	function biokaryawanpdf($nip){
		$this->detailkaryawan($nip, 'pdf');
	}
	#END REKAP KARYAWAN

	#START REKAP ABSENSI
	private function filterwaktu($bln, $thn, $modul, $opsi, $status='semua')
	{
		$whr = "";
		$whr2 = "";
		$whr3 = "";
		if($modul=='absensi'){
			$field = 'tgl_absensi';
		}else if($modul=='pinjaman'){
			$field = 'tgl_pinjaman';
		}else if($modul=='lembur'){
			$field = 'tgl_lembur';
		}else{
			$whr = array('bulan_penggajian'=>$bln, 'tahun_penggajian'=>$thn);
			$whr2 = array('bulan_penggajian'=>$bln);
			$whr3 = array('tahun_penggajian'=>$thn);
		}
		$filter = null;
		if($bln!='semua')
			$filter['month('.$field.')'] = $bln;
		if($thn!='semua')
			$filter['year('.$field.')'] = $thn;
		if($status!='semua')
			$filter['status_absensi'] = $status;
		if($bln=='semua'&&$thn=='semua'){
	      $this->load($modul, $opsi);
	    }else if($bln=='semua'){
	      $modul=='penggajian'?$this->load($modul, $opsi, $whr3):$this->load($modul, $opsi, $filter);
	    }else if($thn=='semua'){
	      $modul=='penggajian'?$this->load($modul, $opsi, $whr2):$this->load($modul, $opsi, $filter);
	    }else{
	      $modul=='penggajian'?$this->load($modul, $opsi, $whr):$this->load($modul, $opsi, $filter);
	    }
	}
	public function absensicetak($bln='semua', $thn='semua', $status='semua')
	{
		$this->filterwaktu($bln, $thn, 'absensi', 'cetak', $status);
	}
	public function absensipdf($bln='semua', $thn='semua', $status='semua')
	{
		$this->filterwaktu($bln, $thn, 'absensi', 'pdf', $status);
	}
	#END REKAP ABSENSI

	#START REKAP PINJAMAN
    public function pinjamancetak($bln='semua', $thn='semua')
	{
		$this->filterwaktu($bln, $thn, 'pinjaman', 'cetak');
	}
	public function pinjamanpdf($bln='semua', $thn='semua')
	{
		$this->filterwaktu($bln, $thn, 'pinjaman', 'pdf');
	}
	#END REKAP PINJAMAN

	#START REKAP LEMBUR
    public function lemburcetak($bln='semua', $thn='semua')
	{
		$this->filterwaktu($bln, $thn, 'lembur', 'cetak');
	}
	public function lemburpdf($bln='semua', $thn='semua')
	{
		$this->filterwaktu($bln, $thn, 'lembur', 'pdf');
	}
	#END REKAP LEMBUR

	#START REKAP GAJI
    public function penggajiancetak($bln='semua', $thn='semua')
	{
		$this->filterwaktu($bln, $thn, 'penggajian', 'cetak');
	}
	public function penggajianpdf($bln='semua', $thn='semua')
	{
		$this->filterwaktu($bln, $thn, 'penggajian', 'pdf');
	}
	#END REKAP GAJI

	#START SLIP GAJI
	public function slipgaji($idgaji, $opsi)
	{
		$gaji = $this->GajiModel->gajian(array('penggajian.id_penggajian'=>$idgaji));
		$kar = array();
		foreach ($gaji as $g) {
			// $kar['jenis_karyawan']		= $g->jenis_karyawan;
			$kar['nip_karyawan'] 		= $g->nip_karyawan;
			$kar['nama_karyawan'] 		= $g->nama_karyawan;
			$kar['gaji_pokok']			= $g->gaji_pokok;
			$kar['tunjangan']			= $g->tunjangan;
			// $kar['lembur']				= $g->lbr;
			$kar['nama_jabatan']		= $g->nama_jabatan;
			$kar['pinjaman']			= $g->pinjaman;
			$kar['title']				= 'Slip gaji';
			$kar['bulan_penggajian']	= $g->bulan_penggajian;
			$kar['tahun_penggajian']	= $g->tahun_penggajian;
			// $kar['pph']					= $g->pph;
			// $kar['bpjs_ketenagakerjaan']	= $g->bpjs_ketenagakerjaan;
			$kar['transportasi']	= $g->transportasi;
			$kar['pulsa']	= $g->pulsa;
			$kar['no_telp']	= $g->no_telp;
			$kar['i'] = 1;
		}
		// if($kar['jenis_karyawan']=='Sementara'){
		// 	$abs = $this->GajiModel->absensi($kar['nip_karyawan'], $kar['bulan_penggajian'], $kar['tahun_penggajian']);
		// 	$kar['gaji_pokok']				*= $abs['Masuk']/30;
		// 	$kar['tunjangan']				*= $abs['Masuk']/30;
		// 	$lembur = $this->GajiModel->totallembur($kar['nip_karyawan'], $kar['bulan_penggajian'], $kar['tahun_penggajian']);
		// 	if($lembur['total_jam_lembur'] > 0){
		// 		$kar['lembur'] *= $lembur['total_jam_lembur'];
		// 	}else{
		// 		$kar['lembur'] = 0;
		// 	}
		// }
		if($opsi=='pdf'){
			$kar['pdf'] = true;
			$html = $this->load->view($this->folderAdmin.'rekap/slipgajicetak', $kar, true);
			$this->pdfgenerator->generate($html, 'slipgaji');
		}else{
			$this->load->view($this->folderAdmin.'rekap/slipgaji'.$opsi, $kar);
		}
	}
    public function slipgajicetak($idgaji)
	{
		$this->slipgaji($idgaji, 'cetak');
	}
	public function slipgajipdf($idgaji)
	{
		$this->slipgaji($idgaji, 'pdf');
	}
	public function cobasaja()
	{

	}
	#END SLIP GAJI
}
