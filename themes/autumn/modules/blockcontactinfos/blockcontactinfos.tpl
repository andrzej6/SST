{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA

*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<div id="block_contact_infos" class="footer-block item">
    <h4>{l s='Store Information' mod='blockcontactinfos'}<span class="wpicon wpicon-plus small"></span></h4>
    <div>
        <ul class="toggle-footer list-icon-custom">
            {if $blockcontactinfos_company != ''}
                <li>
                    <span class="wpicon wpicon-location medium"></span>
                    {$blockcontactinfos_company|escape:'html':'UTF-8'}{if $blockcontactinfos_address != ''}, {$blockcontactinfos_address|escape:'html':'UTF-8'}{/if}
                </li>
            {/if}
            {if $blockcontactinfos_phone != ''}
                <li>
                    <span class="wpicon wpicon-phone medium"></span>{l s='Call us now:' mod='blockcontactinfos'}
                    <span>{$blockcontactinfos_phone|escape:'html':'UTF-8'}</span>
                </li>
            {/if}
            {if $blockcontactinfos_email != ''}
                <li>
                    <span class="wpicon wpicon-envelop medium"></span>{l s='Email:' mod='blockcontactinfos'}
                    <span>{mailto address=$blockcontactinfos_email|escape:'html':'UTF-8' encode="hex"}</span>
                </li>
            {/if}
        </ul>
    </div>
</div>