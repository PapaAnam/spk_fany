
<div class="modal-body">
<?php
  if($modul === 'produk'){
    $this->load->view($folder.'produkModal', array('aksi'=>$aksi));
  }
?>
</div>
<div class="modal-footer">
  
  <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
</div>