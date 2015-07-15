$(document).ready(function(){
	

	$(".remove-slider").click(function(){
		confirms({
			"title" : "您确定要删除吗",
			"icon" : "icon-trash",
			"content" : "<p>您确定要删除掉这篇文章吗？</p><p>删除后将无法复原，点击确定按钮确认删除该条记录</p>",
			"success" : function(){
				alert("");	
			}
		});
	});
	
	$(".edit-slider").click(function(){
		input({
			"title" : "编辑轮播焦点图",
			"icon" : "icon-trash",
			"success" : function(){
				alert("");	
			}
		});
	});
	
	$(".add-pic").click(function(){
		input({
			"title" : "添加轮播焦点图",
			"icon" : "icon-trash",
			"success" : function(){
				alert("");	
			}
		});
	});
	
	
	
	
	var sourceInfo;
	var reader = new FileReader();
	$previewImg = $('#preview'),
	reader.onload = function (e) {
		$previewImg.attr('src', e.target.result);
		$temp.attr('src', e.target.result);
	}
	
	$(".slider-color").keypress(function(){
		setTimeout(function(){
			$(".color").css({"background-color" : $(".slider-color").val()});
		},200);
	})
	
	 $('input[type="file"]').bind('change', function (e) {
		var file = e.target.files[0];
		reader.readAsDataURL(file);
		$temp = $('.temp-image'),
		sourceInfo = {
			height: $temp.height(),
			width: $temp.width()
		};
		$(".table-form span").text("建议图片尺寸：1200 * 400 ， 该图片尺寸：" + sourceInfo.width + " * " + sourceInfo.height);
	});
	
	
	

	
			


})