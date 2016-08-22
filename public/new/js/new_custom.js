  $(document).ready(function() {
      
      
      $('.product-owl-carousel').owlCarousel({
    
    loop:true,
    margin:0,
    nav:true,
    responsive:{
        0:{
            items:1
        },
		300:{
            items:1
        },
		
        400:{
            items:1
        },
		700:{
            items:2
        },
		800:{
            items:3
        },
		1100:{
            items:4
        }
    }
});
      
      
    
    function scrollNav() { 
  $('.scrollToDiv').click(function(){
      //alert("test");
    //Toggle Class
    /*$(".active").removeClass("active");      
    $(this).closest('li').addClass("active");
    var theClass = $(this).attr("class");
    $('.'+theClass).parent('li').addClass('active');*/
    //Animate
    $('html, body').stop().animate({
        scrollTop: $( $(this).attr('href') ).offset().top - 30
    }, 400);
    return false;
  });
  $('.scrollTop a').scrollTop();
}
scrollNav();
 });