<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class cart extends MX_Controller
{

  function __construct() {
    parent::__construct();
  }

  function _draw_choose_qty_dropdown($item_id) {
    $data['item_id'] = $item_id;
    $this->load->view('draw_dropdown', $data);
  }

  function _display_add_to_cart_box($item_id, $item_price) {
    $data['item_id'] = $item_id;
    $data['item_price'] = $item_price;
    $data['currency'] = Modules::run('site_settings/get_currency');
    $this->load->view('add_to_cart_box', $data);
  }

  function get($order_by) {
    $this->load->model('mdl_cart');
    $query = $this->mdl_cart->get($order_by);
    return $query;
  }

  function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_cart');
    $query = $this->mdl_cart->get_with_limit($limit, $offset, $order_by);
    return $query;
  }

  function get_where($id) {
    $this->load->model('mdl_cart');
    $query = $this->mdl_cart->get_where($id);
    return $query;
  }

  function get_where_custom($col, $value) {
    $this->load->model('mdl_cart');
    $query = $this->mdl_cart->get_where_custom($col, $value);
    return $query;
  }

  function _insert($data) {
    $this->load->model('mdl_cart');
    $this->mdl_cart->_insert($data);
  }

  function _update($id, $data) {
    $this->load->model('mdl_cart');
    $this->mdl_cart->_update($id, $data);
  }

  function _delete($id) {
    $this->load->model('mdl_cart');
    $this->mdl_cart->_delete($id);
  }

  function count_where($column, $value) {
    $this->load->model('mdl_cart');
    $count = $this->mdl_cart->count_where($column, $value);
    return $count;
  }

  function get_max() {
    $this->load->model('mdl_cart');
    $max_id = $this->mdl_cart->get_max();
    return $max_id;
  }

  function _custom_query($mysql_query) {
    $this->load->model('mdl_cart');
    $query = $this->mdl_cart->_custom_query($mysql_query);
    return $query;
  }

}