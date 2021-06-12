function checkPassword(password){
	var checker = "^(?=.*?[a-z])(?=.*?[0-9]).{6,}$";
	if(password.match(checker)){
		return true;
	}else{
		return false;
	}
}
$("#fdaftar").on('submit', function(e){
  e.preventDefault();
	NProgress.start();
	$('.btn-submit').prop('disabled',true);
	$('.icon-submit').addClass('fa-circle-o-notch');
	$('.icon-submit').addClass('fa-spin');
	if(checkPassword($("#ipassword").val()) == false){
			NProgress.done();
			$('.btn-submit').prop('disabled',false);
			$('.icon-submit').removeClass('fa-circle-o-notch');
			$('.icon-submit').removeClass('fa-spin');
		  gritter('<h4>Perhatian</h4><p>Password minimal 6 karakter dan mengandung huruf dan angka</p>','warning');
			return;
	}
  var url = '<?=base_url('api_web/user/daftar/')?>';
  var fd = $(this).serialize();
  $.post(url,fd).done(function(dt){
    if(dt.status == 200){
      gritter('<h4>Berhasil daftar</h4><p>Selamat Datang</p>','success');
      setTimeout(function(){
        window.location = '<?=base_url('')?>';
      },1500)
    }else{
			$('.btn-submit').prop('disabled',false);
			$('.icon-submit').removeClass('fa-circle-o-notch');
			$('.icon-submit').removeClass('fa-spin');
      gritter('<h4>Perhatian</h4><p>'+dt.message+'</p>','warning');
			NProgress.done();
    }
  }).fail(function(){
		gritter('<h4>Gagal</h4><p>Coba beberapa saat lagi</p>','danger');
		$('.btn-submit').prop('disabled',false);
		$('.icon-submit').removeClass('fa-circle-o-notch');
		$('.icon-submit').removeClass('fa-spin');
		NProgress.done();
  });
});
