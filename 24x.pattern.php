<?php
$pattern['OS_default_prefilter_index']['S']['table_content_begin']='<div id="content" class="content{if isset($MENUBAR)} contentWithMenu{/if}">';
$pattern['OS_default_prefilter_index']['R']['table_content_begin']='<div id="content" class="content{if isset($MENUBAR)} contentWithMenu{/if}">
  <table id="table_content" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td id="section_up_left">&nbsp;</td>
      <td id="section_up">
';
$pattern['OS_default_prefilter_index']['S']['div_titrePage_deletion']='</div>{* <!-- titrePage --> *}';
$pattern['OS_default_prefilter_index']['R']['div_titrePage_deletion']='';
$pattern['OS_default_prefilter_index']['S']['div_titrePage_embed']='<h2>{$TITLE}</h2>';
$pattern['OS_default_prefilter_index']['R']['div_titrePage_embed']='<h2>{$TITLE}</h2>
	</div>{* <!-- titrePage --> *}  
	  </td>
      <td id="section_up_right">&nbsp;</td>
    </tr>
    <tr>
      <td id="section_left">&nbsp;</td>
      <td id="section_in">';
$pattern['OS_default_prefilter_index']['S']['table_content_end']='{if !empty($PLUGIN_INDEX_CONTENT_END)}{$PLUGIN_INDEX_CONTENT_END}{/if}';
$pattern['OS_default_prefilter_index']['R']['table_content_end']='{if !empty($PLUGIN_INDEX_CONTENT_END)}{$PLUGIN_INDEX_CONTENT_END}{/if}
      </td>
	  <td id="section_right">&nbsp;</td>
    </tr>
    <tr>
      <td id="section_bottom_left">&nbsp;</td>
      <td id="section_bottom" >&nbsp;</td>
      <td id="section_bottom_right" >&nbsp;</td>
    </tr>
  </table>
';
$pattern['OS_default_prefilter_picture']['S']['div_imageInfos_deletion']='#<div id="imageInfos">.*<dl id="standard" class="imageInfoTable">#s';
$pattern['OS_default_prefilter_picture']['R']['div_imageInfos_deletion']='<dl id="standard" class="imageInfoTable">';
?>