<head>
  <meta charset="utf-8">
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <title><?php echo $this->getTitle(); ?></title>
  <link rel="canonical" href="https://amp.dev/documentation/guides-and-tutorials/start/create/basic_markup/">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>


  <?php $this->getAdditionalBefore(); ?>
  <?php $this->getAdditional(); ?>
  <?php $this->getAdditionalAfter(); ?>

  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>

  <script>
  /* NProgress, (c) 2013, 2014 Rico Sta. Cruz - http://ricostacruz.com/nprogress
 * @license MIT */

;(function(root, factory) {

  if (typeof define === 'function' && define.amd) {
    define(factory);
  } else if (typeof exports === 'object') {
    module.exports = factory();
  } else {
    root.NProgress = factory();
  }

})(this, function() {
  var NProgress = {};

  NProgress.version = '0.2.0';

  var Settings = NProgress.settings = {
    minimum: 0.08,
    easing: 'linear',
    positionUsing: '',
    speed: 200,
    trickle: true,
    trickleSpeed: 200,
    showSpinner: true,
    barSelector: '[role="bar"]',
    spinnerSelector: '[role="spinner"]',
    parent: 'body',
    template: '<div class="bar" role="bar"><div class="peg"></div></div><div class="spinner" role="spinner"><div class="spinner-icon"></div></div>'
  };

  /**
   * Updates configuration.
   *
   *     NProgress.configure({
   *       minimum: 0.1
   *     });
   */
  NProgress.configure = function(options) {
    var key, value;
    for (key in options) {
      value = options[key];
      if (value !== undefined && options.hasOwnProperty(key)) Settings[key] = value;
    }

    return this;
  };

  /**
   * Last number.
   */

  NProgress.status = null;

  /**
   * Sets the progress bar status, where `n` is a number from `0.0` to `1.0`.
   *
   *     NProgress.set(0.4);
   *     NProgress.set(1.0);
   */

  NProgress.set = function(n) {
    var started = NProgress.isStarted();

    n = clamp(n, Settings.minimum, 1);
    NProgress.status = (n === 1 ? null : n);

    var progress = NProgress.render(!started),
        bar      = progress.querySelector(Settings.barSelector),
        speed    = Settings.speed,
        ease     = Settings.easing;

    progress.offsetWidth; /* Repaint */

    queue(function(next) {
      // Set positionUsing if it hasn't already been set
      if (Settings.positionUsing === '') Settings.positionUsing = NProgress.getPositioningCSS();

      // Add transition
      css(bar, barPositionCSS(n, speed, ease));

      if (n === 1) {
        // Fade out
        css(progress, {
          transition: 'none',
          opacity: 1
        });
        progress.offsetWidth; /* Repaint */

        setTimeout(function() {
          css(progress, {
            transition: 'all ' + speed + 'ms linear',
            opacity: 0
          });
          setTimeout(function() {
            NProgress.remove();
            next();
          }, speed);
        }, speed);
      } else {
        setTimeout(next, speed);
      }
    });

    return this;
  };

  NProgress.isStarted = function() {
    return typeof NProgress.status === 'number';
  };

  /**
   * Shows the progress bar.
   * This is the same as setting the status to 0%, except that it doesn't go backwards.
   *
   *     NProgress.start();
   *
   */
  NProgress.start = function() {
    if (!NProgress.status) NProgress.set(0);

    var work = function() {
      setTimeout(function() {
        if (!NProgress.status) return;
        NProgress.trickle();
        work();
      }, Settings.trickleSpeed);
    };

    if (Settings.trickle) work();

    return this;
  };

  /**
   * Hides the progress bar.
   * This is the *sort of* the same as setting the status to 100%, with the
   * difference being `done()` makes some placebo effect of some realistic motion.
   *
   *     NProgress.done();
   *
   * If `true` is passed, it will show the progress bar even if its hidden.
   *
   *     NProgress.done(true);
   */

  NProgress.done = function(force) {
    if (!force && !NProgress.status) return this;

    return NProgress.inc(0.3 + 0.5 * Math.random()).set(1);
  };

  /**
   * Increments by a random amount.
   */

  NProgress.inc = function(amount) {
    var n = NProgress.status;

    if (!n) {
      return NProgress.start();
    } else if(n > 1) {
      return;
    } else {
      if (typeof amount !== 'number') {
        if (n >= 0 && n < 0.2) { amount = 0.1; }
        else if (n >= 0.2 && n < 0.5) { amount = 0.04; }
        else if (n >= 0.5 && n < 0.8) { amount = 0.02; }
        else if (n >= 0.8 && n < 0.99) { amount = 0.005; }
        else { amount = 0; }
      }

      n = clamp(n + amount, 0, 0.994);
      return NProgress.set(n);
    }
  };

  NProgress.trickle = function() {
    return NProgress.inc();
  };

  /**
   * Waits for all supplied jQuery promises and
   * increases the progress as the promises resolve.
   *
   * @param $promise jQUery Promise
   */
  (function() {
    var initial = 0, current = 0;

    NProgress.promise = function($promise) {
      if (!$promise || $promise.state() === "resolved") {
        return this;
      }

      if (current === 0) {
        NProgress.start();
      }

      initial++;
      current++;

      $promise.always(function() {
        current--;
        if (current === 0) {
            initial = 0;
            NProgress.done();
        } else {
            NProgress.set((initial - current) / initial);
        }
      });

      return this;
    };

  })();

  /**
   * (Internal) renders the progress bar markup based on the `template`
   * setting.
   */

  NProgress.render = function(fromStart) {
    if (NProgress.isRendered()) return document.getElementById('nprogress');

    addClass(document.documentElement, 'nprogress-busy');

    var progress = document.createElement('div');
    progress.id = 'nprogress';
    progress.innerHTML = Settings.template;



    var bar = progress.querySelector(Settings.barSelector),
        perc = fromStart ? '-100' : toBarPerc(NProgress.status || 0),
        parent = isDOM(Settings.parent)
          ? Settings.parent
          : document.querySelector(Settings.parent),
        spinner

    css(bar, {
      transition: 'all 0 linear',
      transform: 'translate3d(' + perc + '%,0,0)'
    });

    if (!Settings.showSpinner) {
      spinner = progress.querySelector(Settings.spinnerSelector);
      spinner && removeElement(spinner);
    }

    if (parent != document.body) {
      addClass(parent, 'nprogress-custom-parent');
    }

    parent.appendChild(progress);
    return progress;
  };

  /**
   * Removes the element. Opposite of render().
   */

  NProgress.remove = function() {
    removeClass(document.documentElement, 'nprogress-busy');
    var parent = isDOM(Settings.parent)
      ? Settings.parent
      : document.querySelector(Settings.parent)
    removeClass(parent, 'nprogress-custom-parent')
    var progress = document.getElementById('nprogress');
    progress && removeElement(progress);
  };

  /**
   * Checks if the progress bar is rendered.
   */

  NProgress.isRendered = function() {
    return !!document.getElementById('nprogress');
  };

  /**
   * Determine which positioning CSS rule to use.
   */

  NProgress.getPositioningCSS = function() {
    // Sniff on document.body.style
    var bodyStyle = document.body.style;

    // Sniff prefixes
    var vendorPrefix = ('WebkitTransform' in bodyStyle) ? 'Webkit' :
                       ('MozTransform' in bodyStyle) ? 'Moz' :
                       ('msTransform' in bodyStyle) ? 'ms' :
                       ('OTransform' in bodyStyle) ? 'O' : '';

    if (vendorPrefix + 'Perspective' in bodyStyle) {
      // Modern browsers with 3D support, e.g. Webkit, IE10
      return 'translate3d';
    } else if (vendorPrefix + 'Transform' in bodyStyle) {
      // Browsers without 3D support, e.g. IE9
      return 'translate';
    } else {
      // Browsers without translate() support, e.g. IE7-8
      return 'margin';
    }
  };

  /**
   * Helpers
   */

  function isDOM (obj) {
    if (typeof HTMLElement === 'object') {
      return obj instanceof HTMLElement
    }
    return (
      obj &&
      typeof obj === 'object' &&
      obj.nodeType === 1 &&
      typeof obj.nodeName === 'string'
    )
  }

  function clamp(n, min, max) {
    if (n < min) return min;
    if (n > max) return max;
    return n;
  }

  /**
   * (Internal) converts a percentage (`0..1`) to a bar translateX
   * percentage (`-100%..0%`).
   */

  function toBarPerc(n) {
    return (-1 + n) * 100;
  }


  /**
   * (Internal) returns the correct CSS for changing the bar's
   * position given an n percentage, and speed and ease from Settings
   */

  function barPositionCSS(n, speed, ease) {
    var barCSS;

    if (Settings.positionUsing === 'translate3d') {
      barCSS = { transform: 'translate3d('+toBarPerc(n)+'%,0,0)' };
    } else if (Settings.positionUsing === 'translate') {
      barCSS = { transform: 'translate('+toBarPerc(n)+'%,0)' };
    } else {
      barCSS = { 'margin-left': toBarPerc(n)+'%' };
    }

    barCSS.transition = 'all '+speed+'ms '+ease;

    return barCSS;
  }

  /**
   * (Internal) Queues a function to be executed.
   */

  var queue = (function() {
    var pending = [];

    function next() {
      var fn = pending.shift();
      if (fn) {
        fn(next);
      }
    }

    return function(fn) {
      pending.push(fn);
      if (pending.length == 1) next();
    };
  })();

  /**
   * (Internal) Applies css properties to an element, similar to the jQuery
   * css method.
   *
   * While this helper does assist with vendor prefixed property names, it
   * does not perform any manipulation of values prior to setting styles.
   */

  var css = (function() {
    var cssPrefixes = [ 'Webkit', 'O', 'Moz', 'ms' ],
        cssProps    = {};

    function camelCase(string) {
      return string.replace(/^-ms-/, 'ms-').replace(/-([\da-z])/gi, function(match, letter) {
        return letter.toUpperCase();
      });
    }

    function getVendorProp(name) {
      var style = document.body.style;
      if (name in style) return name;

      var i = cssPrefixes.length,
          capName = name.charAt(0).toUpperCase() + name.slice(1),
          vendorName;
      while (i--) {
        vendorName = cssPrefixes[i] + capName;
        if (vendorName in style) return vendorName;
      }

      return name;
    }

    function getStyleProp(name) {
      name = camelCase(name);
      return cssProps[name] || (cssProps[name] = getVendorProp(name));
    }

    function applyCss(element, prop, value) {
      prop = getStyleProp(prop);
      element.style[prop] = value;
    }

    return function(element, properties) {
      var args = arguments,
          prop,
          value;

      if (args.length == 2) {
        for (prop in properties) {
          value = properties[prop];
          if (value !== undefined && properties.hasOwnProperty(prop)) applyCss(element, prop, value);
        }
      } else {
        applyCss(element, args[1], args[2]);
      }
    }
  })();

  /**
   * (Internal) Determines if an element or space separated list of class names contains a class name.
   */

  function hasClass(element, name) {
    var list = typeof element == 'string' ? element : classList(element);
    return list.indexOf(' ' + name + ' ') >= 0;
  }

  /**
   * (Internal) Adds a class to an element.
   */

  function addClass(element, name) {
    var oldList = classList(element),
        newList = oldList + name;

    if (hasClass(oldList, name)) return;

    // Trim the opening space.
    element.className = newList.substring(1);
  }

  /**
   * (Internal) Removes a class from an element.
   */

  function removeClass(element, name) {
    var oldList = classList(element),
        newList;

    if (!hasClass(element, name)) return;

    // Replace the class name.
    newList = oldList.replace(' ' + name + ' ', ' ');

    // Trim the opening and closing spaces.
    element.className = newList.substring(1, newList.length - 1);
  }

  /**
   * (Internal) Gets a space separated list of the class names on the element.
   * The list is wrapped with a single space on each end to facilitate finding
   * matches within the list.
   */

  function classList(element) {
    return (' ' + (element && element.className || '') + ' ').replace(/\s+/gi, ' ');
  }

  /**
   * (Internal) Removes an element from the DOM.
   */

  function removeElement(element) {
    element && element.parentNode && element.parentNode.removeChild(element);
  }

  return NProgress;
});

