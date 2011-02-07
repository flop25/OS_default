
<dt class="{$tab_spe}titre_acordeon"><a href="javascript:void(0);"><img src="{$ROOT_URL}{$themeconf.icon_dir}/menu/small_resizable.png" class="button_res" alt="[_]">{'Specials'|@translate}</a></dt>
<dd>
  <ul>
    {foreach from=$block->data item=link}
    <li><a href="{$link.URL}" title="{$link.TITLE}" {if isset($link.REL)}{$link.REL}{/if}>{$link.NAME}</a></li>
    {/foreach}
  </ul>
</dd>
