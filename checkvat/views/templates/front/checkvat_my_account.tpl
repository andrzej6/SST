{*
* History:
*
* 1.0 - First version (only for prestashop 1.4)
* 1.5 - Only for prestashop version 1.5
* 1.5.2 - Correction little bug when the group is "Client"
* 1.5.3 - Add possibility to valid if VIES is enable, Add table with last customers in the back office home page
* 1.5.4 - Allow group pro only (not default)
* 1.5.4.1 - optimisation when VIES is "out"
* 1.5.5 - Add VAT number in the invoice and add Croatia in the list of country
* 1.5.6 - little debug (VAT number also included in the footer of PDF)
* 1.6 - update for v1.6, add hookdashboardZoneTwo 
*
*  @author    Vincent MASSON <contact@coeos.pro>
*  @copyright Vincent MASSON <www.coeos.pro>
*  @license   http://www.coeos.pro/boutique/fr/content/3-conditions-generales-de-ventes
*}

	{if $bloc_checkvat}
		<li class="lnk_wishlist" id="check_vat" style="background-color:#FAE2E3;padding:10px;">
			<p id='title_check_vat'><strong>{l s='Your VAT' mod='checkvat'} : </strong></p>
				{if $msg_vat_invalid}<p style="color:red;"><strong>{l s='Sorry, invalid VAT number' mod='checkvat'}</strong></p>{/if}
				
				<form method="post" style="display:inline;">
					<input name="vat_number" type="text" value="{if isset($smarty.post.vat_number)}{$smarty.post.vat_number}{/if}"/>
					<input value="{l s='Save' mod='checkvat'}" type="submit"/>
				</form>
				
		</li>
	{/if}
	{if $msg_vat_valid}
		<p id="msg_vat_valid" style="{if $msg_vat_valid}background-color:#DFFAD3;padding:10px{/if}">
		<strong>{l s='Your VAT number is correct and has been successfully' mod='checkvat'}
		{if isset($validation_auto) AND $validation_auto == False}, 
		<span id="validation_auto">{l s='the webmaster will validate your account soon' mod='checkvat'}</span>{else}.{/if}
		</strong></p>
	{/if}
<!-- MODULE check_VAT by www.coeos.pro -->