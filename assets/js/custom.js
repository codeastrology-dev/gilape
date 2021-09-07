/**************/
// gilape custom.js
/**************/
(function ($) {
 "use strict";
  //Navigation Menu dropdown Focused

  var $openClass = "open open-position";
  var $hasChildren = "menu-item-has-children";

  if ($hasChildren.length > 0) {
    $(".navbar").on("focusin", "." + $hasChildren, function () {
      $(this).addClass($openClass);

    });
    $(".navbar").on("focusout", "." + $hasChildren, function () {
      $(this).removeClass($openClass);
    });
  }
  //scroll to top
    $("#scroll_to_top").hide();
    $("#scroll_to_top").on("click",function(e) {
      e.preventDefault();
      $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $(window).on( 'scroll', function(){
      var scrollheight =400;
      if( $(window).scrollTop() > scrollheight ) {
        $("#scroll_to_top").fadeIn();
        $("#scroll-to-top").addClass("scroll-visible");
      }
      else {
        $("#scroll_to_top").fadeOut();
        $("#scroll_to_top").removeClass("scroll-visible");
      }
    });
	
    $("a[href^=\\#]").on( 'click', function(event){     
        event.preventDefault();
        $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
    });
	
	$(window).on( 'scroll', function (event) {
		var scrollValue = $(window).scrollTop();
		if (scrollValue > 120) {
			$('.nav-header').addClass('affix');
		} else{
			$('.nav-header').removeClass('affix');
		}
	});
	
})(jQuery);