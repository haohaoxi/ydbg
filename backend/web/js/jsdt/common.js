jQuery(function($){
	$(".box-menu #date").getDate();
	var innerHeight = document.documentElement.clientHeight;
	var innerWidth = document.documentElement.clientWidth;
	$(".left-menu").css("height",innerHeight - 162 + "px");
	$(".boxer").css("width",innerWidth - 210 + "px").css("height",innerHeight - 190 + "px");
	$(".boxer-large").css("width",innerWidth - 30 + "px").css("height",innerHeight - 190 + "px");
	if (innerWidth < 1200) {
  		$("#box-body").css("width","1200px");
		$(".boxer").css("width","990px");
		$(".boxer-large").css("width","1170px");
	}
});