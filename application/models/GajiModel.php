<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class GajiModel extends CI_Model {
	function cekuser($u, $p){
		$hasil = "";
		$qry = $this->db->get_where('pengguna', array('nama_pengguna'=>$u));
		if($qry->num_rows() > 0 ){
			$qry = $this->db->get_where('pengguna', array('sandi_pengguna'=>$p));
			if($qry->num_rows() > 0 ){
				$hasil = $qry->num_rows();
			}else{
				$hasil = 'Kata Sandi Salah!!!';
			}
		}else{
			$hasil = 'Nama Pengguna Tidak Ada!!!';
		}
		return $hasil;
	}
	function view($tbl, $whr=array()){
		$this->db->select('*');
		$this->db->from($tbl);
		if($tbl==='karyawan'){
			$this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan');
		}else if($tbl==='absensi'){
			$this->db->join('karyawan', 'karyawan.nip_karyawan = absensi.nip_karyawan');
		}else if($tbl==='pinjaman'){
			$this->db->join('karyawan', 'karyawan.nip_karyawan = pinjaman.nip_karyawan');
		}else if($tbl==='lembur'){
			$this->db->join('karyawan', 'karyawan.nip_karyawan = lembur.nip_karyawan');
		}else if($tbl==='penggajian'){
			$this->db->join('karyawan', 'karyawan.nip_karyawan = penggajian.nip_karyawan');
			$this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan');
		}
		if(is_array($whr)){
			$this->db->where($whr);
		}
		return $this->db->get()->result();
	}
	public function gajian($whr)
	{
		$this->db->select('*');
		$this->db->from('penggajian');
		$this->db->join('karyawan', 'karyawan.nip_karyawan = penggajian.nip_karyawan');
	// $this->db->join('divisi', 'karyawan.id_divisi = divisi.id_divisi');
		$this->db->join('jabatan', 'karyawan.id_jabatan = jabatan.id_jabatan');
		if(is_array($whr)){
			$this->db->where($whr);
		}
		return $this->db->get()->result();
	}
	function viewo($tbl, $order=array(), $whr=array()){
		$this->db->select('*');
		$this->db->from($tbl);
		$this->db->order_by($order[0], $order[1]);
		$this->db->where($whr);
		return $this->db->get()->result();
	}
	function insert($tbl, $data){
		return $this->db->insert($tbl, $data);
	}
	function update($tbl, $data, $whr){
		return $this->db->update($tbl, $data, $whr);
	}
	function delete($tbl, $whr){
		return $this->db->delete($tbl, $whr);
	}
	function totalpinjaman($nip, $bln, $thn){
		$this->db->select_sum('besar_pinjaman')->from('pinjaman')->where(array('nip_karyawan'=>$nip, 'status_pinjaman'=>'Belum Lunas'))->where('month(tgl_pinjaman)', $bln)->where('year(tgl_pinjaman)', $thn);
		$pinjaman = $this->db->get()->result();
		$totalpinjaman;
		foreach($pinjaman as $p){
			$totalpinjaman = $p->besar_pinjaman;
		}
		return empty($totalpinjaman)? $hasil = 0: $hasil=$totalpinjaman;
	}
	function totallembur($nip, $bln, $thn){
		$lembur = $this->db->query("select month(tgl_lembur) as bulan, count(*) as jumlah_lembur, sum(lama_lembur) as total_lembur from lembur where nip_karyawan = '".$nip."' and month(tgl_lembur) = '".$bln."' and year(tgl_lembur) = '".$thn."' GROUP BY bulan")->result();
		$total_jam_lembur = "";
		$ar['total_jam_lembur'] = '0';
		$ar['jumlah_lembur'] = '0';
		foreach ($lembur as $l) {
			$ar['total_jam_lembur'] 	= $l->total_lembur;
			$ar['jumlah_lembur']		= $l->jumlah_lembur;
		}
		return $ar;
	}
	function count($tbl, $whr=null){
		if(is_array($whr)){
			$this->db->where($whr);
		}
		return $this->db->get($tbl)->num_rows();
	}
	function karyawanbaru(){
		return $this->db->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')->limit(10)->get('karyawan')->result();
	}
	function absensi($nip, $bln, $thn){
		$status = ['Masuk', 'Ijin', 'Cuti', 'Alpa'];
		$status_absensi = [];
		foreach ($status as $s) {
			$masuk = $this->db->query('select count(status_absensi) as totalmasuk from absensi where nip_karyawan=\''.$nip.'\' and YEAR(tgl_absensi)=\''.$thn.'\' and MONTH(tgl_absensi)=\''.$bln.'\' and status_absensi=\''.$s.'\'')->result();
			foreach ($masuk as $m) {
				$totalmasuk = $m->totalmasuk;
			}
			$status_absensi[$s] = $totalmasuk;
		}
		return $status_absensi;
	}
}
