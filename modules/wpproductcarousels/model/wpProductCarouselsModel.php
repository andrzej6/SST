<?php

class WPProductCarouselsModel extends ObjectModel
{
    public $id_wpproductcarousels;
    public $active = 1;
    public $position;
    public $carousel_type;
    public $carousel_content;

    //Multilang Fields
    public $title;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'wpproductcarousels',
        'primary' => 'id_wpproductcarousels',
        'multilang' => true,
        'fields' => array(
            //Fields
            'active'          =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'position'        =>  array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'carousel_type'        =>  array('type' => self::TYPE_STRING),
            'carousel_content'     =>  array('type' => self::TYPE_STRING),

            //Multilanguage Fields
            'title'           =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 250)
        )
    );

    /*-------------------------------------------------------------*/
    /*  CONSTRUCT
    /*-------------------------------------------------------------*/
    public function __construct($id_wpproductcarousels = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation('wpproductcarousels', array('type' => 'shop'));
        parent::__construct($id_wpproductcarousels, $id_lang, $id_shop);
    }

    /*-------------------------------------------------------------*/
    /*  ADD
    /*-------------------------------------------------------------*/
    public function add($autoddate = true, $null_values = false)
    {
        $this->position = (int) $this->getMaxPosition() + 1;
        return parent::add();
    }

    /*-------------------------------------------------------------*/
    /*  DELETE
    /*-------------------------------------------------------------*/
    public function delete()
    {
        $response = parent::delete();
        $this->reorderCarousels();

        return $response;
    }

    /*-------------------------------------------------------------*/
    /*  GET ALL ROWS
    /*-------------------------------------------------------------*/
    public static function getAll()
	{
		$response = Db::getInstance()->executeS('
            SELECT *
			FROM `'._DB_PREFIX_.'wpproductcarousels`'
        );
        
        return $response;
	}

    /*-------------------------------------------------------------*/
    /*  GET TAB IDs
    /*-------------------------------------------------------------*/
    public function getCarouselIds($id_shop)
    {
        $response = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT a.id_wpproductcarousels, b.id_wpproductcarousels
            FROM '._DB_PREFIX_.'wpproductcarousels as a,
                 '._DB_PREFIX_.'wpproductcarousels_shop as b
            WHERE a.id_wpproductcarousels = b.id_wpproductcarousels
            AND b.id_shop = '.$id_shop.'
            AND a.active = 1
            ORDER BY a.position ASC'
        );

        return $response;
    }

    /*-------------------------------------------------------------*/
    /*  GET MAX POSITION
    /*-------------------------------------------------------------*/
    public static function getMaxPosition()
    {
        $response = Db::getInstance()->getRow('
            SELECT MAX(position)
			FROM `'._DB_PREFIX_.'wpproductcarousels`'
        );

        if ($response['MAX(position)'] == null){
            return -1;
        }

        return $response['MAX(position)'];

    }

    /*-------------------------------------------------------------*/
    /*  UPDATE POSITION
    /*-------------------------------------------------------------*/
    public function updatePosition($way, $position)
    {
        if (!$carousels = Db::getInstance()->executeS('
			SELECT `id_wpproductcarousels`, `position`
			FROM `'._DB_PREFIX_.'wpproductcarousels`
			ORDER BY `position` ASC'
        ))
            return false;

        foreach ($carousels as $carousel)
            if ((int)$carousel['id_wpproductcarousels'] == (int)$this->id)
                $moved_carousel = $carousel;

        if (!isset($moved_carousel) || !isset($position))
            return false;

        return (Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpproductcarousels`
			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
			WHERE `position`
			'.($way
                       ? '> '.(int)$moved_carousel['position'].' AND `position` <= '.(int)$position
                       : '< '.(int)$moved_carousel['position'].' AND `position` >= '.(int)$position
			))
            && Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpproductcarousels`
			SET `position` = '.(int)$position.'
			WHERE `id_wpproductcarousels` = '.(int)$moved_carousel['id_wpproductcarousels']));
    }

    /*-------------------------------------------------------------*/
    /*  REORDER TABS AFTER DELETION
    /*-------------------------------------------------------------*/
    public static function reorderCarousels()
    {
        $return = true;

        $sql = 'SELECT `id_wpproductcarousels`
		        FROM `'._DB_PREFIX_.'wpproductcarousels`
		        ORDER BY `position` ASC';

        $result = Db::getInstance()->executeS($sql);

        $i = 0;
        foreach ($result as $value) {
            $return = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpproductcarousels`
			SET `position` = '.(int)$i++.'
			WHERE `id_wpproductcarousels` = '.(int)$value['id_wpproductcarousels']);
        }

        return $return;
    }
}