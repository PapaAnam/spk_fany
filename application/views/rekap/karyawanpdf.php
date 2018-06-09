<h3>REKAP KARYAWAN</h3>
<table>
    <tr class="atas">
        <td>NIP KARYAWAN</td>
        <td>NAMA KARYAWAN</td>
        <td>DIVISI</td>
        <td>JABATAN</td>
        <td>GAJI POKOK</td>
        <td>TUNJANGAN</td>
        <td>LEMBUR (PER JAM)</td>
    </tr>
    <?php foreach($data as $d){?>
    <tr>
        <td>
            <?= $d->nip_karyawan ?>
        </td>
        <td>
            <?= $d->nama_karyawan ?>
        </td>
        <td>
            <?= $d->nama_divisi ?>
        </td>
        <td>
            <?= $d->nama_jabatan ?>
        </td>
        <td>
            <?= rupiah($d->gaji_pokok) ?>
        </td>
        <td>
            <?= rupiah($d->tunjangan) ?>
        </td>
        <td>
            <?= rupiah($d->lembur) ?>
        </td>
    </tr>
    <?php } ?>
</table>