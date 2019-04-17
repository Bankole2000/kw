$('.section').hide();
        $('.page-footer').hide();
 
    setTimeout(function () {
      $(document).ready(function () {
        //select form options initiate
          $('select').material_select();
		  $(".dropdown-trigger").dropdown();
          
        // Show sections
        $('.section').fadeIn(1000);
          $('.page-footer').fadeIn(1000);
        // Hide preloader
        $('.loader').fadeOut();

        //Init Side nav
        $('.button-collapse').sideNav();

        // Counter
        $('.count').each(function () {
          $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
          }, {
              duration: 1250,
              easing: 'swing',
              step: function (now) {
                $(this).text(Math.ceil(now));
              }
            });
        });
      
      });
    },500);