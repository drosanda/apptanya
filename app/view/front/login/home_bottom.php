$("#flogin").on('submit', function(e){
  e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch');
	$('.icon-submit').addClass('fa-spin');
  var url = '<?=base_url('api_web/user/login/')?>';
  var fd = $(this).serialize();
  $.post(url,fd).done(function(dt){
    if(dt.status == 200){
      gritter('<h4>Berhasil login</h4>','success');
      setTimeout(function(){
        window.location = '<?=base_url('profil')?>';
      },1500)
    }else{
			$('.btn-submit').prop('disabled',false);
			$('.icon-submit').removeClass('fa-circle-o-notch');
			$('.icon-submit').removeClass('fa-spin');
      gritter('<h4>Perhatian</h4><p>'+dt.message+'</p>','warning');
			NProgress.done();
    }
  }).fail(function(){
		$('.btn-submit').prop('disabled',false);
		$('.icon-submit').removeClass('fa-circle-o-notch');
		$('.icon-submit').removeClass('fa-spin');
    gritter('<h4>Gagal</h4><p>Coba beberapa saat lagi</p>','danger');
		NProgress.done();
  })
})
