<?php
// ClanSphere 2008 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('links');
require_once('mods/categories/functions.php');
 
$img_max['width'] = 470;
$img_max['height'] = 100;
$img_max['size'] = 256000;
$img_filetypes = array('image/pjpeg' => 'jpg','image/jpeg' => 'jpg','image/gif' => 'gif');

echo cs_html_table(1,'forum',1);
echo cs_html_roco(1,'headb');
echo $cs_lang['mod'] . ' - ' . $cs_lang['head2'];
echo cs_html_roco(0);
echo cs_html_roco(1,'leftb');
echo $cs_lang['body_create'];
echo cs_html_roco(0);
echo cs_html_table(0);
echo cs_html_br(1);

$links_error = 5; 
$links_form = 1; 
$symbol = '';
$links_name = ''; 
$categories_id = empty($_POST['categories_id']) ? 0 : $_POST['categories_id'];
$links_info = '';
$links_url = '';
$links_stats = '';
$links_sponsor = 0;
$errormsg = '';

if(!empty($_POST['links_url'])) {
	$links_url = $_POST['links_url'];
	$links_error--;
}
if(!empty($_POST['links_info'])) {
	$links_info = $_POST['links_info'];
	$links_error--;
    if(!empty($cs_main['fckeditor'])) {
  	  $links_info = '[html]' . $links_info . '[/html]';
	}
}
if(!empty($_POST['links_name'])) {
	$links_name = $_POST['links_name'];
	$links_error--;
}  
if(!empty($_POST['links_stats'])) {
	$links_stats = $_POST['links_stats'];
	$links_error--;
}

$categories_id = empty($_POST['categories_name']) ? $categories_id : cs_categories_create('links',$_POST['categories_name']);

if(!empty($categories_id)) {
	$links_error--;
}
$links_sponsor = empty($_POST['links_sponsor']) ? 0 : $_POST['links_sponsor'];

if(!empty($_FILES['symbol']['tmp_name'])) {
    $symbol_error = 1;
    $errormsg .= $cs_lang['ext_error'] . cs_html_br(1);
      foreach($img_filetypes AS $allowed => $new_ext) {
        if($allowed == $_FILES['symbol']['type']) {
          $errormsg = '';
          $symbol_error = 0;
          $extension = $new_ext;
        } 
      }
      $img_size = getimagesize($_FILES['symbol']['tmp_name']);
      if($img_size[0]>$img_max['width']) {
      $errormsg .= $cs_lang['too_wide'] . cs_html_br(1); 
        $symbol_error++;
      }
      if($img_size[1]>$img_max['height']) { 
      $errormsg .= $cs_lang['too_high'] . cs_html_br(1);
        $symbol_error++;
      }
      if($_FILES['symbol']['size']>$img_max['size']) {
      $errormsg .= $cs_lang['too_big'] . cs_html_br(1); 
        $symbol_error++;
      }
    }

if(isset($_POST['submit'])) {
	if(empty($links_error) AND empty($symbol_error)) {
		$links_form = 0;
		
    $awards_cells = array('categories_id','links_name','links_url','links_info','links_stats','links_sponsor');
    $awards_save = array($categories_id,$links_name,$links_url,$links_info,$links_stats,$links_sponsor);
    cs_sql_insert(__FILE__,'links',$awards_cells,$awards_save);
    
    if(!empty($_FILES['symbol']['tmp_name']) AND $symbol_error == 0) {
      $where = "links_name = '" . cs_sql_escape($links_name) . "'";
      $getid = cs_sql_select(__FILE__,'links','links_id',$where);
      $filename = $getid['links_id'] . '.' . $extension;
      
      if (cs_upload('links',$filename,$_FILES['symbol']['tmp_name'])) {
        $link_cells1 = array('links_banner');
        $link_save1 = array($filename);
        cs_sql_update(__FILE__,'links',$link_cells1,$link_save1,$getid['links_id']);
      } else {
        $msg = $cs_lang['success_noup'];
      }
    }
    
    cs_redirect($cs_lang['create_done'],'links');
	}
	else {  
	        echo cs_html_table(1,'forum',1);
		echo cs_html_roco(1,'leftc');
		echo cs_icon('important');
		echo $cs_lang['error_occurred'];
		echo ' - ';
		echo cs_secure ($links_error).' '.$cs_lang['error_count'];
		echo cs_html_br(1);
		echo $errormsg;
		echo cs_html_roco(0);
		echo cs_html_table(0);
		echo cs_html_br(1);
	}
}

