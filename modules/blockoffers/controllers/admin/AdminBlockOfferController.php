<?php

class AdminBlockOfferController extends ModuleAdminController {

    public function __construct()
    {
        $this->className = 'blockOffersModel';
        $this->table = 'blockoffers';
        $this->meta_title = $this->l('Block Offers');
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->context = Context::getContext();

        //$this->lang = true;
        $this->bootstrap = true;

        $this->_defaultOrderBy = 'position';

        $this->addRowAction('edit');
        $this->addRowAction('delete');


        $imageInfo = array(
            'name' => 'simage',
            'dir' => 'blockoffers'
        );


        $this->fieldImageSettings = $imageInfo;

        $this->position_identifier = 'id_blockoffers';

        $this->fields_list = array(
            'id_blockoffers' => array(
                'title' => $this->l('ID'),
                'type' => 'int',
                'width' => 'auto',
                'orderby' => false
            ),
            'simage' => array(
                'title' => $this->l('Image'),
                'callback' => 'getSImage',
                'width' => 'auto',
                'orderby' => false,
                'search' => false
            ),

            'toptext'=>array(
                'title'=>$this->l('Top Text'),
                'width'=>'auto',
                'orderby'=>false
            ),

            /*
            'toplink' => array(
                'title' => $this->l('Top Link'),
                'width' => 'auto',
                'orderby' => false
            ),
            'bottomtext'=>array(
                'title'=>$this->l('Bottom Text'),
                'width'=>'auto',
                'orderby'=>false
            ),
            'buttontext'=>array(
                'title'=>$this->l('Button Text'),
                'width'=>'auto',
                'orderby'=>false
            ),
            'buttonlink' => array(
                'title' => $this->l('Button Link'),
                'width' => 'auto',
                'orderby' => false
            ),
            */
            'active' => array(
                'title' => $this->l('Status'),
                'width' => '100',
                'active' => 'status',
                'type' => 'bool',
                'orderby' => false
            ),
            'position' => array(
                'title' => $this->l('Position'),
                'width' => 'auto',
                'filter_key' => 'a!position',
                'position' => 'position'
            )
        );

        $this->_processType = 'update';

        parent::__construct();

    }

    /* ------------------------------------------------------------- */
    /*  INIT PAGE HEADER TOOLBAR
    /* ------------------------------------------------------------- */
    public function initPageHeaderToolbar()
    {
        if (empty($this->display)){
            $this->page_header_toolbar_btn = array(
                'new' => array(
                    'href' => self::$currentIndex.'&addblockoffers&token='.$this->token,
                    'desc' => $this->l('Add New Offer', null, null, false),
                    'icon' => 'process-icon-new'
                )

            );
        }

        parent::initPageHeaderToolbar();
    }

    /* ------------------------------------------------------------- */
    /*  INCLUDE NECESSARY FILES
    /* ------------------------------------------------------------- */
    public function setMedia()
    {
        parent::setMedia();
        //could change below later to our module
        $this->addCSS(__PS_BASE_URI__.'modules/wpimageslider/views/css/admin/wpimageslider.css');
    }

