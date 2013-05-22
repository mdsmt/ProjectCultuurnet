

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
	var naam = $(this).attr("data-naam");
	var voornaam = $(this).attr("data-voornaam");
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
			var div =  div + '<div id="' + uId + '"> '+ naam + ' ' + voornaam  + ' ' +
						'<a href="#"class="delMember" data-id ="' + userid + '">verwijder</a>' +
						'</div>';

			$("#leden").html(div);
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
		if(msg == 'succes'){
			$('#' + eId).html('Dit event is toegevoegd.');
			console.log(msg);
		}		
		if(msg == 'failed'){
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
	var titel = $(this).attr("data-titel");
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/accept_event.php",
	  type: "POST",
	  data: {eventid : eventid},
	  dataType: "json"
	});

	request.done(function(msg) {
		console.log(msg);
		if(msg == 'succes'){
			var uId = 'id' + eventid;
			$('#' + uId).html('Dit event is geaccepteerd.');

			var div2 = $("#eventen").html();
			div2 =  div2 + '<div id="' + uId + '"> ' + titel + ' ' +
						'<a href="#"class="delMember" data-id ="' + eventid + '">verwijder</a>' +
						'</div>';
			$("#eventen").html(div2);
		}		

		
	});
	request.fail(function(jqXHR, textStatus) {
	alert( "Request failed: " + textStatus );
	});

	e.preventDefault();
});

$('.aanwezig').on('click',function(e) {
	var eventid = $(this).attr("data-eventid");
	var eId2 = 'aanwezig' + eventid;
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/aanwezig.php",
	  type: "POST",
	  data: {eventid : eventid},
	  dataType: "json"
	});
	request.done(function(msg) {
		if(msg == 'succes'){
			var eId = 'id' + eventid;
			$('#' + eId2).html('Je hebt je aanwezig gezet op dit evenement.');
			console.log(msg);
		}
		if(msg == 'fail'){
			var eId = 'id' + eventid;
			$('#' + eId2).html('<p class="success">Je hebt je  aanwezig  gezet voor dit evenement.</p>');
			console.log(msg);
		}				
		
	});
	e.preventDefault();
});

$('.afwezig').on('click',function(e) {
	var eventid2 = $(this).attr("data-eventid");
	var eId2 = 'aanwezig' + eventid2;
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/afwezig.php",
	  type: "POST",
	  data: {eventid2 : eventid2},
	  dataType: "json"
	});
	request.done(function(msg) {
		if(msg == 'succes'){
			var eId = 'id' + eventid2;
			$('#' + eId2).html('Je hebt je afwezig gezet op dit evenement.');
			console.log(msg);
		}
		if(msg == 'fail'){
			var eId = 'id' + eventid2;
			$('#' + eId2).html('Je hebt je  afwezig  gezet voor dit evenement.');
			console.log(msg);
		}				
		
	});
	e.preventDefault();
});

$('.lidworden').on('click',function(e) {
	var groepid = $(this).attr("data-groepid");
	var userid = $(this).attr("data-userid");
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/lidworden.php",
	  type: "POST",
	  data: {groepid : groepid, userid : userid},
	  dataType: "json"
	});
	request.done(function(msg) {
		if(msg == 'succes'){
			$('#lidworden').html('Je hebt je aangemeld om lid te worden.');
			console.log(msg);
		}		
	});
	e.preventDefault();
});

$('.nietAccept').on('click',function(e) {
	var userid = $(this).attr("data-id");
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/nietaccept.php",
	  type: "POST",
	  data: {userid : userid},
	  dataType: "json"
	});
	request.done(function(msg) {
		if(msg == 'succes'){
			var eId = 'id' + userid;
			$('#' + eId).html('De persoon is niet geaccepteerd.');
			console.log(msg);
		}		
		
	});
	e.preventDefault();
});