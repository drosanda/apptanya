$('#fjawab').on('submit',function(e){
  e.preventDefault();
  var c = confirm('Apakah anda yakin?\n(Dengan menjawab anda menyetujui ketentuan layanan aplikasi ini)');
  if(c){
    var x = $('#ijawab').val();
    if(x.length<=2){
      gritter('<h4>Perhatian</h4><p>Silakan isi jawaban yang lengkap</p>','info');
      return;
    }

    NProgress.start();
    $('.btn-submit').prop('disabled',true);
    $('.icon-submit').addClass('fa-circle-o-notch');
    $('.icon-submit').addClass('fa-spin');
    $.post('<?=base_url('api_web/jawab/pertanyaan/'.$data->id)?>',$(this).serialize()).done(function(dt){
      if(dt.status == 200){
        gritter('<h4>Berhasil</h4><p>'+dt.message+'</p>','success');
        setTimeout(function(){
          $('.btn-submit').prop('disabled',false);
          $('.icon-submit').removeClass('fa-circle-o-notch');
          $('.icon-submit').removeClass('fa-spin');
          NProgress.done();

          window.location.reload();
        },5678)
      }else{
        gritter('<h4>Gagal</h4><p>['+dt.status+'] '+dt.message+'</p>','danger');
        $('.btn-submit').prop('disabled',false);
        $('.icon-submit').removeClass('fa-circle-o-notch');
        $('.icon-submit').removeClass('fa-spin');
        NProgress.done();
      }

    }).fail(function(){
      gritter('<h4>Error</h4><p>Tidak dapat menyimpan jawaban sekarang</p>','warning');
      $('.btn-submit').prop('disabled',false);
      $('.icon-submit').removeClass('fa-circle-o-notch');
      $('.icon-submit').removeClass('fa-spin');
      NProgress.done();
    });
  }
});