function gritter(isi,kelas='info'){
  $('.gritter-message').removeClass('gritter-info');
  $('.gritter-message').removeClass('gritter-success');
  $('.gritter-message').removeClass('gritter-danger');
  $('.gritter-message').removeClass('gritter-warning');

  $('.gritter-message').addClass('gritter-'+kelas);
  $('.gritter-message').fadeIn('slow').html(isi);
  setTimeout(function(){
    $('.gritter-message').fadeOut('slow');
  }, 4567);
}
  </script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <style amp-custom>
* {
  outline: none;
}
html {
  background-color: #fff;
  font-size: 20px;
  -moz-osx-font-smoothing: antialiased;
  -webkit-font-smoothing: antialiased;
  min-width: 300px;
  overflow-x: hidden;
  overflow-y: scroll;
  text-rendering: optimizeLegibility;
  -webkit-text-size-adjust: 100%;
  -moz-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  text-size-adjust: 100%;
  -webkit-tap-highlight-color: transparent;
}

a {
  cursor: pointer;
  text-decoration: none;
}
a:hover, a:focus {
  text-decoration: underline;
}

body, button, input, select, textarea {
  font-family: BlinkMacSystemFont,-apple-system,"Segoe UI","Roboto","Oxygen","Ubuntu","Cantarell","Fira Sans","Droid Sans","Helvetica Neue","Helvetica","Arial",sans-serif;
}
body {
  color: #333;
  font-size: 1em;
  font-weight: 400;
  line-height: 1.5;
}

