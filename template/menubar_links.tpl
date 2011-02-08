{if isset($tab_system) && $tab_system && in_array($id, $tab_closed)}
<dt class="titre_acordeon">
{else}
<dt class="titre_acordeon_0">
{/if}
<a href="javascript:void(0);"><img src="{$ROOT_URL}{$themeconf.icon_dir}/menu/small_resizable.png" class="button_res" alt="[_]">{'Links'|@translate}</a></dt>
<dd>
	<ul>
		{foreach from=$block->data item=link}
			<li>
				<a href="{$link.URL}" class="external" 
					{if isset($link.new_window) } onclick="window.open(this.href, '{$link.new_window.NAME}','{$link.new_window.FEATURES}'); return false;"{/if}
				>
				{$link.LABEL}
				</a>
			</li>
		{/foreach}
	</ul>
</dd>