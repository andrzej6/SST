<?php

class WPAutumnModel {
    
    public static function checkAutumnNewsletterTable()
    {
        $response = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                    SELECT id
                    FROM '._DB_PREFIX_.'autumn_newsletter
                    LIMIT 1'
        );

        if ($response){
            return $response;
        } else {
            return false;
        }
    }

    public function mergeOldNewsletterContent()
    {
        $response = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
                    SELECT *
                    FROM '._DB_PREFIX_.'autumn_newsletter'
        );

        if ($response){
            $this->_addOldNewsletterContent($response);
        } else {
            return false;
        }
    }

    private function _addOldNewsletterContent($content)
    {
        $response = true;
        foreach ($content as $entry) {
            $response &= Db::getInstance(_PS_USE_SQL_SLAVE_)->execute('
                INSERT INTO '._DB_PREFIX_.'newsletter (id_shop, id_shop_group, email, newsletter_date_add, ip_registration_newsletter, http_referer, active)
                VALUES('.$entry["id_shop"].','.$entry["id_shop_group"].',\''.$entry["email"].'\',\''.$entry["newsletter_date_add"].'\',\''.$entry["ip_registration_newsletter"].'\',\''.$entry["http_referer"].'\','.$entry["active"].')
            ');

            if ($response) {
                Db::getInstance(_PS_USE_SQL_SLAVE_)->execute('
                    DELETE FROM '._DB_PREFIX_.'autumn_newsletter
                    WHERE id = '. $entry["id"]
                );
            }

        }

        return $response;
    }

    public static function findProductPos($id_category, $id_product)
    {
        $response = Db::getInstance()->getRow('
            SELECT position
			FROM '._DB_PREFIX_.'category_product
            WHERE id_category = ' . $id_category . '
            AND id_product = ' . $id_product
        );

        if ($response['position'] == null){
            return false;
        }

        return (int)$response['position'];
    }

    public static function getProductIdFromPos($id_category, $position)
    {
        $response = Db::getInstance()->getRow('
            SELECT id_product
			FROM '._DB_PREFIX_.'category_product
            WHERE id_category = ' . $id_category . '
            AND position = ' . $position
        );

        if ($response['id_product'] == null){
            return false;
        }

        return (int)$response['id_product'];
    }
}