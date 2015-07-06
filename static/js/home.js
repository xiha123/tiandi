$(document).ready(function(e) {

	var slider = $(".slider") , list_index = 1 , slider_time_out , temp_index = 0;
	var slider_left = slider.find(".left-slider img") , clear = false;
	slider_setInterval();

	slider.find(".left-slider li").hover(function(){
		slider.find(".left-slider li").eq(temp_index).find("i").show()
		$(this).find("i").hide();
		temp_index = slider.find(".left-slider li").index(this);
		slider.find(".right-slider .right-data").hide()
		slider.find(".right-slider .right-data").eq(temp_index).show()
		slider.find(".center-slider img").attr("src" , slider_left.eq(temp_index).attr("src") );
		list_index = temp_index + 1;
		if(list_index >= slider_left.length){
			list_index = 0;
		}
	});

	slider.hover(function(){
		type = false;
		clear = false;
		setTimeout(function(){
			if(type == false){
				clear = true;
				clearInterval(slider_time_out);
			}
		},400);
	},function(){
		type = true;
		if(clear){
			slider_setInterval();
		}

	})
	function slider_setInterval(){
		slider_time_out = setInterval(function(){
			slider.find(".left-slider li").eq(temp_index).find("i").fadeIn(400);
			slider.find(".left-slider li").eq(list_index).find("i").fadeOut(400);

			slider.find(".right-slider .right-data").hide()
			slider.find(".right-slider .right-data").eq(list_index).show()

			slider.find(".center-slider .one").hide()
			slider.find(".center-slider .lost").show()
			slider.find(".center-slider .one").fadeIn(800);
			slider.find(".center-slider .one").attr("src" , slider_left.eq(list_index).attr("src") );
			slider.find(".center-slider .lost").attr("src" , slider_left.eq(temp_index).attr("src") );


			temp_index = list_index;
			list_index ++;
			if(list_index >= slider_left.length){
				list_index = 0;
			}
		},3000);
	}

});