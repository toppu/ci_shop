<div id="add_to_cart_box">
Item Price: <?php echo $currency.$item_price; ?><br><br>

<?php
echo Modules::run('store_item_colours/_draw_dropdown', $item_id);
?><br>

<?php
echo Modules::run('store_item_sizes/_draw_dropdown', $item_id);
?><br>

<?php
echo Modules::run('cart/_draw_choose_qty_dropdown', $item_id);
?><br>

<button type="button" class="btn btn-primary">
  <span class="glyphicon glyphicon-plus"></span> Add to Basket
</button>

</div>