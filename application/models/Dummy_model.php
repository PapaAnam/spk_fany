<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dummy_model extends CI_Model {

	public function start()
	{
		$this->db->query('SET FOREIGN_KEY_CHECKS=0;');
		$this->load->helper('dummy');
		$this->refreshDivisi();
		$this->refreshJabatan();
		$this->refreshKaryawan();
		$this->refreshPengguna();
		$this->refreshPinjaman();
		$this->refreshAbsensi();
		$this->refreshLembur();
		$this->refreshGaji();
	}

	private function refreshDivisi($value='')
	{
		$this->db->truncate('divisi');
		$divisi = divisi_dummy();
		$div = [];
		foreach($divisi as $d):
			$div[] = ['nama_divisi' => $d];
		endforeach;
		$this->db->insert_batch('divisi', $div);
	}

	private function refreshJabatan()
	{
		$this->db->truncate('jabatan');
		$jabatan = jabatan_dummy();
		$jab = [];
		foreach($jabatan as $d):
			$jab[] = [
				'nama_jabatan' 	=> $d,
				'gaji_pokok' 	=> round(rand(2000000, 10000000), -5),
				'tunjangan'		=> round(rand(1000000, 50000000), -5),
				'lembur'		=> round(rand(10000, 100000), -3),
			];
		endforeach;
		$this->db->insert_batch('jabatan', $jab);
	}

	private function refreshKaryawan()
	{
		$this->db->truncate('karyawan');
		$karyawan = karyawan_dummy();
		$kar = [];
		$pendidikan = pendidikan_dummy();
		foreach($karyawan as $d):
			$kar[] = ['pendidikan_karyawan'=>random($pendidikan)]+$d;
		endforeach;
		$this->db->insert_batch('karyawan', $kar);
	}

	private function get_nip(){
		$karyawan 	= $this->db->get('karyawan')->result();
		$nip 		= array_column($karyawan, 'nip_karyawan');
		return $nip;
	}

	private function set_default_users()
	{
		$akun[] 	= [
			'nama_pengguna' 	=> 'admin',
			'sandi_pengguna' 	=> md5('admin'),
			'level_pengguna'	=> 1
		];
		$akun[] 	= [
			'nama_pengguna' 	=> 'manajer',
			'sandi_pengguna' 	=> md5('manajer'),
			'level_pengguna'	=> 2
		];
		$this->db->insert_batch('pengguna', $akun);
	}

	private function refreshPengguna(){
		$this->db->truncate('pengguna');
		$nip = $this->get_nip();
		$akun 		= [];
		$this->set_default_users();
		foreach($nip as $n):
			$akun[] = [
				'nama_pengguna' => $n,
				'sandi_pengguna' => md5($n),
				'level_pengguna' => 3
			];
		endforeach;
		$this->db->insert_batch('pengguna', $akun);
	}

	private function refreshPinjaman(){
		$this->db->truncate('pinjaman');
		$nip = $this->get_nip();
		shuffle($nip);
		$pin = [];
		$a = 1;
		foreach($nip as $i){
			$pin[] = [
				'nip_karyawan' 			=> $i,
				'status_pinjaman'		=> random(['Belum Lunas', 'Lunas']),
				'tgl_pinjaman'			=> date('Y-m-d', strtotime('-'.random(range(1, 60)).' days')),
				'besar_pinjaman'		=> round(rand(100000, 500000), -4),
				'keterangan_pinjaman' 	=> 'Alasan Pinjaman. Hutang .... Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet asperiores, dolorem quaerat dolores adipisci enim explicabo eveniet ab cupiditate deleniti nisi, eligendi voluptatem voluptas obcaecati? Blanditiis asperiores eos soluta! Inventore.',
			];
			if($a == 20)
				break;
			$a++;
		}
		$this->db->insert_batch('pinjaman', $pin);
	}

	private function refreshAbsensi()
	{
		$this->db->truncate('absensi');
		$nip = $this->get_nip();
		$abs = [];
		$men = ['01', '02', '03', '04', '05', '06', '07', '08', '09']+range(10, 59);
		foreach(range(1,3) as $a):
			foreach($nip as $i){
				$keterangan = '';
				$jam 		= random(['07', '08', '09', '10']);
				$menit 		= random($men);
				$detik 		= random($men);
				$status 	= random(['Masuk', 'Cuti', 'Ijin', 'Alpa', 'Libur']);
				$jam_masuk 	= $jam.':'.$menit.':'.$detik;
				$jam 		= random(range(15, 23));
				$menit 		= random($men);
				$detik 		= random($men);
				$jam_keluar = $jam.':'.$menit.':'.$detik;
				if($jam_masuk > $this->config->item('jam_terlambat'))
					$status = 'Terlambat';
				if($status != 'Terlambat' && $status != 'Masuk'){
					$jam_masuk 	= '';
					$jam_keluar = '';
					$keterangan = 'Alasan ....';
				}
				$abs[] 		= [
					'nip_karyawan' 			=> $i,
					'status_absensi'		=> $status,
					'tgl_absensi'			=> date('Y-m-d', strtotime('-'.$a.' days')),
					'jam_masuk_absensi'		=> $jam_masuk,
					'jam_keluar_absensi'	=> $jam_keluar,
					'keterangan_absensi' 	=> $keterangan,
				];
			}
		endforeach;
		$this->db->insert_batch('absensi', $abs);
	}

	private function refreshLembur()
	{
		$this->db->truncate('lembur');
		$abs = $this->db->query('SELECT * FROM `absensi` WHERE 
			status_absensi=\'Masuk\' AND jam_keluar_absensi > \''.$this->config->item('jam_keluar').'\'
			ORDER BY jam_keluar_absensi ASC')->result();
		$lem = [];
		foreach ($abs as $a) {
			$diff 			= strtotime($a->jam_keluar_absensi)-strtotime($this->config->item('jam_keluar'));
			$lama_lembur 	= round($diff/3600);
			if($lama_lembur > 0) :
				$lem[] 			= [
					'nip_karyawan' 		=> $a->nip_karyawan,
					'tgl_lembur'		=> $a->tgl_absensi,
					'lama_lembur'		=> $lama_lembur,
					'keterangan_lembur' => 'Lembur ....'
				];
			endif;
		}
		$this->db->insert_batch('lembur', $lem);
	}

	private function refreshGaji()
	{
		$this->db->truncate('penggajian');
		$per 		= [date('Y-m'), date('Y-m', strtotime('-1 months'))];
		$gaji 		= [];
		$a = 1;
		$this->load->model(['pinjaman_model', 'lembur_model', 'karyawan_model', 'absensi_model', 'absensi_model']);
		foreach ($per as $p) {
			foreach ($this->karyawan_model->all() as $k) {
				$nip 			= $k->nip_karyawan;
				$bln 			= substr($p, 5, 2);
				$thn 			= substr($p, 0, 4);
				$pinjaman 		= $this->pinjaman_model->pinjaman_by_bulan($bln, $thn, $nip)->pinjaman;
				$lama_lembur 	= $this->lembur_model->by_bulan($bln, $thn, $nip)->lama_lembur;
				if(!$pinjaman)
					$pinjaman = 0;
				$lembur 		= 0;
				if($lama_lembur)
					$lembur 		= $k->lembur*$lama_lembur;
				$gaji_kotor		= $k->gaji_pokok+$k->tunjangan+$lembur-$pinjaman;
				if($k->jenis_karyawan === 'Sementara'){
					$total_masuk	= $this->absensi_model->total_masuk($bln, $thn, $nip)->masuk;
					$gp = $k->gaji_pokok * $total_masuk / 30;
					$t = $k->tunjangan * $total_masuk / 30;
					$gaji_kotor		= $gp + $t + $lembur - $pinjaman;
				}
				$pph 			= $gaji_kotor * $this->config->item('pph') / 100;
				$bpjs 			= $gaji_kotor * $this->config->item('bpjs') / 100;
				$gaji_bersih 	= $gaji_kotor - $bpjs - $pph;
				if($gaji_bersih > 1000000) : 
					$gaji[] 		= [
						'nip_karyawan' 			=> $nip,
						'bulan_penggajian'		=> $bln,
						'tahun_penggajian'		=> $thn,
						'tgl_penggajian'		=> $a === 2 ? date('Y-m-d', strtotime('-30 days')) : date('Y-m-d'),
						'pinjaman'				=> $pinjaman,
						'lembur'				=> $lembur,
						'gaji_kotor'			=> $gaji_kotor,
						'pph'					=> $pph,
						'bpjs_ketenagakerjaan'	=> $bpjs,
						'gaji_bersih'			=> $gaji_bersih,
					];
				endif;
			}
			$a++;
		}
		$this->db->insert_batch('penggajian', $gaji);
		echo 'REFRESH DATA GAJI BERHASIL :)';	
	}

	public function reset()
	{
		$this->db->query('SET FOREIGN_KEY_CHECKS=0;');
		$this->db->truncate('divisi');
		$this->db->truncate('jabatan');
		$this->db->truncate('karyawan');
		$this->db->truncate('pengguna');
		$this->db->truncate('pinjaman');
		$this->db->truncate('absensi');
		$this->db->truncate('lembur');
		$this->db->truncate('penggajian');
		$this->set_default_users();
		echo 'RESET BERHASIL DILAKUKAN :)';
	}

}