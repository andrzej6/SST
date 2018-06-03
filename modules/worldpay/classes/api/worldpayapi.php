<?php
/**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2014 PrestaShop SA
*  @version   Release: $Revision: 6844 $
*  @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class WorldPayAPI {

	protected $url;
	protected $config;
	protected $params;

	protected $response;

	public function setUrl($url)
	{
		$this->url = $url;
	}

	public function setConfig($config)
	{
		$this->config = $config;
	}

	public function setParams($params)
	{
		$this->params = $params;
	}

	protected function buildParams()
	{
		return http_build_query($this->params, '', '&');
	}

	public function sendRequest($secure = false)
	{
		if (function_exists('curl_exec'))
			$this->adapterCURL($secure);

		return $this;
	}

	public function getResponseBody()
	{
		$parts = preg_split('|(?:\r?\n){2}|m', $this->response, 2);

		if (isset($parts[1]))
			return $parts[1];

		return null;
	}

	public function getResponseCode()
	{
		preg_match('|^HTTP/[\d\.x]+ (\d+)|', $this->response, $m);

		if (isset($m[1]))
			return (int)$m[1];

		return null;
	}

	public function getResponseMessage()
	{
		preg_match('|^HTTP/[\d\.x]+ \d+ ([^\r\n]+)|', $this->response, $m);

		if (isset($m[1]))
			return $m[1];

		return null;
	}

	public function getResponseVersion()
	{
		preg_match('|^HTTP/([\d\.x]+) \d+|', $this->response, $m);

		if (isset($m[1]))
			return $m[1];

		return null;
	}

	private function adapterCURL($secure = false)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->buildParams());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HEADER, true);

		if (!empty($this->config['timeout']))
		{
			curl_setopt($ch, CURLOPT_TIMEOUT, $this->config['timeout']);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->config['timeout']);
		}

		if (!empty($this->config['maxredirects']))
			curl_setopt($ch, CURLOPT_MAXREDIRS, $this->config['maxredirects']);

		if ($secure !== false)
		{
			if (isset($this->config['sslcert']))
				curl_setopt($ch, CURLOPT_SSLCERT, $this->config['sslcert']);

			if (isset($this->config['sslpassphrase']))
				curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $this->config['sslpassphrase']);
		}

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_VERBOSE, true);

		$this->response = curl_exec($ch);

		curl_close($ch);
	}
}
