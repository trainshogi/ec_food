// get cook name from url
var url = location.href;
var cook_name = decodeURIComponent(url.split('=')[1]);

// define string
var ings_start     = '<div class="ingredient_name alert alert-warning" role="alert">';
var ings_end       = '</div>';
var item_start     = '<div class="ingredient_select">';
var item_end       = '</div>';
var item_img_start = '<img class="ing_img inb" src="';
var item_img_end   = '"  align="top">';
var item_txt_start = '<div class="ing_txt inb"><span class="mgl-10 ing_title">'
var item_txt_mid1  = '</span><span class="mgl-10 ing_title"><a href="';
var item_txt_mid2  = '">';
var item_txt_end   = '</a></span></div>'
var item_btn_start = '<div class="ing_btns"><button type="button" class="btn btn-info inb">select</button>';
var item_btn_end   = '<button type="button" class="btn btn-success inb">buy now</button></div>';

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
        		// $('#ingredients').append('<tr><td>' + ing + '</td><td>' + ings[ing][0]['url'] + '</td><td>' + ings[ing][0]['img'] + '</td></tr>');
                        // ingredients name
                        $('#ingredients').append(ings_start + ing + ings_end);
                        for (var item of ings[ing]){
                                var tmpitem = item_start;
                                tmpitem += item_img_start + item['img'] + item_img_end;
                                tmpitem += item_txt_start + item['name'] + item_txt_mid1 + item['url'] + item_txt_mid2 + item['url'] + item_txt_end;
                                tmpitem += item_btn_start + item_btn_end;
                                tmpitem += item_end;
                                $('#ingredients').append(tmpitem);
                        }

        	}
        }
});
