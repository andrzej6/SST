<?php
class Category extends CategoryCore
{
    public function getProductstabs($id_lang, $p, $n, $order_by = null, $order_way = null,
                                   $get_total = false, $active = true, $random = false,
                                   $random_number_products = 1, $check_access = true,
                                   Context $context = null)
    {
        if (!$context)
            $context = Context::getContext();
        $front = true;

        $order_by_prefix = false;
        if ($order_by == 'id_product' || $order_by == 'date_add' || $order_by == 'date_upd')
            $order_by_prefix = 'p';
        elseif ($order_by == 'name')
            $order_by_prefix = 'pl';
        elseif ($order_by == 'manufacturer')
        {
            $order_by_prefix = 'm';
            $order_by = 'name';
        }
        elseif ($order_by == 'position')
            $order_by_prefix = 'cp';

        if ($order_by == 'price')
            $order_by = 'orderprice';


        $sql = 'SELECT p.*, pl.*'.
               'FROM `'._DB_PREFIX_.'category_product` cp
				LEFT JOIN `'._DB_PREFIX_.'product` p
					ON p.`id_product` = cp.`id_product`'.Shop::addSqlAssociation('product', 'p').'
					LEFT JOIN `'._DB_PREFIX_.'product_lang` pl
					ON (p.`id_product` = pl.`id_product`
					AND pl.`id_lang` = '.(int)$id_lang.Shop::addSqlRestrictionOnLang('pl').')
					
				 WHERE cp.`id_category` = '.(int)$this->id;

            $sql .= ' ORDER BY p.price ASC'.'
			LIMIT '.(((int)$p - 1) * (int)$n).','.(int)$n;

        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS($sql);

        /* Modify SQL result */
        return Product::getProductsProperties($id_lang, $result);
    }
}