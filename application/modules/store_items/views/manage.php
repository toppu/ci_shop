<h2>Manage your items</h2>

<?php
if (isset($flash)) {
  echo $flash;
}

echo anchor('store_items/create', 'Create New Item');
?>

<br><br>
<?php
echo Modules::run('store_items/_display_items_table')
?>