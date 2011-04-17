{if !empty($blocks) }

{if isset($blocks.mbMenu)}
{assign var='block' value=$blocks.mbMenu}
{assign var='myblock' value=$blocks.mbCategories } 
{include file=$block->template|@get_extent:'mbMenu' }
{/if}
<div id="menubar">
  <table id="table_menu" cellspacing="0" cellpadding="0" border="0" >
    <tr id="up">
      <td class="mb_left">&nbsp;</td>
      <td class="mb_middle">&nbsp;</td>
      <td class="mb_right">&nbsp;</td>
    </tr>
    {foreach from=$blocks key=id item=block}
    {if ( not empty($block->template) or not empty($block->raw_content) ) and $id != 'mbMenu'}
    <tr id="tr_{$id}" class="middle">
      <td class="mb_left">&nbsp;</td>
      <td class="mb_middle">
        <dl id="{$id}">
          {if not empty($block->template)}
          {include file=$block->template|@get_extent:$id }
          {else}
          {$block->raw_content|@default}
          {/if}
        </dl></td>
      <td class="mb_right">&nbsp;</td>
    </tr>
    {/if}
    {/foreach}
    <tr id="bottom">
      <td class="mb_left">&nbsp;</td>
      <td class="mb_middle">&nbsp;</td>
      <td class="mb_right">&nbsp;</td>
    </tr>
  </table>
</div>
{/if} 