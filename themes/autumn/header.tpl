{* 2014 - Autumn Prestashop Theme - Sercan YEMEN - twitter.com/sercan *}<!DOCTYPE HTML><html lang="{$lang_iso}">	<head>		<title>{$meta_title|escape:'html':'UTF-8'}</title>        {if isset($meta_description) AND $meta_description}		    <meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />        {/if}        {if isset($meta_keywords) AND $meta_keywords}		    <meta name="keywords" content="{$meta_keywords|escape:'html':'UTF-8'}" />        {/if}        {* General meta tags *}		<meta charset="utf-8" />        {*        below replaced due to html validation error        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />        *}        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />        <meta name="generator" content="PrestaShop" />        <meta name="google-site-verification" content="aQu7rXCWaxVBaDC6esgAQp0p8p53RjqME26WrsU49E0" />		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />				<link href="https://plus.google.com/+Sitstand-Megastore/about" rel="Publisher" />        {* End - General meta tags *}        {* Disable IE Compat Mode tag *}        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge" />-->        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->        {* End - Disable IE Compat Mode tag *}        {* Meta data for Facebook*}        <meta property="og:title" content="{$meta_title|escape:'htmlall':'UTF-8'}" />        <meta property="og:type"   content="product" />        {if isset($page_name) && $page_name == "product" && isset($have_image) && $have_image}            <meta property="og:image" content="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'atmn_large')}" />        {/if}        {* End - Meta data for Facebook *}        {* Apple mobile specific meta tags *}        <meta name="apple-mobile-web-app-capable" content="yes" />        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />        {* End -  Apple mobile specific meta tags *}        {if isset($css_files)}            {foreach from=$css_files key=css_uri item=media}                <link rel="stylesheet" href="{$css_uri}" type="text/css" media="{$media}" />            {/foreach}        {/if}        {* IE9 specific styles - lovely, isn't it? *}        <!--[if IE 9]> <link rel="stylesheet" href="{$css_dir}ie/ie9.css" type="text/css" media="all" /><![endif]-->        {* End - IE specific styles *}        {if (isset($WPAC_customCSS))}        <!-- Start Custom CSS -->            <style>{$WPAC_customCSS}</style>        <!-- End Custom CSS -->        {/if}				{if $page_name == 'contact'}      <script type="text/javascript">        var allowSubmit = false;        function capcha_filled () {            allowSubmit = true;        }        function capcha_expired () {            allowSubmit = false;        }        var onloadCallback = function() {            grecaptcha.render('html_element', {            'sitekey':'6LenhkcUAAAAAPJPkm-N_Z2e7Jh_R0RayRjHPtDX',            'callback': capcha_filled,            'expired-callback': capcha_expired            });           };        function check_if_capcha_is_filled () {            if(allowSubmit) return true;            alert('Please check the capcha!');            return false;        }        </script>				        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"        async defer></script>							{/if}        		{literal}		<!-- Hotjar Tracking Code for sit-stand.com --><script type="text/javascript">    (function(h,o,t,j,a,r){        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};        h._hjSettings={hjid:803441,hjsv:6};        a=o.getElementsByTagName('head')[0];        r=o.createElement('script');r.async=1;        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;        a.appendChild(r);    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');</script>				{/literal}  		{$HOOK_HEADER}	</head>	<body itemscope itemtype="http://schema.org/WebPage" {if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if} class="{if isset($page_name)}{$page_name|escape:'html':'UTF-8'}{/if}{if isset($body_classes) && $body_classes|@count} {implode value=$body_classes separator=' '}{/if}{if $hide_left_column} hide-left-column{/if}{if $hide_right_column} hide-right-column{/if}{if $content_only} content_only{/if} lang_{$lang_iso} {$WPAC_mainLayout}">    {if !$content_only}		{if isset($restricted_country_mode) && $restricted_country_mode}			<div id="restricted-country">				<p>{l s='You cannot place a new order from your country:'} <span class="bold">{$geolocation_country}</span></p>			</div>		{/if}            <div id="skin_wrapper">        <!-- Outer Wrapper -->                                           <div id="outer_left">                                      &nbsp;                                              </div>                                                <div id="outer-wrapper">            <!-- Mobile Menu -->            <div id="wpmm-nav">                <div class="row">                    <div id="wpmm-nav-buttons" class="column col-12-12"></div>                </div>            </div>            <div id="wpmm-container" class="">                <div id="wpmm-tabs"></div>            </div>            <!-- End of Mobile Menu -->            <!-- Wrapper -->            <div id="wrapper" {if isset($restricted_country_mode) && $restricted_country_mode}style="margin-top: 40px;"{/if}>                <!-- Cart Layer -->                <div id="cart-layer-wrapper"></div>                <!-- End of Cart Layer -->                <!-- Header -->                <header id="header">                    {include file="$tpl_dir./$WPAC_headerStyle.tpl"}                </header>                <!-- End of Header -->                {if (isset($WPAC_stickyMenu) && $WPAC_stickyMenu)}                    <div id="sticky-menu-wrapper">                        <div class="row valign-middle">                             <div>                                                        <div id="sticky-logo" class="column col-for-logo"></div>                                <div id="sticky-menu" class="column col-8-12"></div>                                                        </div>                                                                                            <div id="sticky-cart" class="column col-for-basket t-align-right hide-below-1024"></div>                                                                               </div>                                            </div>                {/if}                {if (isset($page_name) && $page_name == "index")}                    <!-- Slider -->                    <div id="frontpage-slider">                        {hook h='displayHomepageSlider'}                    </div>                    <!-- End of Slider -->                {/if}                {if (isset($CONTENT_HEADER) && $CONTENT_HEADER != '')}                    {$CONTENT_HEADER}                {/if}                <!-- Columns -->                <div id="columns" class="{if (isset($HOOK_LEFT_COLUMN) && $HOOK_LEFT_COLUMN|trim && !$hide_left_column)}sidebar-enabled{/if}{if $page_name == "index"} onhome{/if}">                    <!-- Main Row -->                    <div class="row parent">                        {if (isset($HOOK_LEFT_COLUMN) && $HOOK_LEFT_COLUMN|trim && !$hide_left_column)}                            {if ($WPAC_sidebarPosition == "left")}                                {$centerColumnClasses='col-9-12 push-3-12'}                            {elseif ($WPAC_sidebarPosition == "right")}                                {$centerColumnClasses='col-9-12'}                            {/if}                        {else}                            {$centerColumnClasses='col-12-12'}                        {/if}                        <!-- Center Column -->                        <div id="center_column" class="column {$centerColumnClasses}">{/if}                            {if ( !isset($CONTENT_HEADER) || (isset($CONTENT_HEADER) && $CONTENT_HEADER == '') )}                                <!-- Breadcrumb Column -->                                <div id="breadcrumb" class="row">                                        {if $page_name !='index' && $page_name !='pagenotfound'}                                            {include file="$tpl_dir./breadcrumb.tpl"}                                        {/if}                                </div>                                <!-- End Breadcrumb Column -->                            {/if}