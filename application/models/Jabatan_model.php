<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {

	public function by_id($id)
	{
		$this->db->where('id_jabatan', $id);
		$q = $this->db->get('karyawan');
		return $q->row_array();
	}

}