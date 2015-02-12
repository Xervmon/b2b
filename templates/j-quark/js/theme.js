jQuery(function($){

	if(document.getElementById("sp-slider-wrapper") !== null){
		$(window).on('scroll', function(){
			if( $(window).scrollTop()>200 ){
				$('#sp-slider-wrapper').addClass('search-fixed');
				$('#sp-service-wrapper').addClass('no-margin');
			} else {
				$('#sp-slider-wrapper').removeClass('search-fixed');
				$('#sp-service-wrapper').removeClass('no-margin');
			}
		});
	}

	if(document.getElementById("sp-slider-wrapper") !== null){
		$("#sp-service-wrapper .container").css('margin-top','-80px');
	}else{
		$("#sp-service-wrapper").css('margin-top','99px');
	}
	
	if(document.getElementById("sp-search-wrapper") !== null){
		if(!document.body.classList.contains("subpage")){
			$("body").css('padding-top','95px');
		}
	}
	
	
});