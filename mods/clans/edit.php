<?php
// ClanSphere 2010 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('clans');
$files = cs_files();

$clans_id = $_REQUEST['id'];
settype($clans_id, 'integer');

$op_clans = cs_sql_option(__FILE__, 'clans');
$img_filetypes = ['gif','jpg','png'];

$users_nick = '';
$cs_clans['users_id'] = 0;

if(isset($_POST['submit'])) {
  $cs_clans['clans_name'] = $_POST['clans_name'];
  $cs_clans['clans_short'] = $_POST['clans_short'];
  $cs_clans['clans_tag'] = $_POST['clans_tag'];  
  $cs_clans['clans_tagpos'] = $_POST['tag_pos'];  
  $cs_clans['clans_country'] = $_POST['clans_country'];  
  $cs_clans['clans_url'] = $_POST['clans_url'];
  $cs_clans['clans_since'] = cs_datepost('since', 'date');
  
  $picture = cs_sql_select(__FILE__, 'clans', 'clans_picture', "clans_id = " . (int)$clans_id);
  
  $cs_clans['clans_picture'] = empty($_POST['clans_picture']) ? $picture['clans_picture'] : $_POST['clans_picture'];
  $cs_clans['clans_pwd'] = $_POST['clans_pwd'];

  $users_nick = empty($_REQUEST['users_nick']) ? '' : $_REQUEST['users_nick'];

  $error = 0;
  $errormsg = '';

  $where = "users_nick = '" . cs_sql_escape($users_nick) . "'";
  $users_data = cs_sql_select(__FILE__, 'users', 'users_id', $where);
  if(empty($users_data['users_id']))
    $users_nick = '';
  else
    $cs_clans['users_id'] = $users_data['users_id'];

  if(isset($_POST['delete'])) {
    cs_unlink('clans', $cs_clans['clans_picture']);
    $cs_clans['clans_picture'] = '';
  }

  if (!empty($files['picture']['tmp_name']))
    $img_size = getimagesize($files['picture']['tmp_name']);
  else
    $img_size = 0;
  
  if(!empty($files['picture']['tmp_name']) AND empty($img_size) OR $img_size[2] > 3) {
    $errormsg .= $cs_lang['ext_error'] . cs_html_br(1);
  $error++;
  }
  elseif(!empty($files['picture']['tmp_name'])) {
    switch($img_size[2]) {
    case 1:
      $ext = 'gif'; break;
    case 2:
      $ext = 'jpg'; break;
    case 3:
      $ext = 'png'; break;
  }
  $filename = 'picture-' . $clans_id . '.' . $ext;
    
  if($img_size[0]>$op_clans['max_width']) {
    $errormsg .= $cs_lang['too_wide'] . cs_html_br(1);
    $error++;
  }
  
  if($img_size[1]>$op_clans['max_height']) { 
    $errormsg .= $cs_lang['too_high'] . cs_html_br(1);
    $error++;
  }
  
  if($files['picture']['size']>$op_clans['max_size']) { 
    $errormsg .= $cs_lang['too_big'] . cs_html_br(1);
    $error++;
  }
  
  if(empty($error) AND cs_upload('clans', $filename, $files['picture']['tmp_name']) OR !empty($error) AND extension_loaded('gd') AND cs_resample($files['picture']['tmp_name'], 'uploads/clans/' . $filename, $op_clans['max_width'], $op_clans['max_height'])) {
    $error = 0;
    $errormsg = '';
    
  if($cs_clans['clans_picture'] != $filename AND !empty($cs_clans['clans_picture'])) {
      cs_unlink('clans', $cs_clans['clans_picture']);
    }
  
  $cs_clans['clans_picture'] = $filename;
  }
  else {
    $errormsg .= $cs_lang['up_error'];
    $error++;
  }
}

if(empty($cs_clans['clans_name'])) {
  $error++;
  $errormsg .= $cs_lang['no_name'] . cs_html_br(1);
}

if(empty($cs_clans['clans_short'])) {
  $error++;
  $errormsg .= $cs_lang['no_short'] . cs_html_br(1);
}
  
$where = "clans_name = '" . cs_sql_escape($cs_clans['clans_name']) . "'";
$where .= " AND clans_id != " . (int)$clans_id;
$search = cs_sql_count(__FILE__, 'clans', $where);

if(!empty($search)) {
  $error++;
  $errormsg .= $cs_lang['name_exists'] . cs_html_br(1);
  }
}
else {
  $cells = 'clans_name, clans_short, clans_tag, clans_tagpos, clans_country, clans_url, clans_since, clans_pwd, clans_picture, users_id';
  $cs_clans = cs_sql_select(__FILE__, 'clans', $cells, "clans_id = " . (int)$clans_id);
  $cs_users = cs_sql_select(__FILE__, 'users', 'users_nick', 'users_id = ' . (int) $cs_clans['users_id']);
  $users_nick = $cs_users['users_nick'];
}

