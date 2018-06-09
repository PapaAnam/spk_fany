<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AbsensiModel extends CI_Model {
	public $status_absensi;
	public $keterangan_absensi;
	public $tgl_absensi;
	public $jam_masuk_absensi;
	public $jam_keluar_absensi;
	public $nip_karyawan;

	public function __construct()
	{
		$this->tgl_absensi        = date('Y-m-d');
		$this->jam_masuk_absensi  = date('H:i:s');
		// $this->jam_keluar_absensi = date('H:i:s');
		$this->nip_karyawan       = $this->session->userdata('username');
	}
	public function absensi_masuk()
	{
		$this->status_absensi     = 'Masuk';
		$this->keterangan_absensi = '-';
		$this->db->insert('absensi', $this);
	}

	public function cek_absensi_hari_ini()
	{
		return $this->db->get_where('absensi', ['tgl_absensi'=>date('Y-m-d'), 'nip_karyawan'=>$this->nip_karyawan])->result();
	}

	public function cek_absensi_keluar()
	{
		return $this->db->get_where('absensi', ['tgl_absensi'=>date('Y-m-d'), 'nip_karyawan'=>$this->nip_karyawan, 'jam_keluar_absensi !='=>null])->result();
	}

	public function set_jam_keluar($value)
	{
		$this->jam_keluar_absensi = $value;
	}

	public function absensi_keluar()
	{
		return $this->db->where(['tgl_absensi'=>date('Y-m-d'), 'nip_karyawan'=>$this->nip_karyawan])->update('absensi', ['jam_keluar_absensi'=>date('H:i:s')]);
	}

	public function absensi_hari_ini()
	{
		$d = ['jam_masuk_absensi'=>'-','jam_keluar_absensi'=>'-'];
		foreach($this->db->get_where('absensi', ['tgl_absensi'=>date('Y-m-d'), 'nip_karyawan'=>$this->nip_karyawan])->result() as $abs){
			$d['jam_masuk_absensi'] = $abs->jam_masuk_absensi;		
			$d['jam_keluar_absensi'] = $abs->jam_keluar_absensi;
		}
		return (object) $d;
	}
}