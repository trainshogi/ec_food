// get cook name from url
var url = location.href;
var cook_name = decodeURIComponent(url.split('=')[1]);

// define string of item
var ings_start     = '<div class="ingredient_name alert alert-warning" role="alert">';
var ings_end       = '</div>';
var item_start     = '<div class="ingredient_select">';
var item_end       = '</div>';
var ings_h_start1  = '<div class="hidden_ings hidden';
var ings_h_start2  = '">';
var ings_h_end     = '</div>';
var item_h_start1  = '<div class="ingredient_select hidden_ing hidden';
var item_h_start2  = '">';
var item_h_end     = '</div>';
var item_img_start = '<img class="ing_img inb" src="';
var item_img_end   = '" align="top">';
var item_txt_start = '<div class="ing_txt inb"><span class="mgl-10 ing_title">'
var item_txt_mid1  = '</span><span class="mgl-10 ing_title"><a href="';
var item_txt_mid2  = '">';
var item_txt_end   = '</a></span></div>'
var item_btn_start = '<div class="ing_btns"><button type="button" class="btn btn-info inb ing_btn">select</button>';
var item_btn_mid   = '<button type="button" class="btn btn-success inb ing_btn" onclick="item2cart(';
var item_btn_end   = ');">buy now</button></div>';

// define string of more select button
var more_btn_start = '<div class="more_select_btn"><button type="button" class="btn btn-primary btn-block ';
var more_btn_mid   = '" style="width: 50%" onclick="disp_ing(';
var more_btn_end   = ')">more select</button></div>';

// static ids
var shop_bids = [];
var item_ids  = [];

function sleep(a){
  var dt1 = new Date().getTime();
  var dt2 = new Date().getTime();
  while (dt2 < dt1 + a){
    dt2 = new Date().getTime();
  }
  return;
}

function add2ings(tmpstr){
        $('#ingredients').append(tmpstr);
}

function add_more_button(num){
        var tmpbtn = more_btn_start + String(num);
        tmpbtn += more_btn_mid + String(num) + more_btn_end;
        add2ings(tmpbtn);
}

function add_item(item){
        var tmpitem = item_start;
        var purbtn  = "" + item['shopId']
        tmpitem += item_img_start + item['mediumImageUrls'] + item_img_end;
        tmpitem += item_txt_start + item['itemName'] + item_txt_mid1 + item['itemUrl'] + item_txt_mid2 + item['itemUrl'] + item_txt_end;
        tmpitem += item_btn_start + item_btn_mid + item['shopId'] + "," +item['itemCode'].split(':')[1] + item_btn_end;
        tmpitem += item_end;
        // add to static
        shop_bids.push(item['shopId']);
        item_ids.push(item['itemCode'].split(':')[1]);
        add2ings(tmpitem);
}

function make_hidden_item(item, num){
        var tmpitem = item_h_start1 + String(num) + item_h_start2;
        tmpitem += item_img_start + item['mediumImageUrls'] + item_img_end;
        tmpitem += item_txt_start + item['itemName'] + item_txt_mid1 + item['itemUrl'] + item_txt_mid2 + item['itemUrl'] + item_txt_end;
        tmpitem += item_btn_start + item_btn_mid + item['shopId'] + "," +item['itemCode'].split(':')[1] + item_btn_end;
        tmpitem += item_h_end;
        return tmpitem;        
}

function disp_ing(num){
        var clsname = '.hidden' + String(num);
        var hid = 'none';
        var dis = 'inline-block'
        if ($(clsname).css('display') == hid){
                $(clsname).css('display', dis);
        }else{
                $(clsname).css('display', hid);
        }
}

function item2cart(shop_bid, item_id){
        _item2cart(shop_bid, item_id).then(function(data){
                if( data.resultCode == '0'){
                        splash("カートに入れました");                                
                }else{
                        splash("カートに入れられませんでした");
                }
        });
}

function _item2cart(shop_bid, item_id){        
        var params = {
            'shopid': shop_bid,
            'units': 1,
            'itemid': item_id
        };
        return $.ajax({
                url: 'http://direct.step.rakuten.co.jp/rms/mall/cartAdd/',
                type: 'get',
                dataType: 'jsonp',
                data: params
        });
        //.then(function(data){
                // 挿入できました的なフィードバックを表示する

        //     current ++;
        //     if( current >= productList.length ){
               // location.href = 'https://ts.basket.step.rakuten.co.jp/rms/mall/bs/cartall/';
        //     }
        //     else {
        //        setProduct( current );
        //     }
        //});
}

function items2cart(){
        // show guruguru
        $('html, body').animate({scrollTop:0}, 'slow');
        var h = $(window).height();
        $('#loader-bg,#loader').height(h).css('display','inline-block');

        var results = [];
        var ajaxs = _items2cart(shop_bids, item_ids);
        $.when.apply($, ajaxs).always(function(data){
                // hide gif
                $('#loader-bg').fadeOut(800);
                $('#loader').delay(600).fadeOut(300);
                splash("全てカートに入れました");
        });
}

function _items2cart(shop_bids, item_ids){
        var ajaxs = [];
        for (let i = 0; i < shop_bids.length; i++) {
               ajaxs.push(_item2cart(shop_bids[i], item_ids[i]));
               if (i % 4 == 0){
                 sleep(1000);
               }
        }
        return ajaxs;
}

// show guruguru
var h = $(window).height();
$('#loader-bg,#loader').height(h).css('display','inline-block');

// counter
var counter = 0;

// get ingrediants from cook name using PHP api
$.ajax({
        type: 'post',
        url: "php/api.php",
        data: {"cook_name":cook_name},
        success: function(result){
        	// parse
                var parsed = JSON.parse(result);
        	var ings = parsed['info'];
        	// show cook name
        	$('#cook_name').text(parsed['cook_name']);
        	// show ingredients
        	for (var ing in ings){
        		// $('#ingredients').append('<tr><td>' + ing + '</td><td>' + ings[ing][0]['url'] + '</td><td>' + ings[ing][0]['img'] + '</td></tr>');
                        // ingredients name
                        add2ings(ings_start + ing + ings_end)
                        // init item
                        add_item(ings[ing][0]);
                        // more select button
                        add_more_button(counter);
                        // items
                        var h_items = ings_h_start1 + String(counter) + ings_h_start2;
                        for (var item of ings[ing]){
                                h_items += make_hidden_item(item, counter);
                        }
                        add2ings(h_items + ings_h_end);
                        // make class of item
                        disp_ing(counter);
                        // count up
                        counter += 1;
        	}
                // hide gif
                $('#loader-bg').fadeOut(800);
                $('#loader').delay(600).fadeOut(300);
        }
});
