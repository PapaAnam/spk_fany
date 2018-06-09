<h3>REKAP ABSENSI</h3>
<table>
    <tr class="atas">
        <td>ID ABSENSI</td>
        <td>NIP KARYAWAN (NAMA)</td>
        <td>TANGGAL</td>
        <td>STATUS</td>
        <td>JAM MASUK</td>
        <td>JAM KELUAR</td>
    </tr>
    <?php $no=1;foreach($data as $d){?>
    <tr>
        <td>
            <?= $d->id_absensi ?>
        </td>
        <td>
            <?= $d->nip_karyawan.' ('.$d->nama_karyawan.')' ?>
        </td>
        <td>
            <?= tglIndo($d->tgl_absensi) ?>
        </td>
        <td>
            <?= $d->status_absensi ?>
        </td>
        <td>
            <?= $d->jam_masuk_absensi ?>
        </td>
        <td>
            <?= $d->jam_keluar_absensi ?>
        </td>
    </tr>
    <?php $no++;} ?>
</table>