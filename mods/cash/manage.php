<?php
// ClanSphere 2008 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('cash');

empty($_REQUEST['start']) ? $start = 0 : $start = $_REQUEST['start'];
$cs_sort[1] = 'cash_time DESC';
$cs_sort[2] = 'cash_time ASC';
$cs_sort[3] = 'cash_money DESC';
$cs_sort[4] = 'cash_money ASC';
$cs_sort[5] = 'cash_inout DESC';
$cs_sort[6] = 'cash_inout ASC';
$cs_sort[7] = 'users_nick DESC';
$cs_sort[8] = 'users_nick ASC';
empty($_REQUEST['sort']) ? $sort = 1 : $sort = $_REQUEST['sort'];
$order = $cs_sort[$sort];
$cash_count = cs_sql_count(__FILE__,'cash');

echo cs_html_table(1,'forum',1);
echo cs_html_roco(1,'headb',0,3);
echo $cs_lang['mod'] . ' - ' . $cs_lang['head'];
echo cs_html_roco(0);
echo cs_html_roco(1,'leftb');
echo cs_icon('editpaste') . cs_link($cs_lang['new_cash'],'cash','create');
echo cs_html_roco(2,'leftb');
echo cs_icon('contents') . $cs_lang['total'] . ': ' . $cash_count;
echo cs_html_roco(2,'rightb');
echo cs_pages('cash','manage',$cash_count,$start,0,$sort);
echo cs_html_roco(0);
echo cs_html_roco(1,'leftb');
echo cs_icon('editpaste') . cs_link($cs_lang['kt'],'cash','account');
echo cs_html_roco(2,'leftb',0,2);
echo cs_icon('package_settings') . cs_link($cs_lang['options'],'cash','options');
echo cs_html_roco(0);
echo cs_html_table(0);
echo cs_html_br(1);

echo cs_getmsg();

echo cs_html_table(1,'forum',1);

$money = 0;
$where = "cash_inout = 'in'"; 
$cs_cash_overview = cs_sql_select(__FILE__,'cash','cash_money',$where,0,0,0);
$over_loop = count($cs_cash_overview);
for($run=0; $run<$over_loop; $run++) {
$money = $money + $cs_cash_overview[$run]['cash_money'];
}
$money_in = $money;
$money = 0;
$where = "cash_inout = 'out'"; 
$cs_cash_overview = cs_sql_select(__FILE__,'cash','cash_money',$where,0,0,0);
$over_loop = count($cs_cash_overview);
for($run=0; $run<$over_loop; $run++) {
$money = $money + $cs_cash_overview[$run]['cash_money'];
}
$money_out = $money;
$money_now = $money_in - $money_out;
echo cs_html_roco(1,'headb',0,3);
echo $cs_lang['mod'] . ' - ' . $cs_lang['overview'];
echo cs_html_roco(0);

$user_money = cs_sql_option(__FILE__,'cash');
$user_money = $user_money['month_out'];

echo cs_html_roco(1,'leftb');
echo cs_icon('money');
echo cs_html_roco(2,'rightb');
echo $cs_lang['month_out'];
echo cs_html_roco(3,'leftb');
echo $user_money['options_value'] . ' ' . $cs_lang['euro'];
echo cs_html_roco(0);

echo cs_html_roco(1,'leftb');
echo cs_icon('money');
echo cs_html_roco(2,'rightb');
echo $cs_lang['user_money'];
echo cs_html_roco(3,'leftb');
$users = cs_sql_count(__FILE__,'users','access_id >= 3');
$user_money = $user_money['options_value'] / $users;
$user_money = round($user_money, 2); 
echo $user_money . ' ' . $cs_lang['euro'];
echo cs_html_roco(0);

echo cs_html_roco(1,'leftb');
echo cs_icon('personal');
echo cs_html_roco(2,'rightb');
echo $cs_lang['akt_users_month'];
echo cs_html_roco(3,'leftb');

$mon  = cs_datereal('n');
$year = cs_datereal('Y'); 
$zahlungen = 0;
$tables = 'cash ca INNER JOIN {pre}_users usr ON ca.users_id = usr.users_id';
$cells = 'ca.cash_time AS cash_time, ca.cash_inout AS cash_inout, ca.users_id AS users_id, usr.users_nick AS users_nick, ca.cash_text AS cash_text';
$cells .= ', ca.cash_money AS cash_money, ca.cash_id AS cash_id';
$cash = cs_sql_select(__FILE__,$tables,$cells,"cash_inout = 'in'",0,0,0);
$cash_count = count($cash);
for($run=0; $run<$cash_count; $run++) {
$cash_year = substr($cash[$run]['cash_time'], 0, 4);
$cash_month = substr($cash[$run]['cash_time'], 5, 2);
	if($cash_year == $year AND ($cash_month == $mon)) {
		$zahlungen++;
	}
}
$users_link = $zahlungen . ' / ' . $users . ' - ' . $cs_lang['show'];
echo cs_link($users_link,'cash','view_cash');
echo cs_html_roco(0);

