<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class store_categories extends MX_Controller
{

  function __construct() {
    parent::__construct();
  }

  function get_breadcrumb($category_id) {
    $breadcrumb = "";

    do {
      if (!isset($category_parent)) {
        $category_parent = $category_id;
      }

      $category_parent = $this->get_category_parent($category_parent);

      if($category_parent>0) {
        $parents[] = $category_parent;
      }

    } while ($category_parent != "");

    if(isset($parents)){
      $parents = array_reverse($parents);
      foreach($parents as $parent) {
        $category_name = $this->get_category_name($parent);
        $breadcrumb .= $category_name." > ";
      }
    }

    return $breadcrumb;
  }

  function get_end_of_line_categories() {
    $max_depth = Modules::run('site_settings/get_max_category_depth');

    $query = $this->get('category_name');
    foreach($query->result() as $row) {
      $category_id = $row->id;
      $category_parent = $row->category_parent;
      $category_depth = $this->get_category_depth($category_parent);

      // end of line category
      if($category_depth===$max_depth){
        $categories[] = $category_id;
      }
    }

    if(!isset($categories)) {
      $categories="";
    }

    return $categories;
  }

  function _is_new_category_allowed($category_parent) {
    $max_depth = Modules::run('site_settings/get_max_category_depth');
    $current_depth = $this->get_category_depth($category_parent);
    if ($current_depth<$max_depth) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  // check how many layers deep a category is, based on the parent category
  function get_category_depth($category_parent) {
    $depth = 0;
    do {
      $depth++;
      $category_parent = $this->get_category_parent($category_parent);
    } while ($category_parent!=="");

    return $depth;
  }

  function get_category_parent($id) {
    $query = $this->get_where($id);
    foreach($query->result() as $row) {
      $category_parent = $row->category_parent;
    }

    if (!isset($category_parent)) {
      $category_parent = "";
    }

    return $category_parent;
  }

  function _display_categories_table($category_parent) {
    $data['query'] = $this->get_where_custom('category_parent', $category_parent);
    $this->load->view('categories_table', $data);
  }

  function get_data_from_post() {
    $data['category_name'] = $this->input->post('category_name', TRUE);
    return $data;
  }

  function get_data_from_db($category_id)
  {
    $query = $this->get_where($category_id);
    foreach ($query->result() as $row) {
      $data['category_name'] = $row->category_name;
      $data['priority'] = $row->priority;
    }
    return $data;
  }

  // submit form
  function submit() {
    $category_parent = $this->uri->segment(4);

    if (!is_numeric($category_parent)) {
      $category_parent = 0;
    }

    $this->load->library('form_validation');

    $this->form_validation->set_rules('category_name', 'Category Name', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $update_id = $this->uri->segment(3);

      if ($update_id>0) {
        // edit
        $data = $this->get_data_from_post();
        $data['category_url'] = url_title($data['category_name']);
        $this -> _update($update_id, $data);
        $value = "<p style='color: green;'> The category was successfully edited </p>";
        $category_parent = $update_id;
      } else {
        // create
        $data = $this->get_data_from_post();
        $data['category_url'] = url_title($data['category_name']);
        $data['category_parent'] = $category_parent;
        $this -> _insert($data);
        $value = "<p style='color: green;'> The category was successfully created </p>";
        $update_id = $this->get_max();
      }

      // add flashdata
      $this->session->set_flashdata('item', $value);

      //$max_id = $this->get_max();
      redirect('store_categories/manage/'.$category_parent);
    }

  }

  function create() {
    $category_id = $this->uri->segment(3);
    $data = $this->get_data_from_post();
    $submit = $this->input->post('submit', TRUE);

    if ($category_id > 0) {
      // form has NOT been posted yet, so read from the database
      if($submit != "Submit") {
        $data = $this->get_data_from_db($category_id);
      }

      $data['headline'] = 'Edit category';

    } else {
      $data['headline'] = 'Create New category';
    }

    $current_url = current_url();
    $data['form_location'] = str_replace('/create', '/submit', $current_url);

    // Add flash message, just before we bring up a template
    $flash = $this->session->flashdata('item');
    if($flash != "") {
      $data['flash'] = $flash;
    }

    $data['category_id'] = $category_id;
    $template = 'admin';
    $data['view_file'] = 'create';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function delete($category_id) {
    $submit = $this->input->post('submit', TRUE);
    if ($submit === "No") {
      redirect('store_categories/create/'.$category_id);
    }

    if ($submit === "Yes") {
      $this->_delete($category_id);
      $value = "<p style='color: green;'> The category was successfully deleted </p>";
      $this->session->set_flashdata('item', $value);
      redirect('store_categories/manage');

    }

    $data['category_id'] = $category_id;
    $template = 'admin';
    $data['form_location'] = current_url();
    $data['view_file'] = 'delete';
    $this->load->module('template');
    $this->template->$template($data);

  }

  function get_category_name($id) {
    $data = $this->get_data_from_db($id);
    $category_name = $data['category_name'];
    return $category_name;
  }

  function manage() {
    $category_parent = $this->uri->segment(3);
    if (($category_parent<1) || (!is_numeric($category_parent))) {
      $category_parent = 0;
    }

    $data['category_parent'] = $category_parent;

    if($category_parent>0) {
      $data['headline'] = 'Manage '.$this->get_category_name($category_parent);
    } else {
      $data['headline'] = 'Manage Store Categories';
    }

    $flash = $this->session->flashdata('item');
    if($flash != "") {
      $data['flash'] = $flash;
    }

    $data['new_category_allowed'] = $this->_is_new_category_allowed($category_parent);

    $template = 'admin';
    $data['view_file'] = 'manage';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function get($order_by) {
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get($order_by);
    return $query;
  }

  function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_with_limit($limit, $offset, $order_by);
    return $query;
  }

  function get_where($id) {
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_where($id);
    return $query;
  }

  function get_where_custom($col, $value) {
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->get_where_custom($col, $value);
    return $query;
  }

  function _insert($data) {
    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_insert($data);
  }

  function _update($id, $data) {
    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_update($id, $data);
  }

  function _delete($id) {
    $this->load->model('mdl_store_categories');
    $this->mdl_store_categories->_delete($id);
  }

  function count_where($column, $value) {
    $this->load->model('mdl_store_categories');
    $count = $this->mdl_store_categories->count_where($column, $value);
    return $count;
  }

  function get_max() {
    $this->load->model('mdl_store_categories');
    $max_id = $this->mdl_store_categories->get_max();
    return $max_id;
  }

  function _custom_query($mysql_query) {
    $this->load->model('mdl_store_categories');
    $query = $this->mdl_store_categories->_custom_query($mysql_query);
    return $query;
  }

}