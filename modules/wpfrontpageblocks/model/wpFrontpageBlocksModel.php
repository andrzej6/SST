<?php

class WPFrontpageBlocksModel extends ObjectModel
{
    public $id_wpfrontpageblocks;
    public $active = 1;
    public $position;
    public $open_in_new = 0;

    //Multilang Fields
    public $title;
    public $description;
    public $link;
    public $image;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'wpfrontpageblocks',
        'primary' => 'id_wpfrontpageblocks',
        'multilang' => true,
        'fields' => array(
            //Fields
            'active'          =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'position'        =>  array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
            'open_in_new'     =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),

            //Multilanguage Fields
            'title'           =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'required' => true, 'size' => 250),
            'description'     =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 250),
            'link'            =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isUrl'),
            'image'           =>  array('type' => self::TYPE_STRING, 'lang' => true, 'validate' => 'isGenericName', 'size' => 250),
        )
    );

    /*-------------------------------------------------------------*/
    /*  CONSTRUCT
    /*-------------------------------------------------------------*/
    public function __construct($id_wpfrontpageblocks = null, $id_lang = null, $id_shop = null)
    {
        Shop::addTableAssociation('wpfrontpageblocks', array('type' => 'shop'));
        parent::__construct($id_wpfrontpageblocks, $id_lang, $id_shop);
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
        $this->reorderTabs();
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
            SELECT id_wpfrontpageblocks
			FROM '._DB_PREFIX_.'wpfrontpageblocks_lang
            WHERE image = "' . $imageName .'"'
        );

        if ($response['id_wpfrontpageblocks'] == null){
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
            foreach ($this->image as $id_lang => $image){
                if ($image != '' && file_exists(_PS_MODULE_DIR_.'wpfrontpageblocks/views/img/'.$image)){
                    unlink(_PS_MODULE_DIR_.'wpfrontpageblocks/views/img/'.$image);
                }
            }
            return true;
        }
        else {
            if ($this->_checkImageNameForUsage($this->image[$id_lang])){
                if ($this->image[$id_lang] != '' && file_exists(_PS_MODULE_DIR_.'wpfrontpageblocks/views/img/'.$this->image[$id_lang])){
                    unlink(_PS_MODULE_DIR_.'wpfrontpageblocks/views/img/'.$this->image[$id_lang]);
                    return true;
                }
            }
        }

        return true;
    }

    /*-------------------------------------------------------------*/
    /*  GET BLOCK IDs
    /*-------------------------------------------------------------*/
    public function getBlockIds($id_shop)
    {
        $response = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
            SELECT a.id_wpfrontpageblocks, b.id_wpfrontpageblocks
            FROM '._DB_PREFIX_.'wpfrontpageblocks as a,
                 '._DB_PREFIX_.'wpfrontpageblocks_shop as b
            WHERE a.id_wpfrontpageblocks = b.id_wpfrontpageblocks
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
			FROM `'._DB_PREFIX_.'wpfrontpageblocks`'
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
			SELECT `id_wpfrontpageblocks`, `position`
			FROM `'._DB_PREFIX_.'wpfrontpageblocks`
			ORDER BY `position` ASC'
        ))
            return false;

        foreach ($tabs as $tab)
            if ((int)$tab['id_wpfrontpageblocks'] == (int)$this->id)
                $moved_tab = $tab;

        if (!isset($moved_tab) || !isset($position))
            return false;

        return (Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpfrontpageblocks`
			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
			WHERE `position`
			'.($way
                       ? '> '.(int)$moved_tab['position'].' AND `position` <= '.(int)$position
                       : '< '.(int)$moved_tab['position'].' AND `position` >= '.(int)$position
			))
            && Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpfrontpageblocks`
			SET `position` = '.(int)$position.'
			WHERE `id_wpfrontpageblocks` = '.(int)$moved_tab['id_wpfrontpageblocks']));
    }

    /*-------------------------------------------------------------*/
    /*  REORDER BLOCKS AFTER DELETION
    /*-------------------------------------------------------------*/
    public static function reorderTabs()
    {
        $return = true;

        $sql = 'SELECT `id_wpfrontpageblocks`
		        FROM `'._DB_PREFIX_.'wpfrontpageblocks`
		        ORDER BY `position` ASC';

        $result = Db::getInstance()->executeS($sql);

        $i = 0;
        foreach ($result as $value) {
            $return = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'wpfrontpageblocks`
			SET `position` = '.(int)$i++.'
			WHERE `id_wpfrontpageblocks` = '.(int)$value['id_wpfrontpageblocks']);
        }

        return $return;
    }
}