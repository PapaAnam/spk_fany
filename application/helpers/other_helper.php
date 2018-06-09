<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function tglIndo($val){
	$thn = substr($val, 0, 4);
	$bln = substr($val, 5, 2);
	$tgl = substr($val, 8, 2);
	if($tgl=='00'||$bln=='00'||$thn=='0000'){
		return 'Tanggal tidak valid';
	}
	return $tgl.' '.namaBulan($bln).' '.$thn;
}

function namaBulan($bln){
	switch($bln){
		case '01': $nama = 'Januari'; break;
		case '02': $nama = 'Februari'; break;
		case '03': $nama = 'Maret'; break;
		case '04': $nama = 'April'; break;
		case '05': $nama = 'Mei'; break;
		case '06': $nama = 'Juni'; break;
		case '07': $nama = 'Juli'; break;
		case '08': $nama = 'Agustus'; break;
		case '09': $nama = 'September'; break;
		case '10': $nama = 'Oktober'; break;
		case '11': $nama = 'November'; break;
		case '12': $nama = 'Desember'; break;
		default : $nama = 'error';
	}
	return $nama;
}

function rupiah($uang, $rp='Rp'){
	if($rp==='Rp'){
		return 'Rp. '.number_format($uang, 2,',', '.');
	}else{
		return number_format($uang, 2,',', '.');
	}
}

function level($val){
	switch ($val) {
		case 1:
		return 'Admin';
		break;
		case 2:
		return 'Direktur';
		break;
		
		default:
		return 'Karyawan';
		break;
	}
}
/*HELPER WAKTU BY HAIRUL ANAM */
function zonawaktu(){
	date_default_timezone_set('Asia/Jakarta');
}
function thnskrng(){
	return date('Y');
}
function tglskrng(){
	return date('Y-m-d');
}
function blnskrng(){
	return date('m');
}
function jamskrng(){
	return date('H:i:s');
}
function cekjam($v){
	return $v=='00:00:00'?$hsl = '-':$hsl = $v;
}
function duit($duit){
	return str_replace(',', '.', str_replace('.', '', $duit));
}
function koma($val){
	return str_replace('.', ',', $val);
}
function titik($val){
	return str_replace(',', '.', $val);
}
function getsuffix($foto){
	$suffix = "";
	if($foto==='image/jpeg'){
		$suffix = '.jpg';
	}else if($foto==='image/png'){
		$suffix = '.png';
	}
	return $suffix;
}
function terbilang($satuan)
{
	if($satuan<0)
		return 'Tidak valid';
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	if ($satuan < 12)
		return " " . $huruf[$satuan];
	elseif ($satuan < 20)
		return terbilang($satuan - 10) . "belas";
	elseif ($satuan < 100)
		return terbilang($satuan / 10) . " puluh" . terbilang($satuan % 10);
	elseif ($satuan < 200)
		return " seratus" . terbilang($satuan - 100);
	elseif ($satuan < 1000)
		return terbilang($satuan / 100) . " ratus" . terbilang($satuan % 100);
	elseif ($satuan < 2000)
		return " seribu" . terbilang($satuan - 1000);
	elseif ($satuan < 1000000)
		return terbilang($satuan / 1000) . " ribu" . terbilang($satuan % 1000);
	elseif ($satuan < 1000000000)
		return terbilang($satuan / 1000000) . " juta" . terbilang($satuan % 1000000);
	elseif ($satuan >= 1000000000)
		echo "Hasil terbilang tidak dapat di proses karena nilai uang terlalu besar!"; 
}


function ceklevel($optional = null){
	$ci =& get_instance();
	if($ci->session->userdata('level')!='1' and $optional==null){
		redirect(base_url().'peka/eror404');
	}
}