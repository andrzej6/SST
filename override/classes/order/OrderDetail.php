<?php


class OrderDetail extends OrderDetailCore
{
	
	/**
	 * Create an order detail liable to an id_order
	 * @param object $order
	 * @param object $cart
	 * @param array $product
	 * @param int $id_order_status
	 * @param int $id_order_invoice
	 * @param bool $use_taxes set to false if you don't want to use taxes
	 */
	protected function create(Order $order, Cart $cart, $product, $id_order_state, $id_order_invoice, $use_taxes = true, $id_warehouse = 0)
	{
		if ($use_taxes)
			$this->tax_calculator = new TaxCalculator();

		$this->id = null;

		$this->product_id = (int)($product['id_product']);
		$this->product_attribute_id = (int)($product['id_product_attribute'] ? (int)($product['id_product_attribute']) : null);
		
		// we should have attributes seperated by <br/>, before inserting to db replace them with comma below
		if (isset($product['attributes']) && $product['attributes'] != null) {
			$product['attributes'] = str_replace ("<br/>" , "| " , $product['attributes']);
		}
		
		
		$this->product_name = $product['name'].
			((isset($product['attributes']) && $product['attributes'] != null) ?
				', '.$product['attributes'] : '');

		$this->product_quantity = (int)($product['cart_quantity']);
		$this->product_ean13 = empty($product['ean13']) ? null : pSQL($product['ean13']);
		$this->product_upc = empty($product['upc']) ? null : pSQL($product['upc']);
		$this->product_reference = empty($product['reference']) ? null : pSQL($product['reference']);
		$this->product_supplier_reference = empty($product['supplier_reference']) ? null : pSQL($product['supplier_reference']);
		$this->product_weight = (float)($product['id_product_attribute'] ? $product['weight_attribute'] : $product['weight']);
		$this->id_warehouse = $id_warehouse;

		$productQuantity = (int)(Product::getQuantity($this->product_id, $this->product_attribute_id));
		$this->product_quantity_in_stock = ($productQuantity - (int)($product['cart_quantity']) < 0) ?
			$productQuantity : (int)($product['cart_quantity']);

		$this->setVirtualProductInformation($product);
		$this->checkProductStock($product, $id_order_state);

		if ($use_taxes)
			$this->setProductTax($order, $product);
		$this->setShippingCost($order, $product);
		$this->setDetailProductPrice($order, $cart, $product);

		// Set order invoice id
		$this->id_order_invoice = (int)$id_order_invoice;
		
		// Set shop id
		$this->id_shop = (int)$product['id_shop'];
		
		// Add new entry to the table
		$this->save();

		if ($use_taxes)
			$this->saveTaxCalculator($order);
		unset($this->tax_calculator);
	}

	
}