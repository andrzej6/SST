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

<!DOCTYPE html>
<html lang="{$lang_iso}" style="height:100%">
    <head>
        <title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        {if isset($meta_description)}
            <meta name="description" content="{$meta_description|escape:'htmlall':'UTF-8'}" />
        {/if}
        {if isset($meta_keywords)}
            <meta name="keywords" content="{$meta_keywords|escape:'htmlall':'UTF-8'}" />
        {/if}
        <meta name="robots" content="{if isset($nobots)}no{/if}index,follow" />
        <link rel="shortcut icon" href="{$favicon_url}" />
        <link href="{$css_dir}/wp_framework/reset.css" rel="stylesheet" type="text/css" />
        <link href="{$css_dir}/wp_framework/layout.css" rel="stylesheet" type="text/css" />
        <link href="{$css_dir}/wp_framework/responsive.css" rel="stylesheet" type="text/css" />
        <link href="{$css_dir}autumn.css" rel="stylesheet" type="text/css" />
    </head>
    <body id="maintenance" class="maintenance" style="height:100%">
        <div id="wrapper">
            <div class="row">
                <div class="column col-12-12">
                    <div id="logo">
                        <img src="{$logo_url}" {if $logo_image_width}width="{$logo_image_width}"{/if} {if $logo_image_height}height="{$logo_image_height}"{/if} alt="logo" />
                    </div>
                    <div id="message">
                        <div>{l s='In order to perform website maintenance, our online store will be temporarily offline.'}</div>
                        <div>{l s='We apologize for the inconvenience and ask that you please try again in 5 MINUTES.'}</div>
                    </div>
                    {$HOOK_MAINTENANCE}
                </div>
            </div>
        </div>
    </body>
</html>
