<div class="row">
  <div class="col-md-12">
    <div class="panel">
      <div style="color: white;" class="panel-body bg-danger text-center">
        <?php if(date('Y') > $this->config->item('tahun_berdiri')){ ?>
        Copyright <?= $this->config->item('tahun_berdiri') ?> - <?= date('Y') ?>
        <?php } else { ?>
        Copyright <?= date('Y') ?>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
<!-- start: Javascript -->
<script src="<?= $burl ?>asset/js/jquery.min.js"></script>
<script src="<?= $burl ?>asset/js/jquery.ui.min.js"></script>
<script src="<?= $burl ?>asset/js/bootstrap.min.js"></script>
<!-- plugins -->
<script src="<?= $burl ?>asset/js/plugins/holder.min.js"></script>
<script src="<?= $burl ?>asset/js/plugins/moment.min.js"></script>
<script src="<?= $burl ?>asset/js/plugins/jquery.nicescroll.js"></script>
<script src="<?= $burl ?>asset/js/plugins/jquery.validate.min.js"></script>
<script src="<?= $burl ?>asset/js/plugins/jquery.mask.min.js"></script>
<script src="<?= $burl ?>asset/js/plugins/bootstrap-material-datetimepicker.js"></script>
<!--START DATATABLES -->
<script src="<?= $burl ?>asset/js/plugins/jquery.datatables.min.js"></script>
<script src="<?= $burl ?>asset/js/plugins/datatables.bootstrap.min.js"></script>
<!--END DATATABLES -->
<!-- custom -->
<script src="<?= $burl ?>asset/js/main.js"></script>
<script src="<?= $burl ?>asset/js/sipeka.js"></script>
<script type="text/javascript">
 function checkTime(i) {
  if (i < 10) {i = "0" + i};
  return i;
}
function startTime() {
  var weekday = new Array(7);
  weekday[0] =  "Sunday";
  weekday[1] = "Monday";
  weekday[2] = "Tuesday";
  weekday[3] = "Wednesday";
  weekday[4] = "Thursday";
  weekday[5] = "Friday";
  weekday[6] = "Saturday";

  var month = new Array();
  month[0] = "January";
  month[1] = "February";
  month[2] = "March";
  month[3] = "April";
  month[4] = "May";
  month[5] = "June";
  month[6] = "July";
  month[7] = "August";
  month[8] = "September";
  month[9] = "October";
  month[10] = "November";
  month[11] = "December";

  var today = new Date();
  var n = weekday[today.getDay()];
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  $('.absensi-baru').html('<i class="fa fa-clock-o"></i> '+n+', '+month[today.getMonth()]+' '+today.getDate()+' '+today.getFullYear()+' '+h + ":" + m + ":" + s);
  setTimeout(startTime, 500);
}
function filterkaryawan(){
 // window.location = '<?=$url?>'+'rekapkaryawan/'+$('.selectdivisi').val()+'/'+$('.selectjabatan').val();
 window.location = '<?=$url?>'+'rekapkaryawan/'+$('.selectjabatan').val();
}
function filterwaktu(){
 window.location = '<?=$url?>'+'<?=$this->uri->segment(2)?>/'+$('.selectbln').val()+'/'+$('.selectthn').val();
}
function to()
{
  window.location = '<?=base_url()."peka/rekapabsensi/" ?>'+$('#bulan').val()+'/'+$('#tahun').val()+'/'+$('#status').val();
}
function cekusername(username){
  $.ajax({
    type:'GET',
    url:'<?= $url."cekusername/"?>'+username,
    success:function(data){
      if(data>0){
        $('#notifusername').text('Nama sudah ada!!!');
        $('#simpan').hide();
      }else{
        if(username.length <5){
          $('#notifusername').text('Nama minimal 5 karakter');
          $('#simpan').hide();
        }else{
          $('#notifusername').text('Nama valid');
          $('#simpan').show();
        }
      }
    },
    error:function(){

    }
  });
}
$(document).ready(function()
{
  startTime();
});
</script>
</body>
</html>
