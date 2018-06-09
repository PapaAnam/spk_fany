<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembur_model extends CI_Model {

	public function by_bulan($bln, $thn, $nip)
	{
		$q = "SELECT SUM(lama_lembur) as lama_lembur FROM `lembur` WHERE tgl_lembur LIKE '{$thn}-{$bln}%' AND nip_karyawan='{$nip}'";
		return $this->db->query($q)->row();
	}

}