<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Mock Restaurant Sorting</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="css/main_model.css" rel="stylesheet">
<link href="jquery-ui-1.10.4/development-bundle/themes/custom-theme-mini/jquery-ui.css" rel="stylesheet">
<script src="jquery-ui-1.10.4/js/jquery-1.10.2.js"></script>
<script src="jquery-ui-1.10.4/js/jquery-ui-1.10.4.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>

$(function() {
	$("#price").slider({min: 0, max: 10});
	$("#steak").slider({min: 0, max: 10});
	$("#shakes").slider({min: 0, max: 10});
	$("#delivery").slider({min: 0, max: 10});
	$("#pizza").slider({min: 0, max: 10});
	$("#chicken").slider({min: 0, max: 10});
	$("#mexican").slider({min: 0, max: 10});
	$("#juice").slider({min: 0, max: 10});
	$("#asian").slider({min: 0, max: 10});
	
	
	$("#evaluate").click(function() {
		var price = $("#price").slider("value");
		var steak = $("#steak").slider("value");
		var shakes = $("#shakes").slider("value");
		var delivery = $("#delivery").slider("value");
		var pizza = $("#pizza").slider("value");
		var chicken = $("#chicken").slider("value");
		var mexican = $("#mexican").slider("value");
		var juice = $("#juice").slider("value");
		var asian = $("#asian").slider("value");
		
		var data_str = "price=" + price + "&steak=" + steak + "&shakes=" + shakes + "&delivery=" + delivery + "&pizza=" + pizza + "&chicken=" + chicken + "&mexican=" + mexican + "&juice=" + juice + "&asian=" + asian;
		
		$.ajax({
			type: 'POST',
			url: 'get_restaurants.php',
			data: data_str,
			dataType: 'json',
			cache: false,
			timeout: 1000,
			success: function(data) {
				var counter = 0;
				var str_response = "";
				for(var numeric in data) {
					str_response += "<div class=\"restaurant_box\">";
					
					if(counter%4==0) {
						str_response += "<div class=\"restaurant_group\">";
					}
					
					for(var key in data[numeric]) {
						str_response += "<h4>" + key + "</h4>";
						for(attr in data[numeric][key]) {
							str_response += "<p>" + attr + ": " + data[numeric][key][attr] + "</p>";
						}
					}
					str_response += "</div></div>";
					counter++;
				}
				
				$("#restaurants_list").html(str_response);
			}
		});
		
	});
	
});

</script>
</head>
<body>

<div class="main_container">
<div class="top_header"><h1>Restaurant Listing</h1></div>

<hr />	

<form>
	<div class="form_input_row">
		<label for="price" class="form_left">Price</label><div id="price" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="steak" class="form_left">Steak</label><div id="steak" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="shakes" class="form_left">Shakes</label><div id="shakes" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="delivery" class="form_left">Delivery</label><div id="delivery" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="pizza" class="form_left">Pizza</label><div id="pizza" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="chicken" class="form_left">Chicken</label><div id="chicken" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="mexican" class="form_left">Mexican</label><div id="mexican" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="juice" class="form_left">Juice</label><div id="juice" class="form_right"></div>
	</div>
	<div class="form_input_row">
		<label for="asian" class="form_left">Asian</label><div id="asian" class="form_right"></div>
	</div>
	
</form>
<button class="eval_btn btn btn-lg" id="evaluate">Evaluate</button>
<br />
<br />
<br />
<hr style="border-color: black;" />

<div id="restaurants_list">
</div>

</div>
</body>
</html>