.hamburger{
 width: 30px;
 height: 15px;
 display:block;
 cursor: pointer;
 position: fixed;
 top: 1em;
 right: 1em;
 z-index: 1;
 border-radius: 3px;
 font-size: 2em;
 font-weight: bolder;
 color: #f44336;
}


#sidebar1 {
  line-height: 1.25;
}
amp-sidebar#sidebar1 {
  background-color: hsl(357deg 93% 76%);
  padding: 0.5em;
}

amp-sidebar#sidebar1 ul {
  list-style: none;
}

amp-sidebar#sidebar1 li {
  margin: 0;
  padding: 0;
  margin: 1em 0;
}

amp-sidebar#sidebar1 li a {
}

amp-sidebar#sidebar1 a {
  color: #fff;
  border-radius: 2px;
  font-size: 1em;
  padding: .5em .75em;
}
amp-sidebar#sidebar1 a:focus, amp-sidebar#sidebar1 a:hover {
  background-color: #ed6f75;
  color: #fff;
}

amp-sidebar#sidebar1 ul li ul {
  border-left: 1px solid #dbdbdb;
  margin: .75em;
  padding-left: .75em;
}


.main-content {
  min-height: 90vh;
}

section, .section {
  padding: 2.5rem 3.5rem;
}
.container {
  margin: 0 auto;
  position: relative;
  width: auto;
}
.columns {
  margin-left: -.75rem;
  margin-right: -.75rem;
  margin-top: -.75rem;
}
.columns:not(:last-child) {
  margin-bottom: .75rem;
}
.columns:not(.is-desktop) {
}
.column {
  display: block;
  padding: .75rem;
}

