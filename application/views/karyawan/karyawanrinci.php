<div class="col-md-12">
  <div class="panel">
    <div class="panel-heading">
      <h4>Rinci Karyawan 
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </h4>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table">
            <tbody>
              <tr>
                <td>NIP Karyawan</td>
                <td><?= $kar['nip_karyawan'] ?></td>
              </tr>
              <tr>
                <td>Nama</td>
                <td><?= $kar['nama_karyawan'] ?></td>
              </tr>
              <tr>
                <td>Jenis Kelamin</td>
                <td><?= $kar['jk_karyawan'] ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td><?= $kar['status_karyawan'] ?></td>
              </tr>
              <tr>
                <td>Jabatan</td>
                <td><?= $kar['nama_jabatan'] ?></td>
              </tr>
              <tr>
                <td>Gaji Pokok</td>
                <td><?= rupiah($kar['gaji_pokok']) ?></td>
              </tr>
              <tr>
                <td>Tunjangan</td>
                <td><?= rupiah($kar['tunjangan']) ?></td>
              </tr>
              <tr>
                <td>Lembur (Per jam)</td>
                <td><?= rupiah($kar['lembur']) ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>