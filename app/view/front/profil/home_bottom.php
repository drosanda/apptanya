var page = 1;
var jumlahpage = 0;
var keyword = '';

function hitungHalaman(jumlah, pagesize){
  jumlahpage = Math.ceil(jumlah/pagesize);
}

function getData(utype='scroll'){
	NProgress.start();
  $.get("<?=base_url("api_web/bimbingan/?keyword=")?>"+keyword+"&page="+page).done(function(dt){
		NProgress.done();
    if(dt.status == 200){
      var h = '';
      if(dt.data.pertanyaan.length > 0){
        $.each(dt.data.pertanyaan, function(k,v){
          var u = '<?=base_url('bimbingan/detail/')?>'+v.id;
          h += '<div class="row ">'
          h += '<a id="'+v.id+'" href="'+u+'" class="lpertanyaan">'
          h +='<div class="col-md-12 pull-right">'
          h += '<div class="row">'
          h += '<div class="col-md-3 col-xs-6" style="margin-bottom:10px">'
					h += '<span class="label label-default ">'+v.dokutype+' - '+v.doknama+'</span>'
          h += '</div>'
          h += '<div class="col-md-2 col-xs-6" style="margin-bottom:10px">'
          h += '<span class="label bg-secondary ">'+v.jurnama+'</span>'
          h += '</div>'
          h += '<div class="col-md-3 col-xs-6" style="margin-bottom:10px">'
          h += '<span class="label label-'+v.status+' ">'+v.status_teks+'</span>'
          h += '</div>'
          h += '<div class="col-md-12 col-xs-12">'
          h += '<h4>'+v.deskripsi+'</h4>';
          h += '</div>'
          <?php if($sess->user->is_mentor){ ?>
          h += '<div class="col-md-12 col-xs-12">'
          h += '<span class="label label-warning ">'+v.fnama+' - '+v.instansi+'</span> <span class="label label-primary ">'+v.jenjang+'</span>';
          h += '</div>'
          <?php } ?>
          h += '</div></div></a></div><hr />';
        })

				$.each(dt.data.statistik, function(k,v){
					$("#v"+v.status).text(v.total);
				})

        hitungHalaman(dt.data.jumlah, dt.data.pagesize)
      }else{
        h += '<div class="row text-center"><p>Data tidak ditemukan.</p></div>';
      }
			if(utype == 'cari'){
				$("#panel-pertanyaan").html(h);
			}else{
				$("#panel-pertanyaan").append(h);
			}

      $("#panel-pertanyaan").off('click','.lpertanyaan')
      $("#panel-pertanyaan").on('click','.lpertanyaan',function(e){
        e.preventDefault();
        var id = $(this).attr('id');
        window.location = '<?=base_url('bimbingan/detail/')?>' + id;
      })
    }else{
      gritter('<h4>Gagal</h4><p>'+dt.message+'</p>','warning');
    }
  }).fail(function(){
		NProgress.done();
    gritter('<h4>Gagal</h4><p>Anda tidak bisa mengambil data. Coba beberapa saat lagi</p>','warning');
  })
}

$("#bkeyword").on('click',function(e){
  e.preventDefault();
  $('#fcari').trigger("submit");
});

$('#fcari').on("submit",function(e){
  e.preventDefault();
  keyword = $("#ikeyword").val();
  page = 0;
  getData('cari');
});

//infinite scroll
var win = $(window);
// Each time the user scrolls
win.scroll(function() {
	// End of the document reached?
	if ($(document).height() - win.height() == win.scrollTop()) {
		if(page < jumlahpage){
      page++;
      getData();
    }
	}
});


getData();

$("#iokupansi").val("<?=$sess->user->a_kategori_id_ocp?>");
$("#ijurusan").val("<?=$sess->user->a_kategori_id_jur?>");

$("#fedit").on('submit', function(e){
	e.preventDefault();
	NProgress.start();
  $('.btn-submit').prop('disabled',true);
  $('.icon-submit').addClass('fa-circle-o-notch');
  $('.icon-submit').addClass('fa-spin');
	var fd = $(this).serialize();
	var url = '<?=base_url("api_web/user/edit/")?>'
	$.post(url,fd).done(function(dt){
		NProgress.done();
		if(dt.status == 200){
			gritter('<h4>Berhasil</h4><p>profil berhasil diedit</p>','success');
			setTimeout(function(){
				window.location = '<?=base_url('profil')?>'
			},2555)
		}else{
			gritter('<h4>Gagal</h4><p>'+dt.message+'</p>','warning');
      $('.btn-submit').prop('disabled',false);
      $('.icon-submit').removeClass('fa-circle-o-notch');
      $('.icon-submit').removeClass('fa-spin');
    	NProgress.done();
		}
	}).fail(function(){
		gritter('<h4>Gagal</h4><p>Coba beberapa saat lagi</p>','danger');
    $('.btn-submit').prop('disabled',false);
    $('.icon-submit').removeClass('fa-circle-o-notch');
    $('.icon-submit').removeClass('fa-spin');
    NProgress.done();
	})
});

$("#bedit").on('click',function(e){
	e.preventDefault();
	$("#modal_edit_profil").modal('show');
});

$("#bgp").on('click',function(e){
	e.preventDefault();
	$("#modal_password_ganti").modal('show');
});

$("#fpassword_ganti").on('submit', function(e){
	e.preventDefault();
  var pb = $("#igp_password_baru").val();
  var pk = $("#igp_password_baru_konfirmasi").val();
  if(pb != pk){
    $("#igp_password_baru_konfirmasi").focus();
    gritter('<h4>Perhatian</h4><p>Password baru dengan konfirmasi password baru tidak sama!</p>','info');
    return false;
  }
	NProgress.start();
  $('.btn-submit').prop('disabled',true);
  $('.icon-submit').addClass('fa-circle-o-notch');
  $('.icon-submit').addClass('fa-spin');
	var fd = $(this).serialize();
	var url = '<?=base_url("api_web/user/password_ganti/")?>'
	$.post(url,fd).done(function(dt){
		NProgress.done();
		if(dt.status == 200){
			gritter('<h4>Berhasil</h4><p>Password berhasil diganti</p>','success');
			setTimeout(function(){
  			gritter('<h4>Silakan tunggu</h4><p>Kami sedang mengalihkan menuju ke halaman login</p>','info');
			},1333);
			setTimeout(function(){
				window.location = '<?=base_url('logout')?>'
			},4555);
		}else{
			gritter('<h4>Gagal</h4><p>'+dt.message+'</p>','warning');
      $('.btn-submit').prop('disabled',false);
      $('.icon-submit').removeClass('fa-circle-o-notch');
      $('.icon-submit').removeClass('fa-spin');
    	NProgress.done();
		}
	}).fail(function(){
		gritter('<h4>Gagal</h4><p>Coba beberapa saat lagi</p>','danger');
    $('.btn-submit').prop('disabled',false);
    $('.icon-submit').removeClass('fa-circle-o-notch');
    $('.icon-submit').removeClass('fa-spin');
    NProgress.done();
	})
});
