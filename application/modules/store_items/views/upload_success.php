<h2>Upload Success</h2>

<p>The image was successfully uploaded.</p>

<p>
<?php
echo anchor('store_items/create/'.$item_id, 'Return to edit item.');
echo '</p>';

if (isset($pic_big)) {
  $pic_path = base_url().'upload/'.$pic_big;
  echo '<p>';
  echo "<img src='".$pic_path."'>";
  echo '</p>';
}
