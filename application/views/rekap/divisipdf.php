<h3>REKAP DIVISI</h3>
<table>
    <tr class="atas">
        <th>ID DIVISI</th>
        <td>NAMA DIVISI</td>
    </tr>
    <?php $no=1;foreach($data as $d){?>
    <tr>
        <td><?= $d->id_divisi ?></td>
        <td>
            <?= $d->nama_divisi ?>
        </td>
    </tr>
    <?php } ?>
</table>