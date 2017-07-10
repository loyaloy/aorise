

$(function(){
	$(".slider li").click(function(){
		var num=$(this).attr("slideNum");
		$(this).addClass("actived").siblings().removeClass("actived");

		$(".banner").fadeOut("500",function(){
			$(this).css({background:"url(./images/banner"+num+".jpg)"}).fadeIn("500");
		})
	})
})