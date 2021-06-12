var login_try = 0;

$("#form-lupa").on("submit",function(evt){
	evt.preventDefault();
	console.log('login');
	login_try++;
	var url = '<?=base_url('lupa/proses'); ?>';
	var fd = {};
	fd.email = $("#iemail").val();
	if(fd.email.length<=3){
		$("#iemail").focus();
		gritter("<h4>Info</h4><p>Email belum diisi atau terlalu pendek</p>",'info');
		return false;
	}
	NProgress.start();
	$("#icon-submit").removeClass("fa-circle-o-notch");
  $("#icon-submit").removeClass("fa-spin");
	$("#iemail").prop("disabled",true);
	$("#icon-submit").addClass("fa-circle-o-notch");
  $("#icon-submit").addClass("fa-spin");
	$.post(url,fd).done(function(dt){
		NProgress.set(0.6);
		if(dt.status == 200){
			gritter("<h4>Sukses</h4><p>Silakan cek kotak masuk / spam email anda</p>",'success');
			setTimeout(function(){
				NProgress.set(0.7)
			},2000);
			setTimeout(function(){
				NProgress.done();
				$("#iemail").removeAttr("disabled");
		    $("#btn-submit").removeAttr("disabled");
				$("#icon-submit").removeClass("fa-circle-o-notch");
			  $("#icon-submit").removeClass("fa-spin");
			},3000);
		}else{
    	$("#icon-submit").removeClass("fa-circle-o-notch");
      $("#icon-submit").removeClass("fa-spin");
			$("#iemail").removeAttr("disabled");
			$("#btn-submit").removeAttr("disabled");
			NProgress.done();
			gritter("<h4>Gagal</h4><p>"+dt.message+"</p>",'danger');
			setTimeout(function(){
				$("#bsubmit").removeClass("fa-spin");
				if(login_try>2){
					window.location = '<?=base_url('login')?>';
				}
			},3000);
		}
	}).fail(function(){
    $("#icon-submit").removeClass("fa-circle-o-notch");
    $("#icon-submit").removeClass("fa-spin");
    $("#iemail").removeAttr("disabled");
    $("#btn-submit").removeAttr("disabled");
		gritter("<h4>Error</h4><p>Tidak dapat mereset password saat ini, silahkan coba lagi nanti</p>",'warning');
		NProgress.done();
	});
});
setTimeout(function(){
  $('#iemail').focus();
},777);