if(!empty($links_form)) {

	echo cs_html_form (1,'awards_create','links','create',1);
	echo cs_html_table(1,'forum',1);
	echo cs_html_roco(1,'leftc');
	echo cs_icon('kedit') . $cs_lang['name']. ' *';
	echo cs_html_roco(2,'leftb');
	echo cs_html_input('links_name',$links_name,'text',200,50);
	echo cs_html_roco(0);
  
        echo cs_html_roco(1,'leftc');
	echo cs_icon('folder_yellow') . $cs_lang['categories']. ' *';
	echo cs_html_roco(2,'leftb');
	echo cs_categories_dropdown('links',$categories_id);
        echo cs_html_roco(0);
        
        echo cs_html_roco(1,'leftc');
	echo cs_icon('gohome') . $cs_lang['url']. ' *';
	echo cs_html_roco(2,'leftb');
	echo cs_secure('http://');
	echo cs_html_input('links_url',$links_url,'text',200,50);
	echo cs_html_roco(0); 

	echo cs_html_roco(1,'leftc');
	echo cs_icon('multimedia') . $cs_lang['status']. ' *';
	echo cs_html_roco(2,'leftb');
	$linksstat[0]['links_stats'] = 'on';
        $linksstat[0]['name'] = $cs_lang['online1'];
        $linksstat[1]['links_stats'] = 'off';
        $linksstat[1]['name'] = $cs_lang['offline1'];
        echo cs_dropdown('links_stats','name',$linksstat,$links_stats);
	echo cs_html_roco(0);

  if(empty($cs_main['fckeditor'])) {
    echo cs_html_roco(1,'leftc');
	echo cs_icon('kate') . $cs_lang['info']. ' *';
    echo cs_html_br(2);
    echo cs_abcode_smileys('links_info');
	echo cs_html_roco(2,'leftb');
    echo cs_abcode_features('links_info');
	echo cs_html_textarea('links_info',$links_info,'50','15');
	echo cs_html_roco(0);
  } else {
    echo cs_html_roco(1,'leftc',0,2);
	echo cs_icon('kate') . $cs_lang['info']. ' *';
	echo cs_html_roco(0);
	echo cs_html_roco(1,'leftb" style="padding: 0px',0,2);
	echo cs_fckeditor('links_info',$links_info);
	echo cs_html_roco(0);
  }	
	

        echo cs_html_roco(1,'leftc');
    	echo cs_icon('images') . $cs_lang['icon'];
    	echo cs_html_roco(2,'leftb');
    	echo cs_html_input('symbol',$symbol,'file');
    	echo cs_html_br(2);
    	$matches[1] = $cs_lang['pic_infos'];
	$return_types = '';
	foreach($img_filetypes AS $add => $value) {
		$return_types .= empty($return_types) ? $add : ', ' . $add;
	}
	$matches[2] = $cs_lang['max_width'] . $img_max['width'] . ' px' . cs_html_br(1);
	$matches[2] .= $cs_lang['max_height'] . $img_max['height'] . ' px' . cs_html_br(1);
	$matches[2] .= $cs_lang['max_size'] . cs_filesize($img_max['size']) . cs_html_br(1);
	$matches[2] .= $cs_lang['filetypes'] . $return_types;
	echo cs_abcode_clip($matches);
    	echo cs_html_roco(0);
    	
    	echo cs_html_roco(1,'leftc');
	echo cs_icon('configure') . $cs_lang['extension'];
	echo cs_html_roco(2,'leftb');
	echo cs_html_vote('links_sponsor','1','checkbox',$links_sponsor) .' ';
	echo $cs_lang['sponsorbox'];
	echo cs_html_roco(0); 

	echo cs_html_roco(1,'leftc');
	echo cs_icon('ksysguard') . $cs_lang['options'];
	echo cs_html_roco(2,'leftb');
	echo cs_html_vote('submit',$cs_lang['create'],'submit');
	echo cs_html_vote('reset',$cs_lang['reset'],'reset');
	echo cs_html_roco(0);
	echo cs_html_table(0);
	echo cs_html_form (0);
}

?>
