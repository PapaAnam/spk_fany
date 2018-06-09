<body>
    <center>
        <div class="kertas">
            <?php $this->load->view('rekap/header') ?>
            <h3>REKAP KARYAWAN</h3>
            <table>
                <tr class="atas">
                    <td>NIP KARYAWAN</td>
                    <td>NAMA KARYAWAN</td>
                    <td>JABATAN</td>
                    <td>GAJI POKOK</td>
                    <td>TUNJANGAN</td>
                    <td>TRANSPORTASI</td>
                    <td>PULSA</td>
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
                        <?= $d->nama_jabatan ?>
                    </td>
                    <td>
                        <?= rupiah($d->gaji_pokok) ?>
                    </td>
                    <td>
                        <?= rupiah($d->tunjangan) ?>
                    </td>
                    <td>
                        <?= rupiah($d->transportasi) ?>
                    </td>
                    <td>
                        <?= rupiah($d->pulsa) ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </center>
    <script>
        window.print();
    </script>
</body>
</html>