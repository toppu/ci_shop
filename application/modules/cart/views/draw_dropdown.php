<select name="item_qty" class="form-control">
  <option value="">Choose Quantity...</option>
  <?php
  for ($i=1; $i < 10; $i++) {
    echo '<option value="'.i.'">'.$i.'</option>';
  }
  ?>
</select>