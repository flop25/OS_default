<?php
/*
Theme Name: OS_default
Version: auto
Description: 
Theme URI: http://piwigo.org/ext/extension_view.php?eid=497
Author: flop25
Author URI: http://www.planete-flop.fr
*/
$themeconf = array(
  'name'         => 'OS_default',
  'parent'        => 'default',
  'icon_dir'      => 'themes/OS_default/icon',
  'mime_icon_dir' => 'themes/OS_default/icon/mimetypes/',
  'local_head'    => 'local_head.tpl',
  'activable' => false,
	'add_menu_on_public_pages'			=> true,	# activation
	'Exclude'			=> array('theNBMPage','thePicturePage','thePopuphelpPage',),	# Excluded pages
);



add_event_handler('loc_begin_picture', 'pwg_v');
function  pwg_v() {
  global $template;
  $template->assign(
  array(
    'PHPWG_VERSION' => PHPWG_VERSION,
  ));
}
/*********************************menu on every pages ************************************/
// thx to Vdigital and his plugin spreadmenus
if ( !function_exists( 'add_menu_on_public_pages' ) ) {
	if ( defined('IN_ADMIN') and IN_ADMIN ) return false;
	add_event_handler('loc_after_page_header', 'add_menu_on_public_pages', 20);

	function  add_menu_on_public_pages() {
	  if ( function_exists( 'initialize_menu') ) return false; # The current page has already the menu 
	  if ( !get_themeconf('add_menu_on_public_pages') ) return false; # The current page has already the menu 
	  global $template, $page, $conf;
	  if ( isset($page['body_id']) and in_array($page['body_id'], get_themeconf('Exclude')) ) return false;

	  $template->set_filenames(array(
		'add_menu_on_public_pages' => dirname(__FILE__) . '/template/add_menu_on_public_pages.tpl',
	  ));
	  include_once(PHPWG_ROOT_PATH.'include/menubar.inc.php');
	  $template->parse('add_menu_on_public_pages');
	  
	  if (is_admin())
		{
	  $template->assign(
        'U_ADMIN', get_root_url().'admin.php?page=picture_modify'
      .'&amp;cat_id='.(isset($page['category']) ? $page['category']['id'] : '')
      .( isset($page['image_id']) ? '&amp;image_id='.$page['image_id'] : '')
      );
		}
	  
	}
}


// function load_pattern
// include the right ***.pattern.php
// not compatible 2.2and<2.2

function load_pattern()
{
  global $pattern;
  $pwgversion=str_replace('.','',PHPWG_VERSION);
  $pwgversion_array=explode('.', PHPWG_VERSION);
  if (file_exists($pwgversion.'pattern.php'))
  {
    include($pwgversion.'.pattern.php');
    return true;
  }
  elseif (file_exists(PHPWG_ROOT_PATH.'themes/OS_default/'.$pwgversion_array[0].$pwgversion_array[1].'x.pattern.php'))
  {
    include(PHPWG_ROOT_PATH.'themes/OS_default/'.$pwgversion_array[0].$pwgversion_array[1].'x.pattern.php');
    return true;
  }
  else
  {
    $list_pattern_path=array();
    $dir=PHPWG_ROOT_PATH.'themes/OS_default';
    $dh = opendir($dir);
    while (($file = readdir ($dh)) !== false ) {
      if ($file !== '.' && $file !== '..') {
        $path =$dir.'/'.$file;
        if (!is_dir ($path)) { 
          if(strpos($file,'pattern.php')!==false) { //On ne prend que les .pattern.php
            $list_pattern_path[]=$file;
          }
        }
      }
    }
    closedir($dh);
    $f=0;
    for($i = 10; $i >=0; $i--)
    {
      if (in_array($pwgversion_array[0].$i.'.pattern.php',$list_pattern_path))
      {
        include($pwgversion_array[0].$i.'.pattern.php');
        return true;
        $f=1;
        break;
      }
    }
    if ($f=0)
    {
      return false;
    }
  }
  
}
if(!load_pattern())
{
  global $page;
  $page['errors'][]='Theme not compatible';
}
add_event_handler('loc_end_index', 'OS_default_index');
function OS_default_index()
{
  global $template;
  $template->set_prefilter('index', 'OS_default_prefilter_index');
}
function OS_default_prefilter_index($content, &$smarty)
{
  global $pattern;
  $r=$pattern['OS_default_prefilter_index']['R'];
  $ps=$pattern['OS_default_prefilter_index']['S'];
  foreach($r as $i => $pr)
  {
    $content = str_replace($ps[$i], $pr, $content);
  }
  return $content;
}

add_event_handler('loc_begin_picture', 'OS_default_picture');
function OS_default_picture()
{
  global $template;
  $template->set_prefilter('picture', 'OS_default_prefilter_picture');
}
function OS_default_prefilter_picture($content, &$smarty)
{
  global $pattern;
  $r=$pattern['OS_default_prefilter_picture']['R'];
  $ps=$pattern['OS_default_prefilter_picture']['S'];
  foreach($r as $i => $pr)
  {
    $content = preg_replace($ps[$i], $pr, $content);
  }
  return $content;
}
?>