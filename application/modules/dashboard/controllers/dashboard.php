<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MX_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper('url');
  }

  function home() {
    $template = 'admin';
    $data['view_file'] = 'home';
    $this->load->module('template');
    $this->load->template->$template($data);
  }

}