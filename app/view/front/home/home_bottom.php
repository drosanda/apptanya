var msgs = [
  'Selamat datang di AppTanya',
  'Aplikasi berbasis web untuk bertanya tentang masalah sehari-hari',
  'Aplikasi ini dibuat untuk memenuhi salah satu tugas akhir PKL',
]

var i = 0;
$('.maintext').html('');
$.each(msgs,function(k,v){
  var h = '';
  if(i%2==1){
    var h = '<div class="bubble bubble-bottom-right" style="display: none;">'+v+'</div>';
  }else{
    var h = '<div class="bubble bubble-bottom-left" style="display: none;">'+v+'</div>';
  }
  $('.maintext').append(h);
  $('.maintext').append('<br>');
  i++;
});
function showDeui(){
  var els = $('.maintext').children();
  $.each(els,function(k,v){
    if($(v).is(':hidden')){
      $(v).fadeIn('slow');
      setTimeout(function(){
        showDeui();
      },3210);
      return false;
    }
  });
}
showDeui();
