<html>
  <head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/admin.css">
  </head>
  <body style="background-color: cyan;">
    <div id = "container">
      <table>
      <tr>
        <td height="600" valign="top">
          <h1><?php echo anchor('/dashboard/home', 'Admin panel'); ?></h1>
          <?php
          if (!isset($module)) {
            $module = $this->uri->segment(1);
          }

          if (!isset($view_file)) {
            $view_file = $this->uri->segment(2);
          }

          if(($module!="") && ($view_file!="")) {
            $path = $module."/".$view_file;
            $this->load->view($path);
          }
          ?>

        </td>
      </tr>
      </table>
    </div>
  </body>
</html>
