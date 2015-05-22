<h2>Update Item Sizes</h2>
<div id="leftside">

<p>Please enter a size and then press 'Submit.'</p>

<?php
echo form_open($form_location);
echo form_input('item_size', '');
echo form_submit('submit', 'Submit');
echo form_submit('submit', 'Cancel');
echo form_close();
?>
</div>

<div id="rightside">
  <?php
  echo Modules::run('store_item_sizes/_display_options_so_far', $item_id);
  ?>
</div>

