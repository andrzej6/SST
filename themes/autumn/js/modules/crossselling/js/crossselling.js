/*
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
*/
$(window).load(function() {
    $('#crossselling-carousel').owlCarousel({
        itemsCustom: [ [0, 1], [379, 2], [419, 2], [479, 2], [639, 3], [767, 3], [959, 4], [1023, 4], [1279, 5], [1559, 5] ],
        responsiveRefreshRate: 50,
        slideSpeed: 200,
        paginationSpeed: 500,
        rewindSpeed: 600,
        rewindNav: true,
        pagination: true,
        navigation: true,
        navigationText: ['<div class="carousel-previous disable-select"><span class="wpicon wpicon-chevron-left medium"></span></div>', '<div class="carousel-next disable-select"><span class="wpicon wpicon-chevron-right medium"></span></div>']
    });
});