(function($) {
  "use strict"; // Start of use strict
  
  /**
   * Calculate and set custom header media height.
   */
  $(document).ready(function(){
    var mainNavHeight = $( '.main-navigation' ).outerHeight( true );
    $( '.custom-header-other-page .custom-header-media' ).css('height',mainNavHeight );
  });
  
  /**
   * Control the serchbox events.
   */
  $('#desktop-search-icon').on('click tap',function(event) {
     $('.ananya-popup-search-form').addClass('open-search-form');
     var x = setTimeout('jQuery(".ananya-popup-search-form .search-form .search-field").focus()', 700);
  });
  
  $('.ananya-close-popup').on('click tap', function (event) {
      $('.ananya-popup-search-form').removeClass('open-search-form');
      $('#desktop-search-icon').focus();
  });
  
  //Set focus to input field in search form
  if( $('.ananya-popup-search-form').css('display') == 'block' ) {
    $('.ananya-popup-search-form .search-form .search-field').focus();
  };
  /**
   * Change the arrow direction of read more button if RTL is enabled.
   */
   if ( $('body').hasClass('rtl') ) {
    $('.more-link i').removeClass('fa-long-arrow-right');
    $('.more-link i').addClass('fa-long-arrow-left');
   }

    //loop the focus of elements when tab and tab+shift keys are used in keyboard navigation
    $( ".ananya-popup-search-form" ).keydown( function( event ) {

      var tabKey = event.keyCode === 9;
      var shiftKey = event.shiftKey;
      if( shiftKey || tabKey) {
        var selectors = 'a, input, button';
        var parent = $( document ).find('.ananya-popup-search-form');
        var elements = parent.find(selectors);
        
        var firstEl = elements[0];
        
        var lastEl = elements[elements.length -1 ];
        
        var activeEl = event.target;

        if ( ! shiftKey && tabKey && lastEl === activeEl ) {
          event.preventDefault();
          firstEl.focus();
        }

        if ( shiftKey && tabKey && firstEl === activeEl ) {
          event.preventDefault();
          lastEl.focus();
        }
      }
    });

    //loop the focus of elements when tab and tab+shift keys are used in keyboard navigation
    $( '#site-navigation' ).keydown( function( event ) {
      var tabKey,shiftKey,selectors,parent,elements,firstEl,lastEl,activeEl;
      tabKey = event.keyCode === 9;
      shiftKey = event.shiftKey;
      if( shiftKey || tabKey) {
        selectors = 'button, li, a, input[type="search"]';
        parent = $( document ).find('.main-navigation');
        elements = parent.find(selectors);
        elements = elements.filter('button, li, a, input[type="search"]');
        firstEl = elements[1];
        lastEl = elements[elements.length -1 ];
        activeEl = event.target;
        if ( ! shiftKey && tabKey && lastEl === activeEl ) {
          event.preventDefault();
          firstEl.focus();
        }

        if ( shiftKey && tabKey && firstEl === activeEl ) {
          event.preventDefault();
          lastEl.focus();
        }
      }
    });
})(jQuery); // End of use strict