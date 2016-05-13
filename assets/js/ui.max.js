// .hasAttr Extentions

var $ = jQuery;

$.fn.hasAttr = function (name) {
  return this.attr(name) !== undefined;
};
$.fn.outerHTML = function(){
  return (!this.length) ? this : (this[0].outerHTML || (
  function(el){
    var div = document.createElement('div');
    div.appendChild(el.cloneNode(true));
    var contents = div.innerHTML;
    div = null;
    return contents;
  })(this[0]));
}

$.fn.findNextAll = function(selector){
  var that = this[ 0 ],
    selection = $( selector ).get();
  return this.pushStack(
    !that && selection || $.grep( selection, function(n){
       return that.compareDocumentPosition(n) & (1<<2);
       // if you are looking for previous elements it should be & (1<<1);
    })
  );
}
$.fn.findNext = function(selector){
  return this.pushStack( this.findNextAll( selector ).first() );
}

$(document).ready(function () {

  // Device detection: desktop, tablet, mobile
  var device;
  function checkdevice() {
    device = $('body').attr('class');
  }
  checkdevice();
  
  /*** Global variables (beyond the theme settings) ***/
    // Base
  var baseurl = $('body').attr('data-base');
  //var basedir = $('body').attr('data-dir');
    // UI
  var uiready = false;
  var keyboardready = false;
  var pageready = true;
  var replacepagetype = 'default';
  var viewportHeight = $(window).height();
  var viewportWidth = $(window).width();
  var docheight = $(document).height();
    // Menu speed settings values transformed
  var menu_speed = toggle_menu_speed;
  if (device == 'mobile') {
    menu_speed = mobile_toggle_menu_speed;
  } else if (device == 'tablet') {
    menu_speed = tablet_toggle_menu_speed;
  }
    // X-tra variables for misc. needs
  var imagefadespeed = image_loaded_fade_speed;
  var headerheight = $('#header').outerHeight();
  var footerheight = $('#footer').height();
  var loadmoreready = true;
  var nextprevadjuststate = false;
  var coverheight = 0;
  var mmenustate = false;
  var history_transition_delay = 50;
  var next_prev_fixed_display = false; // Only display when reaching the bottom
  var next_prev_fixed_display = true; // Always display
  var focusmode = false;
  var coverslider = false;
  
    // Slideshow arrow icons
  var slideshow_arrow_icon_left = '5';
  var slideshow_arrow_icon_right = '6';
  
  if (slideshow_arrow_icons == '2') {
    slideshow_arrow_icon_left = 'H';
    slideshow_arrow_icon_right = 'I';  
  } else if (slideshow_arrow_icons == '3') {
    slideshow_arrow_icon_left = 'X';
    slideshow_arrow_icon_right = 'Y';
  } else if (slideshow_arrow_icons == '4') {
    slideshow_arrow_icon_left = 'm';
    slideshow_arrow_icon_right = 'n';
  } else if (slideshow_arrow_icons == '5') {
    slideshow_arrow_icon_left = 'h';
    slideshow_arrow_icon_right = 'f';
  }
  
    // Focus mode arrow icons
  var focus_mode_arrow_icon_left = '5';
  var focus_mode_arrow_icon_right = '6';
  var focus_mode_arrow_icon_close = 'p';
  
  if (focus_mode_icons == '2') {
    focus_mode_arrow_icon_left = 'H';
    focus_mode_arrow_icon_right = 'I';
    focus_mode_arrow_icon_close = 'g';
  } else if (focus_mode_icons == '3') {
    focus_mode_arrow_icon_left = 'X';
    focus_mode_arrow_icon_right = 'Y';
    focus_mode_arrow_icon_close = 'g';
  } else if (focus_mode_icons == '4') {
    focus_mode_arrow_icon_left = 'm';
    focus_mode_arrow_icon_right = 'n';
    focus_mode_arrow_icon_close = 'p';
  } else if (focus_mode_icons == '5') {
    focus_mode_arrow_icon_left = 'h';
    focus_mode_arrow_icon_right = 'f';
    focus_mode_arrow_icon_close = 'g';
  }
  
  /*** Browser support detection ***/
    // Identify rusty rusty browsers
  function isCanvasSupported() {
    var elem = document.createElement('canvas');
    return !!(elem.getContext && elem.getContext('2d'));
  }

  if (!isCanvasSupported()) {
    // The action for the rusty rusty browsers	
  }

  /*** HEX Color calc func ***/
  var prev_site_bg_color;
  var prev_header_bg_color;

  function colorcheck() {
    prev_site_bg_color = $('#block').attr('data-color');
  }

  /*** IE fix's ***/
  function ie7boxsizing() {
    if (navigator.appVersion.indexOf("MSIE 7.") != -1) {
      $('input, textarea').each(function () {
        if ($(this).hasClass('done')) {
          // Escape
        } else {
          outherwidth = $(this).outerWidth();
          width = $(this).width();
          diff = outherwidth - width;
          newwidth = width - diff;
          $(this).width(newwidth).addClass('done');
        }
      });
    }
  }

  /*** HTML 5 push + Ajax ***/
    // Ajax Cache Array
  var page_cache = [];
    // Set push state, default is true
  var pushstate = true;
  if (!isCanvasSupported()) {
    // If old browser
    pushstate = false;
  }
  if (history_state == false) {
    // If turned off in theme settings
    pushstate = false;
  }
  
    // Append function
  function appendpage($response, transition_speed, transition_delay, reinitMe) { 
    // Grab content
    one = $response.find('#content').html();
    two = $response.find('#header').html();
    three = $response.find('#footer').html();
    four = $response.filter('#toggle').html();
    // Grab title
    targetTitle = $response.filter('title').text();
    
    headerclass = $response.filter('#header').attr('class');
    $('#header').attr('class', headerclass);
    
    headercolor = $response.find('#header').attr('data-color');
    $('#header').attr('data-color', headercolor);    
    
    menucolor = $response.filter('#toggle').attr('data-color');
    $('#toggle').attr('data-color', menucolor); 
    
    // Append content
    $("#content").empty().append(one);
    $("#header").empty().append(two);
    $("#footer").empty().append(three);
    $("#toggle").empty().append(four);
    
    resize();

    store_prev_site_bg_color = prev_site_bg_color;
    store_prev_header_bg_color = prev_header_bg_color;
    colorcheck();
    
    //overrideheaderpos();
    
    if (device == 'desktop') {

      $('#block').transition({
        backgroundColor: '' + store_prev_site_bg_color + ''
      }, 0, function () {
  
        $('#block').transition({
          backgroundColor: '' + prev_site_bg_color + ''
        }, transition_speed, function () {
        
          setheadercolor(0);
        
          if (prev_site_bg_color == store_prev_site_bg_color) {
            bodyscrollto(0, 0);
            $('#block').fadeTo(transition_delay, 1).fadeTo(transition_speed, 0, function () {
              $('#block').hide();
              pageready = true;
              
            });
          } else {
            bodyscrollto(0, 0);
            $('#block').fadeTo(transition_delay, 1).fadeTo(transition_speed, 0, function () {
              $('#block').hide();
              pageready = true;
              
            });
          }
           
        });
  
      });

    } else {
      setheadercolor(0);
      $('#block').hide();
      bodyscrollto(0, 0);
      pageready = true;
    }

    document.title = targetTitle;
    
    if (reinitMe == true) {
      reinit();
    } else {
      reinitAlt();
    }
    
  }

  var replacePage = function (url) {

    if (typeof (window.history.pushState) == 'function' && pushstate == true) {

      if (replacepagetype == 'default') {
        // This is when navigating with the back and forward buttons
        // ...or any other history management event like trackpad or simillar
        colorcheck();

        if (page_cache[url] && history_cache !== 'Off') {
      
          // Weehoo, already in cache
          var $response = page_cache[url];
          one = $response.find('#content').html();
          two = $response.find('#header').html();
          three = $response.find('#footer').html();
          four = $response.filter('#toggle').html();
          targetTitle = $response.filter('title').text();

          headerclass = $response.filter('#header').attr('class');
          $('#header').attr('class', headerclass);
          
          headercolor = $response.find('#header').attr('data-color');
          $('#header').attr('data-color', headercolor); 
          
          menucolor = $response.filter('#toggle').attr('data-color');
          $('#toggle').attr('data-color', menucolor); 

          // Append content
          $("#content").empty().append(one);
          $("#header").empty().append(two);
          $("#footer").empty().append(three);
          $("#toggle").empty().append(four);
          
          store_prev_site_bg_color = prev_site_bg_color;
          colorcheck();

          $('#block').fadeTo(0, 1).fadeTo(0, 0, function () {
            $('#block').hide();
            setheadercolor(0);
          });

          document.title = targetTitle;
          imagefadespeed = 0;
          reinitAlt();
          
        } else {
          window.location.href = url;
        }

      } else {
      
        // This is used for mobile & tablets
        
        if (device == 'mobile' || device == 'tablet') {
          
          if (replacepagetype == 'sideclick') {
          
            $('#partial-block').remove();
            
            $('<div/>', {
              id: 'partial-block',
              "class": '',
              text: ' '
            }).prependTo('#wrap');
  
            $('#partial-block').fadeTo(0, 0).fadeTo(500, 1, function () {
  
              setTimeout(function () {
                bodyscrollto(0, 0);
              }, 100);
              
              colorcheck();
  
              if (page_cache[url] && history_cache == 'Cache All') {
                // Weehoo, already in cache
                var $response = page_cache[url];
                appendpage($response, transition_speed, transition_delay, true);
              } else {
                if ($.ajaxq.isRunning()) {
                  // Speed it up to keep it smooth
                  var transition_speed = 0;
                  var transition_delay = 0;
                } else {
                  // Translate speed values
                  transition_speed = history_transition_speed;
                  transition_delay = history_transition_delay;
                }
                // Not in client cache, so do make the call
                $.ajaxq ("testqueue", {
                  url: url,
                  type: 'get',
                  dataType: 'html',
                  cache: true,
                  success: function (data) {
                    var $response = $(data);
                    page_cache[url] = $response;
                    appendpage($response, transition_speed, transition_delay, true);
                  },
                  error: function (data) {
                    document.location.reload();
                  }
                });
  
              }
  
            });
            
          
          } else {
          
            // This is for desktop
          
            addpageloader();
          
            $('#block').fadeTo(0, 0).fadeTo(0, 1, function () {
  
              setTimeout(function () {
                bodyscrollto(0, 0);
              }, 100);
              
              colorcheck();
  
              if (page_cache[url] && history_cache == 'Cache All') {
                // Weehoo, already in cache
                var $response = page_cache[url];
                appendpage($response, transition_speed, transition_delay, true);
              } else {
                if ($.ajaxq.isRunning()) {
                  // Speed it up to keep it smooth
                  var transition_speed = 0;
                  var transition_delay = 0;
                } else {
                  // Translate speed values
                  transition_speed = history_transition_speed;
                  transition_delay = history_transition_delay;
                }
                // Not in client cache, so do make the call
                $.ajaxq ("testqueue", {
                  url: url,
                  type: 'get',
                  dataType: 'html',
                  cache: true,
                  success: function (data) {
                    var $response = $(data);
                    page_cache[url] = $response;
                    appendpage($response, transition_speed, transition_delay, true);
                  },
                  error: function (data) {
                    document.location.reload();
                  }
                });
  
              }
  
            });
            
          }

        } else {
        
          // This is used for Desktop

          addpageloader();
          
          $('#block').stop().fadeTo(history_transition_speed, 1, function () {

            bodyscrollto(0, 0);
            colorcheck();

            if (page_cache[url] && history_cache == 'Cache All') {
              // Weehoo, already in cache
              var $response = page_cache[url];
              appendpage($response, transition_speed, transition_delay, true);
            } else {
              if ($.ajaxq.isRunning()) {
                // Speed it up to keep it smooth
                var transition_speed = 0;
                var transition_delay = 0;
              } else {
                // Translate speed values
                transition_speed = history_transition_speed;
                transition_delay = history_transition_delay;
              }
              // Not in client cache, so do make the call

              $.ajax({
                url: url,
                type: 'get',
                dataType: 'html',
                cache: true,
                success: function (data) {
                  var $response = $(data);
                  page_cache[url] = $response;
                  appendpage($response, transition_speed, transition_delay, true);
                },
                error: function (data) {
                  document.location.reload();
                }
              });

            }

          });

        }

      }


    } else {
      window.location.href = url;
    }

  }

  // Bind to State Change (only if pushstate is turned on)
  if (typeof (window.history.pushState) == 'function' && pushstate == true) {

    History.Adapter.bind(window, 'statechange', function () {
      var State = History.getState();
      replacePage(State.url);
    });
    

    $('body').on('click', 'a.history, .history a, .menu-item a, .text-item a, .figcaption a, #nextprev-page a', function (e) {
      
      if (!$(this).hasClass('scrollpos')) {
    
        prehistory();
        domain = baseurl;
        thislink = $(this).attr('href');
        thislinktarget = $(this).attr('target');
        if (thislink.indexOf(domain) >= 0) {
          if (thislinktarget == '_blank' || thislinktarget == '_new') {
            // New window link
            // Fallback to default
          } else {
            e.preventDefault();
            if (mmenustate == true) {
              replacepagetype = 'sideclick';
            } else {
              replacepagetype = 'click';  
            }
            
            History.pushState({
              state: 1,
              rand: Math.random()
            }, null, this.href); 
          }
        } else {
          // External link
          // Fallback to default
        }
      
      }
      
    });

  }

  // If transition hybrid is turned on
  if (pushstate == false && transition_hybrid == true) {
    $('body').on('click', 'a.history, .history a, .menu-item a, .text-item a, .figcaption a, #nextprev-page a', function (e) {
      e.preventDefault();
      href = $(this).attr('href');
      
      if (!$(this).hasClass('scrollpos')) {
        //$('#header, #wrap, #toggle').hide();
        closemmenu(history_transition_speed);
        $('#block').show().fadeTo(0,0).fadeTo(history_transition_speed,1, function(){
          window.location.href = href;
        });
      }
    });
  }


  /*** Google Analytics on Ajax update ***/
	$(document).on('ajaxComplete', function (event, request, settings) {
	  if (typeof ga == 'function' ) {
  		ga('send', 'pageview', window.location.pathname);
		}
  });
  
  
  var timer;
  function pageloaderTimer(sec) {
    if (timer) clearInterval(timer);
    
    if (history_transition_speed < 250) {
      timerdelay = 250;
    } else {
      timerdelay = history_transition_speed;
    }
    
    timer = setInterval(function() { 
      var p = $('#pageloader');
        if (p.hasClass('pump')) {
          p.removeClass('pump');
          p.fadeTo(500, 1);
        } else {
          p.addClass('pump');
          p.fadeTo(500, 0);
        }
        if (sec == -1) {
            clearInterval(timer);
        } 
    }, timerdelay);
  }
  
  /*** Page-loading ***/
  function addpageloader() {
    if (page_loader == 'None') {
      // Escape
    } else if (page_loader == 'Type-5') {
      $('#pageloader').remove();
      $('<div/>', {
        id: 'pageloader',
        "class": ''+page_loader+' vcenter hcenter '+page_loader_text_size+'',
        text: ' '
      }).prependTo('body');
      $('#pageloader').html(page_loader_text);
      vcenter();
      hcenter();  
      pageloaderTimer(1);    
    } else {
      $('#pageloader').remove();
      $('<div/>', {
        id: 'pageloader',
        "class": ''+page_loader+'',
        text: ' '
      }).prependTo('body');
    
      pageloaderTimer(1);
    }
  }
  
  function removepageloader() {
    if (page_loader == 'None') {
      // Escape
    } else {
      $('#pageloader').remove();
    }
  }
  
  /*
  // Header Position Logic
  function overrideheaderpos() {
    default_header_pos = $('#header').attr('class');
    override_header_pos = $('#block').attr('data-header-position');
    
    if (override_header_pos == 'static') {
      if (default_header_pos == override_header_pos) {
        // Escape
      } else {
        $('#header').removeClass('fixed').addClass('static');
      }
    } else if (override_header_pos == 'fixed') {
      if (default_header_pos == override_header_pos) {
        // Escape
      } else {
        $('#header').removeClass('static').addClass('fixed');
      }
    }
  }
  */
  
  /*** Pre-loading ***/

  // Pre-resize the images before they are loaded (to prevent loading flicker)
  function prepreloading() {
    $('#content img').each(function () {
      if (!$(this).hasClass('ready')) {
        if ($(this).hasClass('notme')) {
          // Escape
        } else if ($(this).hasClass('reverse')) {
          parentheight = $(this).parent().height();
          imgwidth = $(this).attr('data-width');
          imgheight = $(this).attr('data-height');
          imgdim = imgwidth / imgheight;
          newwidth = parentheight * imgdim;
          newwidth = Math.round(newwidth);
          // Apply
          $(this).width(newwidth);
          $(this).height(parentheight);
          $(this).fadeTo(0, 0);
        } else {
          parentwidth = $(this).parent().width();
          imgwidth = $(this).attr('data-width');
          imgheight = $(this).attr('data-height');
          imgdim = imgwidth / imgheight;
          newheight = parentwidth / imgdim;
          newheight = Math.round(newheight);
          // Apply
          $(this).width(parentwidth);
          $(this).height(newheight);
          $(this).fadeTo(0, 0);
        }
      }
    });
  }

  // Image preloading
  function preloadimages() {
    
    // Add spinner if
    $('#content img').each(function (i) {
      if ($(this).hasClass('notme')) {
        // Escape
      } else {
        var pt = $(this).parent();
        var t = $(this);
        setTimeout(function () {
          if (pt.hasClass('bing')) {
            // Escape
            //t.fadeTo(0, 1);
          } else {
            pt.prepend('<div class="slide-spinn">&nbsp;</div>');
            t.addClass('bong');
          }
        }, 600);
      }
    });

    // Preload
    $('#content img').imgpreload({
      each: function () {
        // Selectors
        var t = $(this);
        var tp = $(this).parent();
        var tpp = $(this).parent().parent();
        var tppp = $(this).parent().parent().parent();
        
        if ($(this).hasClass('notme')) {
          // Escape
        } else {
          if (tpp.hasClass('thumb')) {
            tpp.addClass('ready');
          }
  
          t.addClass('ready');
          tp.addClass('ready');
          
          if ($('#header').hasAttr('data-color')) {
            bgcolor = $('#header').attr('data-color');
          } else {
            bgcolor = 'transparent';
          }
  
          // Force color
          // ... & Hide circle loader
          if (tp.hasClass('row-img')) {
            // IF row item = keep bg color
            tp.addClass('bing').find('.slide-spinn').fadeTo(0, 0, function () {
              $(this).remove();
            });
          } else {
            // Set color
            if (tp.hasClass('bleed')) {
              tp.addClass('bing').css({
                'background': 'transparent'
              }).find('.slide-spinn').fadeTo(0, 0, function () {
                $(this).remove();
              }); 
            } else {
              tp.addClass('bing').css({
                'background': '' + bgcolor + ''
              }).find('.slide-spinn').fadeTo(0, 0, function () {
                $(this).remove();
              }); 
            }
          }
  
          // Fade in loaded images
          if (t.hasClass('reverse')) {
            if (t.hasClass('bong')) {
              $(this).css({
                'height': '100%',
                'width': 'auto'
              }).fadeTo(imagefadespeed, 1);
            } else {
              $(this).css({
                'height': '100%',
                'width': 'auto'
              }).fadeTo(0, 1);
            }
          } else {
            if (t.hasClass('bong')) {
              $(this).css({
                'width': '100%',
                'height': 'auto'
              }).fadeTo(imagefadespeed, 1);
            } else {
              $(this).css({
                'width': '100%',
                'height': 'auto'
              }).fadeTo(0, 1);
            }
          }
          
          resize();
        
        }
        
      },
      all: function () {
        // Executes when all images are loaded
        resize();
        imagefadespeed = image_loaded_fade_speed;
        $('.slide-spinn').remove();
      }
    });
    
    
    $('body .royalSlider .rsImg').imgpreload({
      each: function () {
        // Executes on each slideshow image load
        resize();
      },
      all: function () {
        // Executes when all slideshow images are loaded
        resize();
      }
    });
    
    
    /*
    // Preload thumb hover images (if any)
      // Fill array with all hover images so we can preload them
    var hover_thumb_src_array = [];
    var arraycount = 0;
    $('.module .thumb .img-holder img').each(function(i){
      if ($(this).hasAttr('data-hoversrc')) { 
        hs = $(this).attr('data-hoversrc');
        if (hs) {
          hover_thumb_src_array[arraycount] = hs;
          arraycount++;
        }
      }
    });
    // Now preload thumb hover images
    $.imgpreload(hover_thumb_src_array, {
      each: function() {
        // Executes after each image
      },
      all: function() {
        // Executes when all images are loaded
      }
    });
    */

  }

  function adjustsiteborders() {
    if ($('#border-left').length) {
      contentwidth = $('#content').width();
      if (contentwidth >= max_site_width) {
        limit = (viewportWidth - contentwidth) / 2;
        $('#border-right').css({
          'right': '' + limit + 'px'
        });
        $('#border-left').css({
          'left': '' + limit + 'px'
        });
      } else {
        $('#border-right').css({
          'right': '' + site_margin_right + ''
        });
        $('#border-left').css({
          'left': '' + site_margin_left + ''
        });
      }
    }
  }

  /* Resizers */

  function resize() {
    headerheight = $('#header').outerHeight();
    footerheight = $('#footer').height();
    headerheightadjust();
    footerheightadjust();
    adjustsiteborders();
    resizeiframes();
    resizecoverspace();
    resizebleed();
    resizemenu();
    nextprevadjust();
    vcenter();
    hcenter();
    resizefocus();
    resizeslideshows();
    resizefixedsidebarmenu();
    setpackery();
    if (device == 'desktop') {
      resizesticky();
      ie7boxsizing();
    }
    $('#main').css({'min-height':''+viewportHeight/2+'px'});
  }

  // Vertically center elements
  function vcenter() {
    $('.vcenter, .rsArrow').each(function () {
      h = $(this).outerHeight() / 2;
      $(this).css({
        'margin-top': '-' + h + 'px'
      });
    });
    /*
    $('.vcenter-rev').each(function () {
      h = $(this).outerHeight() / 2;
      $(this).css({
        'margin-bottom': '-' + h + 'px'
      });
    });
    */
  }

  // Horizontally center elements
  function hcenter() {
    $('.hcenter, .rsBullets').each(function () {
      w = $(this).outerWidth() / 2;
      $(this).css({
        'margin-left': '-' + w + 'px'
      });
    });
  }
  
  function resizefixedsidebarmenu() {
    side = $('#side.fixed #sidebar_menu_holder');
    if (side.length) {
      sideparentwidth = side.parent().width();
      side.width(sideparentwidth);
    }
  }
  
  function resizecoverspace() {
    cover = $('#cover-space');
    coverheight = $('#cover-space').attr('data-cover-height');
    
    if (!coverheight) {
      coverheight = 100; 
    }
        
    if (device == 'mobile') {
      coverheight = 55;
    } else if (device == 'tablet') {
      coverheight = 50;
    }
    
    // Mobile Cover slideshow on top margin adjust  
    $('body.mobile #cover-space').css({'top':''+headerheight+'px'});
    // Tablet Cover slideshow on top margin adjust  
    $('body.tablet #cover-space').css({'top':''+headerheight+'px'});
    coverheight = viewportHeight * (coverheight / 100 );
    
    if (cover.length) {
      mt = coverheight - headerheight - header_bottom_margin;
      pt = header_bottom_margin;
      if (device == 'mobile') {
        mt = coverheight - mobile_header_bottom_margin;
        pt = mobile_header_bottom_margin;
      } else if (device == 'tablet') {
        mt = coverheight - tablet_header_bottom_margin;
        pt = tablet_header_bottom_margin;        
      }
      $('#mainside').css({'margin-top':''+mt +'px','padding-top':''+pt+'px'});
      cover.height(coverheight);
      $('#cover-title').css({'margin-top':''+headerheight+'px'});
      ch = $('#cover-title.middle').outerHeight();
      mt = (- ch/2);
      $('#cover-title.middle').css({'margin-top':''+ mt +'px'});
    }
  }
  
  function resizefocus() {
    if ($('#focus').length) {
    
      viewportDim = (viewportWidth - focus_mode_margin_top * 2) / (viewportHeight - focus_mode_margin_top - focus_mode_margin_bottom);
      imgWidth = parseInt($('#focus img').attr('data-width'));
      imgHeight = parseInt($('#focus img').attr('data-height'));    
      imgDim = imgWidth / imgHeight;
  
      if (viewportDim > imgDim || viewportWidth > 1024) {
        // Landscape
        newHeight = viewportHeight - focus_mode_margin_top - focus_mode_margin_bottom;
        newWidth = newHeight * imgDim;
        mtop = focus_mode_margin_top;
        mleft = (viewportWidth - newWidth) / 2;
        $('#focus img').height(newHeight).width(newWidth).css({
          'margin-top': '' + mtop + 'px',
          'margin-left': '' + mleft + 'px'
        });
      } else {
        // Portrait
        newWidth = viewportWidth - focus_mode_margin_top - focus_mode_margin_bottom;
        newHeight = newWidth / imgDim;
        mleft = (focus_mode_margin_top + focus_mode_margin_bottom) / 2;
        mtop = (viewportHeight - newHeight) / 2;
        $('#focus img').width(newWidth).height(newHeight).css({
          'margin-left': '' + mleft + 'px',
          'margin-top': '' + mtop + 'px'
        });
      }
      
      nav = $('#s-middle');
      navheight = nav.height();
      navwidth = nav.width();
      navpos = viewportHeight - focus_mode_margin_bottom / 2;
      nav.css({'top':''+navpos+'px','margin-left':'-'+navwidth/2+'px','margin-top':'-'+navheight/2+'px'});
    
    }
    
  }
  
  function resizeslideshows() {
    // Cover slideshow on resize    
    $('.royalSlider.cover-slideshow').each(function() {
      t = $(this);
      t.width(viewportWidth).height(coverheight);
      t.parent().width(viewportWidth).height(coverheight);
      t.royalSlider('updateSliderSize', true);
    });
    
    // Default slideshow on resize
    $('.royalSlider.default-slideshow').each(function() {
      t = $(this);
      parentwidth = t.parent().width();      
      // Grab first image info
      slideshow_firstimg_w = t.find('.rsImg').first().attr('data-rsw');
      slideshow_firstimg_h = t.find('.rsImg').first().attr('data-rsh');
      slideshow_dim = slideshow_firstimg_w / slideshow_firstimg_h;
      slideshow_w = t.parent().width();
      slideshow_h = slideshow_w / slideshow_dim;
      // Apply
      t.width(parentwidth).height(slideshow_h);
      t.royalSlider('updateSliderSize', true);
    });
    // Row slideshow on resize
    $('.royalSlider.row-slideshow').each(function() {
      t = $(this);
      //parentwidth = t.parent().width();
      parentheight = t.parent().parent().parent().height();    
      // Grab first image info
      slideshow_firstimg_w = t.find('.rsImg').first().attr('data-rsw');
      slideshow_firstimg_h = t.find('.rsImg').first().attr('data-rsh');
      slideshow_dim = slideshow_firstimg_w / slideshow_firstimg_h;
      slideshow_h = parentheight;
      slideshow_w = slideshow_h * slideshow_dim;
      // Math
      slideshow_w = Math.ceil(slideshow_w);
      // Apply
      t.height(parentheight).width(slideshow_w);
      t.royalSlider('updateSliderSize', true);
    });
  }

  function resizemenu() {
    // Toggle
    if ($('#menu-icon').hasClass('open')) {
      opentogglemenu(1);
    } else {
      closetogglemenu(0);
    }
    // Select menues
    if (viewportWidth < 1025) {
      setselectmenus(); 
    } else {
      removeselectmenus();
    }
  }
  
  function resizesticky() {
    if (device == 'desktop' && $('#side.sticky').length) {
      stickywidth = $('#side.sticky').width();
      $("#side.sticky #sidebar_menu_holder").width(stickywidth);
    }
  }

  function resizeiframes() {
    $('iframe').each(function () {
      iframewidth = $(this).attr('width');
      iframeheight = $(this).attr('height');
      iframedim = iframewidth / iframeheight;
      parentwidth = $(this).parent().width();
      newwidth = parentwidth;
      newheight = parentwidth / iframedim;
      newheight = Math.ceil(newheight);
      $(this).width(newwidth).height(newheight);
    });
    $('.row-item iframe').each(function () {
      iframewidth = $(this).attr('width');
      iframeheight = $(this).attr('height');
      iframedim = iframewidth / iframeheight;
      parentheight = 150;
      newheight = parentheight;
      newwidth = parentheight * iframedim;
      newwidth = Math.ceil(newwidth);
      $(this).width(newwidth).height(newheight);
    });
  }

  function resizebleed() {
    $(".bleed").each(function (intIndex) {
      selectorHolder = $(this);
      wm = selectorHolder.parent().width();
      hm = selectorHolder.parent().height();
      spaceRatio = wm / hm;
      selector = selectorHolder.find('img');
      imageWidth = $(selector).attr('data-width');
      imageHeight = $(selector).attr('data-height');
      imageRatio = imageWidth / imageHeight;
      newHeight = 0;
      newWidth = 0;

      if (spaceRatio > imageRatio) {
        newHeight = (wm / imageWidth) * imageHeight;
        newWidth = wm;
      } else {
        newHeight = hm;
        newWidth = (hm / imageHeight) * imageWidth;
      }

      newTop = 0 - ((newHeight - hm) / 2);
      newLeft = 0 - ((newWidth - wm) / 2);

      /* Holder */
      if ($('#header').hasClass('static')) {
        selectorHolder.height(hm).width(wm);
      } else {
        selectorHolder.height(hm).width(wm);
      }

      if (selectorHolder.hasClass('iframe')) {
        // Escape
      } else {
        /* Img */
        selector.css({
          height: newHeight,
          width: newWidth,
          marginTop: newTop,
          marginLeft: newLeft
        });
      }

    });
  }

  /* Masonry/Packery */
  
  /*
  // Set/target single packery 
  // ...probably never needed
  function setpack(container, s) {
    $(container).packery({
      itemSelector: '.masonry-item',
      transitionDuration: 0
    });
  }
  */

  // Set packery (all)
  function setpackery() {
    // Packery
    var container = $('.packery');
    container.packery({
      itemSelector: '.masonry-item',
      transitionDuration: 0,
    });
  }
  
  // Set mobile
  function setmobile() {
    // Disable link hover states
    $('body.mobile a').addClass('disabled');
  }
  
  // Set tablet
  function settablet() {
    // Disable link hover states
    $('body.tablet a').addClass('disabled');
  }

  // Logic for #header
  function headerheightadjust() {
    h = $('#header');
    if (h.length) {
      headerheight = h.outerHeight();
      $('#content').css({
        'padding-top': '' + headerheight + 'px'
      });
    }
  }

  // Logic for #footer
  function footerheightadjust() {
    if ($('#footer').length) {
      footerpos = $('#footer').position().top;
      wrapbottom = $('#wrap').css('margin-bottom');
      wrapbottom = wrapbottom.replace('px', '');
      if ((footerpos + footerheight) < viewportHeight) {
        diff = viewportHeight - (footerpos + footerheight) - wrapbottom;
        $('#footer').css({
          'padding-top': '' + diff + 'px'
        });
      } else {
        $('#footer').css({
          'padding-top': '0px'
        });
      }
    }
  }
  
  // Logic for #nextprev navigation
  function nextprevadjust() {
    if ($('#nextprev').length && nextprevadjuststate == true) {
      toppos = $('#nextprev').offset().top;
      nextprevheight = $('#nextprev a').innerHeight();
      half = viewportHeight / 2;
      diff = (half - toppos) - (nextprevheight/2);

      if (diff < 0) {
        diff = 0;
      }
      
      if (toppos < half) {
        $('#nextprev .separator-module').css({'margin-top':''+ diff +'px'});
      } else {
        $('#nextprev .separator-module').css({'margin-top':'0px'});
      }
    }
  }
  

  /* Scrollers */

  var bodyscrollpos = 0;
  var bodyoldscrollpos = 0;
  //var bodyscrolldir = 'down';
  var covershift = 0;

  // When scrolling the window

  function bodyscrolling() {

    bodyscrollpos = $(window).scrollTop();
    
    if (device == 'desktop') {
      docheight = $(document).height();
  
      if (bodyscrollpos < 0) {
        bodyscrollpos = 0;
      }
  
      // Identify scroll direction. Not used atm, but left for future reference
  		//if (bodyoldscrollpos > bodyscrollpos) {
  		  //bodyscrolldir = 'up';
  		//} else {
  		  //bodyscrolldir = 'down';
  		//}
  		
  		setcovertrans();
  
      if (taxonomy_pagination_type == 'Infinity (Ajax)' && loadmoreready == true) {
        if ($('.loadmore-trigger a').length) {
          if (bodyscrollpos >= (docheight - viewportHeight*2)) {
            $('.loadmore-trigger a').trigger('click');
          }
        }
      }
      
      if ($('#menu-icon').hasClass('open')) {
        $('#menu-icon').trigger('click');
      }
      
      setsticky();
      setnextprevarrows();
      
      if ($('#cover-space').hasClass('cover_smooth_fade')) {
        min = 0;
        max = $('#cover-space').height();
        
        relation = bodyscrollpos / max;
        alpha = Math.round(relation * 100) / 100;
        
        if (alpha > 1) {
          alpha = 1;
        } else if (alpha < 0) {
          alpha = 0;
        }
        
        // Cover image
        cover_image_alpha = $('#cover-space').attr('data-imgalpha') - alpha;        
        $('#cover-space-bg-image').css({'opacity': cover_image_alpha});
        // Title
        title_alpha = 1 - alpha;
        baseh = viewportHeight / 2;
        mt = 0 - (baseh - baseh * title_alpha) - $('#cover-title').height() / 2;        
        $('#cover-title.middle').css({'margin-top' : ''+mt+'px', 'opacity': title_alpha});
        //$('#cover-title.top').css({'marginTop' : ''+mt+'px', 'opacity': title_alpha});
        $('#cover-title.bottom').css({'margin-top' : ''+mt+'px', 'opacity': title_alpha});
        // Bg color
        bgalpha = 1 - $('#cover-space').attr('data-alpha');
        bgalpha = Math.round((alpha * relation) + alpha);
        bgalpha = Math.round(relation * 100) / 100;
        fix = parseFloat($('#cover-space').attr('data-alpha'), 10);
        
        if (alpha == 0) {
          $('#cover-space-bg').addClass('hide');
        } else {
          $('#cover-space-bg').css({'opacity': bgalpha + fix}).removeClass('hide');
        }
        
      }
      
    } else {
      // Mobile & Tablets
      if ($('#header').hasClass('fixed')) {
        setcovertrans();
      }
    }

    // Archive the old pos
    bodyoldscrollpos = bodyscrollpos;

  }

  // Bundle bind scrollers
  function bindScrollers() {
    if (device == 'mobile' || device == 'tablet') {
      $(window).bind('scroll', bodyscrolling);
    } else {
      $(window).bind('scroll', bodyscrolling);
    }
  }

  // Use this function to scroll to a y pos of the body. You can also insert a speed value.
  var maxspeed = 2000;
  var minspeed = 800;
  var normdistance = 1000;
  
  function bodyscrollto(pos, s) {
    newspeed = s;
    docheight = $(document).height();

    distance = pos - bodyscrollpos;
    distance = Math.abs(distance);
    ratio = distance / normdistance;
    newspeed = newspeed * ratio;
    newspeed = Math.round(newspeed);
    if (newspeed > maxspeed) {
      newspeed = maxspeed;
    }
    newspeed = Math.round(newspeed / 10) * 10;
    
    if (pos > docheight - viewportHeight) {
      //pos = docheight - viewportHeight;
    }
    
    pos = Math.round(pos);
    
    if (newspeed < minspeed) {
      newspeed = minspeed;
    }
    
    if (bodyscrollpos == pos) {
      
    } else {
     
      $('body, html').animate({
        scrollTop: '' + pos + 'px'
      }, newspeed, 'easeInOutQuart', function () {
        // Animation complete.
        
      });
      
    }
  }
  
  function setheadercolor(speed) {
    if (header_background_transparency == false) {
      setTimeout(function () {
        headerbgcolor = $('#header').attr('data-color');
        $('#header, #header-inner').css({'background': headerbgcolor});      
      
        togglebgcolor = $('#toggle').attr('data-color');
        $('#toggle-menu').css({'background': togglebgcolor});
        
      }, speed);
    }
  }
  
  function setsticky() {
    if (device == 'desktop' && $('#side.sticky').length) {
    
      t = $('#side.sticky');
      stickydist = headerheight + header_bottom_margin;
      
      /*
      if ($('#menu-icon').hasClass('open')) {
        stickydist = stickydist + $('#toggle-menu').height();
      }
      */
      
      stickytoppos =  t.offset().top - stickydist;
      stickywidth = t.width();
      
      if (!$('#cover-space').length) {
      
          if (! $("#side.sticky #sidebar_menu_holder").hasClass('fixed')) {
            $("#side.sticky #sidebar_menu_holder").addClass('fixed').css({'top':''+stickydist+'px'}).width(stickywidth);
          }
      
      } else {
      
        if (bodyscrollpos > stickytoppos) {
          if (! $("#side.sticky #sidebar_menu_holder").hasClass('fixed')) {
            $("#side.sticky #sidebar_menu_holder").addClass('fixed').css({'top':''+stickydist+'px'}).width(stickywidth);
          }
        } else {
          if ($("#side.sticky #sidebar_menu_holder").hasClass('fixed')) {
            $("#side.sticky #sidebar_menu_holder").removeClass('fixed').css({'top':'0px'});
          }
        }
        
      }
      
    }
  }
  
  function setnextprevarrows() {
    if (device == 'desktop') {
      
      if (viewportHeight <= docheight && next_prev_fixed_display == false) {
        
        snap = docheight - viewportHeight*2;
        if (snap < 0) {
          snap = 0;
        }
        
        if (bodyscrollpos >= snap) {
          $('#nextprev a.next-fixed, #nextprev a.prev-fixed').addClass('display');
        } else {
          $('#nextprev a.next-fixed, #nextprev a.prev-fixed').removeClass('display');
        }
      } else {
        $('#nextprev a.next-fixed, #nextprev a.prev-fixed').addClass('display');
      }
      
    }
  }
  
  function setclasses() {
    if ($('#cover-space').length) {
      $('#wrap').addClass('cover');
    } else {
      $('#wrap').removeClass('cover');
    }
    
    if ($('#tiled-marker').length) {
      $('#wrap').addClass('tiled');
    } else {
      $('#wrap').removeClass('tiled');
    }
  }

  function setslideshow() {
    
    // Reset slide ID
    slide_id = 0;
    
    if (device == 'desktop') {
      clicksupport = false;
      dragsupport = false;
    } else {
      clicksupport = true;
      dragsupport = true;      
    }
    
    // Default Slideshow
    default_slideshow = $('.royalSlider.default-slideshow');
    
    if (default_slideshow.length) {
      
      if (default_slideshow.hasAttr('data-slideshow-transition-type')) {
        if (default_slideshow.attr('data-slideshow-transition-type') == 'move') {
          data_slideshow_transition_type = 'move';
        } else {
          data_slideshow_transition_type = 'fade';
        }
      } else {
        data_slideshow_transition_type = 'fade';
      }
      
      if (slideshow_arrow_icons == 'none') {
        slideshow_arrow_icons_state = false;
      } else {
        slideshow_arrow_icons_state = true;
      }
      
      default_slideshow.royalSlider({
        
        fullscreen: {
          enabled: false,
          nativeFS: true
        },
        autoPlay: {
      		enabled: false,
      		pauseOnHover: true,
      		stopAtAction: false,
      		delay: 4000
      	},
        controlNavigation: slideshow_control_navigation,
        autoScaleSlider: false, 
        autoScaleSliderWidth: slideshow_w,     
        autoScaleSliderHeight: slideshow_h,
        loop: false,
        loopRewind: true,
        imageScaleMode: 'fill',
        navigateByClick: true,
        sliderDrag: true,
        numImagesToPreload:6,
        slidesSpacing: 0,
        imageScalePadding: 0,
        arrowsNav: slideshow_arrow_icons_state,
        arrowsNavAutoHide: true,
        arrowsNavHideOnTouch: true,
        keyboardNavEnabled: false,
        fadeinLoadedSlide: true,
        globalCaption: true,
        globalCaptionInside: false,
        transitionType: data_slideshow_transition_type,
        slideTransitionEasing:"easeInOutQuart",
        transitionSpeed: slideshow_speed,
          visibleNearby: {
              enabled: false,
              centerArea: 0.6,
              center: true,
              breakpoint: 650,
              breakpointCenterArea: 0.64,
              navigateByCenterClick: true
          },
        thumbs: {
          appendSpan: false,
          firstMargin: true,
          paddingBottom: 4
        }
      });
      
      slider = default_slideshow.data('royalSlider');
      slider.ev.on('rsAfterSlideChange', function(event) {
        // triggers after slide change
        slide_id = slider.currSlideId;      
      });
      
      default_slideshow.find('.rsArrowLeft .rsArrowIcn').html(slideshow_arrow_icon_left).addClass(''+slideshow_arrow_size+' icons');
      default_slideshow.find('.rsArrowRight .rsArrowIcn').html(slideshow_arrow_icon_right).addClass(''+slideshow_arrow_size+' icons');
      
    }
    
    
    
    // Row Slideshow
    row_slideshow = $('.royalSlider.row-slideshow');
    
    if (row_slideshow.length) {
      
      if (row_slideshow.hasAttr('data-slideshow-transition-type')) {
        if (row_slideshow.attr('data-slideshow-transition-type') == 'move') {
          data_slideshow_transition_type = 'move';
        } else {
          data_slideshow_transition_type = 'fade';
        }
      } else {
        data_slideshow_transition_type = 'fade';
      }
      
      if (slideshow_arrow_icons == 'none') {
        slideshow_arrow_icons_state = false;
      } else {
        slideshow_arrow_icons_state = true;
      }
      
      row_slideshow.royalSlider({
        
        fullscreen: {
          enabled: false,
          nativeFS: true
        },
        autoPlay: {
      		enabled: true,
      		pauseOnHover: true,
      		stopAtAction: false,
      		delay: 4000
      	},
        controlNavigation: 'none',
        autoScaleSlider: false, 
        autoScaleSliderWidth: 0,     
        autoScaleSliderHeight: 0,
        loop: false,
        loopRewind: true,
        imageScaleMode: 'fill',
        navigateByClick: true,
        sliderDrag: true,
        numImagesToPreload:6,
        slidesSpacing: 0,
        imageScalePadding: 0,
        arrowsNav: false,
        arrowsNavAutoHide: true,
        arrowsNavHideOnTouch: true,
        keyboardNavEnabled: false,
        fadeinLoadedSlide: true,
        globalCaption: true,
        globalCaptionInside: false,
        transitionType: data_slideshow_transition_type,
        slideTransitionEasing:"easeInOutQuart",
        transitionSpeed: slideshow_speed,
          visibleNearby: {
              enabled: false,
              centerArea: 0.6,
              center: true,
              breakpoint: 650,
              breakpointCenterArea: 0.64,
              navigateByCenterClick: true
          },
        thumbs: {
          appendSpan: false,
          firstMargin: true,
          paddingBottom: 4
        }
      });
      
      slider = row_slideshow.data('royalSlider');
      slider.ev.on('rsAfterSlideChange', function(event) {
        // triggers after slide change
        slide_id = slider.currSlideId;      
      });
      
      row_slideshow.find('.rsArrowLeft .rsArrowIcn').html(slideshow_arrow_icon_left).addClass(''+slideshow_arrow_size+' icons');
      row_slideshow.find('.rsArrowRight .rsArrowIcn').html(slideshow_arrow_icon_right).addClass(''+slideshow_arrow_size+' icons');
      
    }
    
    
    
    // Cover Slideshow
    cover_slideshow = $('.royalSlider.cover-slideshow');
    
    if (cover_slideshow.length) {
    
      cover_slideshow.parent().height(viewportHeight - (viewportHeight/3));
      cover_slideshow.height(viewportHeight - (viewportHeight/3));
      
      if (cover_slideshow.hasAttr('data-slideshow-transition-type')) {
        if (cover_slideshow.attr('data-slideshow-transition-type') == 'move') {
          data_slideshow_transition_type = 'move';
        } else {
          data_slideshow_transition_type = 'fade';
        }
      } else {
        data_slideshow_transition_type = 'fade';
      }
      
      if (cover_slideshow.hasAttr('data-slideshow-autoplay')) {
        if (cover_slideshow.attr('data-slideshow-autoplay') == 'on') {
          data_slideshow_autoplay = true;
        } else {
          data_slideshow_autoplay = false;
        }
      } else {
        data_slideshow_autoplay = false;
      }
      
      cover_slideshow.royalSlider({
        
        fullscreen: {
          enabled: false,
          nativeFS: true
        },
        autoPlay: {
      		enabled: data_slideshow_autoplay,
      		pauseOnHover: true,
      		stopAtAction: false,
      		delay: cover_slideshow_autoplay_delay_time
      	},
        controlNavigation: 'none',
        autoScaleSlider: false, 
        autoScaleSliderWidth: 0,     
        autoScaleSliderHeight: 0,
        loop: false,
        loopRewind: true,
        imageScaleMode: 'fill',
        navigateByClick: true,
        sliderDrag: true,
        numImagesToPreload:6,
        slidesSpacing: 0,
        imageScalePadding: 0,
        arrowsNav:false,
        arrowsNavAutoHide: false,
        arrowsNavHideOnTouch: true,
        keyboardNavEnabled: true,
        fadeinLoadedSlide: true,
        globalCaption: true,
        globalCaptionInside: false,
        transitionType: data_slideshow_transition_type,
        slideTransitionEasing:"easeInOutQuart",
        transitionSpeed: slideshow_speed,
          visibleNearby: {
              enabled: false,
              centerArea: 0.6,
              center: true,
              breakpoint: 650,
              breakpointCenterArea: 0.64,
              navigateByCenterClick: true
          },
        thumbs: {
          appendSpan: false,
          firstMargin: true,
          paddingBottom: 4
        }
      });
      
      slider = cover_slideshow.data('royalSlider');
      slider.ev.on('rsAfterSlideChange', function(event) {
        // triggers after slide change
        slide_id = slider.currSlideId;
      });
      
      cover_slideshow.find('.rsArrowLeft .rsArrowIcn').html(slideshow_arrow_icon_left).addClass(''+slideshow_arrow_size+' icons');
      cover_slideshow.find('.rsArrowRight .rsArrowIcn').html(slideshow_arrow_icon_right).addClass(''+slideshow_arrow_size+' icons');
      
    }
    
    $('.royalSlider').each(function() {
      t = $(this);
      // Set size and align
      slideshowcolor = t.attr('data-color');
      if (slideshowcolor) {
        t.find('.rsArrow, .rsCaption').css({'color':''+slideshowcolor+' !important'});
        t.find('.rsBullets .rsBullet span').css({'background':''+slideshowcolor+''});
      }
      captionalign = t.attr('data-slide-caption-align');
      t.find('.rsCaption').addClass(''+captionalign+'');
    });
    
    resize();      
     
  }
  
  /* Mouseover / Hover */
  if (device == 'desktop') {
    $('body').on('mouseenter mouseleave', 'a.thumb.ready.advanced', function (e) {
      e.preventDefault();
      var t = $(this);
      var holder = t.find('.img-holder');
      var holderimg = t.find('.img-holder img');
      var holderoverlay = t.find('.thumb-hover');
      
      if (t.hasClass('active')) {
        // Escape hover if active
      } else {
        
        if (holder.hasClass('bing')) {
          if (e.type == 'mouseenter') {
          // Mouseenter
              // Thumb hover text color
            if (t.attr('data-hover-text-color')) {
              hovertextcolor = t.attr('data-hover-text-color');
            }
  
            // Apply Hover Text Color
            if (t.hasAttr('data-hover-text-color')) {
              t.find('.figcaption span.underline').css({'color': hovertextcolor});
              if (link_decoration == '1px always' || link_decoration == '1px on mouseover and marked') {
                t.find('.figcaption span.underline').css({'border-color': hovertextcolor});
              }
            }
            
          } else {
            // Mouseleave
            // Apply Text Color
            if (t.hasAttr('data-text-color')) {
              textcolor = t.attr('data-text-color');
              t.find('.figcaption span.underline').css({'color': textcolor});
              if (link_decoration == '1px always' || link_decoration == '1px on mouseover and marked') {
                t.find('.figcaption span.underline').css({'border-color': textcolor});
              }
            }
            
          }
        }
      }
      
    });
  }
  
  if (device == 'mobile' || device == 'tablet') {
  
    $('body').on('mouseenter mouseleave', 'a.thumb.ready', function (e) {
      e.preventDefault();
      
      if (device == 'mobile' && mobile_thumbnails_force_hover == true) {
        // Escape if mobile and force hover on
      } else if (device == 'tablet' && tablet_thumbnails_force_hover == true) {
        // Escape if tablet and force hover on
      } else {
        var t = $(this);
        var holder = t.find('.img-holder');
        var holderimg = t.find('.img-holder img');
        var holderoverlay = t.find('.thumb-hover');
        
        if (t.hasClass('active')) {
          // Escape hover if active
        } else {
          
          if (holder.hasClass('bing')) {
            if (e.type == 'mouseenter') {
            // Mouseenter
              // Add .hover class
              t.addClass('hover');
              // Grab data
                // Opacity
              if (t.attr('data-opacity')) {
                opacity = t.attr('data-opacity');
              }
                // Thumb text color
              if (t.attr('data-text-color')) {
                textcolor = t.attr('data-text-color');
              }
                // Thumb hover text color
              if (t.attr('data-hover-text-color')) {
                hovertextcolor = t.attr('data-hover-text-color');
              }
                // Thumb bg/overlay color
              if (t.attr('data-bg-color')) {
                bgcolor = t.attr('data-bg-color');
              }
              
              // Apply Opacity
              if (t.hasAttr('data-opacity')) {
                if (t.hasClass('row-thumb')) {
                  holderoverlay = t.find('.figcaption-bg');
                  holderoverlay.fadeTo(0, opacity);
                } else {
                  holderoverlay.fadeTo(0, opacity);
                }
              }
              
              // Apply Hover Text Color
              if (t.hasAttr('data-hover-text-color')) {
                t.find('.figcaption span.underline').css({'color': hovertextcolor});
                if (link_decoration == '1px always' || link_decoration == '1px on mouseover and marked') {
                  t.find('.figcaption span.underline').css({'border-color': hovertextcolor});
                }
              }
              
            } else {
              // Mouseleave
              // Remove .hover class
              t.removeClass('hover');
              
              // Opacity
              if (t.hasAttr('data-opacity')) {
                if (t.hasClass('row-thumb')) {
                  t.find('.img-holder img').fadeTo(0, 1);
                } else {
                  t.find('.img-holder img').fadeTo(0, 1);
                }
              }
              
              // Apply Text Color
              if (t.hasAttr('data-text-color')) {
                t.find('.figcaption span.underline').css({'color': textcolor});
                if (link_decoration == '1px always' || link_decoration == '1px on mouseover and marked') {
                  t.find('.figcaption span.underline').css({'border-color': textcolor});
                }
              }
              
            }
          }
        }
      }
    });
  
  }
  
  function thumbhover(t) {
    // Add .hover class
    t.addClass('hover');
    holder = t.find('.img-holder');
    holderimg = t.find('.img-holder img');
    holderoverlay = t.find('.thumb-hover');
    // Grab data
      // Opacity
    if (t.attr('data-opacity')) {
      opacity = t.attr('data-opacity');
    }
      // Thumb text color
    if (t.attr('data-text-color')) {
      textcolor = t.attr('data-text-color');
    }
      // Thumb hover text color
    if (t.attr('data-hover-text-color')) {
      hovertextcolor = t.attr('data-hover-text-color');
    }
      // Thumb bg/overlay color
    if (t.attr('data-bg-color')) {
      bgcolor = t.attr('data-bg-color');
    }
    
    // Apply Hover Image Src
    if (holderimg.hasAttr('data-hoversrc')) {
      origsrc = holderimg.attr('src');
      hoversrc = holderimg.attr('data-hoversrc');
      holderimg.attr('data-hoversrc', origsrc);
      holderimg.attr('src', hoversrc);
    }
    
    // Apply Opacity
    if (t.hasAttr('data-opacity')) {
      if (t.hasClass('row-thumb')) {
        holderoverlay = t.find('.figcaption-bg');
        holderoverlay.fadeTo(0, opacity);
      } else {
        holderoverlay.fadeTo(0, opacity);
      }
    }
    
    // Apply Hover Text Color
    if (t.hasAttr('data-hover-text-color')) {
      t.find('.figcaption span.underline').css({'color': hovertextcolor});
      if (link_decoration == '1px always' || link_decoration == '1px on mouseover and marked') {
        t.find('.figcaption span.underline').css({'border-color': hovertextcolor});
      }
    } 
  }

  
  // Trigger hover state on 'active/current' thumbs
  function activethumbsset() {
    if (device == 'mobile' || device == 'tablet') {
        if (device == 'mobile' && mobile_thumbnails_force_hover == true) {
          $('a.thumb').each(function() {
            thumbhover($(this));
          });
        } else if (device == 'tablet' && tablet_thumbnails_force_hover == true) {
          $('a.thumb').each(function() {
            thumbhover($(this));
          });
        } else {
          $('a.thumb.active').each(function() {
            thumbhover($(this));
          });
        }
    }
  }
  
  // Toggle all panes
  function openalltogglepanes(togglespeed) {
    $('.float-module-toggle, .masonry-module-toggle').each(function(){
      $(this).trigger('click', togglespeed);
    });
  }
  
  function closealltogglepanes(togglespeed) {
    setTimeout(function () {
      $('.float-module-toggle, .masonry-module-toggle').each(function(){
        $(this).trigger('click', togglespeed);
      });
    }, 50);
  }
  
 /* Clicks */
 
  // Cover click
	$('body').on('click', '#cover-space', function(e){
	  //e.preventDefault();
    bodyscrollto(0, 600);
	});
 
  // Toggle modules
  $('body').on('click', 'button.link', function (e, togglespeed) {
    link = $(this).attr('data-link');
    window.location = link;
  });
  
  // Toggle modules
  $('body').on('click', '.float-module-toggle', function (e, togglespeed) {
    e.preventDefault();
    var area = $(this).parent().parent().parent().parent().find('.column-module-inner');
    
    toggleareaheight = area.height();
    normheight = 300;
    ratio = toggleareaheight / normheight;
    new_speed = module_toggle_speed * ratio;
    if (new_speed > 800) {new_speed = 800;}
    if (new_speed < module_toggle_speed) {new_speed = module_toggle_speed;}
    
    if (togglespeed == false) {
      new_speed = 0;
    }
    
    if ($(this).hasClass('close')) {
    
      // OPEN
      txt = $(this).attr('data-hide-copy');
      $(this).removeClass('close').html(txt);
      
      resize();
      area.show();
      resize();
      area.fadeTo(0,0).hide();

      area.slideDown(new_speed, 'easeInOutQuart', function() {
        resize();
        area.fadeTo(new_speed/2,1);
      });
      
    } else {
    
      // CLOSE
      txt = $(this).attr('data-show-copy');
      $(this).addClass('close').html(txt);
      
      area.fadeTo(new_speed/2,0, function(){
        area.slideUp(new_speed, 'easeInOutQuart', function() {
          resize();
        });
      });

    }
    
  });
  
  $('body').on('click', '.masonry-module-toggle', function (e, togglespeed) {
    
    e.preventDefault();
    var area = $(this).parent().parent().parent().parent().find('.masonry-module-inner');
    
    if ($(this).hasClass('close')) {
      
      // OPEN
      txt = $(this).attr('data-hide-copy');
      $(this).removeClass('close').html(txt);
      
      //resize();
      area.show();
      resize();
      area.fadeTo(0,0).hide();
    
      // Speed
      toggleareaheight = area.height();
      normheight = 300;
      ratio = toggleareaheight / normheight;
      new_speed = module_toggle_speed * ratio;
      if (new_speed > 800) {new_speed = 800;}
      if (new_speed < module_toggle_speed) {new_speed = module_toggle_speed;}
      
      if (togglespeed == false) {
        new_speed = 0;
      }
      
      area.slideDown(new_speed, 'easeInOutQuart', function() {
        area.fadeTo(new_speed/2,1);
      });
      
    } else {
    
      // CLOSE
      txt = $(this).attr('data-show-copy');
      $(this).addClass('close').html(txt);
      
      // Speed
      toggleareaheight = area.height();
      normheight = 300;
      ratio = toggleareaheight / normheight;
      new_speed = module_toggle_speed * ratio;
      if (new_speed > 800) {new_speed = 800;}
      if (new_speed < module_toggle_speed) {new_speed = module_toggle_speed;}
      
      if (togglespeed == false) {
        new_speed = 0;
      }
      
      area.fadeTo(new_speed/2, 0, function(){

        area.slideUp(new_speed, 'easeInOutQuart', function() {
          resize();
        });
        
      });
       
    }
    
  });

  // Show/Open Focus cover
  function showcover() {
    $('<div/>', {
      id: 'cover',
      "class": 'open',
      text: ' '
    }).prependTo('body');
  }
  // Hide/Close Focus cover  
  function hidecover() {
    $('#cover, #focus').remove();
  }
  
  function setcovertrans() {
  
    if (uiready == true && $('#cover-space').hasClass('transparent')) { 
    
  		if ($('#menu-icon').hasClass('open')) {
  		  covershift = coverheight - headerheight - $('#toggle-menu').outerHeight();
  		} else {
  		  covershift = coverheight - headerheight;  		
  		}
    
      if (device == 'desktop') {
    		if (bodyscrollpos > covershift) {
      		$('#header').removeClass('transparent');
      		$('#toggle').removeClass('transparent');
    		} else {
      		$('#header').addClass('transparent');
      		$('#toggle').addClass('transparent');
    		}
  		} else {
    		if (bodyscrollpos > covershift) {
      		$('#header').removeClass('transparent');
      		$('#toggle').removeClass('transparent');
    		} else {
      		$('#header').addClass('transparent');
      		$('#toggle').addClass('transparent');
    		}
  		}
  		
		}
  }
  
  function mobilerenderissues() {
    if ($('#cover-space').length && $('#bg').length) {
      $('body').addClass('renderissuefix');
      $('#bg').addClass('renderissuefix');
    } else {
      $('body').removeClass('renderissuefix');
      $('#bg').removeClass('renderissuefix');
    }
  }
  
  var realm;

  // Click to enter focus mode
  $('body').on('click', '.img-holder .focus-mode, a.row-item.focus-mode', function (e) {
    e.preventDefault();
    focusmode = true;
    
    realm = $(this).closest('.module');
    $(this).addClass('in-focus');
    
    if ($('#cover').length) {
      hidecover();
    } else {
      imgelem = $(this).parent().find('img').clone();
      showcover();
      $('#cover').after('<div id="focus"></div>');
      $('#focus').append(imgelem);
      resizefocus();
      
      numfocusitems = realm.find('.img-holder .focus-mode').length;
      
      if (numfocusitems == 1) {
      
        $('<div/>', {
          id: 'focus-nav',
          "class": 'focus-nav',
          text: ''
        }).insertAfter('#focus');
        
        $('<div/>', {
          id: 'focus-ui-middle',
          "class": 'focus-ui-middle',
          text: ''
        }).appendTo('#focus-nav');
        
        $('<div/>', {
          id: 's-middle',
          "class": 's-middle vcenter hcenter '+focus_counter_text_size+'',
          text: ''
        }).appendTo('#focus-nav');
        
        $('<a/>', {
          id: 's-center',
          "class": 's-center fixed vcenter hcenter '+focus_left_right_close_icon_size+' icons',
          text: focus_mode_arrow_icon_close,
          href: '#'
        }).appendTo('#focus-nav');
      
      } else if (numfocusitems > 1) {
      
        $('<div/>', {
          id: 'focus-nav',
          "class": 'focus-nav',
          text: ''
        }).insertAfter('#focus');
        
        $('<div/>', {
          id: 'focus-ui-left',
          "class": 'focus-ui-left',
          text: ''
        }).appendTo('#focus-nav');
        
        $('<div/>', {
          id: 'focus-ui-middle',
          "class": 'focus-ui-middle',
          text: ''
        }).appendTo('#focus-nav');
        
        $('<div/>', {
          id: 'focus-ui-right',
          "class": 'focus-ui-right',
          text: ''
        }).appendTo('#focus-nav');
      
        $('<a/>', {
          id: 's-left',
          "class": 's-left fixed vcenter '+focus_left_right_close_icon_size+' icons',
          text: focus_mode_arrow_icon_left,
          href: '#'
        }).appendTo('#focus-nav');
        
        $('<div/>', {
          id: 's-middle',
          "class": 's-middle vcenter hcenter '+focus_counter_text_size+'',
          text: ''
        }).appendTo('#focus-nav');
        
        $('<a/>', {
          id: 's-center',
          "class": 's-center fixed vcenter hcenter '+focus_left_right_close_icon_size+' icons',
          text: focus_mode_arrow_icon_close,
          href: '#'
        }).appendTo('#focus-nav');
        
        $('<a/>', {
          id: 's-right',
          "class": 's-right fixed vcenter '+focus_left_right_close_icon_size+' icons',
          text: focus_mode_arrow_icon_right,
          href: '#'
        }).appendTo('#focus-nav');
        
      }
      
      realmindex = realm.find('.focus-mode.in-focus');
      newindex = realm.find('.focus-mode').index(realmindex);
      $('#s-middle').html((newindex + 1) + ' / ' + numfocusitems);
      
      resizefocus();
      hcenter();
      vcenter();
      
    }
  });
  
  // Click next/prev in focus mode
  $('body').on('click', '#s-left', function (e) {
    e.preventDefault();
    prevfocusitem();
  });
  $('body').on('click', '#s-right', function (e) {
    e.preventDefault();
    nextfocusitem();
  });
  $('body').on('click', '#focus-ui-left', function (e) {
    e.preventDefault();
    prevfocusitem();
  });
  $('body').on('click', '#focus-ui-right', function (e) {
    e.preventDefault();
    nextfocusitem();
  });
  
  $('body').on('mouseenter mouseleave', '#focus-ui-left', function (e) {
    e.preventDefault();
    if (e.type == 'mouseenter') {
      // Enter
      leftpos = $('#mainside-inner').css('padding-left').replace("px", "");
      $('#s-left.fixed').css({'left':''+leftpos+'px'});
    } else {
      // Leave
      $('#s-left.fixed').css({'left':'-200px'});
    }
  });
  
  $('body').on('mouseenter mouseleave', '#focus-ui-middle', function (e) {
    e.preventDefault();
    if (e.type == 'mouseenter') {
      // Enter
      leftpos = $('#mainside-inner').css('padding-left').replace("px", "");
      $('#s-center.fixed').show();
    } else {
      // Leave
      $('#s-center.fixed').hide();
    }
  });
  
  $('body').on('mouseenter mouseleave', '#focus-ui-right', function (e) {
    e.preventDefault();
    if (e.type == 'mouseenter') {
      // Enter
      leftpos = $('#mainside-inner').css('padding-left').replace("px", "");
      $('#s-right.fixed').css({'right':''+leftpos+'px'});
    } else {
      // Leave
      $('#s-right.fixed').css({'right':'-200px'});
    }
  });
  
  function prevfocusitem() {

    count_focusitems_in_item = realm.find('.focus-mode.in-focus').parents('.item').find('.focus-mode').length;
    
    if(count_focusitems_in_item > 1) {
      newimage = realm.find('.focus-mode.in-focus').parents('.default').prevAll('.default').find('.focus-mode').last().parent().find('img');
      
      if (newimage.length == 0) {
        newimage = realm.find('.focus-mode.in-focus').parents('.item').prevAll('.item').find('.focus-mode').last().parent().find('img');
      }
      
    } else {
      newimage = realm.find('.focus-mode.in-focus').parents('.item').prevAll('.item').find('.focus-mode').last().parent().find('img');
    }
    

    if (newimage.length) {
      
      if(count_focusitems_in_item > 1) {
        newfocus = realm.find('.focus-mode.in-focus').parents('.default').prevAll('.default').find('.focus-mode').last();
        if (newfocus.length == 0) {
          newfocus = realm.find('.focus-mode.in-focus').parents('.item').prevAll('.item').find('.focus-mode').last(); 
        }
      } else {
        newfocus = realm.find('.focus-mode.in-focus').parents('.item').prevAll('.item').find('.focus-mode').last(); 
      }
      
      realm.find('.img-holder .focus-mode').removeClass('in-focus');
      newfocus.addClass('in-focus');
      realmindex = realm.find('.focus-mode.in-focus');
      newindex = realm.find('.focus-mode').index(realmindex);
      numfocusitems = realm.find('.img-holder .focus-mode').length;
      $('#s-middle').html((newindex+1) + ' / ' + numfocusitems);
      newimagesrc = newimage.attr('src');
      newimagewidth = newimage.attr('data-width');
      newimageheight = newimage.attr('data-height');
      $('#focus img').attr('src', newimagesrc).attr('data-width', newimagewidth).attr('data-height', newimageheight);
      keyboardready = true;
    } else {
      newimage = realm.find('.focus-mode:last').parent().find('img');
      newfocus = realm.find('.focus-mode:last');
      realm.find('.img-holder .focus-mode').removeClass('in-focus');
      newfocus.addClass('in-focus');
      realmindex = realm.find('.focus-mode.in-focus');
      newindex = realm.find('.focus-mode').index(realmindex);
      numfocusitems = realm.find('.img-holder .focus-mode').length;
      $('#s-middle').html((newindex+1) + ' / ' + numfocusitems);
      newimagesrc = newimage.attr('src');
      newimagewidth = newimage.attr('data-width');
      newimageheight = newimage.attr('data-height');
      $('#focus img').attr('src', newimagesrc).attr('data-width', newimagewidth).attr('data-height', newimageheight);
      keyboardready = true;
    }
    
    resizefocus();
    
  }
  
  function nextfocusitem() {
    
    count_focusitems_in_item = realm.find('.focus-mode.in-focus').parents('.item').find('.focus-mode').length;
    
    if(count_focusitems_in_item > 1) {
      newimage = realm.find('.focus-mode.in-focus').parents('.default').nextAll('.default').find('.focus-mode').first().parent().find('img');
      
      if (newimage.length == 0) {
        newimage = realm.find('.focus-mode.in-focus').parents('.item').nextAll('.item').find('.focus-mode').first().parent().find('img');
      }

    } else {
      newimage = realm.find('.focus-mode.in-focus').parents('.item').nextAll('.item').find('.focus-mode').first().parent().find('img');
    }
    
    if (newimage.length) {
    
      if(count_focusitems_in_item > 1) {
        newfocus = realm.find('.focus-mode.in-focus').parents('.default').nextAll('.default').find('.focus-mode').first();
        
        if (newfocus.length == 0) {
          newfocus = realm.find('.focus-mode.in-focus').parents('.item').nextAll('.item').find('.focus-mode').first(); 
        }

      } else {
        newfocus = realm.find('.focus-mode.in-focus').parents('.item').nextAll('.item').find('.focus-mode').first(); 
      }
      
      realm.find('.img-holder .focus-mode').removeClass('in-focus');
      newfocus.addClass('in-focus');
      
      realmindex = realm.find('.focus-mode.in-focus');
      newindex = realm.find('.focus-mode').index(realmindex);
      numfocusitems = realm.find('.img-holder .focus-mode').length;
      $('#s-middle').html((newindex + 1) + ' / ' + numfocusitems);
      newimagesrc = newimage.attr('src');
      newimagewidth = newimage.attr('data-width');
      newimageheight = newimage.attr('data-height');
      $('#focus img').attr('src', newimagesrc).attr('data-width', newimagewidth).attr('data-height', newimageheight);
      keyboardready = true;
    } else {
      newimage = realm.find('.focus-mode:first').parent().find('img');
      newfocus = realm.find('.focus-mode:first');
      realm.find('.img-holder .focus-mode').removeClass('in-focus');
      newfocus.addClass('in-focus');
      realmindex = realm.find('.focus-mode.in-focus');
      newindex = realm.find('.focus-mode').index(realmindex);
      numfocusitems = realm.find('.img-holder .focus-mode').length;
      $('#s-middle').html((newindex+1) + ' / ' + numfocusitems);
      newimagesrc = newimage.attr('src');
      newimagewidth = newimage.attr('data-width');
      newimageheight = newimage.attr('data-height');
      $('#focus img').attr('src', newimagesrc).attr('data-width', newimagewidth).attr('data-height', newimageheight);
      keyboardready = true;
    }
    
    resizefocus();
    
  }

  // Close Focus cover when clicking outside of the focus image
  $('body').on('click', '#focus-ui-middle', function (e) {
    e.preventDefault();
    focusmode = false;
    $('.img-holder .focus-mode').removeClass('in-focus');
    $('#focus-nav').remove();
    hidecover();
  });

  var menustate = true;
  // Toogle menu open
  function opentogglemenu(s) {
    
    if (menustate == true) {

      menustate = false;
      
      if ($('#toggle-menu').hasClass('static')) {
      
        // STATIC
        icon = $('#menu-icon').attr('data-icon-hover');
        $('#menu-icon').addClass('open').html(icon);
        
        $('#toggle-menu').show().transition({
          top: '' + headerheight + 'px'
        }, s, default_easing, function () {
          menustate = true; 
        });
        
        //th = $('#toggle-menu').outerHeight();
        
      } else if ($('#toggle-menu').length) {
      
        // FIXED
        icon = $('#menu-icon').attr('data-icon-hover');
        $('#menu-icon').addClass('open').html(icon);
        $('#toggle-menu').show().transition({
          top: '' + headerheight + 'px'
        }, s, default_easing, function () {
          menustate = true;
        });
        
        //th = $('#toggle-menu').outerHeight();
      
      }
    }
  }

  // Toogle menu close
  function closetogglemenu(s) {
    if (menustate == true) {
      menustate = false;
      
      if ($('#toggle-menu').hasClass('static')) {
      
        // STATIC
        th = $('#toggle-menu').outerHeight();
        icon = $('#menu-icon').attr('data-icon');
        $('#menu-icon').removeClass('open').html(icon);
        
        $('#toggle-menu').transition({
          top: '-' + th + 'px'
        }, s, default_easing, function () {
          menustate = true; 
        });
        
      } else if ($('#toggle-menu').length) {
      
        // FIXED
        th = $('#toggle-menu').outerHeight();
        icon = $('#menu-icon').attr('data-icon');
        $('#menu-icon').removeClass('open').html(icon);
        $('#toggle-menu').transition({
          top: '-' + th + 'px'
        }, s, default_easing, function () {
          menustate = true;
        });
        
      }
    }
  }
  // Trigger to open toggle menu
  $('body').on('click', '#menu-icon', function (e) {
    e.preventDefault();
    var t = $(this);
    
    if (t.hasClass('open')) {

      t.removeClass('open');
      
      if (device == 'mobile' && mobile_main_menu == 'Slide Toggle') {
        closemmenu(menu_speed);
      } else if (device == 'tablet' && tablet_main_menu == 'Slide Toggle') {
        closemmenu(menu_speed);
      } else {
        closetogglemenu(menu_speed);
      }
      
    } else {

      t.addClass('open');
      
      if (device == 'mobile' && mobile_main_menu == 'Slide Toggle') {
        openmmenu(menu_speed);
      } else if (device == 'tablet' && tablet_main_menu == 'Slide Toggle') {
        openmmenu(menu_speed);
      } else {
        opentogglemenu(menu_speed);
      }
      
    }
  });
  
  // Close MMenu on click
  /*
  $('body').on('click', '#mmenu-main-menu a', function (e) {
      setTimeout(function () {
        closemmenu(menu_speed);
      }, 100);
  });
  */
  
  function openmmenu(speed) {
    mmenustate = true;
    
    mmenupercent = 50;
    
    if (device == 'mobile') {
      mmenupercent = 75;
    }
    
    $('#page, #bg, #tiled-marker, #header.fixed').transition({
      left: '-'+mmenupercent+'%'
    }, speed, 'ease', function () {
      
    });
    
    $('#menu').transition({
      left: ''+100 - mmenupercent+'%'
    }, speed, 'ease', function () {

    });
    
    icon = $('#menu-icon').attr('data-icon-hover');
    $('#menu-icon').html(icon);
  }
  
  function closemmenu(speed) {
    mmenustate = false;
    $('#partial-block').remove();
    $('#menu-icon').removeClass('open');
    
    $('#page, #bg, #tiled-marker, #header.fixed').transition({
      left: '0%'
    }, speed, 'ease', function () {
      
    });
    
    $('#menu').transition({
      left: '100%'
    }, speed, 'ease', function () {

    });
    
    icon = $('#menu-icon').attr('data-icon');
    $('#menu-icon').html(icon);
  }
  
  // Select menus (mobile & tablet)
  
  var menu_ids = [];
  var menu_urls = [];
  var menu_titles = [];
  
  function setselectmenus() {
  
    removeselectmenus();
  
    menu_ids = [];
    menu_urls = [];
    menu_titles = [];
    menu = $('#secondary_menu_holder');
    menu_name = menu.attr('data-menu-name');
  
    menu.find('.menu .menu-item').each(function(index){
      menu_ids[index] = $(this).attr('id');
      menu_urls[index] = $(this).find('a').attr('href');
      menu_titles[index] = $(this).find('a').html();
    });
    
    menu.hide();
    
    var sel = $('<select class="drop-nav">').insertAfter(menu);
    sel.append($("<option>").attr('value','').text(menu_name));
    $(menu_ids).each(function(index) {
      sel.append($("<option>").attr('value',menu_urls[index]).text(menu_titles[index]));
    });
    
    menu_ids = [];
    menu_urls = [];
    menu_titles = [];
    menu = $('#sidebar_menu_holder');
    menu_name = menu.attr('data-menu-name');
  
    menu.find('.menu .menu-item').each(function(index){
      menu_ids[index] = $(this).attr('id');
      menu_urls[index] = $(this).find('a').attr('href');
      menu_titles[index] = $(this).find('a').html();
    });
    
    menu.hide();
    
    var sel = $('<select class="drop-nav">').insertAfter(menu);
    sel.append($("<option>").attr('value','').text(menu_name));
    $(menu_ids).each(function(index) {
      sel.append($("<option>").attr('value',menu_urls[index]).text(menu_titles[index]));
    });
    
    $('select.drop-nav').wrap('<div class="new-menu col col-100"><div class="col-inner-hori"></div></div>');

  }
  
  setselectmenus();
  
  function removeselectmenus() {
    $('#secondary_menu_holder, #sidebar_menu_holder').show();
    $('.new-menu').remove();
  }
  
  $('body').on('change', '.drop-nav', function (e) {

    var url = $(this).val(); // get selected value.
    if (url) { // require a URL.
      window.location = url; // redirect.
    }
  
  });

  // Mark items in the menu when clicked
  $('body').on('click', '#menu-main-menu a', function (e) {
    domain = baseurl;
    thislink = $(this).attr('href');
    thislinktarget = $(this).attr('target');
    if (thislink.indexOf(domain) >= 0) {
      if (thislinktarget == '_blank' || thislinktarget == '_new') {
        // New window link, fallback to default
      } else {
        $(this).addClass('marked');
      }
    } else {
      // External link, fallback to default
    }
  });
  
  // Royalslider img click
  $('body').on('click', '.royalSlider.default-slideshow img.rsImg', function (e) {
    e.preventDefault();
    
    slide = $(this).parent().parent().parent().parent();
    
    if (slideshow_window_scroll_adjust) {
      slideoffset = slide.offset().top - headerheight;
      slideheight = slide.height();
      slidecorrection = (viewportHeight - headerheight - slideheight) / 2;
      
      if (slidecorrection < 0) {
        slidecorrection = 0;
      }
      
      ppp = slideoffset - slidecorrection;
      bodyscrollto(ppp, 600);
    }
  });
  
  // Scrollto pos click
  $('body').on('click', 'a.scrollpos', function (e) {
    e.preventDefault();
    if ($(this).hasAttr('data-scrollpos')) { 
      pos = $(this).attr('data-scrollpos');
      
      if (pos.indexOf("#") >= 0) {
        id = pos;
        pos = $(''+id+'').offset().top - headerheight;
        pos = Math.round(pos);
        
        if (pos < 0) {
          pos = 0;
        }
      }
      
    } else {
      pos = 0;
    }
    
    if ($(this).hasAttr('data-scrollspeed')) { 
      speed = $(this).attr('data-scrollspeed');
    } else {
      speed = 600;
    }
    
    //$(this).attr('href', '#pos='+pos+'');
    bodyscrollto(pos, speed);
  });
  
  // Load more
  $('body').on('click', '.loadmore-trigger a', function (e) {
    loadmoreready = false;
    e.preventDefault();
    t = $(this);
    tp = $(this).parent().parent();
    tpppp = t.parent().parent().parent().parent();
    href = t.attr('href');
    t.html(''+copy_6+'');

    $.ajax({
      url: href,
      type: 'get',
      dataType: 'html',
      success: function (data) {
      
        if (tp.hasClass('loadmore-fullrender')) {
        
          // Full render click
          var $response = $(data);
          one = $response.find('.fullpost-module').outerHTML();
          $('#main').append(one);
          $(".loadmore-holder").remove();
          
          if ($response.find('.loadmore-holder').length) {
            two = $response.find('.loadmore-holder').outerHTML();
            $('#main').append(two);
          }
          
          reinit();
          loadmoreready = true;
          
        } else {
          // Else
          var $response = $(data);
          one = $response.find('.appender').html();
          two = $response.find('.loadmore-holder').html();
  
          if ($response.find('.appender').hasClass('masonry')) {
            three = $response.find('.appender .item');
            tpppp.find('.appender').append(three).packery('appended', three);
          } else {
            tpppp.find('.appender').append(one);
          }
  
          $(".loadmore-holder").empty().append(two);
          
          reinit();
          loadmoreready = true;
        
        }
      }
    });
  });
  
  // Trigger to open toggle menu
  $('body').on('click', 'a.preventDefault', function (e) {
    e.preventDefault();
  });
  
  // Keys (bind)
	function bindkeys() {
  	if (post_next_previous_keys) { 
  		shortcut.add("Left",function() {
  		  if (keyboardready == true) {
  		    if (focusmode == false) {
  		      keyboardready = false;
  		      if ($('#nextprev .key-next').length) {
              $('#nextprev .key-next').trigger('click');
            } else {
              keyboardready = true;
            }
  				} else {
    				$('#s-left').trigger('click');
  				}
        }
  		});
  		shortcut.add("Right",function() {
  		  if (keyboardready == true) {
  		    if (focusmode == false) {
  		      keyboardready = false;
  		      if ($('#nextprev .key-prev').length) {
              $('#nextprev .key-prev').trigger('click');
            } else {
              keyboardready = true;
            }
  				} else {
    				$('#s-right').trigger('click');
  				}
        }
  		});
    }
	}
	
	// Keys (unbind)
	function unbindkeys() {
	  if (post_next_previous_keys) {
		  shortcut.remove("Left");
		  shortcut.remove("Right");
		}
	}
	
	// Save forms from keys
	//if (post_next_previous_keys) {
	  //$('body').on('focus', 'input, textarea, select', function (e) {
	  //$('input, textarea, select').on('focus', function() {
		  //unbindkeys();
    //});
	  //$('body').on('blur', 'input, textarea, select', function (e) {
		  //bindkeys();
    //});
  //}

  // Hide block
  function hideBlock() {
    setTimeout(function () {
      $('#block').fadeTo(500, 0, function () {
        $(this).hide();
      });
    }, 100);
  }
  
  // Bring back fixed nav
  function bringbackfixednav() {
    if ($('#nextprev a.prev-fixed').length) {
      $('#nextprev a.prev-fixed').show();
    }
    if ($('#nextprev a.next-fixed').length) {
      $('#nextprev a.next-fixed').show();
    }
  }
  
  function prehistory() {
    if (pushstate == true) {
      uiready = false;
      setTimeout(function () {
        $('#header').removeClass('transparent');
        $('#header, #toggle-menu').css({'background':'transparent'});
        closetogglemenu(0);
      }, history_transition_speed);
    }
  }

  // Inits & re-inits	
  // Trigger A$AP
  function preinit() {
    addpageloader();
    colorcheck();
    setclasses();
    prepreloading();
    preloadimages();
    bindScrollers();
    resize();
    hideBlock();
    setslideshow();
    //overrideheaderpos();
    //bindkeys();
  }

  preinit();

  // Trigger on window ready
  function init() {
    uiready = true;
    keyboardready = true;
    setmobile();
    settablet();
    setpackery();
    resize();
    if (device == 'desktop') {
      if (toggle_menu_init_state == 'Closed') {
        closetogglemenu(0);
      } else {
        opentogglemenu(0);
      }
    } else {
      closetogglemenu(0);
    }
    activethumbsset();
    url = window.location;
    // Set Init URL cache
    $.ajax({
      url: url,
      type: 'get',
      dataType: 'html',
      cache: true,
      success: function (data) {
        var $response = $(data);
        page_cache[url] = $response;
      }
    });
    bringbackfixednav();
    mobilerenderissues();
    bodyscrolling();
    setcovertrans();
    setheadercolor(history_transition_speed);
    closealltogglepanes(0);
    removepageloader();
    setTimeout(function () {
      resize();
    }, 200);
  }
  // Trigger on Re-init (after history push state between pages)
  function reinit() {
    uiready = true;
    keyboardready = true;
    menustate = true;
    replacepagetype = 'default';
    setmobile();
    settablet();
    removepageloader();
    bodyscrolling();
    setclasses();
    setcovertrans();
    prepreloading();
    preloadimages();
    setpackery();
    setslideshow();
    resize();
    bodyscrolling();
    if (device == 'desktop') {
      if (toggle_menu_init_state == 'Closed') {
        closetogglemenu(0);
      } else {
        opentogglemenu(0);
      }
    } else {
      closetogglemenu(0);
      setTimeout(function () {
        closemmenu(menu_speed);
      }, 100);
    }
    activethumbsset();
    bringbackfixednav();
    mobilerenderissues();
    //unbindkeys();
    //bindkeys();
    closealltogglepanes(0); 
    setTimeout(function () {
      resize();
    }, 200);
  }
  // Trigger on Re-init ALT (next / prev)
  function reinitAlt() {
    uiready = true;
    keyboardready = true;
    menustate = true;
    replacepagetype = 'default';
    setmobile();
    settablet();
    removepageloader();
    bodyscrolling();
    setclasses();
    setcovertrans();
    $('.img-holder').css({'background':'transparent'}).addClass('ready bing');
    $('.img-holder img, a.thumb').addClass('ready');
    setpackery();
    setslideshow();
    resize();
    bodyscrolling();
    if (device == 'desktop') {
      if (toggle_menu_init_state == 'Closed') {
        closetogglemenu(0);
      } else {
        opentogglemenu(0);
      }
    } else {
      closetogglemenu(0);
    }
    activethumbsset();
    bringbackfixednav();
    mobilerenderissues();
    //unbindkeys();
    //bindkeys();
    closealltogglepanes(0);
    setTimeout(function () {
      resize();
    }, 200);
  }
  // Resize event
  $(window).resize(function () {
    viewportHeight = $(window).height();
    viewportWidth = $(window).width();
    docheight = $(document).height();
    resize();
  });
  // Secure window resize on orientation change on mobile devices
  $(window).bind('orientationchange', function () {
    $(window).resize();
  });
  // When Window is Ready
  $(window).ready(function () {
    init();
  });
  // When Window is fully loaded
  $(window).bind("load", function() {
    resize();
  });


if (device == 'mobile' || device == 'tablet') {
  // force mobile hover alt
  if (mobile_thumbnails_force_hover || tablet_thumbnails_force_hover) {
      jQuery('.img-holder').bind('touchstart touchend', function(e) {
          //e.preventDefault();
          jQuery(this).trigger('hover');
          //jQuery(this).find('a').bind('touchstart touchend', function() {
            //return true;
          //});
      });
  }
}
  
  // Portrait & Landscape resize logic on mobile and tablets
  if (device == 'mobile' && device == 'tablet') {
	
    function doOnOrientationChange() {
      switch(window.orientation) {  
        case -90:
        case 90:
        viewport = document.querySelector("meta[name=viewport]");
        viewport.setAttribute('content', 'width=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0');
        break; 
        default:
        viewport = document.querySelector("meta[name=viewport]");
        viewport.setAttribute('content', 'width = device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0');
        break; 
      }
    }
    
    window.addEventListener('orientationchange', doOnOrientationChange);
    doOnOrientationChange(); 
    
  }

});