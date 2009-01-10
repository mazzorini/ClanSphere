<?php
// ClanSphere 2008 - www.clansphere.net
// $Id$

function cs_update_rss($mod,$action,$name,$desc,$array) {

  global $cs_main;
  $cs_main['rss'] = 1;
  $target = 'uploads/rss/';

  if(is_writeable($target)) {
    include_once('system/output/rss_20.php');
    $content = cs_rss_mode(1);
    $page = 'http://' . $_SERVER['HTTP_HOST'];
    $content .= cs_rss_channel(1,$mod,$name,$page,$desc);
    if(!empty($array)) {
        foreach($array AS $item) {
            if(!empty($item['id']) AND !empty($item['title']) AND !empty($item['text'])) {
                $title = htmlspecialchars($item['title'],ENT_QUOTES);
				$save = $cs_main['php_self']['basename'];
				$cs_main['php_self']['basename'] = 'index.php';
                $link = $page . cs_url($mod,$action,'id=' . $item['id']);
				$cs_main['php_self']['basename'] = $save;
                
				if(!empty($item['readmore'])) {
				  $text = '<![CDATA[ ' . cs_secure($item['readmore'],1,0,0) . cs_html_br(2) . cs_secure($item['text'],1,0,0) . ' ]]>';
				}
				else {
				  $text = '<![CDATA[ ' . cs_secure($item['text'],1,0,0) . ' ]]>';
				}
				
                $date = empty($item['time']) ? 0 : date('D, d M Y H:i:s',$item['time']) . ' +0000';
                $author = empty($item['author']) ? 0 : $item['author'];
                $author .= empty($item['nick']) ? '' : ' (' . cs_secure($item['nick']) . ')';
                $category = empty($item['cat']) ? 0 : htmlspecialchars($item['cat'],ENT_QUOTES);
                $content .= cs_rss_item($title, $link, $text, $date, $author, $category);
            }
        }
    }
    $content .= cs_rss_channel(0);
    $content .= cs_rss_mode(0);

    $save_file = fopen($target . $mod . '.xml','w');
    fwrite($save_file,$content);
    fclose($save_file);
    @chmod($target . $mod . '.xml',0644);
  }
  else {
		cs_error($target,'cs_update_rss - Unable to write into directory');
  }
  $cs_main['rss'] = 0;
}

?>