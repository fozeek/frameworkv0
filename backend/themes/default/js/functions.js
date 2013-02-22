$("document").ready(function() {
	
	$('body').keyup(function(e) { //remplacez {id_img} par l'id de votre image
	      if(e.keyCode == 27) {
	   		$("#panel").css("display", "none");
	       }
	});

	function closeComment(field){
		field.css("cursor", "pointer");
		field.children(".close").css("display", "none");
		field.removeClass();
		field.addClass("itemlist");
		field.addClass("showmore");
		field.children(".descriptionitem").children(".textcomment").css("display", "none");
		field.children(".titleitem").children("span").css("display", "none");
		field.children(".descriptionitem").find("input").css("display", "none");
	}

	$($(".descriptionitem")).each(function() {
		if($(this).height()>$(this).parent().children(".titleitem").height()) {
			$(this).children(".borderitem").css("display", "block");
			$(this).css("height", $(this).parent().children(".titleitem").height()+15);
			$(this).css("marginBottom", "-15px");
		}
	});
	
	$(".itemlist.showmore").live("click", function(){
		var previous = $(this).parent().children(".open");
		
		closeComment(previous);
		
		$(this).children(".close").css("display", "block");
		$(this).css("cursor", "auto");
		$(this).removeClass();
		$(this).addClass("open");
		$(this).addClass("itemlist");
		$(this).children(".descriptionitem").children(".textcomment").css("display", "block");
		$(this).children(".titleitem").children("span").css("display", "block");
		$(this).children(".descriptionitem").find("input").css("display", "block");
	});
	
	$(".close").live("click", function(){
		var toclose = $(this).parent();
		console.log(toclose);
		closeComment(toclose);
	});	
});