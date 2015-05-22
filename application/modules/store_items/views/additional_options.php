<h2>Additional Options</h2>

<ul>
  <li><?php echo anchor('store_item_colours/update/'.$item_id, 'Update Item Colours'); ?></li>
  <li><?php echo anchor('store_item_sizes/update/'.$item_id, 'Update Item Sizes'); ?></li>
  <li><?php echo anchor('store_items/upload_pic/'.$item_id, 'Update Item Picture'); ?></li>
  <li><?php echo anchor('store_cat_assign/assign/'.$item_id, 'Assign Category'); ?></li>
  <li><?php echo anchor('store_items/delete/'.$item_id, '<span style="color: red;">Delete Item</span>'); ?></li>
</ul>