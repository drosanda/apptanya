/*** Plugin ***/

(function($) {
  // writes the string
  //
  // @param jQuery $target
  // @param String str
  // @param Numeric cursor
  // @param Numeric delay
  // @param Function cb
  // @return void
  function typeString($target, str, cursor, delay, cb) {
    $target.html(function(_, html) {
      return html + str[cursor];
    });

    if (cursor < str.length - 1) {
      setTimeout(function() {
        typeString($target, str, cursor + 1, delay, cb);
      }, delay);
    } else {
      cb();
    }
  }

  // clears the string
  //
  // @param jQuery $target
  // @param Numeric delay
  // @param Function cb
  // @return void
  function deleteString($target, delay, cb) {
    var length;

    $target.html(function(_, html) {
      length = html.length;
      return html.substr(0, length - 1);
    });

    if (length > 1) {
      setTimeout(function() {
        deleteString($target, delay, cb);
      }, delay);
    } else {
      cb();
    }
  }

  // jQuery hook
  $.fn.extend({
    teletype: function(opts) {
      var settings = $.extend({}, $.teletype.defaults, opts);

      return $(this).each(function() {
        (function loop($tar, idx) {
          // type
          typeString($tar, settings.text[idx], 0, settings.delay, function() {
            // delete
            setTimeout(function() {
              deleteString($tar, settings.delay, function() {
                loop($tar, (idx + 1) % settings.text.length);
              });
            }, settings.pause);
          });

        }($(this), 0));
      });
    }
  });

  // plugin defaults
  $.extend({
    teletype: {
      defaults: {
        delay: 100,
        pause: 5000,
        text: []
      }
    }
  });
}(jQuery));


/*** init ***/

setTimeout(function(){
$('#cursor').fadeIn('slow',function(){
  $('#cursor').teletype({
    text: [
      'Selamat datang di Aplikasi Tanya (AppTanya)',
      'Yukkk!  Pakai aplikasi ini untuk bertanya apa saja..',
      'Maupun mencari jawaban tentang masalah sehari-hari',
      'accusam et justo duo dolores et ea rebum. Stet clita kasd',
      'gubergren, no sea takimata sanctus est Lorem ipsum dolor sit',
      'amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,',
      'sed diam nonumy eirmod tempor invidunt ut labore et dolore',
      'magna aliquyam erat, sed diam voluptua. At vero eos et accusam',
      'et justo duo dolores et ea rebum. Stet clita kasd gubergren,',
      'no sea takimata sanctus est Lorem ipsum dolor sit amet.'
    ],
    delay: 123,
    pause: 500
  });
});
},1230);

setTimeout(function(){
$('#cursor2').fadeIn('slow',function(){
  $('#cursor2').teletype({
    text: [
      'Aplikasi ini akan membantu kalian untuk bertanya       ',
      'Malu bertanya Sesat dijalan!',
      'magna aliquyam erat, sed diam voluptua. At vero eos et',
      'accusam et justo duo dolores et ea rebum. Stet clita kasd',
      'gubergren, no sea takimata sanctus est Lorem ipsum dolor sit',
      'amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr,',
      'sed diam nonumy eirmod tempor invidunt ut labore et dolore',
      'magna aliquyam erat, sed diam voluptua. At vero eos et accusam',
      'et justo duo dolores et ea rebum. Stet clita kasd gubergren,',
      'no sea takimata sanctus est Lorem ipsum dolor sit amet.'
    ],
    delay: 123,
    pause: 123
  });
});
},5678);
