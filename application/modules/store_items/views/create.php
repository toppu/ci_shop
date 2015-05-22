<h2><?php echo $headline; ?></h2>
<div id="leftside">
<?php

if (isset($flash)) {
  echo $flash;
}

echo validation_errors("<p style='color: red;'>", "</p>");
echo form_open($form_location);
?>

<table cellpadding="7" cellspacing="0" border="0" width="600">
  <tr>
    <td>Item Name</td>
    <td><?php echo form_input('item_name', $item_name); ?></td>
  </tr>
  <tr>
    <td valign="top">Item Price></td>
    <td><?php echo form_input('item_price', $item_price); ?></td>
  </tr>
  <tr>
    <td valign="top">Item Description</td>
    <td><?php echo form_textarea('item_desc', $item_desc); ?></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td><?php echo form_submit('submit', 'Submit'); ?></td>
  </tr>
</table>

<?php
echo form_close();
?>
</div>

<div id="rightside">
  <?php
  if ($item_id > 0) {
    // we are editing an item!
    include('additional_options.php');
  }

  ?>

</div>