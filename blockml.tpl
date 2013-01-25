<!-- Block ML module -->
<!--
/*
 * Module ......: blockml
 * File ........: blockml.tpl
 * Description .: Simple Prestashop Module to able Mercado Livre Link on Template
 * Authot ......: Luis Machado Reis <luis.reis@singularideas.com.br>
 * Licence .....: GNU Lesser General Public License V3
 * Created .....: 01/09/2010
 */
-->
{if $enabled and $enabled == 'true'}
<div id="tags_block_left" class="block tags_block">
	<h4>{l s='Mercado Livre' mod='blockml'}</h4>
	<p class="block_content" style="text-align:right">
    {if $type == 'customer'}
    	{if $customerSize == 'normal'}
		<a href="http://lista.mercadolivre.com.br/_CustId_{$customerId}" title="Mercado Livre" target="_blank">
        {else}
		<a href="http://lista.mercadolivre.com.br/_CustId_{$customerId}_DisplayType_G" title="Mercado Livre" target="_blank">
        {/if}
    {else}
    	&nbsp;
		<a href="http://eshops.mercadolivre.com.br/{$eshopId}" title="E-shop Mercado Livre" target="_blank">
    {/if}
    <img src="{$linkPrefixImg}/logo.gif" alt="Mercado Livre" border="0"/>
    </a>
	</p>
</div>
{/if}
<!-- /Block ML module -->
