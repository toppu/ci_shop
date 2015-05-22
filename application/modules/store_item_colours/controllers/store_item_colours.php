<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Store_item_colours extends MX_Controller
{

  function __construct() {
    parent::__construct();
  }

  function _draw_dropdown ($item_id) {
    $data['query'] = $this->get_where_custom('item_id', $item_id);
    $this->load->view('draw_dropdown', $data);
  }

  function _display_options_so_far($item_id) {
    $data['query'] = $this->get_where_custom('item_id', $item_id);
    $this->load->view('options_so_far', $data);
  }

  function delete($update_id) {
    Modules::run('site_security/check_is_admin');
    $this->_delete($update_id);
    $item_id = $this->uri->segment(4);
    redirect('store_item_colours/update/'.$item_id);
  }

  function update($item_id) {
    $submit = $this->input->post('submit', TRUE);
    $item_colour = trim($this->input->post('item_colour', TRUE));

    if($submit==="Cancel") {
      redirect('store_items/create/'.$item_id);
    }

    if(($submit==="Submit") && ($item_colour!=="")) {
      $data['item_id'] = $item_id;
      $data['item_colour'] = $item_colour;
      $this->_insert($data);
    }

    $data['form_location'] = current_url();
    $data['item_id'] = $item_id;
    $template = 'admin';
    $data['view_file'] = 'update';
    $this->load->module('template');
    $this->template->$template($data);
  }

  function get($order_by) {
    $this->load->model('mdl_store_item_colours');
    $query = $this->mdl_store_item_colours->get($order_by);
    return $query;
  }

  function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_store_item_colours');
    $query = $this->mdl_store_item_colours->get_with_limit($limit, $offset, $order_by);
    return $query;
  }

  function get_where($id) {
    $this->load->model('mdl_store_item_colours');
    $query = $this->mdl_store_item_colours->get_where($id);
    return $query;
  }

  function get_where_custom($col, $value) {
    $this->load->model('mdl_store_item_colours');
    $query = $this->mdl_store_item_colours->get_where_custom($col, $value);
    return $query;
  }

  function _insert($data) {
    $this->load->model('mdl_store_item_colours');
    $this->mdl_store_item_colours->_insert($data);
  }

  function _update($id, $data) {
    $this->load->model('mdl_store_item_colours');
    $this->mdl_store_item_colours->_update($id, $data);
  }

  function _delete($id) {
    $this->load->model('mdl_store_item_colours');
    $this->mdl_store_item_colours->_delete($id);
  }

  function count_where($column, $value) {
    $this->load->model('mdl_store_item_colours');
    $count = $this->mdl_store_item_colours->count_where($column, $value);
    return $count;
  }

  function get_max() {
    $this->load->model('mdl_store_item_colours');
    $max_id = $this->mdl_store_item_colours->get_max();
    return $max_id;
  }

  function _custom_query($mysql_query) {
    $this->load->model('mdl_store_item_colours');
    $query = $this->mdl_store_item_colours->_custom_query($mysql_query);
    return $query;
  }

}