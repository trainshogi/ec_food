// get cook name from url
var url = location.href;
var cook_name = decodeURIComponent(url.split('=')[1]);

// get ingrediants from cook name using PHP api
$.ajax({
        type: 'post',
        url: "php/api.php",
        data: {"cook_name":cook_name},
        success: function(result){
        	// parse
        	var ings = JSON.parse(result)['info'];
        	// show cook name
        	$('#cook_name').text(cook_name);
        	// show ingredients
        	for (var ing in ings){
        		$('#ingredients').append('<tr><td>' + ing + '</td><td>' + ings[ing][0]['url'] + '</td><td>' + ings[ing][0]['img'] + '</td></tr>');
        	}
        }
});