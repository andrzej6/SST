<?php

class WPMegamenuModel extends ObjectModel
{
    public $id_wpmegamenu;
    public $active = 1;
    public $position;
    public $open_in_new;
    public $icon_class;
    public $menu_class;

    //Multilang Fields
    public $title;
    public $description;
    public $link;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'wpmegamenu',
        'primary' => 'id_wpmegamenu',
        'multilang' => true,
        'fields' => array(
            //Fields
            'active'      =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'position'    =>  array('type' => self::TYPE_INT, 'validate' => 'isunsignedInt'),
            'open_in_new' =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'icon_class'  =>  array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),
            'menu_class'  =>  array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 255),

            //Multilanguage Fields
            'title'       =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 255),
            'description' =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 125),
            'link'        =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isUrl', 'size' => 255),
        )
    );

    /*-------------------------------------------------------------*/
    /*  CONSTRUCT
    /*-------------------------------------------------------------*/
    public function __construct($id_wpmegamenu = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation('wpmegamenu', array('type' => 'shop'));
        parent::__construct($id_wpmegamenu, $id_lang, $id_shop);
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
        $this->reorderMenus();

        return $response;
    }

    /*-------------------------------------------------------------*/
    /*  GET MENUS
    /*-------------------------------------------------------------*/
    public static function getMenus($id_shop)
    {
        $response = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT a.id_wpmegamenu
            FROM '._DB_PREFIX_.'wpmegamenu as a,
                 '._DB_PREFIX_.'wpmegamenu_shop as b
            WHERE a.id_wpmegamenu = b.id_wpmegamenu
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
			FROM `'._DB_PREFIX_.'wpmegamenu`'
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
        if (!$menus = Db::getInstance()->executeS('
			SELECT `id_wpmegamenu`, `position`
			FROM `'._DB_PREFIX_.'wpmegamenu`
			ORDER BY `position` ASC'
        ))
            return false;

        foreach ($menus as $menu)
            if ((int)$menu['id_wpmegamenu'] == (int)$this->id)
                $moved_menu = $menu;

        if (!isset($moved_menu) || !isset($position))
            return false;

        return (Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpmegamenu`
			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
			WHERE `position`
			'.($way
                       ? '> '.(int)$moved_menu['position'].' AND `position` <= '.(int)$position
                       : '< '.(int)$moved_menu['position'].' AND `position` >= '.(int)$position
			))
            && Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpmegamenu`
			SET `position` = '.(int)$position.'
			WHERE `id_wpmegamenu` = '.(int)$moved_menu['id_wpmegamenu']));
    }

    /*-------------------------------------------------------------*/
    /*  REORDER AFTER DELETION
    /*-------------------------------------------------------------*/
    public static function reorderMenus()
    {
        $return = true;

        $sql = 'SELECT `id_wpmegamenu`
		        FROM `'._DB_PREFIX_.'wpmegamenu`
		        ORDER BY `position` ASC';

        $result = Db::getInstance()->executeS($sql);

        $i = 0;
        foreach ($result as $value) {
            $return = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpmegamenu`
			SET `position` = '.(int)$i++.'
			WHERE `id_wpmegamenu` = '.(int)$value['id_wpmegamenu']);
        }

        return $return;
    }
}