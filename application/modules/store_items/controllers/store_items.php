<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Store_items extends MX_Controller {

  function __construct() {
    parent::__construct();
  }

  function show($item_id) {
    $data = $this->get_data_from_db($item_id);
    $template = 'public_one_col';
    $data['view_file'] = 'show_item';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function upload_success($item_id) {
    $query = $this->get_where($item_id);
    foreach($query->result() as $row) {
      $data['pic_big'] = $row->pic_big;
    }

    $data['item_id'] = $item_id;
    $template = 'admin';
    $data['view_file'] = 'upload_success';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function do_upload($item_id) {
    Modules::run('site_security/check_is_admin');

    $config['upload_path'] = './upload/';
    $config['allowed_types'] = 'gif|jpg|jpeg|png';
    $config['max_size']	= '1000';
    $config['max_width']  = '2024';
    $config['max_height']  = '2768';

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload()) {
      $data['error'] = array('error' => $this->upload->display_errors("<p style='color: red;'>", "</p>"));
      $data['item_id'] = $item_id;
      $template = 'admin';
      $data['view_file'] = "upload_pic";
      $this->load->module('template');
      $this->template->$template($data);
      //$this->load->view('upload_form', $error);
    } else {
      //$data = array('upload_data' => $this->upload->data());
      //$this->load->view('upload_success', $data);
      $data = $this->upload->data();
      $file_name = $data['file_name']; // the name of the file that is now uploaded
      $file_raw_name = $data['raw_name'];
      $file_ext = $data['file_ext'];

      // create a thumbnail
      $config['image_library'] = 'gd2';
      $config['source_image']	= './upload/'.$file_name;
      $config['create_thumb'] = TRUE;
      $config['maintain_ratio'] = TRUE;
      $config['width']	= 137;
      $config['height']	= 137;

      $this->load->library('image_lib', $config);
      $this->image_lib->resize();

      // resize the larger picture (make it 400px * 400px)
      $new_width = 400;
      $new_height = 400;
      $this -> _resize_pic($file_name, $new_width, $new_height);

      // update the database
      unset($data);
      $data['pic_small'] = $file_raw_name.'_thumb'.$file_ext;
      $data['pic_big'] = $file_name;
      $this->_update($item_id, $data);

      // redirect to a success page
      redirect('store_items/upload_success/'.$item_id);
    }
  }

  // resize a new uploaded image
  function _resize_pic($file_name, $new_width, $new_height) {
    Modules::run('site_security/check_is_admin');
    $config['image_library'] = 'gd2';
    $config['source_image']	= './upload/'.$file_name;
    $config['create_thumb'] = FALSE;
    $config['maintain_ratio'] = TRUE;
    $config['width']	= $new_width;
    $config['height']	= $new_height;

    $this->image_lib->initialize($config);

    $this->load->library('image_lib', $config);
    $this->image_lib->resize();

  }

  function upload_pic($item_id) {
    $data['item_id'] = $item_id;
    $template = 'admin';
    $data['view_file'] = 'upload_pic';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function _display_items_table() {
    $data['query'] = $this->get('item_name');
    $this->load->view('items_table', $data);
  }

  function get_data_from_post() {
    $data['item_name'] = $this->input->post('item_name', TRUE);
    $data['item_price'] = $this->input->post('item_price', TRUE);
    $data['item_desc'] = $this->input->post('item_desc', TRUE);
    return $data;
  }

  function get_data_from_db($item_id) {
    $query = $this->get_where($item_id);
    foreach($query->result() as $row) {
      $data['item_id'] = $row->id;
      $data['item_asset_id'] = $row->item_asset_id;
      $data['item_name'] = $row->item_name;
      $data['item_price'] = $row->item_price;
      $data['item_desc'] = $row->item_desc;
      $data['item_url'] = $row->item_url;
      $data['pic_small'] = $row->pic_small;
      $data['pic_big'] = $row->pic_big;
    }

    if (!isset($data)) {
      $data = "";
    }
    return $data;
  }

  function create() {
    $item_id = $this->uri->segment(3);
    $data = $this->get_data_from_post();
    $submit = $this->input->post('submit', TRUE);

    if ($item_id > 0) {
      // form has NOT been posted yet, so read from the database
      if($submit != "Submit") {
        $data = $this->get_data_from_db($item_id);
      }

      $data['headline'] = 'Edit Item';

    } else {
      $data['headline'] = 'Create New Item';
    }

    $current_url = current_url();
    $data['form_location'] = str_replace('/create', '/submit', $current_url);

    // Add flash message, just before we bring up a template
    $flash = $this->session->flashdata('item');
    if($flash != "") {
      $data['flash'] = $flash;
    }

    $data['item_id'] = $item_id;
    $template = 'admin';
    $data['view_file'] = 'create';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function delete($item_id) {
    $submit = $this->input->post('submit', TRUE);
    if ($submit === "No") {
      redirect('store_items/create/'.$item_id);
    }

    if ($submit === "Yes") {
      $this->_delete($item_id);
      $value = "<p style='color: green;'> The item was successfully deleted </p>";
      $this->session->set_flashdata('item', $value);
      redirect('store_items/manage');

    }

    $data['item_id'] = $item_id;
    $template = 'admin';
    $data['form_location'] = current_url();
    $data['view_file'] = 'delete';
    $this->load->module('template');
    $this->template->$template($data);

  }

  // submit form
  function submit() {

    $this->load->library('form_validation');

    $this->form_validation->set_rules('item_name', 'Item Name', 'required');
    $this->form_validation->set_rules('item_price', 'Item Price', 'is_numeric|required');
    $this->form_validation->set_rules('item_desc', 'Item Description', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->create();
    } else {
      $update_id = $this->uri->segment(3);

      if ($update_id>0) {
        // edit
        $data = $this->get_data_from_post();
        $data['item_url'] = url_title($data['item_name']);
        $this -> _update($update_id, $data);
        $value = "<p style='color: green;'> The item was successfully edited </p>";
      } else {
        // create
        $data = $this->get_data_from_post();
        $data['item_url'] = url_title($data['item_name']);
        $this -> _insert($data);
        $value = "<p style='color: green;'> The item was successfully created </p>";
        $update_id = $this->get_max();
      }

      // add flashdata
      $this->session->set_flashdata('item', $value);

      //$max_id = $this->get_max();
      redirect('store_items/create/'.$update_id);
    }

  }

  function manage() {

    $flash = $this->session->flashdata('item');
    if($flash != "") {
      $data['flash'] = $flash;
    }

    $template = 'admin';
    $data['view_file'] = 'manage';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function get($order_by) {
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get($order_by);
    return $query;
  }

  function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_with_limit($limit, $offset, $order_by);
    return $query;
  }

  function get_where($id) {
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where($id);
    return $query;
  }

  function get_where_custom($col, $value) {
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->get_where_custom($col, $value);
    return $query;
  }

  function _insert($data) {
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_insert($data);
  }

  function _update($id, $data) {
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_update($id, $data);
  }

  function _delete($id) {
    $this->load->model('mdl_store_items');
    $this->mdl_store_items->_delete($id);
  }

  function count_where($column, $value) {
    $this->load->model('mdl_store_items');
    $count = $this->mdl_store_items->count_where($column, $value);
    return $count;
  }

  function get_max() {
    $this->load->model('mdl_store_items');
    $max_id = $this->mdl_store_items->get_max();
    return $max_id;
  }

  function _custom_query($mysql_query) {
    $this->load->model('mdl_store_items');
    $query = $this->mdl_store_items->_custom_query($mysql_query);
    return $query;
  }

}