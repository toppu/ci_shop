<select name="item_size" class="form-control">
  <option value="">Choose Size...</option>
  <?php
  foreach($query->result() as $row) {
    echo '<option value="'.$row->id.'">'.$row->item_size.'</option>';
  }

  ?>
</select>