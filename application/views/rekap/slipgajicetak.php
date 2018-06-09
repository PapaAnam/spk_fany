<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Sistem Penggajian Karyawan">
    <meta name="author" content="Hairul Anam">
    <meta name="keyword" content="Sistem Penggajian Karyawan berbasis web menggunakan bahasa pemrograman PHP">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="<?= base_url() ?>images/app/<?=$this->config->item('favicon')?>">
    <style>
    table {
        width: 100%;
    }
    <?php 
    if(!isset($pdf)){
        ?>
        body {
            font-family: <?=$this->config->item('font_rekap')?>;
        }
        <?php 
    }
    ?>
    h3 {
        text-align: center;
    }
</style>
</head>
<body>
    <?php $this->load->view('rekap/header') ?>
    <h3>SLIP GAJI</h3>
    <table>
        <tr>
            <td>NIP Karyawan</td>
            <td>: <?= $nip_karyawan?></td>
            <td>No Telp</td>
            <td>: <?= $no_telp?></td>
        </tr>
        <tr>
            <td>Nama Karyawan</td>
            <td>: <?= $nama_karyawan?></td>
            <td>Jabatan</td>
            <td>: <?= $nama_jabatan?></td>
        </tr>
    </table>
    <hr>
    <table>
        <tr>
            <td width="30px"><b>No</b></td>
            <td><b>Keterangan</b></td>
            <td width="300px" align="right"><b>Jumlah</b></td>
            <td width="10px"></td>
        </tr>
        <tr>
            <td><?=$i++?>.</td>
            <td>Gaji Pokok</td>
            <td align="right"><?= rupiah($gaji_pokok)?></td>
            <td></td>
        </tr>
        <tr>
            <td><?=$i++?>.</td>
            <td>Tunjangan</td>
            <td align="right"><?= rupiah($tunjangan)?></td>
            <td></td>
        </tr>
        <tr>
            <td><?=$i++?>.</td>
            <td>Transportasi</td>
            <td align="right"><?= rupiah($transportasi)?></td>
            <td></td>
        </tr>
        <tr>
            <td><?=$i++?>.</td>
            <td>Pulsa</td>
            <td align="right"><?= rupiah($pulsa)?></td>
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
            <td align="right">
                <?php $gaji_temp = $gaji_pokok+$tunjangan+$pulsa+$transportasi; echo rupiah($gaji_temp)?>
            </td>
        </tr>
        <tr>
            <td><?=$i++?>.</td>
            <td>Pinjaman</td>
            <td align="right"><?= rupiah($pinjaman)?></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td><hr></td>
            <td>(-)</td>
        </tr>
        <tr>
            <td colspan="2"><b><i><?= terbilang($gaji_temp-$pinjaman)?></i></b><br><br></td>
            <td align="right"><?= rupiah($gaji_temp-$pinjaman)?></td>
        </tr>
    </table>
    <table>
        <tr>
            <td colspan="2">Penerima<br><br><br><br><br></td>
            <td align="right"><?= tglIndo(tglskrng()) ?></td>
        </tr>
        <tr>
            <td><?= $nama_karyawan?></td>
            <td></td>
            <td align="right"><?= $title ?></td>
        </tr>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>
