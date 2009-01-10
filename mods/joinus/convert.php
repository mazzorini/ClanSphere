<?php
// ClanSphere 2008 - www.clansphere.net
// Id: convert.php (Tue Nov 25 12:37:53 CET 2008) fAY-pA!N

$cs_lang = cs_translate('joinus');
$cs_get = cs_get('id');
$data = array();

$joinus_id = empty($cs_get['id']) ? 0 : $cs_get['id'];

$data['url']['convert_user'] = cs_url('users','create','joinus=' . $joinus_id);
$data['url']['convert_member'] = cs_url('members','create','joinus=' . $joinus_id);

echo cs_subtemplate(__FILE__,$data,'joinus','convert');


?>