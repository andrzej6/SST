<?php

class blockOffersModel extends ObjectModel
{
    public $id_blockoffers;
    public $active = 1;
    public $position;
	
	public $toptext;
	public $toplink;
	public $simage;
	public $bottomtext;
	public $buttontext;
	public $buttonlink;
	  
    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'blockoffers',
        'primary' => 'id_blockoffers',
        'multilang' => false,
        'fields' => array(
            //Fields
            'active' =>  array('type' => self::TYPE_INT, 'validate' => 'isBool'),
            'position' =>  array('type' => self::TYPE_INT, 'validate' => 'isUnsignedInt'),
			'toptext' => array('type'=>self::TYPE_STRING, 'validate' => 'isString'),
			'toplink' =>  array('type' => self::TYPE_STRING, 'validate' => 'isUrl'),
			'simage'      =>  array('type' => self::TYPE_STRING, 'validate' => 'isGenericName', 'size' => 250),
			'bottomtext' => array('type' => self::TYPE_HTML, 'validate' => 'isCleanHtml'),
			'buttontext' => array('type'=>self::TYPE_STRING, 'validate' => 'isString'),
			'buttonlink' =>  array('type' => self::TYPE_STRING, 'validate' => 'isUrl')
        )
    );

    /*-------------------------------------------------------------*/
    /*  CONSTRUCT
    /*-------------------------------------------------------------*/
    public function __construct($id_blockoffers = null, $id_lang = null, $id_shop = null)
    {
        //Shop::addTableAssociation('wpimageslider', array('type' => 'shop'));
        parent::__construct($id_blockoffers, $id_lang, $id_shop);
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
        $this->reorderOffers();
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
            SELECT $id_blockoffers
			FROM '._DB_PREFIX_.'blockoffers
            WHERE simage = "' . $imageName .'"'
        );

        if ($response['$id_blockoffers'] == null){
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

		foreach ($this->simage as $id_lang => $image){
			if ($image != '' && file_exists(_PS_MODULE_DIR_.'blockoffers/views/img/'.$image)){
				unlink(_PS_MODULE_DIR_.'blockoffers/views/img/'.$image);
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
            SELECT *
            FROM '._DB_PREFIX_.'blockoffers as a
            WHERE a.active = 1
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
			FROM `'._DB_PREFIX_.'blockoffers`'
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
			SELECT `id_blockoffers`, `position`
			FROM `'._DB_PREFIX_.'blockoffers`
			ORDER BY `position` ASC'
        ))
            return false;

        foreach ($tabs as $tab)
            if ((int)$tab['id_blockoffers'] == (int)$this->id)
                $moved_tab = $tab;

        if (!isset($moved_tab) || !isset($position))
            return false;

        return (Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'blockoffers`
			SET `position`= `position` '.($way ? '- 1' : '+ 1').'
			WHERE `position`
			'.($way
                       ? '> '.(int)$moved_tab['position'].' AND `position` <= '.(int)$position
                       : '< '.(int)$moved_tab['position'].' AND `position` >= '.(int)$position
			))
            && Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'blockoffers`
			SET `position` = '.(int)$position.'
			WHERE `id_blockoffers` = '.(int)$moved_tab['id_blockoffers']));
    }

    /*-------------------------------------------------------------*/
    /*  REORDER OFFERS AFTER DELETION
    /*-------------------------------------------------------------*/
    public static function reorderOffers()
    {
        $return = true;

        $sql = 'SELECT `id_blockoffers`
		        FROM `'._DB_PREFIX_.'blockoffers`
		        ORDER BY `position` ASC';

        $result = Db::getInstance()->executeS($sql);

        $i = 0;
        foreach ($result as $value) {
            $return = Db::getInstance()->execute('
			UPDATE `'._DB_PREFIX_.'blockoffers`
			SET `position` = '.(int)$i++.'
			WHERE `id_blockoffers` = '.(int)$value['id_blockoffers']);
        }

        return $return;
    }

}