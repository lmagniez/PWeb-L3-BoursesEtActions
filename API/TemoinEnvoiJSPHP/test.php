<!DOCTYPE html>
<html>
<head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	
<script>
$(document).ready(function(){
	$("p").click(function() {
	
		console.log("ok");
		
	  var tmp = JSON.stringify({
		  "id":21,
		  "children":[
			 {
				"id":196
			 },
			 {
				"id":195
			 },
			 {
				"id":49
			 },
			 {
				"id":194
			 }
		  ]
	   });
	   
	   console.log(tmp);
	  // tmp value: [{"id":21,"children":[{"id":196},{"id":195},{"id":49},{"id":194}]},{"id":29,"children":[{"id":184},{"id":152}]},...]
	  $.ajax({
		type: 'POST',
		url: 'save_categories.php',
		data: {'categories': tmp},
		success: function(msg) {
		  alert(msg);
		}
	  });
	});
});
</script>
</head>

<body>

	<p>bzaezaejezalezjjlk</p>
	<button id="save">CLick</button>
</body>
