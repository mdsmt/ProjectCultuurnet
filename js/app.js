$("#slcGroep").on("change",function(e){
	var id = this.value;
	//Ajax call
	var request = $.ajax({
	  url: "../ajax/verander_groep.php",
	  type: "POST",
	  data: {id : id},
	  dataType: "json"
	});
	console.log(id);
	e.preventDefault();
})