<div id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Rekap Jabatan
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pilih Aksi
                                <span class="fa fa-angle-down"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="<?= $urlcetak ?>">Cetak</a></li>
                                <li><a target="_blank" href="<?= $urlpdf ?>">PDF</a></li>
                            </ul>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <table id="datatables-example" class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID Jabatan</th>
                                    <th>Nama Jabatan</th>
                                    <th>Gaji Pokok</th>
                                    <th>Tunjangan</th>
                                    <th>Transportasi</th>
                                    <th>Pulsa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1;foreach($jab as $j){?>
                                    <tr>
                                        <td><?= $j->id_jabatan ?></td>
                                        <td><?= $j->nama_jabatan ?></td>
                                        <td><?= rupiah($j->gaji_pokok) ?></td>
                                        <td><?= rupiah($j->tunjangan) ?></td>
                                        <td><?= rupiah($j->transportasi) ?></td>
                                        <td><?= rupiah($j->pulsa) ?></td>
                                    </tr>
                                    <?php $no++;} ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>