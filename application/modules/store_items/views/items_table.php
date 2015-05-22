<table cellpadding="7" cellspacing="0" border="0" width="600">
  <tr>
    <th>Count</th>
    <th>Item Name</th>
    <th>Action</th>
  </tr>

  <?php
  $count = 0;
  foreach($query->result() as $row) {
    $count++;
    ?>
    <tr>
      <td><?php echo $count; ?></td>
      <td><?php echo $row->item_name ?></td>
      <td><?php echo anchor('store_items/create/' . $row->id, 'Edit Item') ?></td>
    </tr>

  <?php
  }
  ?>

</table>