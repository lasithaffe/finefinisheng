$(document).ready(function(){
	let scrollRef = 0;
window.addEventListener('scroll', function() {
  // increase value up to 10, then refresh AOS
  scrollRef <= 10 ? scrollRef++ : AOS.refresh();
});
	
	window.addEventListener('load', AOS.refresh);
	$(".anim").on('scroll', function () {
		AOS.refresh();
	});
    AOS.init();

    $('.vdo').click(function() {
        //this.paused ? this.play() : this.pause();
        var contentPanelId = $(this).attr("id");
        //var myClass = $(this).attr("class");
        if($(this).hasClass('open')){
            $('.vdo').removeClass("open");
            $('.vdo').removeClass("wd-15");             
            $('#'+contentPanelId).find('.video-ply')[0].pause();
        }else{
            $('.vdo').removeClass("open");
            $('#'+contentPanelId).toggleClass("open");
            $('.vdo').addClass('wd-15');
            $('#'+contentPanelId).removeClass("wd-15");
            $('.video-ply')[0].pause();
            $('#'+contentPanelId).find('.video-ply')[0].play();
        }
    });

    $('.hom-sld').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        items:1,
        dots:false,
        nav:false,
        autoplay:true,
        autoplayTimeout:6000,
        smartSpeed:3000,
    })

    // slider
    $('#owl-mang').owlCarousel({
        loop:false,
        dots:false,
        nav:false,
        autoplay:true,
        autoplayTimeout:4000,
		smartSpeed:3000,
        responsive:{
            0:{
                items:1,
                loop:true,
				dots:true,
            },
            690:{
                items:2,
                loop:true,
            },
            1000:{
                items:3
            }
        }
    });
    $('#owl-job').owlCarousel({
        loop:true,
        dots:false,
        nav:false,
        items:1,
        autoplay:true,
        autoplayTimeout:1000,
        autoplayHoverPause:true
    });
    $('#owl-slider').owlCarousel({
        loop:true,
        dots:false,
        nav:false,
        items:1
    });
    $('#owl-logodex').owlCarousel({
        animateOut: 'fadeOut',
        animateIn: 'fadein',
        items:1,
        loop:true,
        dots:false,
        smartSpeed:3000,
        autoplay:true,
        autoplayTimeout:5000,
    });

     $('#owl-logo').owlCarousel({
        loop:true,
        dots:false,
        nav:false,
        autoplay:true,
        animateOut: 'fadeOut',
        animateIn: 'fadein',
        smartSpeed:2000,
        responsive:{
            0:{
                items:2
            },
            690:{
                items:4
            },
            1000:{
                items:6
            }
        }
    });


     $('#owl-pro').owlCarousel({
        loop:false,
        dots:false,
        nav:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:2
            },
            690:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });

    $('#owl-epecialized').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
                dots:true,
            },
            490:{
                items:2
            }
        }
        
    });

    $('#owl-proj').owlCarousel({
        loop:false,
        dots:false,
        margin:30,
        nav:true,
        responsiveClass:true,
        responsive:{
            0:{
                items:1
            },
            490:{
                items:2
            }
        }
        
    });
    
     $('#owl-cus').owlCarousel({
        loop:true,
        dots:false,
        nav:false,
        responsiveClass:true,
        autoplay:true,
        autoplayTimeout:1000,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:6
            }
        }
        
    });



    $('.count').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });
    

    $('.mnu-btn').click(function() {
        $('.mnu-btn').toggleClass('open');
        $('.sid-menu').toggleClass('open-side');
    });

    $('.menu-item-has-children > a').click(function() {
        $('.menu-item-has-children > .sub-menu').toggleClass('open-sub');
    });

    // var gth = $( ".gt-h" ).height();
    // $( ".set-h div" ).css("height", gth);

    // var gt2h = $( ".get-2h" ).height();
    // $( ".set-2h div" ).css("height", gt2h);


    // var height = $(window).height();
    
    // $(".anim").css('height',height);  
    // $(".ani-top > section").css('height',height);  

    // $('.gapdiv').css('height',(height * 5));

    // var height1 = -+height;
    // var height2 = -+height*2;
    // var height3 = -+height*3;
    // var height4 = -+height*4;
    // var height5 = -+height*5;
    // var height6 = -+height*6;
    // var height7 = -+height*7;

    // var height1m = height;
    // var height2m = height*2;
    // var height3m = height*3;
    // var height4m = height*4;
    // var height5m = height*5;
    // var height6m = height*6;
    // var height7m = height*7;

    // function animet_slid(scroll, size,height, act) {

    //     if(scroll > size){
    //        $('.ani-top').css("top",act);
    //     }else if(scroll < size  ){
    //        // $('.ani-top').css("top",height);         
    //     };

    // };






    $(window).scroll(function() { 
        
	
        var scroll = $(window).scrollTop();
		
        if (scroll >= 200) {
            $("header").addClass("stickmenu");
			$(".logo").removeClass("stickmenu_invert");
			$(".top-cont").removeClass("stickmenu_invert");
			$(".mnu-btn").removeClass("stickmenu_invert");
			$(".custom-menu-class .menu-item").addClass("stickmenu_invert");
			$(".custom-menu-class .sub-menu").addClass("hiddenDropDown");
        } else {
            $("header").removeClass("stickmenu");
			$(".logo").addClass("stickmenu_invert");
			$(".top-cont").addClass("stickmenu_invert");
			$(".mnu-btn").addClass("stickmenu_invert");
			$(".custom-menu-class .menu-item").removeClass("stickmenu_invert");
			$(".custom-menu-class .sub-menu").removeClass("hiddenDropDown");
        }
          
       //  if(scroll >= 1072 ){
       //      $(".anim").addClass("fix-ani");
       //  }else {
       //      $(".anim").removeClass("fix-ani");
       //  };

       //  animet_slid(scroll,'1080', height1m, '0');
       //  animet_slid(scroll, '1150',height2m, height1);
       //  animet_slid(scroll, '1500',height3m, height2);
       //  animet_slid(scroll, '2200',height4m, height3);
       //  animet_slid(scroll, '2700',height5m, height4);
       //  animet_slid(scroll, '3200',height6m, height5);
       //  // animet_slid(scroll, height2m, '2500', '', height3);
       //      
       //  $('#val').text(scroll);
            
    });









    $(".car-main li").click(function(){
        $('.car-main li').removeClass("act");
        $(this).addClass("act");

    });
    $('.file-cr input[type="file"]').change(function(e){
        var fileName = e.target.files[0].name;
        $('.file-cr span').text(fileName);
    });

    var height = $(window).height();
    var width = $(window).width();
    
    // if(width > 800){
    //     $(".scl").css('height',height);
    // };
    

    // first video height
    $( ".ful-wth" ).css("height", height);
    $( ".ful-wth video" ).css("width", width);


    $(".bar-act div").click(function(){
        $('.bar-act div').removeClass("actv");
        $(this).addClass("actv");
        var contentPanelId = $(this).attr("id");
        $('.bar-cont div').removeClass("actv");
        $('.'+contentPanelId).addClass("actv");
    });

    $('.clik-img span').click(function() {
        if($(this).hasClass('open')){
            $('.clik-img span').removeClass("open");
        }else{
            $('.clik-img span').removeClass("open");
            $(this).toggleClass('open');
        }
    });



    $('.mang-div div p span').click(function() {

        var id_man = $(this).attr("id");
        $('.'+id_man).toggleClass('open');

    });

    $('.close').click(function() { 
        $('.moda').removeClass("open");
    });

    // ===== Scroll to Top ==== 
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(200);    // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(200);   // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() {      // When arrow is clicked
        $('body,html').animate({
            scrollTop : 0                       // Scroll to top of body
        }, 500);
    });


});