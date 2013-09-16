jQuery(function($) {
		"use strict";
		$('[rel=tooltip]').tooltip();
              $('input, textarea').placeholder();
        $('#mc_mv_EMAIL').attr('placeholder', 'Type your email address');
		if($('#testimonials').length){
			$('#testimonials').cycle();
        }

		if($('#dynamic_testimonial').length > 0){
			$('#dynamic_testimonial').cycle();
		}
		$(".accordion-group .accordion-toggle").live('click', function(){
			var $self = $(this).parent().parent();
			if($self.find('.accordion-heading').hasClass('in_head')){
				$self.parent().find('.accordion-heading').removeClass('in_head');
			}else{  
				$self.parent().find('.accordion-heading').removeClass('in_head');
				$self.find('.accordion-heading').addClass('in_head');
			}
		});
		
		if($('.recent_sc_portfolio').length){
			$('.recent_sc_portfolio').imagesLoaded(function(){

				$(this).carouFredSel( 
					{
					
						items:6,
						responsive:true,
						scroll : { items : 6 },
						prev : {
						button : $(this).parent().parent().find('.prev')
					},

					next : {
						button : $(this).parent().parent().find('.next')
					}
						

					});
					
			});
		}


	

    $("audio,video").mediaelementplayer();               


	$(".lightbox-gallery").fancybox();
	$('.lightbox-media').fancybox({
		openEffect  : 'none',
		closeEffect : 'none',
		helpers : {
			media : {}
		}
	});
	
	

    
	
	$("#tweet_footer").each(function(){
		var $self = $(this);
			$self.carouFredSel( 
				{
					circular : true,
					infinite : true,
					auto : false,
					scroll : {
						items : 1,
						fx : "fade"
					},
					prev : {
						button : $self.parents('.textshortcode').first().find('.back')
					},

					next : {
						button : $self.parents('.textshortcode').first().find('.next')
					}

					

					
				});
       
          
		});

	

	$(".carousel_staff").each(function(){
		var $self = $(this);
		$self.imagesLoaded(function(){
			$self.carouFredSel( 
					{
						circular : true,
						infinite : true,
						auto : false,

						scroll : {
							items : 1
						},
						prev : {
							button : $self.parents('.team_carousel').first().find('.prev')
						},
						next : {
							button : $self.parents('.team_carousel').first().find('.next')
						}

							
					});
			});
	});
    $(".carousel_blog").each(function(){
		var $self = $(this);
		if( $('li img', $self).size() ) {
			$('li img', $self).one("load", function(){
				$self.carouFredSel( 
				{
					circular : true,
					infinite : true,
					auto : false,
					scroll : {
						items : 1
					},
					prev : {
						button : $self.parents('.latest_blog').find('.prev')
					},
					next : {
						button : $self.parents('.latest_blog').find('.next')
					}

								
							}, {debug:true});
						}).each(function() {
							if(this.complete){ $(this).trigger("load"); }
						});
					}else{
						$self.carouFredSel( 
							{
								
								circular: true,
								infinite: true,
								auto: false,

								scroll  : {
									items: 1 
								},

								prev : {
									button : $self.parents('.latest_blog').find('.prev')
								},

								next : {
									button : $self.parents('.latest_blog').find('.next')
								}

								
							});
					}          
		});
    if($('.cycle_client').length){
    $('.cycle_client').imagesLoaded(function(){
		$(this).carouFredSel( 
				{
					items:4,
					auto: true,
					scroll: { items : 1 }

				});
	});
    }
	

	$("#portfolio-preview-items .portfolio-item .project").hover(function(){
		var $item = $(this).parents('.portfolio-item').first();
		$item.addClass('border_colored');

	}, function(){
		var $item = $(this).parents('.portfolio-item').first();
		$item.removeClass('border_colored');
	});
	function carousel_port_init(){
		$(".carousel_portfolio").each(function(){
			var $self = $(this);
			var cl = 3;
            if($self.parent().hasClass('three-cols')){
				cl = 3;
            }
            if($self.parent().hasClass('four-cols')){
				cl = 4;
            }
            if($self.parent().hasClass('two-cols')){
                cl = 2;
            }
            if($self.parent().hasClass('one-cols')){
				cl = 1;
			}
			$self.imagesLoaded(function(){
				$self.carouFredSel( 
					{
						
						circular: false,
						infinite: false,
						auto: false,

						scroll: {
							items: 1
						},

						prev : {
							button : $self.parents('.recent_portfolio').first().find('.prev')
						},

						next : {
							button : $self.parents('.recent_portfolio').first().find('.next')
						}
					});
			});
		});
	}

    carousel_port_init();
    
    

    $('.testimonials .content li:first-child').addClass('active');   
	$('.testimonials .list li:first-child').addClass('active');
	$('.testimonials .list li').live('click', function(){
		var id = $(this).data('id');
		$(this).parent().find('li').removeClass('active');
		$(this).parent().parent().find('.content').find('li').removeClass('active');
		$(this).parent().parent().find('.content').find('li[data-id="'+id+'"]').addClass('active');
		$(this).addClass('active');
	});
   
	
	
	
	

	
	
	
	if($().mobileMenu) {
		$('#navigation nav').each(function(){
			$(this).mobileMenu();
			$('.select-menu').customSelect();
		});
		
	}



	$('.flexslider').flexslider({
			animationSpeed: 400,
			animation: "fade",
			controlNav: true,
			pauseOnAction: true,
			pauseOnHover: false
		});

	$('.flexslider_with_thumbnails').flexslider({
		animationSpeed: 400,
		animation: "fade",
		pauseOnHover: false,
		controlNav: "thumbnails"
	});
	$("#attention button.close_button").click(function(){
		$("#attention").height(4);
		$(this).parent().parent().parent().find('.open_button').css('top', 3);
	});
	$("#attention span.open_button").mouseenter(function(){
		$("#attention").height(60);
		$(this).css('top', 59);
	});
	$(".menu a").live('click', function(e){
		var button = $(this);
		if($(button).attr('title').length > 0){
			e.preventDefault();
			var title = button.attr('title').split("-");
			var blog  = title[0].split("_");
			if(title[1])
			var sidebar = title[1].split("_");
			var sidebar_pos = '';
			var blog_type = '';
			if(blog[0] === 'blog'){
				sidebar_pos = sidebar[1];
				blog_type = blog[1];
				document.cookie = 'themeple_blog='+blog_type ;
				document.cookie = 'themeple_sidebar='+sidebar_pos;
				setTimeout(function(){
					window.location.hash = "#wpwrap";
					window.location.href = $(button).attr("href");
								
				}, 1000);
			} 
 
			if(blog[0] === 'header'){
				
				blog_type = blog[1];
				document.cookie = 'themeple_header='+blog_type ;
				setTimeout(function(){
					window.location.hash = "#wpwrap";
					window.location.reload(true);
								
				}, 1000);
			}
        }else{
			window.location.href = $(button).attr("href");
        }
	});

	var $container = $('.filterable');
    
    
    if( $('.tpl2 img', $container).size() ) {
		$('.tpl2 img', $container).one("load", function(){
			$container.isotope({
				filter: '*',
				resizeble: true,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
		});

		setTimeout(function(){
			$container.isotope({
				filter: '*',
				resizeble: true,
				animationOptions: {
					duration: 750,
					easing: 'linear',
					queue: false
				}
			});
		}, 100);
   
}
  

 $('nav#portfolio-filter ul li').click(function(){
    var selector = $(this).find('a').attr('data-filter');
    $(this).parent().find('.active').removeClass('active');
    $(this).addClass('active');
    $container.isotope({ 
    filter: selector,
    
	resizeble: true,
    animationOptions: {
		duration: 750,
		easing: 'linear',
		queue: false    
     }
    });
    return false;
  });
	


	
	$('nav#faq-filter li a').click(function(e){
		e.preventDefault();

		var selector = $(this).attr('data-filter');

		$('.faq .accordion-group').fadeOut();
		$('.faq .accordion-group'+selector).fadeIn();

		$(this).parents('ul').find('li').removeClass('active');
		$(this).parent().addClass('active');
	});

	$("#switcher-head").toggle(function(){
		$("#style-switcher").animate({
			left: 0
		}, 500);
	}, function(){
		$("#style-switcher").animate({
			left: -212
		}, 500);
	});
	
});