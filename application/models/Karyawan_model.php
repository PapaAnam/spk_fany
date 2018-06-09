<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Karyawan_model extends CI_Model {

	public function get_by_nip($nip)
	{
		$this->db->where('nip_karyawan', $nip);
		$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
		$q = $this->db->get('karyawan');
		return $q->row_array();
	}

	public function all()
	{
		return $this->db->order_by('nip_karyawan')->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')->get('karyawan')->result();
	}

}