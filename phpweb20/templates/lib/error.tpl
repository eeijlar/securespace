{if $error|@is_array || $error|strlen > 0}
    {assign var=hasError value=true}
{else}
    {assign var=hasError value=false}
{/if}
<div class="error"{if !$hasError} style="color:#FF0000" {else} style="color:#FF0000" {/if}>
    {if $error|@is_array}
        <ul>
            {foreach from=$error item=str}
                <li>{$str|escape}</li>
            {/foreach}
        </ul>
    {else}
        {$error|escape} 
    {/if}
</div>
