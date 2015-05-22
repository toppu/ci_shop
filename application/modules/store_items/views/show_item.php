
<div class="container">
  <!-- Example row of columns -->
  <div class="row">
    <div class="col-md-4">
     <?php
     $pic_path = base_url()."upload/".$pic_big;
     ?>
      <img src="<?php echo $pic_path; ?>">
    </div>
    <div class="col-md-4">
      <h4>Item Name: <?php echo $item_name; ?></h4>
      <?php
      $currency = Modules::run('site_settings/get_currency');
      $item_price = number_format($item_price, 2);
      $item_price = str_replace('.00', '', $item_price);
      ?>
      <h4>Price: <?php echo $currency.$item_price; ?>
      <h5>Reference: <?php echo $item_asset_id; ?></h5>
      </h4>
      <p><?php echo nl2br($item_desc);?></p>
      <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a>

    </div>
    <div class="col-md-4">
      <?php
      echo Modules::run('cart/_display_add_to_cart_box', $item_id, $item_price);

      ?>
    </div>
  </div>
</div>