$(function () {
  $('#itemArea dd.Buy[id]')
    .each(function () {
      var $this = $(this);
      $this.append(
      '<form method="post" data-timesale-id="' + $this.attr('id')
       + '" action="https://basket.step.rakuten.co.jp/rms/mall/bs/cartadd/set" target="_blank">
       個数
       <input value="1" type="text" size="4" name="units" id="units" class="rItemUnits">
       <input value="この商品を購入する" type="submit" id="" data-timesale-id="" class="rCartBtn">
       <input value="ES01_003_001" type="hidden" name="__event">
       <input value="[ショップID]" type="hidden" name="shop_bid">
       <input value="'
       + $this.attr('id')
       + '" type="hidden" name="item_id">
       <input value="1" type="hidden" name="inventory_flag">
       </form>'
       );
  });
});