echo cs_html_roco(1,'leftb',0,0,10);
echo cs_html_img('symbols/clansphere/green.gif');
echo cs_html_roco(2,'rightb',0,0,20);
echo $cs_lang['in'];
echo cs_html_roco(3,'leftb');
echo cs_secure($money_in .' '. $cs_lang['euro']);
echo cs_html_roco(0);

echo cs_html_roco(1,'leftb',0,0,10);
echo cs_html_img('symbols/clansphere/red.gif');
echo cs_html_roco(2,'rightb',0,0,20);
echo $cs_lang['out'];
echo cs_html_roco(3,'leftb');
echo cs_secure($money_out .' '. $cs_lang['euro']);
echo cs_html_roco(0);

echo cs_html_roco(1,'leftc',0,0,10);
echo cs_html_img('symbols/clansphere/grey.gif');
echo cs_html_roco(2,'rightc',0,0,20);
echo $cs_lang['now'];
echo cs_html_roco(3,'leftc');
echo cs_secure($money_now .' '. $cs_lang['euro']);
echo cs_html_roco(0);
echo cs_html_table(0);
echo cs_html_br(1);

if(!empty($_GET['user'])) {
  $cs_cash = cs_sql_select(__FILE__,$tables,$cells,"ca.users_id = '" . $_GET['user'] . "'",$order,$start,$account['users_limit']);
} else {
  $cs_cash = cs_sql_select(__FILE__,$tables,$cells,0,$order,$start,$account['users_limit']);
}
$cash_loop = count($cs_cash);

echo cs_html_table(1,'forum',1);
echo cs_html_roco(1,'headb');
echo cs_sort('cash','manage',$start,0,7,$sort);
echo $cs_lang['nick'];
echo cs_html_roco(2,'headb');
echo cs_sort('cash','manage',$start,0,1,$sort);
echo $cs_lang['date'];
echo cs_html_roco(3,'headb');
echo $cs_lang['for'];
echo cs_html_roco(4,'headb');
echo cs_sort('cash','manage',$start,0,3,$sort);
echo $cs_lang['money'];
echo cs_html_roco(5,'headb');
echo cs_sort('cash','manage',$start,0,5,$sort);
echo cs_html_roco(6,'headb',0,2);
echo $cs_lang['options'];
echo cs_html_roco(0);

for($run=0; $run<$cash_loop; $run++) {
        
	echo cs_html_roco(1,'leftc');
	$data_users = cs_sql_select(__FILE__,'users','users_nick, users_id',"users_id = '" . $cs_cash[$run]['users_id'] . "'",'users_nick',0);
	echo cs_link($cs_cash[$run]['users_nick'],'cash','manage','user=' . $cs_cash[$run]['users_id']);
	echo cs_html_roco(2,'leftc');
	echo cs_date('date',$cs_cash[$run]['cash_time']);
    echo cs_html_roco(3,'leftc');
	$text1 = $cs_cash[$run]['cash_text'];
	$text2 = substr($text1, 0, 25);
	echo cs_secure($text2);
	echo cs_html_roco(4,'leftc');
	echo cs_secure($cs_cash[$run]['cash_money'] .' '. $cs_lang['euro']);
	echo cs_html_roco(5,'leftc');
	$inout = $cs_cash[$run]['cash_inout'];
	if ($inout == 'in') {
	$icon = 'green'; } else {
	if ($inout == 'out') {
	$icon = 'red'; }}
	echo cs_html_img('symbols/clansphere/' . $icon . '.gif');
	echo cs_html_roco(6,'leftc');
  	$img_edit = cs_icon('edit');
	echo cs_link($img_edit,'cash','edit','id=' . $cs_cash[$run]['cash_id'],0,$cs_lang['edit']);
  	echo cs_html_roco(7,'leftc');
	$img_del = cs_icon('editdelete');
  	echo cs_link($img_del,'cash','remove','id=' . $cs_cash[$run]['cash_id'],0,$cs_lang['remove']);
	echo cs_html_roco(0);
}

echo cs_html_table(0);

?>
