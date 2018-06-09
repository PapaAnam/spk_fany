<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Absensi_model extends CI_Model {

	public function total_masuk($bln, $thn, $nip)
	{
		$q = "SELECT COUNT(status_absensi) as masuk FROM `absensi` WHERE tgl_absensi LIKE '{$thn}-{$bln}%' AND nip_karyawan='{$nip}' AND status_absensi='Masuk'";
		return $this->db->query($q)->row();
	}

}