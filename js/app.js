

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
			var div = $('#leden').html();
			var div =  div + '<div> id="' + uId + '">' + 
						'<a href="#"class="delMember" data-id ="' + userid + '">verwijder</a>' +
						'</div>';

			$("#leden").html(div);

			alert(div);
		}		
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
		if(msg == 'succes'){
			var uId = 'id' + userid;
			$('#' + uId).html('Deze persoon is verwijderd.');
			console.log(msg);
		}		
		
	});
	e.preventDefault();
});

$('.voegToe').on('click',function(e) {
	var eventid = $(this).attr("data-eventid");
	var eId = 'id' + eventid;

	//Ajax call
	var request = $.ajax({
	  url: "../ajax/voegtoe_event.php",
	  type: "POST",
	  data: {eventid : eventid},
	  dataType: "json"
	});
	request.done(function(msg) {
		alert("gelukt");
		if(msg == 'succes'){
			$('#' + eId).html('Dit event is toegevoegd.');
			console.log(msg);
		}		
		if(msg == 'failed'){
			alert("gelukt");
			$('#' + eId).html('Dit event is al toegevoegd aan de groep.');
			console.log(msg);
		}		
	});
	e.preventDefault();
});


$('.delEvent').on('click',function(e) {
	var eventid = $(this).attr("data-id");
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/verwijder_event.php",
	  type: "POST",
	  data: {eventid : eventid},
	  dataType: "json"
	});
	request.done(function(msg) {
		if(msg == 'succes'){
			var eId = 'id' + eventid;
			$('#' + eId).html('Dit event is uit de groep verwijderd.');
			console.log(msg);
		}		
		
	});
	e.preventDefault();
});


$('.chkEventaanvraag').on('change',function(e) {
	var eventid = this.value;
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/accept_event.php",
	  type: "POST",
	  data: {eventid : eventid},
	  dataType: "json"
	});

	request.done(function(msg) {
		if(msg == 'succes'){
			var uId = 'id' + userid;
			$('#' + uId).html('Deze persoon is toegevoegd.');
			var div = $('#accEvent').html();
			var div =  div + '<div> id="' + uId + '">' + 
						'<a href="#"class="delMember" data-id ="' + eventid + '">verwijder</a>' +
						'</div>';

			$("#accEvent").html(div);
		}		
		
	});

	e.preventDefault();
});