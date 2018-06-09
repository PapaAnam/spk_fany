function ceksandik(e)
{
  $('.notif').empty();
  if($('#sandi').val()!=$('#sandi2').val()){
    e.preventDefault();
    console.log('error');
    $('.notif').html('Sandi tidak sama!!!');
  }
}
function cekjam(v, id)
{
  var jam = v.substr(0, 2);
  var menit = v.substr(3, 2);
  var detik = v.substr(6, 2);
  detik = (detik>59) ? "00" : detik;
  menit = (menit>59) ? "00" : menit;
  jam = (jam>59) ? "00" : jam;
  $("#"+id).val(jam+":"+menit+":"+detik);
}
function cekvalidgaji(e){
  e.preventDefault();
  // console.log("function beraksi");
  d = new Date();
  blnskrng = d.getMonth()+1;
  thnskrng = d.getFullYear();
  if($("#bulan_penggajian").val()>blnskrng && $("#tahun_penggajian").val()>=thnskrng){
    alert("Belum waktunya penggajian!!!");
    e.preventDefault();
  }
  base_url = $('[name="urlgaji"]').val();
  $.ajax({
    type : 'GET',
    url  : base_url+'cekperiode/'+$('#nip_karyawan').val()+'/'+$("#bulan_penggajian").val()+'/'+$("#tahun_penggajian").val(),
    success : function(response){
      if(response>0){
        alert("Sudah melakukan penggajian di periode ini!!!");
      }else{
        action = $('.cmxform').attr('action');
        dataform = $('.cmxform').serialize();
        $.ajax({
          type    : 'POST',
          url     : action,
          data    : dataform,
          success : function(){
            window.location = base_url;
          },
          error   : function(){
            // $('h3').append('error');
          }
        });
      }
    }
  })
}
//PENGGUNA
function formpengguna(e){
 if($('#notifusername').text()){
   if($('#notifusername').text() != 'Nama valid'){
     e.preventDefault();
     alert($('#notifusername').text());
   }
 }
}
function typeusername(e){
 //backspace, panah kiri, panah kanan, del, enter
 key = [8, 37, 39, 46, 13];
  if(!(e.which>64&&e.which<91) && $.inArray(e.which, key)==-1 || e.ctrlKey==true){
    e.preventDefault();
  }
}
//ABSENSI
function typejam(v){
 v!='Masuk'?$('.jam').hide():$('.jam').show();
}
//LEMBUR
function typelamalembur(e){
 //backspace, panah kiri, panah kanan, del, koma
 key = [8, 37, 39, 46];
  if(!(e.which>47&&e.which<58) && $.inArray(e.which, key)==-1){
    if(e.which==188){
      if($('#lamalembur').val().includes(',')){
        e.preventDefault();
      }
    }else{
      e.preventDefault();
    }
  }
}
//REKAP
$('.selectdivisi, .selectjabatan').change(function(){
 filterkaryawan();
});

$('.selectbln, .selectthn').change(function(){
 filterwaktu();
});
function ceknip(v){
 if(v.length!=18){
   $('#notifnip').text('NIP harus 18 digit!');
 }else{
   $('#notifnip').text('');
 }
}
function cekgaji(){
  nip = $('#nip_karyawan').val();
  bln = $('#bulan_penggajian').val();
  thn = $('#tahun_penggajian').val();
  base_url = $('[name="cekgajiurl"]').val();
  $.ajax({
      type: 'GET',
      url: base_url+'/'+nip+'/'+bln+'/'+thn,
      success: function(data){
          obj = JSON.parse(data);
          $('#gaji_pokok').val(obj.gaji_pokok);
          $('#tunjangan').val(obj.tunjangan);
          $('#pulsa').val(obj.pulsa);
          $('#transportasi').val(obj.transportasi);
          $('#pinjaman').val(obj.pinjaman);
          $('#gaji_kotor').val(obj.gaji_kotor);
          $('#gaji_bersih').val(obj.gaji_bersih);
          $('#masuk').val(obj.masuk);
          $('#ijin').val(obj.ijin);
          $('#cuti').val(obj.cuti);
          $('#alpa').val(obj.alpa);
          $('#jenis_karyawan').val(obj.jenis_karyawan);
      },
      error: function(){
          
      }
  });
}
function inputmati(e){
  e.preventDefault();
}
function angkasaja(e){
//backspace, panah kiri, panah kanan, del
key = [8, 37, 39, 46];
 if(!(e.which>47&&e.which<58) && $.inArray(e.which, key)==-1){
   e.preventDefault();
 }
}
function namaorang(e){
//backspace, panah kiri, panah kanan, del, spasi
key = [8, 37, 39, 46, 32];
 if(!(e.which>64&&e.which<91) && $.inArray(e.which, key)==-1 && ((e.which!=188&&e.which!=190)||e.shiftKey==true) || e.ctrlKey==true){
   e.preventDefault();
 }
}

