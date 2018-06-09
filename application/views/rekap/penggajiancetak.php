<body>
    <center>
        <div class="kertas">
            <?php $this->load->view('rekap/header') ?>
            <h3>REKAP GAJI</h3>
            <table>
                <tr class="atas">
                    <th>ID PENGGAJIAN</th>
                    <td>KARYAWAN</td>
                    <td>TANGGAL</td>
                    <td>PERIODE</td>
                    <td>GAJI BERSIH</td>
                </tr>
                <?php $no=1;foreach($data as $d){?>
                <tr>
                    <td><?= $d->id_penggajian ?></td>
                    <td>
                        <?= $d->nip_karyawan.' ('.$d->nama_karyawan.')' ?>
                    </td>
                    <td>
                        <?= tglIndo($d->tgl_penggajian) ?>
                    </td>
                    <td>
                        <?= namaBulan($d->bulan_penggajian).' '.$d->tahun_penggajian ?>
                    </td>
                    <td>
                        <?= rupiah($d->gaji_bersih) ?>
                    </td>
                </tr>
                <?php $no++;} ?>
            </table>
        </div>
    </center>
    <script>
        window.print();
    </script>
</body>
</html>