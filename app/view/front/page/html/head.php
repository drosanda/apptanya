<head>
  <meta charset="utf-8">
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <title><?php echo $this->getTitle(); ?></title>
  <link rel="canonical" href="<?=rtrim($_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], '/')?>">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>


  <?php $this->getAdditionalBefore(); ?>
  <?php $this->getAdditional(); ?>
  <?php $this->getAdditionalAfter(); ?>

  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>

  <script>
  function gritter(e,t="info"){$(".gritter-message").removeClass("gritter-info"),$(".gritter-message").removeClass("gritter-success"),$(".gritter-message").removeClass("gritter-danger"),$(".gritter-message").removeClass("gritter-warning"),$(".gritter-message").addClass("gritter-"+t),$(".gritter-message").fadeIn("slow").html(e),setTimeout(function(){$(".gritter-message").fadeOut("slow")},4567)}!function(e,t){"function"==typeof define&&define.amd?define(t):"object"==typeof exports?module.exports=t():e.NProgress=t()}(this,function(){var e,t,n={version:"0.2.0"},r=n.settings={minimum:.08,easing:"linear",positionUsing:"",speed:200,trickle:!0,trickleSpeed:200,showSpinner:!0,barSelector:'[role="bar"]',spinnerSelector:'[role="spinner"]',parent:"body",template:'<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'};function i(e){return"object"==typeof HTMLElement?e instanceof HTMLElement:e&&"object"==typeof e&&1===e.nodeType&&"string"==typeof e.nodeName}function s(e,t,n){return e<t?t:e>n?n:e}function o(e){return 100*(-1+e)}n.configure=function(e){var t,n;for(t in e)void 0!==(n=e[t])&&e.hasOwnProperty(t)&&(r[t]=n);return this},n.status=null,n.set=function(e){var t=n.isStarted();e=s(e,r.minimum,1),n.status=1===e?null:e;var i=n.render(!t),c=i.querySelector(r.barSelector),l=r.speed,f=r.easing;return i.offsetWidth,a(function(t){""===r.positionUsing&&(r.positionUsing=n.getPositioningCSS()),u(c,function(e,t,n){var i;i="translate3d"===r.positionUsing?{transform:"translate3d("+o(e)+"%,0,0)"}:"translate"===r.positionUsing?{transform:"translate("+o(e)+"%,0)"}:{"margin-left":o(e)+"%"};return i.transition="all "+t+"ms "+n,i}(e,l,f)),1===e?(u(i,{transition:"none",opacity:1}),i.offsetWidth,setTimeout(function(){u(i,{transition:"all "+l+"ms linear",opacity:0}),setTimeout(function(){n.remove(),t()},l)},l)):setTimeout(t,l)}),this},n.isStarted=function(){return"number"==typeof n.status},n.start=function(){n.status||n.set(0);var e=function(){setTimeout(function(){n.status&&(n.trickle(),e())},r.trickleSpeed)};return r.trickle&&e(),this},n.done=function(e){return e||n.status?n.inc(.3+.5*Math.random()).set(1):this},n.inc=function(e){var t=n.status;return t?t>1?void 0:("number"!=typeof e&&(e=t>=0&&t<.2?.1:t>=.2&&t<.5?.04:t>=.5&&t<.8?.02:t>=.8&&t<.99?.005:0),t=s(t+e,0,.994),n.set(t)):n.start()},n.trickle=function(){return n.inc()},e=0,t=0,n.promise=function(r){return r&&"resolved"!==r.state()?(0===t&&n.start(),e++,t++,r.always(function(){0==--t?(e=0,n.done()):n.set((e-t)/e)}),this):this},n.render=function(e){if(n.isRendered())return document.getElementById("nprogress");l(document.documentElement,"nprogress-busy");var t=document.createElement("div");t.id="nprogress",t.innerHTML=r.template;var s,a=t.querySelector(r.barSelector),c=e?"-100":o(n.status||0),f=i(r.parent)?r.parent:document.querySelector(r.parent);return u(a,{transition:"all 0 linear",transform:"translate3d("+c+"%,0,0)"}),r.showSpinner||(s=t.querySelector(r.spinnerSelector))&&d(s),f!=document.body&&l(f,"nprogress-custom-parent"),f.appendChild(t),t},n.remove=function(){f(document.documentElement,"nprogress-busy"),f(i(r.parent)?r.parent:document.querySelector(r.parent),"nprogress-custom-parent");var e=document.getElementById("nprogress");e&&d(e)},n.isRendered=function(){return!!document.getElementById("nprogress")},n.getPositioningCSS=function(){var e=document.body.style,t="WebkitTransform"in e?"Webkit":"MozTransform"in e?"Moz":"msTransform"in e?"ms":"OTransform"in e?"O":"";return t+"Perspective"in e?"translate3d":t+"Transform"in e?"translate":"margin"};var a=function(){var e=[];function t(){var n=e.shift();n&&n(t)}return function(n){e.push(n),1==e.length&&t()}}(),u=function(){var e=["Webkit","O","Moz","ms"],t={};function n(n){return n=n.replace(/^-ms-/,"ms-").replace(/-([\da-z])/gi,function(e,t){return t.toUpperCase()}),t[n]||(t[n]=function(t){var n=document.body.style;if(t in n)return t;for(var r,i=e.length,s=t.charAt(0).toUpperCase()+t.slice(1);i--;)if((r=e[i]+s)in n)return r;return t}(n))}function r(e,t,r){t=n(t),e.style[t]=r}return function(e,t){var n,i,s=arguments;if(2==s.length)for(n in t)void 0!==(i=t[n])&&t.hasOwnProperty(n)&&r(e,n,i);else r(e,s[1],s[2])}}();function c(e,t){return("string"==typeof e?e:m(e)).indexOf(" "+t+" ")>=0}function l(e,t){var n=m(e),r=n+t;c(n,t)||(e.className=r.substring(1))}function f(e,t){var n,r=m(e);c(e,t)&&(n=r.replace(" "+t+" "," "),e.className=n.substring(1,n.length-1))}function m(e){return(" "+(e&&e.className||"")+" ").replace(/\s+/gi," ")}function d(e){e&&e.parentNode&&e.parentNode.removeChild(e)}return n});
  </script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <style amp-custom>
  *{outline:0}html{background-color:#fff;font-size:20px;-moz-osx-font-smoothing:antialiased;-webkit-font-smoothing:antialiased;min-width:300px;overflow-x:hidden;overflow-y:scroll;text-rendering:optimizeLegibility;-webkit-text-size-adjust:100%;-moz-text-size-adjust:100%;-ms-text-size-adjust:100%;text-size-adjust:100%;-webkit-tap-highlight-color:transparent}a{cursor:pointer;text-decoration:none}a:focus,a:hover{text-decoration:underline}body,button,input,select,textarea{font-family:BlinkMacSystemFont,-apple-system,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",Helvetica,Arial,sans-serif}body{color:#333;font-size:1em;font-weight:400;line-height:1.5}.hamburger{width:30px;height:15px;display:block;cursor:pointer;position:fixed;top:1em;right:1em;z-index:1;border-radius:3px;font-size:2em;font-weight:bolder;color:#f44336}#sidebar1{line-height:1.25}amp-sidebar#sidebar1{background-color:hsl(357deg 93% 76%);padding:.5em}amp-sidebar#sidebar1 ul{list-style:none}amp-sidebar#sidebar1 li{margin:0;padding:0;margin:1em 0}amp-sidebar#sidebar1 a{color:#fff;border-radius:2px;font-size:1em;padding:.5em .75em}amp-sidebar#sidebar1 a:focus,amp-sidebar#sidebar1 a:hover{background-color:#ed6f75;color:#fff}amp-sidebar#sidebar1 ul li ul{border-left:1px solid #dbdbdb;margin:.75em;padding-left:.75em}.main-content{min-height:90vh}.section,section{padding:2.5rem 3.5rem}.container{margin:0 auto;position:relative;width:auto}.columns{margin-left:-.75rem;margin-right:-.75rem;margin-top:-.75rem}.columns:not(:last-child){margin-bottom:.75rem}.column{display:block;padding:.75rem}blockquote,body,dd,dl,dt,fieldset,figure,h1,h2,h3,h4,h5,h6,hr,html,iframe,legend,li,ol,p,pre,textarea,ul{margin:0;padding:0}.content blockquote:not(:last-child),.content dl:not(:last-child),.content ol:not(:last-child),.content p:not(:last-child),.content pre:not(:last-child),.content table:not(:last-child),.content ul:not(:last-child){margin-bottom:1em}.content ul{list-style:disc outside;margin-left:2em;margin-top:1em}.content ol{list-style-position:outside;margin-left:2em;margin-top:1em}.content h1,.content h2,.content h3,.content h4,.content h5,.content h6{color:#666;font-weight:600;line-height:1.125}.content h1{font-size:2em;margin-bottom:.5em}.content h2{font-size:1.75em;margin-bottom:.5714em}.content h3{font-size:1.65em;margin-bottom:.5814em}.content h4{font-size:1.55em;margin-bottom:.5914em}.content h5{font-size:1.5em;margin-bottom:.5914em}.content h6{font-size:1.41em;margin-bottom:.5994em}.content h2:not(:first-child){margin-top:1.1428em}.content h1.is-size-1{font-size:4.5rem}.content h1.is-size-1 span{color:#fb898f;padding:0 .25em;border-bottom:.1em #fb898f dashed}.content amp-img{text-align:center}.content p,.content p:not(:last-child){margin-bottom:.25em}.breadcrumb{-webkit-touch-callout:none;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.breadcrumb ol,.breadcrumb ul{-webkit-box-align:start;-ms-flex-align:start;align-items:flex-start;display:-webkit-box;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-webkit-box-pack:start;-ms-flex-pack:start;justify-content:flex-start}.breadcrumb li{-webkit-box-align:center;-ms-flex-align:center;align-items:center;display:-webkit-box;display:-ms-flexbox;display:flex}.breadcrumb li:first-child a{padding-left:0}.breadcrumb a{padding-right:.4em}.breadcrumb a,.breadcrumb a:hover{color:#ed6f75}.breadcrumb li+li:before{color:#b5b5b5;content:"\0002f";padding-right:.4em}.breadcrumb li.unavailable:before{padding-right:.25em}.footer,footer{color:#dcdcdc;background-color:#bf3e44;padding:1.5em .5em 2.2em;font-size:.75em}.has-text-centered{text-align:center}hr{background-color:#f4d3d5}hr{border:none;display:block;height:2px;margin:1.5rem 0}code,pre{-moz-osx-font-smoothing:auto;-webkit-font-smoothing:auto;font-family:monospace}pre{-webkit-overflow-scrolling:touch;background-color:#f5f5f5;color:#4a4a4a;font-size:.875em;overflow-x:auto;padding:1.25rem 1.5rem;white-space:pre;word-wrap:normal}.content pre{-webkit-overflow-scrolling:touch;overflow-x:auto;padding:1.25em 1.5em;white-space:pre;word-wrap:normal}code{color:#ff3860;font-size:.875em;font-weight:400;padding:.25em .5em}.navbar.navbar-top{margin:0;padding:0;box-sizing:border-box}.navbar.navbar-top>div{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;background-color:#caf7e3;padding:.25em 0}.navbar.navbar-top>div a{display:block;color:#ededed;text-align:center;padding:6px 8px;text-decoration:none;font-size:.75em;margin:0 .25em}.navbar.navbar-top>div a:nth-child(1){background-color:#fafafa;color:#111;border-radius:25px;width:120px;font-weight:bolder}.navbar.navbar-top>div a:nth-child(2){background-color:transparent;color:#111;content:""}.navbar.navbar-top>div a:nth-child(3){color:#111;width:30px}.maintext{position:absolute;top:20vh;z-index:2;padding:1em}.bubble{position:relative;font-family:sans-serif;font-size:18px;line-height:24px;background:#fff;border-radius:40px;padding:24px;text-align:center;color:#000;box-sizing:border-box;min-height:24px}.bubble-bottom-left{background-color:#fafafa}.bubble-bottom-left:before{content:"";width:0;height:0;position:absolute;border-left:24px solid #fafafa;border-right:12px solid transparent;border-top:12px solid #fafafa;border-bottom:20px solid transparent;left:32px;bottom:-24px}.bubble-bottom-right{background-color:#dcf8c6}.bubble-bottom-right:before{content:"";width:0;height:0;position:absolute;border-left:24px solid transparent;border-right:12px solid #dcf8c6;border-top:12px solid #dcf8c6;border-bottom:20px solid transparent;right:32px;bottom:-24px}.navbar.navbar-bottom{margin:0;overflow:hidden;position:fixed;bottom:0;width:100%;padding:.5em 1em;margin-bottom:2em;box-sizing:border-box;z-index:3}.navbar.navbar-bottom>div{display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;background-color:#caf7e3;border-radius:25px;box-shadow:0 4px 4px 0 rgba(0,0,0,.25);-webkit-box-shadow:0 4px 4px 0 rgba(0,0,0,.25);-moz-box-shadow:0 4px 4px 0 rgba(0,0,0,.25)}.navbar.navbar-bottom div a{display:block;color:#111;text-align:center;padding:14px 16px;text-decoration:none;font-size:1em;margin:0 .25em}.navbar.navbar-bottom div a:hover{background-color:#04aa6d;color:#fff}.navbar.navbar-bottom div a.active{background-color:#04aa6d;color:#fff}.homepage{background-color:#f8eded;min-height:100vh}.homepage>.mainbanner{text-align:center;padding-top:2em}.form-group{margin-bottom:1em}.form-group.form-action{display:block}.form-group.form-action .btn{width:100%;box-sizing:border-box;margin-bottom:.25em}label{display:inline-block;max-width:100%;margin-bottom:5px;font-weight:700}.form-control{display:block;height:34px;font-size:14px;line-height:1.42857143;border:1px solid #ccc;-webkit-box-shadow:inset 0 1px 1px rgb(0 0 0 / 8%);box-shadow:inset 0 1px 1px rgb(0 0 0 / 8%);-webkit-transition:border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;-o-transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;transition:border-color ease-in-out .15s,box-shadow ease-in-out .15s;padding:4px 10px;min-width:100%;border-color:#111;border-radius:15px;box-sizing:border-box}input[type=email].form-control,input[type=password].form-control,input[type=text].form-control,textarea.form-control{-webkit-appearance:none}.btn{margin:1px 0;background-color:#ed6f75;display:inline-block;margin-bottom:0;text-align:center;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;background-image:none;border:1px solid transparent;white-space:nowrap;padding:6px 16px;line-height:1.42857143;border-radius:15px;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;color:#fff;font-weight:700;font-size:inherit}.btn.disabled,.btn[disabled],fieldset[disabled] .btn{box-shadow:none;opacity:.4;cursor:not-allowed}.btn-default{background-color:#f5f2f0;color:#4a392b}.btn-primary{background-color:#e4bad4;color:#4a392b}.btn-secondary{background-color:#f6dfeb;color:#4a392b}.btn-success,.gritter-message.gritter-success{background-color:#36ff33;color:#4a392b}.btn-info,.gritter-message.gritter-info{background-color:#cae1f7;color:#4a392b}.btn-warning,.gritter-message.gritter-warning{background-color:#f7f3ca;color:#4a392b}.btn-danger,.gritter-message.gritter-danger{background-color:#e72a2a;color:#fdfdfd}.gritter-message{margin:5%;font-size:inherit;display:none;min-height:10vh;padding:.5em 1em;opacity:.92;background:#bf0025;position:fixed;line-height:60px;z-index:9999;min-width:90%;box-sizing:border-box;border-radius:25px;box-shadow:0 4px 4px 0 rgba(0,0,0,.25);-webkit-box-shadow:0 4px 4px 0 rgba(0,0,0,.25);-moz-box-shadow:0 4px 4px 0 rgba(0,0,0,.25)}.gritter-message>h4{font-size:18px;font-weight:bolder;line-height:1.5}.gritter-message>p{font-size:12px;font-weight:400;line-height:1.2}.notifikasi-list .is-read{opacity:.3}@media screen and (max-width:1024px){.section,section{padding:2.5rem 1.5rem}.content h1.is-size-1{font-size:2.2rem;border-size:.09em}.bubble{min-width:980px}}@media screen and (max-width:768px){.bubble{min-width:690px}}@media screen and (max-width:425px){.section,section{padding:.75rem .5rem}.content h1.is-size-1{font-size:2.5rem}.content h1.is-size-1 span{font-size:2.2rem;border-size:.08em}.navbar.navbar-top>div a:nth-child(2){width:120px}.bubble{min-width:340px}}@media screen and (max-width:320px){.navbar.navbar-top>div a:nth-child(2){width:60px}.bubble{min-width:250px}}
  ?>
  </style>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?=base_url()?>"
      },
      "headline": "Aplikasi Bertanya",
      "datePublished": "2015-02-05T08:00:00+08:00",
      "dateModified": "2015-02-05T09:20:00+08:00",
      "author": {
        "@type": "Person",
        "name": "Daeng Rosanda"
      },
      "description": "Alikasi Bertanya, tempat bertanya dan mencari jawaban masalah sehari-hari"
    }
  </script>
</head>
