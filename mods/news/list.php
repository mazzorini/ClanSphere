<?php
// ClanSphere 2008 - www.clansphere.net
// $Id$

$cs_lang = cs_translate('news');
$cs_post = cs_post('where,start,sort');
$cs_get = cs_get('where,start,sort');

$cat_id = empty($cs_get['where']) ? 0 : $cs_get['where'];
if (!empty($cs_post['where']))  $cat_id = $cs_post['where'];
$start = empty($cs_get['start']) ? 0 : $cs_get['start'];
if (!empty($cs_post['start']))  $start = $cs_post['start'];
$sort = empty($cs_get['sort']) ? 1 : $cs_get['sort'];
if (!empty($cs_post['sort']))  $sort = $cs_post['sort'];

$where = "nws.news_public > 0 AND cat.categories_access <= '" . $account['access_news'] . "'";
if(!empty($cat_id)) {
	$where .= " AND cat.categories_id = '" . $cat_id . "'";
}

$cs_sort[1] = 'news_time DESC';
$cs_sort[2] = 'news_time ASC';
$cs_sort[3] = 'news_headline DESC';
$cs_sort[4] = 'news_headline ASC';
$order = $cs_sort[$sort];

$data['head']['mod'] = $cs_lang['head_mod'];
$data['head']['action'] = $cs_lang['list'];
$data['lang']['all'] = $cs_lang['total'].':';
$join = 'news nws INNER JOIN {pre}_categories cat ON nws.categories_id = cat.categories_id';
$data['head']['news_count'] = cs_sql_count(__FILE__,$join,$where,'news_id');
$data['head']['pages'] = cs_pages('news','list',$data['head']['news_count'],$start,$cat_id,$sort);
$data['lang']['category'] = $cs_lang['category'];
$newsmod = "categories_mod = 'news' AND categories_access <= '" . $account['access_news'] . "'";
$categories_data = cs_sql_select(__FILE__,'categories','*',$newsmod,'categories_name',0,0);
$data['head']['dropdown'] = cs_dropdown('where','categories_name',$categories_data,$cat_id,'categories_id');
$data['head']['button'] = cs_html_vote('submit',$cs_lang['show'],'submit');

$select = 'nws.news_headline AS news_headline, nws.news_time AS news_time, nws.news_id AS news_id';
$cs_news = cs_sql_select(__FILE__,$join,$select,$where,$order,$start,$account['users_limit']);
$news_loop = count($cs_news);

$data['sort']['news_time'] = cs_sort('news','list',$start,$cat_id,1,$sort);
$data['lang']['date'] = $cs_lang['date'];
$data['sort']['news_headline'] = cs_sort('news','list',$start,$cat_id,3,$sort);
$data['lang']['headline'] = $cs_lang['headline'];

for($run=0; $run<$news_loop; $run++) {

	$cs_news[$run]['news_time'] = cs_date('unix',$cs_news[$run]['news_time'],1);
	$sec_head = cs_secure($cs_news[$run]['news_headline']);
	$cs_news[$run]['news_headline'] = cs_link($sec_head,'news','view','id=' . $cs_news[$run]['news_id']);
}

$data['news'] = $cs_news;
echo cs_subtemplate(__FILE__,$data,'news','list');

?>