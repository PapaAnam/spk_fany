<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman_model extends CI_Model {

	public function pinjaman_by_bulan($bln, $thn, $nip)
	{
		$q = "SELECT SUM(besar_pinjaman) as pinjaman FROM `pinjaman` WHERE tgl_pinjaman LIKE '{$thn}-{$bln}%' AND nip_karyawan='{$nip}'";
		return $this->db->query($q)->row();
	}

}