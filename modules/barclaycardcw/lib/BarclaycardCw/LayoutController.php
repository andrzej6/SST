<?php 
/**
  * You are allowed to use this API in your web application.
 *
 * Copyright (C) 2015 by customweb GmbH
 *
 * This program is licenced under the customweb software licence. With the
 * purchase or the installation of the software in your application you
 * accept the licence agreement. The allowed usage is outlined in the
 * customweb software licence which can be found under
 * http://www.sellxed.com/en/software-license-agreement
 *
 * Any modification or distribution is strictly forbidden. The license
 * grants you the installation in one application. For multiuse you will need
 * to purchase further licences at http://www.sellxed.com/shop.
 *
 * See the customweb software licence agreement for more details.
 *
 */

require_once 'Customweb/Util/Html.php';



/**
 * This controller is used to render content in the layout of the store.
 * 
 */
final class BarclaycardCw_LayoutController extends FrontController {

	private $postBackup = null;
	
	/**
	 * @var Customweb_Mvc_Layout_IRenderContext
	 */
	private $layoutContext = null;
	
	protected $page_name = 'barclaycardcw';
	
	public function render(Customweb_Mvc_Layout_IRenderContext $context) {
		$this->layoutContext = $context;
		ob_start();
		$this->run();
		$content = ob_get_contents();
		ob_end_clean();
		
		$content = Customweb_Util_Html::replaceRelativeUrls($content, Tools::getShopDomainSsl(true));
		
		return $content;
	}
	
	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		$this->display_column_left = false;
		parent::initContent();
	
		$this->context->smarty->assign('main_content', $this->layoutContext->getMainContent());
		$this->context->smarty->assign('content_title', $this->layoutContext->getTitle());
		foreach ($this->layoutContext->getCssFiles() as $file) {
			$this->addCSS($file);
		}
		foreach ($this->layoutContext->getJavaScriptFiles() as $js) {
			$this->addJS($js);
		}
		$this->addCSS(_THEME_CSS_DIR_.'addresses.css');
		$this->addCSS(_MODULE_DIR_ . 'barclaycardcw/css/style.css');
		
		$currentTemplatePath = _PS_ALL_THEMES_DIR_ . $this->context->shop->getTheme() . '/modules/barclaycardcw/';
		$modulePath = dirname(dirname(dirname(__FILE__))) . '/';
		$this->context->smarty->setTemplateDir(array(
			$currentTemplatePath,
			$modulePath . 'views/templates/front/',
		));
		
		if (version_compare(_PS_VERSION_, '1.6') > 0) {
			$this->context->smarty->assign(array(
				'js_def' => Media::getJsDef(),
				'js_files' => array_unique($this->js_files),
				'js_inline' => array()
			));
			$javascript = $this->context->smarty->fetch(_PS_ALL_THEMES_DIR_.'javascript.tpl');
			
			$this->context->smarty->assign(array('js_files' => array(), 'js_defer' => false, 'js_def' => $javascript));
		}
		
		$this->setTemplate('default.tpl');
	}

	public function redirect() {
		return;
	}
	
	protected function displayMaintenancePage() {
		// We want never to see here the maintenance page.
	}
	
	protected function displayRestrictedCountryPage() {
		// We do not want to restrict the content by any country.
	}
	
	protected function canonicalRedirection($canonical_url = '') {
		// We do not need any canonical redirect
	}
	
	protected function smartyOutputContent($content) {
		// Do not write cookies. It may lead to unexpected results.
		$this->context->smarty->display($content);
	}
	
}