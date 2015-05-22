<h2><Assign Categoty</h2>

<?php
echo Modules::run('store_cat_assign/_draw_assigned_categories', $item_id);

$this->load->module('store_categories');
$available_categories = $this->store_categories->get_end_of_line_categories();
echo form_open($form_location);
?>

<select name="category_id">
  <?php
  foreach($available_categories as $option) {
    $breadcrumb = $this->store_categories->get_breadcrumb($option);
    $category_name = $this->store_categories->get_category_name($option);
    echo '<option value="'.$option.'"> '.$breadcrumb.' '.$category_name.'</option>';
  }
  ?>
</select>

<?php
echo nbs(3);
echo form_submit('submit', 'Submit');
echo nbs(3);
echo form_submit('submit', 'Finished');
echo form_close();
?>