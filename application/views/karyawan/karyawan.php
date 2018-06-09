<div id="content">
  <div class="row">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Data Karyawan <a class="mdl btn btn-primary" id="<?= base_url() ?>karyawan/tambah">Tambah</a></h3><?= $this->session->userdata('error'). $this->session->userdata('uu')?>
        </div>
        <div class="panel-body">
          <div class="responsive-table">
            <table id="datatables-example" class="table  table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>NIP Karyawan</th>
                  <th>NIK</th>
                  <th>Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Status</th>
                  <th>No Telp</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($kar as $k){?>
                <tr>
                  <td><?= $k->nip_karyawan ?></td>
                  <td><?= $k->nik ?></td>
                  <td><?= $k->nama_karyawan ?></td>
                  <td><?= $k->jk_karyawan ?></td>
                  <td><?= $k->status_karyawan ?></td>
                  <td><?= $k->no_telp ?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Pilih Aksi
                        <span class="fa fa-angle-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a class="mdl" id="<?= base_url().'karyawan/rinci/'.$k->nip_karyawan ?>">Rinci</a></li>
                        <li><a class="mdl" id="<?= base_url().'karyawan/ubah/'.$k->nip_karyawan ?>">Ubah</a></li>
                        <li><a class="mdl" id="<?= base_url().'karyawan/hapus/'.$k->nip_karyawan ?>">Hapus</a></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>