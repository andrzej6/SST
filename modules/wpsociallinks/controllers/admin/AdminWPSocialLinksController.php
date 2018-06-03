<?php

class AdminWPSocialLinksController extends ModuleAdminController {

    public function __construct()
    {
        $this->className = 'wpSocialLinksModel';
        $this->table = 'wpsociallinks';
        $this->meta_title = $this->l('WP Social Links');
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->context = Context::getContext();
        $this->lang = false;
        $this->bootstrap = true;

        $this->_defaultOrderBy = 'position';

        if (Shop::isFeatureActive()){
            Shop::addTableAssociation($this->table, array('type' => 'shop'));
        }

        $this->position_identifier = 'id_wpsociallinks';

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->fields_list = array(
            'id_wpsociallinks' => array(
                'title' => $this->l('ID'),
                'type' => 'int',
                'width' => 'auto',
                'orderby' => false
            ),
            'icon' => array(
                'title' => $this->l('Icon'),
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
                    'href' => self::$currentIndex.'&addwpsociallinks&token='.$this->token,
                    'desc' => $this->l('Add New Link', null, null, false),
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
        $this->addCSS(__PS_BASE_URI__.'modules/wpsociallinks/views/css/admin/wpsociallinks.css');
    }

    /* ------------------------------------------------------------- */
    /*  AJAX PROCESS FOR UPDATING POSITIONS
    /* ------------------------------------------------------------- */
    public function ajaxProcessUpdatePositions()
    {
        $way = (int)(Tools::getValue('way'));
        $id_wpsociallinks = (int)(Tools::getValue('id'));
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value){
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int)$pos[2] === $id_wpsociallinks){
                if ($wpSocialLinks = new WPSocialLinksModel((int)$pos[2])){
                    if (isset($position) && $wpSocialLinks->updatePosition($way, $position)){
                        echo 'ok position '.(int)$position.' for carousel '.(int)$pos[1].'\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update carousel '.(int)$id_wpsociallinks.' to position '.(int)$position.' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This carousel ('.(int)$id_wpsociallinks.') can t be loaded"}';
                }

                break;
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  RENDER ADD/EDIT FORM
    /* ------------------------------------------------------------- */
    public function renderForm() {

        if (($obj = $this->loadObject(true))){
            if (isset($obj->custom_icon) && $obj->custom_icon != ''){
                $files = array(
                    array(
                        'image' => '<img src="' . _MODULE_DIR_ . 'wpsociallinks/views/img/front/customIcons/' . $obj->custom_icon . '" />',
                        'type'  => 'image'
                    )
                );
            }
        }

        /* Render Form */
        $icons = array(
            array(
                'value' => 'facebook',
                'name' => $this->l('Facebook')
            ),
            array(
                'value' => 'twitter',
                'name' => $this->l('Twitter')
            ),
            array(
                'value' => 'pinterest',
                'name' => $this->l('Pinterest')
            ),
            array(
                'value' => 'google-plus',
                'name' => $this->l('Google+')
            ),
            array(
                'value' => 'instagram',
                'name' => $this->l('Instagram')
            ),
            array(
                'value' => 'youtube',
                'name' => $this->l('Youtube')
            ),
            array(
                'value' => 'vimeo',
                'name' => $this->l('Vimeo')
            ),
            array(
                'value' => 'linkedin',
                'name' => $this->l('LinkedIn')
            ),
            array(
                'value' => 'reddit',
                'name' => $this->l('Reddit')
            ),
            array(
                'value' => 'flickr',
                'name' => $this->l('Flickr')
            ),
            array(
                'value' => 'deviantart',
                'name' => $this->l('deviantART')
            ),
            array(
                'value' => 'dribbble',
                'name' => $this->l('Dribbble')
            ),
            array(
                'value' => 'forrst',
                'name' => $this->l('Forrst')
            ),
            array(
                'value' => 'tumblr',
                'name' => $this->l('Tumblr')
            ),
            array(
                'value' => 'blogger',
                'name' => $this->l('Blogger')
            ),
            array(
                'value' => 'wordpress',
                'name' => $this->l('Wordpress')
            ),
            array(
                'value' => 'skype',
                'name' => $this->l('Skype')
            ),
            array(
                'value' => 'envelop',
                'name' => $this->l('MailTo')
            ),
            array(
                'value' => 'custom',
                'name' => $this->l('Custom icon')
            )
        );

        // Init Fields form array
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Social Link'),
                'icon' => 'icon-cogs'
            ),
            // Inputs
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Link'),
                    'name' => 'link',
                    'desc' => $this->l('Must be less than 250 characters.'),
                    'size' => 50,
                    'required' => true,
                    'lang' => false
                ),
                array(
                    'type' => 'select',
                    'name' => 'icon',
                    'label' => $this->l('Icon'),
                    'required' => false,
                    'lang' => false,
                    'options' => array(
                        'query' => $icons,
                        'id' => 'value',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'file',
                    'name' => 'custom_icon',
                    'label' => $this->l('Custom Icon'),
                    'files' => (isset($files) ? $files : false),
                    'required' => false,
                    'lang' => false,
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Open link in new tab/window'),
                    'name' => 'open_in_new',
                    'required' => false,
                    'is_bool' => true,
                    'values' => array(
                        array(
                            'id' => 'openinnew_on',
                            'value' => 1,
                            'label' => $this->l('Yes')
                        ),
                        array(
                            'id' => 'openinnew_off',
                            'value' => 0,
                            'label' => $this->l('No')
                        )
                    )
                )
            ),
            // Submit Button
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'saveSocialLink'
            )
        );

        if (Shop::isFeatureActive()){
            $this->fields_form['input'][] = array(
                'type' => 'shop',
                'label' => $this->l('Shop association'),
                'name' => 'checkBoxShopAsso',
            );
        }

        return parent::renderForm();
    }


    /* ------------------------------------------------------------- */
    /*  POST PROCESS
    /* ------------------------------------------------------------- */
    public function postProcess()
    {
        $id_shop = $this->context->shop->id;

        if (isset($_FILES['custom_icon']) && isset($_FILES['custom_icon']['tmp_name']) && !empty($_FILES['custom_icon']['tmp_name']))
        {
            // Delete old image
            if ($object = $this->loadObject(true)){
                $object->deleteImg();
            }

            if ($error = ImageManager::validateUpload($_FILES['custom_icon'], Tools::convertBytes(ini_get('upload_max_filesize')))){
                $errors[] = $error;
            } else {
                $iconName = explode('.', $_FILES['custom_icon']['name']);
                $iconExt = $iconName[1];
                $iconName = $iconName[0];
                $finalIconName = $iconName . '-' . $id_shop . '.' . $iconExt;

                $_POST['custom_icon'] = $finalIconName;

                if (!move_uploaded_file($_FILES['custom_icon']['tmp_name'], _PS_MODULE_DIR_ . 'wpsociallinks/views/img/front/customIcons/' . $finalIconName)) {
                    $errors[] = $this->l('File upload error.');
                }
            }
        }

        return parent::postProcess();
    }

}
