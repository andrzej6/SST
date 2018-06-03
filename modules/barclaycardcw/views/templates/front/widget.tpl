
{capture name=path}{lcw s='Payment' mod='barclaycardcw'}{/capture}

<h1 class="page-heading">{lcw s='Payment' mod='barclaycardcw'}</h1>
{assign var='current_step' value='payment'}
{include file="$tpl_dir./order-steps.tpl"}

{$widget}
