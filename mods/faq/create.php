<?php
// ClanSphere 2008 - www.clansphere.net
// Id: create.php (Mon Dec  1 20:23:45 CET 2008) fAY-pA!N

$cs_lang = cs_translate('faq');
require_once('mods/categories/functions.php');

$data['if']['preview'] = false;
  
if(isset($_POST['submit']) OR isset($_POST['preview'])) {
	
	$categories_id = empty($_POST['categories_id']) ? cs_categories_create('faq',$_POST['categories_name']) : (int) $_POST['categories_id'];
	$faq_userid = $account['users_id'];
	$faq_frage = empty($_POST['faq_frage']) ? '' : $_POST['faq_frage']; 
	$faq_antwort = empty($_POST['faq_antwort']) ? '' : $_POST['faq_antwort'];
	
	if(!empty($cs_main['fckeditor'])) {
  	  $faq_antwort = '[html]' . $faq_antwort . '[/html]';
	}
	
	$error = '';
	
	if(empty($categories_id)) {
		$error .= $cs_lang['no_cat'] . cs_html_br(1);
	}
	if(empty($faq_frage)) {
		$error .= $cs_lang['no_question'] . cs_html_br(1);
	}
	if(empty($faq_antwort)) {
		$error .= $cs_lang['no_answer'] . cs_html_br(1);
	}

} else {
	$categories_id = 0;
	$faq_userid = $account['users_id'];
	$faq_frage = '';
	$faq_antwort = '';
}

if(!isset($_POST['submit']) AND !isset($_POST['preview']) AND empty($error)) {
	$data['head']['body'] = $cs_lang['body_create'];
} elseif(!empty($error)) {
	$data['head']['body'] = $error;
} elseif(isset($_POST['preview'])) {
	$data['head']['body'] = $cs_lang['preview'];
}

if(isset($_POST['preview']) AND empty($error)) {

	$data['if']['preview'] = true;
  	$data['preview']['question'] = cs_secure($_POST['faq_frage']);
		
	if(!empty($cs_main['fckeditor'])) {
  		$faq_antwort = '[html]' . $_POST['faq_antwort'] . '[/html]';
  	}
	$data['preview']['answer'] = cs_secure($faq_antwort,1,1,1,1);

}

if(!empty($error) OR !isset($_POST['submit'])) {
		
	$data['faq']['cat'] = cs_categories_dropdown('faq',$categories_id);
	$data['faq']['frage'] = $faq_frage;

	if(empty($cs_main['fckeditor'])) {
		$data['abcode']['smileys'] = cs_abcode_smileys('faq_antwort');
		$data['abcode']['features'] = cs_abcode_features('faq_antwort',1);
		$data['if']['fckeditor'] = FALSE;
		$data['if']['nofckeditor'] = TRUE;
		$data['faq']['antwort'] = $faq_antwort;
	} else {
		$data['if']['fckeditor'] = TRUE;
		$data['if']['nofckeditor'] = FALSE;
		$data['faq']['content'] = cs_fckeditor('faq_antwort',$faq_antwort);
	}
	
	echo cs_subtemplate(__FILE__,$data,'faq','create');
	
}
else {
	
	$faq_cells = array('users_id','faq_question','faq_answer','categories_id');
	$faq_save = array($faq_userid,$faq_frage,$faq_antwort,$categories_id);
	cs_sql_insert(__FILE__,'faq',$faq_cells,$faq_save);
    
	cs_redirect($cs_lang['create_done'],'faq');

}

?>