<select name="item_colour" class="form-control">
  <option value="">Choose Colour...</option>
<?php

foreach($query->result() as $row) {
  echo '<option value="'.$row->id.'">'.$row->item_colour.'</option>';
}

?>
</select>