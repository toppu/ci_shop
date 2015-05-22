<h2><?php echo $headline; ?></h2>

<?php
if (isset($flash)) {
  echo $flash;
}

if($new_category_allowed) {
  echo anchor('store_categories/create/x/' . $category_parent, 'Create New Category (on this level)');
}

if($category_parent>0) {
  echo nbs(3);
  echo anchor('store_categories/create/'.$category_parent, 'Update Parent Category Name');
}

?>

<br><br>
<?php
echo Modules::run('store_categories/_display_categories_table', $category_parent);
?>