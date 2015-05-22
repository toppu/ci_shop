<h2>Delete Item</h2>
<p>Are you sure that you want to delete the item?</p>

<?php
echo form_open($form_location);

echo form_submit('submit', 'Yes');

echo form_submit('submit', 'No');

echo form_close();
?>