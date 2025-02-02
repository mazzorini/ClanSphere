<?php
// ClanSphere 2010 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('computers');

if(isset($_POST['submit'])) {
  
  $save = [];
  $save['max_width'] = (int) $_POST['max_width'];
  $save['max_height'] = (int) $_POST['max_height'];
  $save['max_size'] = (int) $_POST['max_size'];

  require_once 'mods/clansphere/func_options.php';
  cs_optionsave('computers', $save);

  cs_redirect($cs_lang['changes_done'], 'options', 'roots');
  
} else {
  
  $data = [];
  $data['com'] = cs_sql_option(__FILE__, 'computers');

  echo cs_subtemplate(__FILE__, $data, 'computers', 'options');

}