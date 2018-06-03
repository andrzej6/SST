<?php

class WPImageSliderModel extends ObjectModel
{
    public $id_wpimageslider;
    public $active = 1;
    public $position;
    public $open_in_new = 0;
    public $html_position;

    //Multilang Fields
    public $html;
    public $link;
    public $slideImage;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'wpimageslider',
        'primary' => 'id_wpimageslider',
        'multilang' => true,
        'fields' => array(
            //Fields
            'active'          =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'position'        =>  array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'open_in_new'     =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'html_position'   =>  array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 250),

            //Multilanguage Fields
            'html'            =>  array('type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml'),
            'link'            =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isUrl'),
            'slideImage'      =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 250),
        )
    );

    /*-------------------------------------------------------------*/
    /*  CONSTRUCT
    /*-------------------------------------------------------------*/
    public function __construct($id_wpimageslider = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation('wpimageslider', array('type' => 'shop'));
        parent::__construct($id_wpimageslider, $id_lang, $id_shop);
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
        $this->reorderSlides();
        $this->deleteImage();

        return $response;
    }

    /*-------------------------------------------------------------*/
    /*  CHECK IMAGE FOR USAGE
    /*-------------------------------------------------------------*/
    private function _checkImageNameForUsage($imageName)
    {
        if (empty($imageName)){
            return true;
        }

        $response = Db::getInstance()->getRow('
            SELECT id_wpimageslider
			FROM '._DB_PREFIX_.'wpimageslider_lang
            WHERE slideImage = "' . $imageName .'"'
        );

        if ($response['id_wpimageslider'] == null){
            return true;
        }

        return false;
    }

    /*-------------------------------------------------------------*/
    /*  DELETE IMAGE
    /*-------------------------------------------------------------*/
    public function deleteImage($id_lang = null)
    {
        if (!$this->id) {
            return false;
        }

        if ($id_lang == null) {
            foreach ($this->slideImage as $id_lang => $image){
                if ($image != '' && file_exists(_PS_MODULE_DIR_.'wpimageslider/views/img/'.$image)){
                    unlink(_PS_MODULE_DIR_.'wpimageslider/views/img/'.$image);
                }
            }
            return true;
        } else {
            if ($this->_checkImageNameForUsage($this->slideImage[$id_lang])){
                if ($this->slideImage[$id_lang] != '' && file_exists(_PS_MODULE_DIR_.'wpimageslider/views/img/'.$this->slideImage[$id_lang])){
                    unlink(_PS_MODULE_DIR_.'wpimageslider/views/img/'.$this->slideImage[$id_lang]);
                    return true;
                }
            }
        }

        return true;
    }

    /*-------------------------------------------------------------*/
    /*  GET BLOCK IDs
    /*-------------------------------------------------------------*/
    public function getSlideIds($id_shop)
    {
        $response = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT a.id_wpimageslider, b.id_wpimageslider
            FROM '._DB_PREFIX_.'wpimageslider as a,
                 '._DB_PREFIX_.'wpimageslider_shop as b
            WHERE a.id_wpimageslider = b.id_wpimageslider
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
			FROM `'._DB_PREFIX_.'wpimageslider`'
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
        if (!$tabs = Db::getInstance()->executeS('
			SELECT `id_wpimageslider`, `position`
			FROM `'._DB_PREFIX_.'wpimageslider`
			ORDER BY `position` ASC'
        ))
            return false;

        foreach ($tabs as $tab)
            if ((int)$tab['id_wpimageslider'] == (int)$this->id)
                $moved_tab = $tab;

        if (!isset($moved_tab) || !isset($position))
            return false;

        return (Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpimageslider`
			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
			WHERE `position`
			'.($way
                       ? '> '.(int)$moved_tab['position'].' AND `position` <= '.(int)$position
                       : '< '.(int)$moved_tab['position'].' AND `position` >= '.(int)$position
			))
            && Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpimageslider`
			SET `position` = '.(int)$position.'
			WHERE `id_wpimageslider` = '.(int)$moved_tab['id_wpimageslider']));
    }

    /*-------------------------------------------------------------*/
    /*  REORDER SLIDES AFTER DELETION
    /*-------------------------------------------------------------*/
    public static function reorderSlides()
    {
        $return = true;

        $sql = 'SELECT `id_wpimageslider`
		        FROM `'._DB_PREFIX_.'wpimageslider`
		        ORDER BY `position` ASC';

        $result = Db::getInstance()->executeS($sql);

        $i = 0;
        foreach ($result as $value) {
            $return = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpimageslider`
			SET `position` = '.(int)$i++.'
			WHERE `id_wpimageslider` = '.(int)$value['id_wpimageslider']);
        }

        return $return;
    }

}