blockquote, body, dd, dl, dt, fieldset, figure, h1, h2, h3, h4, h5, h6, hr, html, iframe, legend, li, ol, p, pre, textarea, ul {
    margin: 0;
    padding: 0;
}

.content blockquote:not(:last-child), .content dl:not(:last-child), .content ol:not(:last-child), .content p:not(:last-child), .content pre:not(:last-child), .content table:not(:last-child), .content ul:not(:last-child) {
    margin-bottom: 1em;
}
.content ul {
    list-style: disc outside;
    margin-left: 2em;
    margin-top: 1em;
}
.content ol {
    list-style-position: outside;
    margin-left: 2em;
    margin-top: 1em;
}
.content h1, .content h2, .content h3, .content h4, .content h5, .content h6 {
    color: #666666;
    font-weight: 600;
    line-height: 1.125;
}
.content h1 {
    font-size: 2em;
    margin-bottom: .5em;
}
.content h2 {
    font-size: 1.75em;
    margin-bottom: .5714em;
}
.content h3 {
    font-size: 1.65em;
    margin-bottom: .5814em;
}
.content h4 {
    font-size: 1.55em;
    margin-bottom: .5914em;
}
.content h5 {
    font-size: 1.50em;
    margin-bottom: .5914em;
}
.content h6 {
    font-size: 1.41em;
    margin-bottom: .5994em;
}
.content h2:not(:first-child) {
    margin-top: 1.1428em;
}

.content h1.is-size-1 {
  font-size: 4.5rem;
}
.content h1.is-size-1 span {
  color: #fb898f;
  padding: 0 0.25em;
  border-bottom: 0.1em #fb898f dashed;
}

