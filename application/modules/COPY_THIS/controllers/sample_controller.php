<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Sample_controller extends MX_Controller
{

  function __construct() {
    parent::__construct();
  }

  function get($order_by) {
    $this->load->model('mdl_sample');
    $query = $this->mdl_sample->get($order_by);
    return $query;
  }

  function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_sample');
    $query = $this->mdl_sample->get_with_limit($limit, $offset, $order_by);
    return $query;
  }

  function get_where($id) {
    $this->load->model('mdl_sample');
    $query = $this->mdl_sample->get_where($id);
    return $query;
  }

  function get_where_custom($col, $value) {
    $this->load->model('mdl_sample');
    $query = $this->mdl_sample->get_where_custom($col, $value);
    return $query;
  }

  function _insert($data) {
    $this->load->model('mdl_sample');
    $this->mdl_sample->_insert($data);
  }

  function _update($id, $data) {
    $this->load->model('mdl_sample');
    $this->mdl_sample->_update($id, $data);
  }

  function _delete($id) {
    $this->load->model('mdl_sample');
    $this->mdl_sample->_delete($id);
  }

  function count_where($column, $value) {
    $this->load->model('mdl_sample');
    $count = $this->mdl_sample->count_where($column, $value);
    return $count;
  }

  function get_max() {
    $this->load->model('mdl_sample');
    $max_id = $this->mdl_sample->get_max();
    return $max_id;
  }

  function _custom_query($mysql_query) {
    $this->load->model('mdl_sample');
    $query = $this->mdl_sample->_custom_query($mysql_query);
    return $query;
  }

}