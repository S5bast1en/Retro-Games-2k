 $(function(){

 	if($(".infoGame").data("verif")<=3) {
 		$(".myCar").removeClass("owl-carousel"); 
 		//$(".contList").addClass("defaultList"); 
 		$(".contList").addClass("col-md-4 ");
 		//$(".list").find("img").addClass("col-md-8 col-md-offset-2");
 		$(".list:first-child").addClass("row"); 

 		$(".list:first-child").css("width" , "100%");
 		$(".list").find("img").css("width" , "100%");
 		$(".list").find("img").css("marginTop" , "0");

 		if($(".infoGame").data("verif")==1) {

 			$(".contList").addClass("col-md-offset-4");

 		}

 	}

 	

 }); 
