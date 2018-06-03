<?php

class AdminWPFrontpageBlocksController extends ModuleAdminController {

    public function __construct()
    {
        $this->className = 'wpFrontpageBlocksModel';
        $this->table = 'wpfrontpageblocks';
        $this->meta_title = $this->l('WP Frontpage Blocks');
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->context = Context::getContext();
        $this->lang = true;
        $this->bootstrap = true;

        $this->_defaultOrderBy = 'position';

        if (Shop::isFeatureActive()){
            Shop::addTableAssociation($this->table, array('type' => 'shop'));
        }

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $imageInfo = array();

        foreach ($this->context->language->getLanguages() as $language){
            $imageInfo[] = array(
                'name' => 'image_' . $language['id_lang'],
                'dir' => 'wpfrontpageblocks'
            );
        }

        $this->fieldImageSettings = $imageInfo;

        $this->position_identifier = 'id_wpfrontpageblocks';

        $this->fields_list = array(
            'id_wpfrontpageblocks' => array(
                'title' => $this->l('ID'),
                'type' => 'int',
                'width' => 'auto',
                'orderby' => false
            ),
            'title' => array(
                'title' => $this->l('Title'),
                'width' => 'auto',
                'orderby' => false
            ),
            'link' => array(
                'title' => $this->l('Link'),
                'width' => 'auto',
                'orderby' => false
            ),
            'active' => array(
                'title' => $this->l('Status'),
                'width' => 'auto',
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
                    'href' => self::$currentIndex.'&addwpfrontpageblocks&token='.$this->token,
                    'desc' => $this->l('Add New Block', null, null, false),
                    'icon' => 'process-icon-new'
                ),
                'options' => array(
                    'href' => $this->context->link->getAdminLink('AdminModules') . '&configure=wpfrontpageblocks',
                    'desc' => $this->l('Options'),
                    'icon' => 'process-icon-cogs'
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
        $this->addCSS(__PS_BASE_URI__.'modules/wpfrontpageblocks/views/css/admin/wpfrontpageblocks.css');
    }

    /* ------------------------------------------------------------- */
    /*  AJAX PROCESS FOR UPDATING POSITIONS
    /* ------------------------------------------------------------- */
    public function ajaxProcessUpdatePositions()
    {
        $way = (int)(Tools::getValue('way'));
        $id_wpfrontpageblocks = (int)(Tools::getValue('id'));
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value){
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int)$pos[2] === $id_wpfrontpageblocks){
                if ($wpFrontpageBlocks = new WPFrontpageBlocksModel((int)$pos[2])){
                    if (isset($position) && $wpFrontpageBlocks->updatePosition($way, $position)){
                        echo 'ok position '.(int)$position.' for block '.(int)$pos[1].'\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update block '.(int)$id_wpfrontpageblocks.' to position '.(int)$position.' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This block ('.(int)$id_wpfrontpageblocks.') can t be loaded"}';
                }

                break;
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  RENDER ADD/EDIT FORM
    /* ------------------------------------------------------------- */
    public function renderForm() {

        /* Render Form */

        // Init Fields form array
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Frontpage Block'),
                'icon' => 'icon-cogs'
            ),
            // Inputs
            'input' => array(
                array(
                    'type' => 'file_lang',
                    'label' => $this->l('Image'),
                    'name' => 'image',
                    'size' => 50,
                    'required' => true,
                    'lang' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Title'),
                    'name' => 'title',
                    'desc' => $this->l('Must be less than 250 characters.'),
                    'size' => 50,
                    'required' => true,
                    'lang' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Description'),
                    'name' => 'description',
                    'desc' => $this->l('Must be less than 250 characters.'),
                    'size' => 50,
                    'required' => false,
                    'lang' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Link'),
                    'name' => 'link',
                    'size' => 50,
                    'required' => false,
                    'lang' => true
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Open in new tab'),
                    'name' => 'open_in_new',
                    'required' => false,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'in_new_on',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'in_new_off',
                            'value' => 0,
                            'label' => $this->l('No')
                        )
                    )
                ),
            ),
            // Submit Button
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'saveFrontpageBlock'
            )
        );

        if (Shop::isFeatureActive()){
            $this->fields_form['input'][] = array(
                'type' => 'shop',
                'label' => $this->l('Shop association'),
                'name' => 'checkBoxShopAsso',
            );
        }

        if (!($obj = $this->loadObject(true)))
            return;

        if (isset($obj->image) && $obj->image != ''){
            $this->tpl_form_vars['blockImages'] = $obj->image;
        }

        return parent::renderForm();
    }

    /* ------------------------------------------------------------- */
    /*  PROCESS ADD
    /* ------------------------------------------------------------- */
    public function processAdd()
    {
        $this->_processType = 'add';

        /* Check if image uploaded at least in default language */
        $id_default_lang = $this->context->language->id;
        $default_language = new Language($id_default_lang);

        $requiredImageFieldName = 'image_' . $id_default_lang;

        if ( !isset($_FILES[$requiredImageFieldName]['tmp_name']) || empty($_FILES[$requiredImageFieldName]['tmp_name']) ){
            $this->errors[] = sprintf(Tools::displayError('Image field is required at least in %1$s.'), $default_language->name);
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
        elseif (!empty($this->fieldImageSettings))
        {
            foreach ($this->fieldImageSettings as $image)
            {
                if (isset($image['name']) && isset($image['dir'])){
                    $this->uploadImage($id, $image['name'], $image['dir'].'/');
                }
            }
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
            if (empty($this->errors) && !ImageManager::resize($tmp_name, _PS_MODULE_DIR_.$dir.'views/img/'.$id.'-blockImage_'.$id_lang.'.'.$this->imageType, (int)$width, (int)$height, $this->imageType)) {
                $this->errors[] = Tools::displayError('An error occurred while uploading the image.');
            }

            if (count($this->errors)) {
                return false;
            }

            $wpFrontpageBlocks = new WPFrontpageBlocksModel($id);
            $wpFrontpageBlocks->image[$id_lang] = $id.'-blockImage_'.$id_lang.'.'.$this->imageType;
            $response = $wpFrontpageBlocks->update();

            if ($response){
                return true;
            }

            return false;
        }
        else {
            if ($this->_processType == 'add'){
                $wpFrontpageBlocks = new WPFrontpageBlocksModel($id);
                $wpFrontpageBlocks->image[$id_lang] = $wpFrontpageBlocks->image[$id_default_lang];
                $response = $wpFrontpageBlocks->update();

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