if(!isset($_POST['submit'])) {
  $data['lang']['body'] = $cs_lang['errors_here'];
}

if(!empty($error)) {
  $data['lang']['body'] = $errormsg;
}

if(!empty($error) OR !isset($_POST['submit'])) {
  $data['lang']['mod'] = $cs_lang[$op_clans['label']];
  $data['clans']['name'] = cs_secure($cs_clans['clans_name']);
  $data['clans']['short'] = cs_secure($cs_clans['clans_short']);
  $data['clans']['tag'] = cs_secure($cs_clans['clans_tag']);  
  
  if($cs_clans['clans_tagpos'] == '1') {
    $data['select']['before'] = 'selected="selected"';
  }
  else {
    $data['select']['before'] = '';
  }
  
  if($cs_clans['clans_tagpos'] == '2') {
    $data['select']['next'] = 'selected="selected"';
  }
  else {
    $data['select']['next'] = '';
  }
    
  $el_id = 'country_1';
  $onc = "document.getElementById('" . $el_id . "').src='" . $cs_main['php_self']['dirname'] . "symbols/countries/' + this.form.";
  $onc .= "clans_country.options[this.form.clans_country.selectedIndex].value + '.png'";
  $data['clans']['country'] = cs_html_select(1, 'clans_country', "onchange=\"" . $onc . "\"");
  include_once('lang/' . $account['users_lang'] . '/countries.php');
  
  foreach ($cs_country AS $short => $full) {
    $short == $cs_clans['clans_country'] ? $sel = 1 : $sel = 0;
    $data['clans']['country'] .= cs_html_option($full, $short, $sel);
  }
  
  $data['clans']['country'] .= cs_html_select(0) . ' ' . cs_html_img('symbols/countries/' . $cs_clans['clans_country'] . '.png', 11, 16, 'id="' . $el_id . '"');
  $data['clans']['url'] = cs_secure($cs_clans['clans_url']);
  $data['clans']['since'] = cs_dateselect('since', 'date', $cs_clans['clans_since']);
  $data['clans']['password'] = cs_secure($cs_clans['clans_pwd']);

  $data['users']['nick'] = $users_nick;
  
  if(empty($cs_clans['clans_picture'])) {
    $data['clans']['pic'] = $cs_lang['nopic'];
  }
  else {
  $place = 'uploads/clans/' . $cs_clans['clans_picture'];
    $size = getimagesize($cs_main['def_path'] . '/' . $place);
    $data['clans']['pic'] = cs_html_img($place, $size[1], $size[0]);
  }

  $matches[1] = $cs_lang['pic_infos'];
  $return_types = '';
  foreach($img_filetypes AS $add) {
    $return_types .= empty($return_types) ? $add : ', ' . $add;
  }
  $matches[2] = $cs_lang['max_width'] . $op_clans['max_width'] . ' px' . cs_html_br(1);
  $matches[2] .= $cs_lang['max_height'] . $op_clans['max_height'] . ' px' . cs_html_br(1);
  $matches[2] .= $cs_lang['max_size'] . cs_filesize($op_clans['max_size']) . cs_html_br(1);
  $matches[2] .= $cs_lang['filetypes'] . $return_types;
  $data['clans']['clip'] = cs_abcode_clip($matches);
  $data['data']['id'] = $clans_id;

  echo cs_subtemplate(__FILE__, $data, 'clans', 'edit');
}
else {
  $clans_cells = array_keys($cs_clans);
  $clans_save = array_values($cs_clans);
  cs_sql_update(__FILE__, 'clans', $clans_cells, $clans_save, $clans_id);
  
  cs_redirect($cs_lang['changes_done'], 'clans') ;
}
