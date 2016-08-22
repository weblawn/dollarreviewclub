$('.form_area .radio label').on('click', function(){
    $(this).parent().addClass('current').siblings().removeClass('current');
});


$('.owl-carousel').owlCarousel({
    stagePadding: 128,
    loop:true,
    margin:10,
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
        }
    }
})