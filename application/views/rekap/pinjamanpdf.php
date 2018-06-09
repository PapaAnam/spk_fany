<h3>REKAP PINJAMAN</h3>
<table>
    <tr class="atas">
        <th>ID PINJAMAN</th>
        <td>PEMINJAM</td>
        <td>TANGGAL</td>
        <td>BESAR PINJAMAN</td>
        <td>STATUS</td>
        <td>KETERANGAN</td>
    </tr>
    <?php $no=1;foreach($data as $d){?>
    <tr>
        <td><?= $d->id_pinjaman ?></td>
        <td>
            <?= $d->nip_karyawan.' ('.$d->nama_karyawan.')' ?>
        </td>
        <td>
            <?= tglIndo($d->tgl_pinjaman) ?>
        </td>
        <td>
            <?= rupiah($d->besar_pinjaman) ?>
        </td>
        <td>
            <?= $d->status_pinjaman ?>
        </td>
        <td>
            <?= $d->keterangan_pinjaman ?>
        </td>
    </tr>
    <?php $no++;} ?>
</table>