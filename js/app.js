$("#slcGroep").on("change",function(e){
	var id = this.value;
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/verander_groep.php",
	  type: "POST",
	  data: {id : id},
	  dataType: "json"
	});
	e.preventDefault();
});

$('.chkGroepsaanvraag').on('change',function(e) {
	var userid = this.value;
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/voegtoe_groep.php",
	  type: "POST",
	  data: {userid : userid},
	  dataType: "json"
	});

	request.done(function(msg) {
		if(msg == 'succes'){
			var uId = 'id' + userid;
			$('#' + uId).html('Deze persoon is toegevoegd.');
		}		
		/*if(msg.status =="success")
		{
			//ok
			var li = '<li style="display:none" class="clearfix">' +
				'<img class="avatar" src="images/avatar.jpg">' + 
				'<p>'+update+' <span>Just now</span></p>' + 
			'</li>';
			$("#tweets ul").prepend(li);
			$("#tweets ul li").first().slideDown();
		}
		else{
			//niet ok
		}
		console.log( msg );*/
	});

	e.preventDefault();
});

$('.delMember').on('click',function(e) {
	var userid = $(this).attr("data-id");
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/verwijder_lid.php",
	  type: "POST",
	  data: {userid : userid},
	  dataType: "json"
	});
	request.done(function(msg) {
		alert("gelukt");
		if(msg == 'succes'){
			alert("gelukt");
			var uId = 'id' + userid;
			$('#' + uId).html('Deze persoon is verwijderd.');
			console.log(msg);
		}		
		/*if(msg.status =="success")
		{
			//ok
			var li = '<li style="display:none" class="clearfix">' +
				'<img class="avatar" src="images/avatar.jpg">' + 
				'<p>'+update+' <span>Just now</span></p>' + 
			'</li>';
			$("#tweets ul").prepend(li);
			$("#tweets ul li").first().slideDown();
		}
		else{
			//niet ok
		}
		console.log( msg );*/
	});
	e.preventDefault();
});