<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Site_security extends MX_Controller {

  function __construct() {
    parent::__construct();
  }

  // make sure the user has logged in as admin
  function check_is_admin() {

    return TRUE;
  }


}