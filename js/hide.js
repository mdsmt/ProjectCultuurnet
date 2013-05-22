$(document).ready(function(){
	var i = 0;		
	$("#registratie").hide();
	$("#inloggen").hide();
	$("#register").click(function(){
		if(i == 0){
			$("#registratie").slideDown();
			i++;
			console.log(i);
		}
		return(false); //Stop link
	});
});