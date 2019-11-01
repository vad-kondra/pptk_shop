// JavaScript Document
$(function() {
 "use strict";

  function responsive_dropdown () {
    /* ---- For Mobile Menu Dropdown JS Start ---- */
      $("#menu span.opener, #menu-main span.opener").on("click", function(){
         var menuopener = $(this);
      if (menuopener.hasClass("plus")) {
         menuopener.parent().find('.mobile-sub-menu').slideDown();
         menuopener.removeClass('plus');
         menuopener.addClass('minus');
      }
      else
      {
         menuopener.parent().find('.mobile-sub-menu').slideUp();
         menuopener.removeClass('minus');
         menuopener.addClass('plus');
      }
      return false;
      });

      $( ".mobilemenu" ).on("click", function() {
      $( ".mobilemenu-content" ).slideToggle();
      if ($(this).hasClass("openmenu")) {
          $(this).removeClass('openmenu');
          $(this).addClass('closemenu');
        }
        else
        {
          $(this).removeClass('closemenu');
          $(this).addClass('openmenu');
        }
        return false;
    });
    /* ---- For Mobile Menu Dropdown JS End ---- */

    /* ---- For Sidebar JS Start ---- */
      $('.sidebar-box span.opener').on("click", function(){
      
        if ($(this).hasClass("plus")) {
          $(this).parent().find('.sidebar-contant').slideDown();
          $(this).removeClass('plus');
          $(this).addClass('minus');
        }
        else
        {
          $(this).parent().find('.sidebar-contant').slideUp();
          $(this).removeClass('minus');
          $(this).addClass('plus');
        }
        return false;
      });
    /* ---- For Sidebar JS End ---- */

    /* ---- For Footer JS Start ---- */
      $('.footer-static-block span.opener').on("click", function(){
      
        if ($(this).hasClass("plus")) {
          $(this).parent().find('.footer-block-contant').slideDown();
          $(this).removeClass('plus');
          $(this).addClass('minus');
        }
        else
        {
          $(this).parent().find('.footer-block-contant').slideUp();
          $(this).removeClass('minus');
          $(this).addClass('plus');
        }
        return false;
      });
    /* ---- For Footer JS End ---- */

     /* ---- For Navbar JS Start ---- */
    $('.navbar-toggle').on("click", function(){
      var menu_id = $('#menu');
      var nav_icon = $('.navbar-toggle i');
      if(menu_id.hasClass('menu-open')){
        menu_id.removeClass('menu-open');
        nav_icon.removeClass('fa-close');
        nav_icon.addClass('fa-bars');
      }else{
        menu_id.addClass('menu-open');
        nav_icon.addClass('fa-close');
        nav_icon.removeClass('fa-bars');
      }
      return false;
    });
    /* ---- For Navbar JS End ---- */

    /* ---- For Category Dropdown JS Start ---- */
    $('.btn-sidebar-menu-dropdown').on("click", function() {
        $('.subcat-dropdown').hide();
      $('.cat-dropdown').slideToggle();

    });
    /* ---- For Category Dropdown JS End ---- */


      $('.btn-submenu')
          .on('mouseover', function () {
              var child = $(this).parent().children('.subcat-dropdown');
              if (!child.is(':visible') && ($(window).width() > 991)) {
                  $('.subcat-dropdown').hide();
                  child.toggle("slide");
              }
          })



    /* ---- For Content Dropdown JS Start ---- */
    /*$('.content-link').on("click", function() {
      $('.content-dropdown').toggle();
    });*/
    /* ---- For Content Dropdown JS End ---- */
  }

  function search_open () {
    /* ----- Search open close Start  ------ */
    $('.search-opener').on("click", function(){
      var search_bar = $('.top-search-bar');
      if(search_bar.hasClass('open')){
        search_bar.removeClass('open');
      }else{
        search_bar.addClass('open');
      }
      return false;
    });
    /* ----- Search open close Start  ------ */
  }

  function owlcarousel_slider () {
    /* ------------ OWL Slider Start  ------------- */

      /* ----- tab_slider Start  ------ */
      $('.tab_slider').owlCarousel({
        items: 8,
        navigation: true,
        pagination: false,
        itemsDesktop : [1769, 5],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 2]
      });
      /* ----- tab_slider End  ------ */

      /* ----- pro_cat_slider Start  ------ */
      $('.pro-cat-slider').owlCarousel({
        items: 5,
        navigation: true,
        pagination: false,
        itemsDesktop : [1769, 3],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 2]
      });
      /* ----- pro_cat_slider End  ------ */

      /* ----- pro_cat_slider Start  ------ */
      $('.pro_cat_slider').owlCarousel({
        items: 5,
        navigation: true,
        pagination: false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1]
      });
      /* ----- pro_cat_slider End  ------ */

      /* ----- sub_menu_slider Start  ------ */
      $('.sub_menu_slider').owlCarousel({
        items: 1,
        navigation: true,
        pagination: false,
        itemsDesktop : [1199, 1],
        itemsDesktopSmall : [991, 1],
        itemsTablet : [768, 1],
        itemsTabletSmall : false,
        itemsMobile : [479, 1]
      });
      /* -----sub_menu_slider End  ------ */

      /* ----- our-sell-pro_slider Start  ------ */
      /*$('#our-sell-pro').owlCarousel({
        items: 4,
        navigation: true,
        pagination: false,
        itemsDesktop : [1199, 4],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 2],
        itemsTabletSmall : false,
        itemsMobile : [479, 1]
      });*/
      /* ----- our-sell-pro_slider End  ------ */

      /* ----- best-seller-pro Start  ------ */
        /*$('.best-seller-pro').owlCarousel({
          items: 4,
          navigation: true,
          pagination: false,
          itemsDesktop : [1769, 3],
          itemsDesktopSmall : [991, 2],
          itemsTablet : [767, 2],
          itemsTabletSmall : false,
          itemsMobile : [600, 1]
        });*/
      /* ----- best-seller-pro End  ------ */

      /* ----- brand-logo Start  ------ */
      /*$('#brand-logo').owlCarousel({
        items: 5,
        navigation: true,
        pagination: false,
        itemsDesktop : [1769, 3],
        itemsDesktopSmall : [991, 3],
        itemsTablet : [768, 1],
        itemsTabletSmall : false,
        itemsMobile : [479, 1]
      });*/
      /* ----- brand-logo End  ------ */

      /* ----- brand-logo Start  ------ */
        $('#blog').owlCarousel({
          items: 4,
          navigation: true,
          pagination: false,
          itemsDesktop : [1199, 3],
          itemsDesktopSmall : [991, 2],
          itemsTablet : [768, 1],
          itemsTabletSmall : false,
          itemsMobile : [479, 1]
        });
      /* ----- brand-logo End  ------ */

      /* ---- Testimonial Start ---- */
      $("#client, .main-banner").owlCarousel({
     
        //navigation : true,  Show next and prev buttons
        slideSpeed : 300,
        paginationSpeed : 400,
        autoPlay: false,
        pagination:true,
        singleItem:true,
        navigation:true
      });
      /* ----- Testimonial End  ------ */
      return false;
    /* ------------ OWL Slider End  ------------- */
  }

  function scrolltop_arrow () {
   /* ---- Page Scrollup JS Start ---- */
   //When distance from top = 250px fade button in/out
    var scrollup = $('#scrollup');
    var headertag = $('header');
    var mainfix = $('.main');
    $(window).scroll(function(){
      if ($(this).scrollTop() > 250) {
          scrollup.fadeIn(300);
      } else {
          scrollup.fadeOut(300);
      }

      /* header-fixed JS Start */
      if ($(this).scrollTop() > 0){
         headertag.addClass("header-fixed");
      }
      else{ 
         headertag.removeClass("header-fixed");
      }

      /* main-fixed JS Start */
      if ($(this).scrollTop() > 0){
         mainfix.addClass("main-fixed");
      }
      else{ 
         mainfix.removeClass("main-fixed");
      }
      /* ---- Page Scrollup JS End ---- */
    });
    
    //On click scroll to top of page t = 1000ms
    scrollup.on("click", function(){
        $("html, body").animate({ scrollTop: 0 }, 1000);
        return false;
    });
  }

  function custom_tab() {
    /* ------------ Account Tab JS Start ------------ */
    $('.account-tab-stap').on('click', 'li', function() {
        $('.account-tab-stap li').removeClass('active');
        $(this).addClass('active');
        
        $(".account-content").fadeOut();
        var currentLiID = $(this).attr('id');
        $("#data-"+currentLiID).fadeIn();
        return false;
    });
    /* ------------ Account Tab JS End ------------ */
  }

  /* Price-range Js Start */
  function price_range () {
      $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 800,
      values: [ 75, 500 ],
      slide: function( event, ui ) {
      $( "#amount" ).val( "Р." + ui.values[ 0 ] + " - Р." + ui.values[ 1 ] );}});


      $( "#amount" ).val( "Р." + $( "#slider-range" ).slider( "values", 0 ) + " - Р." + $( "#slider-range" ).slider( "values", 1 ) );
  }
  /* Price-range Js End */







  /*Video_Popup Js Start*/
  function video_popup() {
    if($('.popup-youtube').length > 0){      
    $('.popup-youtube').magnificPopup({          
        disableOn: 700,          
        type: 'iframe',          
        mainClass: 'mfp-fade',          
        removalDelay: 160,          
        preloader: false,          
        fixedContentPos: false      
      });    
    }  
  }
  /*Video_Popup Js Ends*/

  /*countdown-clock Js Start*/
  function countdown_clock() {
    $('.countdown-clock').downCount({
      date: '03/12/2019 11:39:00',
          offset: +10
      }, 
      function () {
        //alert('done!'); Finish Time limit
      return false;
    });
  }
  /*countdown-clock Js End*/

  /* Product Detail Page Tab JS Start */
  function description_tab () {
    $("#tabs li a").on("click", function(e){
      var title = $(e.currentTarget).attr("title");
      $("#tabs li a , .tab_content li div").removeClass("selected")
      $(".tab-"+title +", .items-"+title).addClass("selected")
      $("#items").attr("class","tab-"+title);

      return false;
    });
  }

  /*Search-box-close-button*/

  $('.search-closer').on('click', function() {
      var sidebar = $('.sidebar-navigation');
      var nav_icon = $('.navbar-toggle i');
      if(sidebar.hasClass('open')){
        //sidebar.removeClass('open');
      }else{
        sidebar.addClass('open');
        nav_icon.addClass('fa-search-close');
        nav_icon.removeClass('fa-search-bars');
      }

      $('.sidebar-search-wrap').removeClass('open');
      return false;
  });


  /* Product Detail Page Tab JS End */
    $(document).ready(function() {
        owlcarousel_slider(); price_range (); responsive_dropdown(); description_tab (); custom_tab (); countdown_clock(); scrolltop_arrow (); search_open (); video_popup();
    });

    $( window ).on( "resize", function() {

    });



    /* Catalog view start*/

    // Product List
    // $('#list-view').click(function() {
    //     var cols = $('.row > .col-md-4 ');
    //
    //     cols.removeClass().addClass('list-view').addClass('col-md-12');
    //     cols.children();
    //
    //
    //
    //     $('#content .row > .product-grid').attr('class', 'product-layout product-list col-xs-12');
    //     $('#grid-view').removeClass('active');
    //     $('#list-view').addClass('active');
    //
    //
    //     localStorage.setItem('display', 'list');
    // });

    // Product Grid
    // $('#grid-view').click(function() {
    //     // What a shame bootstrap does not take into account dynamically loaded columns
    //     var cols = $('#column-right, #column-left').length;
    //
    //     if (cols == 2) {
    //         $('#content .product-list').attr('class', 'product-layout product-grid col-lg-6 col-md-6 col-sm-12 col-xs-12');
    //     } else if (cols == 1) {
    //         $('#content .product-list').attr('class', 'product-layout product-grid col-lg-4 col-md-4 col-sm-6 col-xs-12');
    //     } else {
    //         $('#content .product-list').attr('class', 'product-layout product-grid col-lg-3 col-md-3 col-sm-6 col-xs-12');
    //     }
    //
    //     $('#list-view').removeClass('active');
    //     $('#grid-view').addClass('active');
    //
    //     localStorage.setItem('display', 'grid');
    // });
    //
    // if (localStorage.getItem('display') == 'list') {
    //     $('#list-view').trigger('click');
    //     $('#list-view').addClass('active');
    // } else {
    //     $('#grid-view').trigger('click');
    //     $('#grid-view').addClass('active');
    // }
    /* Catalog view end*/


    $('#call_back_btn').click( function () {
        $('#call_back').modal();
    });

   /* Cart start*/

    function showCartModal(cart) {
        updateCartNotification();
        $('#cart-modal .modal-body').html(cart);
        $('#cart-modal').modal();
    }


    $( document ).ready(function () {
        updateCartNotification();
    });

    function updateCartNotification() {
        $.ajax({
            url: '/cart/count',
            type: 'GET',
            success: function (res) {
                $('#itemCount').html(res);
            },
            error: function () {
                alert('Error!');
            }
        });

    }

    $('.showCartIcon').on('click', function (e) {
        $.ajax({
            url: '/cart/show-modal',
            type: 'GET',
            success: function (res) {
                if (!res) alert('Error!');
                showCartModal(res);

            },
            error: function () {
                alert('Error!');
            }
        });
    });


    $('#clearCartButton').on('click', function (e) {
        alert('asdasd');
        //e.preventDefault();
        $.ajax({
            url: '/cart/clear',
            type: 'GET',
            success: function (res) {
                if (!res) alert('Error!');
                alert('работает');
                showCartModal(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    });



    $('.addToCartButton').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/cart/add',
            data: {id: id},
            type: 'GET',
            success: function (res) {
                if (!res) alert('Error!');
                showCartModal(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    });

    $('.deleteFromCartButton').on('click', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            url: '/cart/remove',
            data: {id: id},
            type: 'GET',
            success: function (res) {
                if (!res) alert('Error!');
                updateCartNotification();
                showCartModal(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    });

    $('#cart-modal .modal-body').on('click', '.del-item', function() {
        let id = $(this).data('id');
        $.ajax({
            url: '/cart/remove',
            data: {id: id},
            type: 'GET',
            success: function (res) {
                if (!res) alert('Error!');
                showCartModal(res);
            },
            error: function () {
                alert('Error!');
            }
        });
    });





   /* Cart end*/


    /* fast-search start */

    $( document ).click(function() {
        if ( $(".main-search input").is(":focus") ) {
            $('.search-fast-result').fadeIn('fast');
        } else {
            $('.search-fast-result').fadeOut('fast');
        }
    });


    let RUSH = {} || RUSH;

    RUSH.search_fast = {
        input: $('.main-search input[name="text"]'),
        result_container: $('.main-search .search-fast-result'),
        init: function () {
            RUSH.search_fast.input.on('keyup', function () {
                if ($(this).val().length < 2) return false;
                $.ajax({
                    url: '/catalog/search-fast',
                    data: {
                        category: $('#category').val(),
                        text: $(this).val()
                    },
                    success: function (data) {
                        RUSH.search_fast.result_container.html(data);
                    }
                });

            });
        }
    };
    RUSH.search_fast.init();
    /* fast-search end */



    // /* cart qty-spiner start */
    // $(document).on('click', '.prod-count .wish-up', function () {
    //     var input = $(this).siblings('.wish-input');
    //     var numb = parseInt(input.val(), 10);
    //     numb = isNaN(numb) ? 0 : numb;
    //     input.val(++numb);
    //     input.change();
    //     return false;
    // });
    // $(document).on('click', '.prod-count .wish-dn', function () {
    //     var input = $(this).siblings('.wish-input');
    //     var numb = parseInt(input.val(), 10);
    //     numb = isNaN(numb) ? 0 : numb;
    //     if(--numb < 1) {
    //         numb = 1;
    //     }
    //     input.val(numb);
    //     input.change();
    //     return false;
    // });
    /* cart qty-spiner end */

});

  /*$( window ).on( "load", function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");
  });*/