function cekkaryawan(e){
 if($('#notifnip').text()){
   e.preventDefault();
   alert($('#notifnip').text());
 }
}
function ubahfoto(modul){
  if($('#btnubahfoto').text() === 'Ubah Foto'){
      $('#ubahfoto').html(
      '<div class="input-group fileupload-v1">'+
          '<input accept="image/png, image/jpg, image/jpeg" type="file" name="foto_'+modul+'" class="fileupload-v1-file hidden" required>'+
          '<input type="text" class="form-control fileupload-v1-path" placeholder="Path Foto..." disabled>'+
          '<span class="input-group-btn">'+
            '<button onclick="up(this)" class="btn fileupload-v1-btn" type="button"><i id="hapusfoto" class="fa fa-folder"></i> Masukkan Foto</button>'+
          '</span>'+
        '</div>'
        );
      $('#btnubahfoto').text('Batal');
  }else{
      $('#ubahfoto').empty();
      $('#btnubahfoto').text('Ubah Foto');
  }
}
function ubahsandi(){
  if($('#btnubahsandi').text() === 'Ubah Sandi'){
      $('#ubahsandi').html(
      '<div class="col-md-12">'+
        '<div class="col-md-6">'+
          '<div class="form-group form-animate-text">'+
            '<input id="sandi" type="password" class="form-text" name="sandi_pengguna" onchange="ceksandi()" onkeyup="ceksandi()" required>'+
            '<span class="bar"></span>'+
            '<label>Sandi Pengguna</label>'+
         ' </div>'+
       ' </div>'+
     ' </div>'+
     ' <div class="col-md-12">'+
     '  <div class="col-md-6">'+
      '    <div class="form-group form-animate-text">'+
       '     <input id="sandi2" type="password" class="form-text" onchange="ceksandi()" onkeyup="ceksandi()" required>'+
       '     <span class="bar"></span>'+
        '    <label>Masukkan Kembali</label>'+
        '    <div id="notifsandi"></div>'+
        '  </div>'+
       ' </div>'+
      '</div>'
        );
      $('#btnubahsandi').text('Batal');
  }else{
      $('#ubahsandi').empty();
      $('#btnubahsandi').text('Ubah Sandi');
  }
}


function ceksandi(){
  if($('#sandi2').val() !== "" && $('#sandi').val() !== ""){
      if($('#sandi2').val() !== $('#sandi').val()){
          $('#notifsandi').text('Kata Sandi Tidak Cocok');
          $('#simpan').hide();
      }else{
          $('#notifsandi').text('Kata Sandi Cocok');
          $('#simpan').show();
      }
  }
}
  function up(sel){
    var wrapper = $(sel).parent("span").parent("div");
    var path    = wrapper.find($(".fileupload-v1-path"));
    var file    = wrapper.find($(".fileupload-v1-file"));
   file.click();
    file.on("change",function(){
          filename = $(this).val();
          ekstensi = filename.substr(filename.length-3, 3);
          path.attr("placeholder",filename);
        if(ekstensi !== 'png' && ekstensi !== 'jpg' && ekstensi !== 'peg'){
          alert('Foto tidak berekstensi png ataupun jpg');
          file.val('');
          path.attr('placeholder','');
        }
        if($('#btnubahsandi').text()=='Ubah Sandi'){
          $('#simpan').show();
        }else{
          if($('#notifsandi').text()=='Kata Sandi Tidak Cocok'){
            $('#simpan').hide();
          }else{
            $('#simpan').show();
          }
        }
        // console.log(wrapper);
        // console.log(path);
    });
  }

$('.mask-money').mask('000.000.000.000.000,00', {reverse: true});
// $('#tf').click(function(){
  function tf(){
    $('#foto').last().after(
      '<div class="row" id="foto">'+
          '<div class="col-md-11">'+
              '<div class="col-lg-12">'+
                '<div class="input-group fileupload-v1">'+
                  '<input type="file" name="foto[]" class="fileupload-v1-file hidden"/>'+
                  '<input type="text" class="form-control fileupload-v1-path" placeholder="Path Foto..." disabled>'+
                  '<span class="input-group-btn">'+
                    '<button onclick="up(this)" class="btn fileupload-v1-btn" type="button"><i class="fa fa-folder"></i> Masukkan Foto</button>'+
                  '</span>'+
                '</div><!-- /input-group -->'+
              '</div><!-- /.col-lg-6 -->'+
            '</div><!-- /.row -->'+
          '<div class="col-md-1"><i style="font-size:30px; cursor: pointer;" class="fa fa-remove" onclick="hf(this)"></i></div>'+
      '</div>')
  }
  function hf(sel){
      $(sel).parents('#foto').remove();
  }
  function f(url) {
      $.ajax({
        type : 'GET',
        url : url,
        success : function(isi){
          // console.log(isi);
          $('.modal-content').html(isi);
          $('#mymodal').modal();
          $('.dateAnimate').bootstrapMaterialDatePicker({ weekStart : 0, time: false,animation:true});
          $('.timeAnimate').bootstrapMaterialDatePicker({ date: false,format:'HH:mm:ss',animation:true});
          $('#statusabsensi').val()!='Masuk'?$('.jam').hide():$('.jam').show();
          $('#simpan').hide();
          $('.mask-time').mask('00:00:00');
        },
        error : function(isi){
        }
      });
  }
  function mod(url){
      f(url);
  }
  $('.mdl').click(function(){
      var url = $(this).attr('id');
      f(url);
  });
$(document).ready(function(){
 $('#datatables-example').DataTable();
 $('#datatables-example').removeClass('table-striped');
 $('#datatables-example').removeClass('table-bordered');
 $('#datatables-example').addClass('table-hover');
 // table-bordered
});