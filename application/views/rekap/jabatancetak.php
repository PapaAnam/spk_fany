<body>
    <center>
        <div class="kertas">
            <?php $this->load->view('rekap/header') ?>
            <h3>REKAP JABATAN</h3>
            <table>
                <tr class="atas">
                    <th>ID Jabatan</th>
                    <td>NAMA JABATAN</td>
                    <td>GAJI POKOK</td>
                    <td>TUNJANGAN</td>
                    <td>TRANSPORTASI</td>
                    <td>PULSA</td>
                </tr>
                <?php $no=1;foreach($data as $d){?>
                <tr>
                    <td><?= $d->id_jabatan ?></td>
                    <td><?= $d->nama_jabatan ?></td>
                    <td><?= rupiah($d->gaji_pokok) ?></td>
                    <td><?= rupiah($d->tunjangan) ?></td>
                    <td><?= rupiah($d->transportasi) ?></td>
                    <td><?= rupiah($d->pulsa) ?></td>
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