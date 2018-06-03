<?php


class OrderInvoice extends OrderInvoiceCore
{
	

	/**
	 * Get order products
	 *
	 * @return array Products with price, quantity (with taxe and without)
	 */
	public function getProducts($products = false, $selectedProducts = false, $selectedQty = false)
	{
		if (!$products)
			$products = $this->getProductsDetail();

		$order = new Order($this->id_order);
		$customized_datas = Product::getAllCustomizedDatas($order->id_cart);

		$resultArray = array();
		foreach ($products as $row)
		{
			// Change qty if selected
			if ($selectedQty)
			{
				$row['product_quantity'] = 0;
				foreach ($selectedProducts as $key => $id_product)
					if ($row['id_order_detail'] == $id_product)
						$row['product_quantity'] = (int)($selectedQty[$key]);
				if (!$row['product_quantity'])
					continue;
			}
			
			
			/* we replace back commas from db to <br/>
			$row['product_name'] = str_replace ("| " , ",<br/>" , $row['product_name']);
			$row['product_name'] = rtrim($row['product_name'],'<br/>');
			$row['product_name'] = rtrim($row['product_name'],',');
			*/


            // we replace back commas from db to <br/>
            $row['product_name'] = rtrim($row['product_name'],'| ');
            $row['product_name'] = str_replace ("| " , ",<br/>" , $row['product_name']);
            $row['product_name'] = rtrim($row['product_name'],',');


			$this->setProductImageInformations($row);
			$this->setProductCurrentStock($row);
			$this->setProductCustomizedDatas($row, $customized_datas);

			// Add information for virtual product
			if ($row['download_hash'] && !empty($row['download_hash']))
			{
				$row['filename'] = ProductDownload::getFilenameFromIdProduct((int)$row['product_id']);
				// Get the display filename
				$row['display_filename'] = ProductDownload::getFilenameFromFilename($row['filename']);
			}
			
			$row['id_address_delivery'] = $order->id_address_delivery;
			
			/* Stock product */
			$resultArray[(int)$row['id_order_detail']] = $row;
		}

		if ($customized_datas)
			Product::addCustomizationPrice($resultArray, $customized_datas);

		return $resultArray;
	}

	
}
