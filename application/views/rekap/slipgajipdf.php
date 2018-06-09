<title>Slip Gaji PDF</title>
<style>
    .text-right  {
        text-align: right;
    }
</style>
<?php $this->load->view('rekap/header') ?>
<h3 style="text-align: center;">SLIP GAJI</h3>
<table width="100%">
    <tr>
        <td width="20%">NIP Karyawan</td>
        <td>: <?= $nip_karyawan?></td>
        <td><div class="text-right">Divisi</div></td>
        <td>: <?= $nama_divisi?></td>

    </tr>
    <tr>
        <td>Nama Karyawan</td>
        <td>: <?= $nama_karyawan?></td>
        <td><div class="text-right">Jabatan</div></td>
        <td>: <?= $nama_jabatan?></td>
    </tr>
    <tr>
        <td colspan="4"><hr></td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td width="5%"><b>No</b></td>
        <td width="40%"><b>Keterangan</b></td>
        <td width="50%"><b>
            <div class="text-right">
                Jumlah
            </div>
        </b>
    </td>
</tr>
<tr>
    <td>1.</td>
    <td>Gaji Pokok</td>
    <td><div class="text-right"><?= rupiah($gaji_pokok)?></div></td>
</tr>
<tr>
    <td>2.</td>
    <td>Tunjangan</td>
    <td><div class="text-right"><?= rupiah($tunjangan)?></div></td>
    <td></td>
</tr>
<tr>
    <td>3.</td>
    <td>Lembur</td>
    <td><div class="text-right"><?= rupiah($lembur)?></div></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td><hr></td>
    <td>(+)</td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td>
        <div class="text-right">
            <?php $gaji_temp = $gaji_pokok+$tunjangan+$lembur; echo rupiah($gaji_temp)?>
        </div>
    </td>
</tr>
<tr>
    <td>4.</td>
    <td>Pinjaman</td>
    <td><div class="text-right"><?= rupiah($pinjaman)?></div></td>
    <td></td>
</tr>
<tr>
    <td></td>
    <td></td>
    <td><hr></td>
    <td>(-)</td>
</tr>
</table>
<table width="100%">
    <tr>
        <td width="5%"></td>
        <td width="40%"><b><i><?= terbilang($gaji_temp-$pinjaman)?></i></b><br><br></td>
        <td width="50%"><div class="text-right"><?= rupiah($gaji_temp-$pinjaman)?></div></td>
        <td></td>
    </tr>
</table>
<table width="100%">
    <tr>
        <td>Penerima<br><br><br><br></td>
        <td><div class="text-right"><?= tglIndo(tglskrng()) ?></div><br><br><br></td>
    </tr>
    <tr>
        <td><?= $nama_karyawan?></td>
        <td><div class="text-right"><?= $title ?></div></td>
    </tr>
</table>