.content amp-img {
  text-align: center;
}

.content p, .content p:not(:last-child) {
  margin-bottom: 0.25em;
}

.breadcrumb {
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
.breadcrumb ol, .breadcrumb ul {
    -webkit-box-align: start;
    -ms-flex-align: start;
    align-items: flex-start;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    -webkit-box-pack: start;
    -ms-flex-pack: start;
    justify-content: flex-start;
}
.breadcrumb li {
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.breadcrumb li:first-child a {
    padding-left: 0;
}
.breadcrumb a {
    padding-right: .4em;
}
.breadcrumb a, .breadcrumb a:hover {
    color: #ed6f75;
}
.breadcrumb li+li:before {
    color: #b5b5b5;
    content: "\0002f";
    padding-right: .4em;
}
.breadcrumb li.unavailable:before {
    padding-right: .25em;
}

.footer, footer {
    color: #dcdcdc;
    background-color: #bf3e44;
    padding: 1.5em .5em 2.2em;
    font-size: 0.75em;
}

.has-text-centered {
    text-align: center;
}

hr {
    background-color: #f4d3d5;
}

hr {
    border: none;
    display: block;
    height: 2px;
    margin: 1.5rem 0;
}
code, pre {
    -moz-osx-font-smoothing: auto;
    -webkit-font-smoothing: auto;
    font-family: monospace;
}
pre {
    -webkit-overflow-scrolling: touch;
    background-color: #f5f5f5;
    color: #4a4a4a;
    font-size: .875em;
    overflow-x: auto;
    padding: 1.25rem 1.5rem;
    white-space: pre;
    word-wrap: normal;
}
.content pre {
    -webkit-overflow-scrolling: touch;
    overflow-x: auto;
    padding: 1.25em 1.5em;
    white-space: pre;
    word-wrap: normal;
}
code {
    color: #ff3860;
    font-size: .875em;
    font-weight: 400;
    padding: .25em .5em;
}

.navbar.navbar-top {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.navbar.navbar-top > div {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  background-color: #CAF7E3;
  padding: 0.25em 0;
}
.navbar.navbar-top > div a {
  display: block;
  color: #ededed;
  text-align: center;
  padding: 6px 8px;
  text-decoration: none;
  font-size: 0.75em;
  margin: 0 0.25em;
}
.navbar.navbar-top > div a:nth-child(1) {
  background-color: #fafafa;
  color: #111111;
  border-radius: 25px;
  width: 120px;
  font-weight: bolder;
}
.navbar.navbar-top > div a:nth-child(2) {
  background-color: transparent;
  color: #111111;
  content: "";
}
.navbar.navbar-top > div a:nth-child(3) {
  color: #111111;
  width: 30px;
}

.maintext {
  position: absolute;
  top: 20vh;
  z-index: 2;
  padding: 1em;
}
.bubble {
  position: relative;
  font-family: sans-serif;
  font-size: 18px;
  line-height: 24px;
  background: #fff;
  border-radius: 40px;
  padding: 24px;
  text-align: center;
  color: #000;
  box-sizing: border-box;
}

.bubble-bottom-left:before {
  content: "";
  width: 0px;
  height: 0px;
  position: absolute;
  border-left: 24px solid #fff;
  border-right: 12px solid transparent;
  border-top: 12px solid #fff;
  border-bottom: 20px solid transparent;
  left: 32px;
  bottom: -24px;
}

/* Place the navbar at the bottom of the page, and make it stick */
.navbar.navbar-bottom {
  margin: 0;
  overflow: hidden;
  position: fixed;
  bottom: 0;
  width: 100%;
  padding: 0.5em 1em;
  margin-bottom: 2em;
  box-sizing: border-box;
}

/* Place the navbar at the bottom of the page, and make it stick */
.navbar.navbar-bottom > div {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  background-color: #CAF7E3;
  border-radius: 25px;
  box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
  -webkit-box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
}

/* Style the links inside the navigation bar */
.navbar.navbar-bottom div a {
  display: block;
  color: #111111;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 1em;
  margin: 0 0.25em;
}

/* Change the color of links on hover */
.navbar.navbar-bottom div a:hover {
  background-color: #04AA6D;
  color: white;
}

/* Add a color to the active/current link */
.navbar.navbar-bottom div a.active {
  background-color: #04AA6D;
  color: white;
}

.homepage {
  background-color: #F8EDED;
  min-height: 100vh;
}
.homepage > .mainbanner {
  text-align: center;
  padding-top: 2em;
}

.form-group {
  margin-bottom: 1em;
}
.form-action {

}
.form-group.form-action {
  display: block;
}
.form-group.form-action .btn {
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 0.25em;
}

label {
  display: inline-block;
  max-width: 100%;
  margin-bottom: 5px;
  font-weight: bold;
}
.form-control {
  display: block;
  height: 34px;
  font-size: 14px;
  line-height: 1.42857143;
  border: 1px solid #ccc;
  -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
  box-shadow: inset 0 1px 1px rgb(0 0 0 / 8%);
  -webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
  padding: 4px 10px;
  min-width: 100%;
  border-color: #111111;
  border-radius: 15px;
  box-sizing: border-box;
}
input[type="text"].form-control, input[type="password"].form-control, input[type="email"].form-control, textarea.form-control {
  -webkit-appearance: none;
}

.btn {
  margin: 1px 0;
  background-color: #ed6f75;
  display: inline-block;
  margin-bottom: 0;
  text-align: center;
  vertical-align: middle;
  -ms-touch-action: manipulation;
  touch-action: manipulation;
  cursor: pointer;
  background-image: none;
  border: 1px solid transparent;
  white-space: nowrap;
  padding: 6px 16px;
  line-height: 1.42857143;
  border-radius: 15px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  color: #fff;
  font-weight: bold;
  font-size: inherit;
}
.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
  box-shadow: none;
  opacity: 0.4;
  cursor: not-allowed;
}

.btn-default {
  background-color: #f5f2f0;
  color: #4a392b;
}
.btn-primary {
  background-color: #E4BAD4;
  color: #4a392b;
}
.btn-secondary {
  background-color: #F6DFEB;
  color: #4a392b;
}
.btn-success, .gritter-message.gritter-success {
  background-color: #CAF7E3;
  color: #4a392b;
}
.btn-info, .gritter-message.gritter-info {
  background-color: #CAE1F7;
  color: #4a392b;
}
.btn-warning, .gritter-message.gritter-warning {
  background-color: #F7F3CA;
  color: #4a392b;
}
.btn-danger, .gritter-message.gritter-danger {
  background-color: #F7CACA;
  color: #4a392b;
}
.gritter-message {
  margin: 5%;
  font-size: inherit;
  display:none;
  min-height: 10vh;
  padding: 0.5em 1em;
  opacity: .92;
  background: #BF0025;
  position: fixed;
  line-height:60px;
  z-index: 9999;
  min-width: 90%;
  box-sizing: border-box;
  border-radius: 25px;
  box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
  -webkit-box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
  -moz-box-shadow: 0px 4px 4px 0px rgba(0,0,0,0.25);
}
.gritter-message > h4 {
  font-size: 18px;
  font-weight: bolder;
  line-height: 1.5;
}
.gritter-message > p {
  font-size: 12px;
  font-weight: normal;
  line-height: 1.2;
}

@media screen and (max-width: 1024px){
  section, .section {
    padding: 2.5rem 1.5rem;
  }
  .content h1.is-size-1 {
    font-size: 2.2rem;
    border-size: 0.09em;
  }
}

@media screen and (max-width: 425px){
  section, .section {
    padding: 0.75rem 0.5rem;
  }
  .content h1.is-size-1 {
    font-size: 2.5rem;
  }
  .content h1.is-size-1 span {
    font-size: 2.2rem;
    border-size: 0.08em;
  }
  .navbar.navbar-top > div a:nth-child(2) {
    width: 120px;
  }
}

@media screen and (max-width: 320px){
  .navbar.navbar-top > div a:nth-child(2) {
    width: 60px;
  }
}
  </style>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "NewsArticle",
      "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "<?=base_url()?>"
      },
      "headline": "Seme Indonesia Address Provider Documentation API",
      "datePublished": "2015-02-05T08:00:00+08:00",
      "dateModified": "2015-02-05T09:20:00+08:00",
      "author": {
        "@type": "Person",
        "name": "Daeng Rosanda"
      },
      "description": "API Documentation for using Indonesian address provider"
    }
  </script>
</head>
