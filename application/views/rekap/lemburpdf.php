<h3>REKAP LEMBUR</h3>
<table>
    <tr class="atas">
        <th>ID LEMBUR</th>
        <td>KARYAWAN</td>
        <td>TANGGAL</td>
        <td>LAMA LEMBUR</td>
        <td>KETERANGAN</td>
    </tr>
    <?php $no=1;foreach($data as $d){?>
    <tr>
        <td><?= $d->id_lembur ?></td>
        <td>
            <?= $d->nip_karyawan.' ('.$d->nama_karyawan.')' ?>
        </td>
        <td>
            <?= tglIndo($d->tgl_lembur) ?>
        </td>
        <td>
            <?= koma($d->lama_lembur) ?> jam</td>
        <td>
            <?= $d->keterangan_lembur ?>
        </td>
    </tr>
    <?php $no++;} ?>
</table>