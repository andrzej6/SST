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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<!-- resultC.html $Revision$ -->
<html lang="<wpdisplay msg=lang.code.name>">
<head>
{if $redirect_enabled}
<meta http-equiv="refresh" content="{$redirect_time|intval}; URL={$redirect_url|escape:'html'}">
{/if}
<title><wpdisplay msg=result.cancel></title>
<style type="text/css">
{literal}
	body {background-color: <wpdisplay disp=body.bg>; <wpdisplay disp=body.bg.image pre=" background-image: url('" post="');"> margin: 0;}
	table.header { background-color: <wpdisplay disp=header.bg>; width: 760px; border: 0;}
	td.headerlogo1 {background-color: <wpdisplay disp=header.bg>; vertical-align: <wpdisplay disp=header.logo1.valign>; width: 383px; text-align: <wpdisplay disp=header.logo1.halign>;}
	td.headerlogo2 {background-color: <wpdisplay disp=body.bg>; vertical-align: <wpdisplay disp=header.logo2.valign>; width: 272px; text-align: <wpdisplay disp=header.logo2.halign>;}
	table.nav { background-image:url('/images/wp/navbar.gif'); width: 760px; border: 0;}
	table.container { background-color: <wpdisplay disp=wp.container.border.bg>; width: <wpdisplay disp=wp.container.width>; border: 0;}
	td.title { background-color: <wpdisplay disp=title.bg>; width: 100%; border: 0;}
	table.containercell { background-color: <wpdisplay disp=1.bg>; width: 100%; border: <wpdisplay disp=wp.container.cellBorder>;}
	td.bannercontainer { background-color: <wpdisplay disp=banner.border.bg>; width: <wpdisplay disp=banner.width empty=95%>; border: <wpdisplay disp=banner.cellBorder>; margin-right: auto; margin-left: auto;}
	table.banner { background-color: <wpdisplay disp=banner.bg>; width: <wpdisplay disp=banner.width>; vertical-align: <wpdisplay disp=header.logo2.valign>; text-align: <wpdisplay disp=header.logo2.halign>; border: <wpdisplay disp=banner.cellBorder>; border-color: <wpdisplay disp=banner.border.bg>;}
	td.banner { background-color: <wpdisplay disp=banner.bg>; vertical-align: top; text-align: left; border: <wpdisplay disp=banner.cellBorder>;}
	td.bannererror { background-color: <wpdisplay disp=banner.bg>; vertical-align: top; text-align: center;}
	h1 {font-size: <wpdisplay fontsize=|disp=title.font.size empty=|disp=title.font.size>; font-family: <wpdisplay disp=title.font>; color: <wpdisplay disp=title.fg>;}
	A.header:Link {text-decoration: none; color: <wpdisplay disp=header.font.fg>; font-family: <wpdisplay disp=header.font>; font-size: <wpdisplay fontsize=|disp=header.font.size empty=|disp=header.font.size>; font-weight: bold;}
	A.header:Visited {text-decoration: none; color: <wpdisplay disp=header.font.fg>; font-family: <wpdisplay disp=header.font>; font-size: <wpdisplay fontsize=|disp=header.font.size empty=|disp=header.font.size>; font-weight: bold;}
	A.header:Active {text-decoration: none; color: <wpdisplay disp=header.font.fg>; font-family: <wpdisplay disp=header.font>; font-size: <wpdisplay fontsize=|disp=header.font.size empty=|disp=header.font.size>; font-weight: bold;}
	A.header:Hover {text-decoration: underlined; color: <wpdisplay disp=header.font.ahover.fg>; font-family: <wpdisplay disp=header.font>; font-size: <wpdisplay fontsize=|disp=header.font.size empty=|disp=header.font.size>; font-weight: bold;}
	td.footerdivider {<wpdisplay disp=footer.divider.bg.image pre=" background-image: url('" post="');">; vertical-align: <wpdisplay disp=footer.valign>; text-align: <wpdisplay disp=footer.halign>;}
	td.footer {background-color: <wpdisplay disp=body.bg>; vertical-align: <wpdisplay disp=footer.valign>; text-align: <wpdisplay disp=footer.halign>;}
{/literal}
</style>
<wpdisplay file=head.html>
</head>
<wpdisplay file=header.html default="<body><table><tr><td><table><tr><td><table><tr><td>">
	<table class="container" cellpadding="<wpdisplay disp=wp.container.border.width>" cellspacing="0" align="center">
		<tr>
			<td>
				<!-- the main content table -->
				<table class="containercell" cellspacing="<wpdisplay disp=wp.container.cellSpacing>" cellpadding="<wpdisplay disp=wp.container.cellPadding>">
					<tr>
						<td class="title">
							<!-- page title -->
							<h1><wpdisplay msg=resultC.name></h1>
							<!--  end page title -->
						</td>
					</tr>
					<tr>
						<td valign="top" align="left"><wpdisplay item=banner default=""></td>
					</tr>
					<tr>
						<td class="one" valign="top" align="right">
							<nobr>
								<a style="text-decoration:none;" href="{$redirect_url|escape:'html'}">
									<img style="border:0px;" alt="<wpdisplay msg=result.redirectToMerchant>" src="<wpdisplay disp=startAgain.button>">
								</a>
								<span style=" font-family: <wpdisplay disp=startAgain.button.font>; font-size: 12pt; color: <wpdisplay disp=startAgain.button.fg>;">
									<b><wpdisplay msg=result.redirectToMerchant></b>
								</span>
							</nobr>
						</td>
					</tr>
				<wpdisplay file=tableFoot.html default="</table></td></tr></table>">
<wpdisplay file=footer.html default="</td></tr></table></td></tr></table></td></tr></table></body>">
</html>
