$(document).ready(function(){
	var index = 0 , temp_index = 0 , carousel , hover_out = false , $yes_out_carousel = !0;
	$Carousel = $(".Carousel");
	$Carousel_nav = $Carousel.find(".Carousel-nav li");
	$Carousel_image = $Carousel.find(".Carousel-image li");
	carousel_function();
	
	function carousel_function(){
		if(carousel != 0){
			clearInterval(carousel);
		}
		carousel = setInterval(function(){
			index ++;
			$Carousel_image.eq(temp_index).removeClass("Carousel-hover");
			$Carousel_image.eq(index).addClass("Carousel-hover");
			$Carousel_nav.eq(temp_index).removeClass("hover");
			$Carousel_nav.eq(index).addClass("hover");
			temp_index = index;
			if(index + 1 >= $Carousel_image.length){
				index = -1;	
			}
		} , 2000);
	}
	
	$Carousel_nav.hover(function(){
		index = $Carousel_nav.index(this);
		$Carousel_image.eq(temp_index).removeClass("Carousel-hover");
		$Carousel_image.eq(index).addClass("Carousel-hover");
		$Carousel_nav.eq(temp_index).removeClass("hover");
		$Carousel_nav.eq(index).addClass("hover");
		temp_index = index;
	});
	
	$($Carousel).hover(function(){
		setTimeout(function(){
			if(hover_out == false){
				$yes_out_carousel = true;
				clearInterval(carousel);
				carousel = 0;
			}
		},300);
	},function(){
		hover_out = true;
		if($yes_out_carousel == true){
			$yes_out_carousel = false;
			carousel_function();
		}
		
	});
	
	
	$nav = $("nav li a");
	$nav.hover(function(){
		console.log(1);
	});
		
});