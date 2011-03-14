
{if isset($tab_system) && $tab_system && in_array($id, $tab_closed)}
<dt class="titre_acordeon">
{else}
<dt class="titre_acordeon_0">
{/if}
<a href="javascript:void(0);"><img src="{$ROOT_URL}{$themeconf.icon_dir}/menu/small_resizable.png" class="button_res" alt="[_]">{'Specials'|@translate}</a></dt>
<dd>
	<ul>{strip}
		{foreach from=$block->data item=link}
		<li><a href="{$link.URL}" title="{$link.TITLE}"{if isset($link.REL)} {$link.REL}{/if}>{$link.NAME}</a></li>
		{/foreach}
	{/strip}</ul>
</dd>