    /* ------------------------------------------------------------- */
    /*  AJAX PROCESS FOR UPDATING POSITIONS
    /* ------------------------------------------------------------- */
    public function ajaxProcessUpdatePositions()
    {
        $way = (int)(Tools::getValue('way'));
        $id_blockoffers = (int)(Tools::getValue('id'));
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value){
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int)$pos[2] === $id_blockoffers){
                if ($blockOffer = new blockOffersModel((int)$pos[2])){
                    if (isset($position) && $blockOffer->updatePosition($way, $position)){
                        echo 'ok position '.(int)$position.' for block '.(int)$pos[1].'\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update block '.(int)$id_blockoffers.' to position '.(int)$position.' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This block ('.(int)$id_blockoffers.') can t be loaded"}';
                }

                break;
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  GET SLIDER IMAGE FOR HELPER LIST
    /* ------------------------------------------------------------- */
    public static function getSImage($sImage)
    {
        $imageUrl1 ='https://sit-stand.com/'._MODULE_DIR_ . 'blockoffers/views/img/' . $sImage;
        $imageUrl = '<img src="'.$imageUrl1.'" width="100">';

        return $imageUrl;
    }

    /* ------------------------------------------------------------- */
    /*  RENDER ADD/EDIT FORM
    /* ------------------------------------------------------------- */
    public function renderForm() {

        /* Render Form */
        // Init Fields form array
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Offer'),
                'icon' => 'icon-cogs'
            ),
            // Inputs
            'input' => array(
                array(
                    'type' => 'file_lang',
                    'label' => $this->l('Image'),
                    'name' => 'simage',
                    'size' => 50,
                    'required' => true,
                    'display_image' => true,
                    'lang' => true
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Top Text'),
                    'name' => 'toptext',
                    'size' => 50,
                    'required' => false,
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Top Link'),
                    'name' => 'toplink',
                    'size' => 50,
                    'required' => false,
                ),

                array(
                    'type' => 'textarea',
                    'label' => $this->l('Bottom Text'),
                    'name' => 'bottomtext',
                    'cols' => 136,
                    'rows' => 10,
                    'autoload_rte' => true,
                    'required' => false,
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Button Text'),
                    'name' => 'buttontext',
                    'size' => 50,
                    'required' => true,
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Button Link'),
                    'name' => 'buttonlink',
                    'size' => 50,
                    'required' => true,
                )
                ),

            // Submit Button
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'saveOffer'
            )
        );

        if (!($obj = $this->loadObject(true)))
            return;

        if (isset($obj->simage) && $obj->simage != ''){
            $this->tpl_form_vars['simages'] = $obj->simage;
        }

        return parent::renderForm();
    }

    /* ------------------------------------------------------------- */
    /*  PROCESS ADD
    /* ------------------------------------------------------------- */
    public function processAdd()
    {
        $this->_processType = 'add';

        $requiredImageFieldName = 'simage';

        if ( !isset($_FILES[$requiredImageFieldName]['tmp_name']) || empty($_FILES[$requiredImageFieldName]['tmp_name']) ){
            $this->errors[] = printf(Tools::displayError('Image field is required at least in %1$s.'));
        }

        return parent::processAdd();
    }

    /* ------------------------------------------------------------- */
    /*  POST IMAGE
    /* ------------------------------------------------------------- */
    protected function postImage($id)
    {
        if (isset($this->fieldImageSettings['name']) && isset($this->fieldImageSettings['dir']))
        {
            return $this->uploadImage($id, $this->fieldImageSettings['name'], $this->fieldImageSettings['dir'].'/');
        }


        if (count($this->errors)){
            return false;
        }

        return true;
    }

    /* ------------------------------------------------------------- */
    /*  UPLOAD IMAGE
    /* ------------------------------------------------------------- */
    protected function uploadImage($id, $name, $dir, $ext = false, $width = null, $height = null)
    {
        //Extract language id from name
        $expName = explode('_', $name);
        $id_lang = $expName[1];
        $id_default_lang = $this->context->language->id;

        if (isset($_FILES[$name]['tmp_name']) && !empty($_FILES[$name]['tmp_name']))
        {
            // Delete old image
            if (Validate::isLoadedObject($object = $this->loadObject())){
                $object->deleteImage($id_lang);
            } else {
                return false;
            }

            // Check image validity
            $max_size = isset($this->max_image_size) ? $this->max_image_size : 0;
            if ($error = ImageManager::validateUpload($_FILES[$name], Tools::getMaxUploadSize($max_size))) {
                $this->errors[] = $error;
            }

            $tmp_name = tempnam(_PS_TMP_IMG_DIR_, 'PS');
            if (!$tmp_name) {
                return false;
            }

            if (!move_uploaded_file($_FILES[$name]['tmp_name'], $tmp_name)) {
                return false;
            }

            // Evaluate the memory required to resize the image: if it's too much, you can't resize it.
            if (!ImageManager::checkImageMemoryLimit($tmp_name)) {
                $this->errors[] = Tools::displayError('Due to memory limit restrictions, this image cannot be loaded. Please increase your memory_limit value via your server\'s configuration settings. ');
            }

            // Copy new image
            if (empty($this->errors) && !ImageManager::resize($tmp_name, _PS_MODULE_DIR_.$dir.'views/img/'.$id.'-simage'.$id_lang.'.'.$this->imageType, (int)$width, (int)$height, $this->imageType)) {
                $this->errors[] = Tools::displayError('An error occurred while uploading the image.');
            }

            if (count($this->errors)) {
                return false;
            }

            $blockOffer = new blockOffersModel($id);
            $blockOffer->simage = $id.'-simage'.$id_lang.'.'.$this->imageType;
            $response = $blockOffer->update();

            if ($response){
                return true;
            }

            return false;
        } else {
            if ($this->_processType == 'add'){
                $blockOffer = new blockOffersModel($id);
                $blockOffer->simage = $blockOffer->simage[$id_default_lang];
                $response = $blockOffer->update();

                if ($response){
                    return true;
                }

                return false;
            } else {
                return true;
            }
        }

    }

}
