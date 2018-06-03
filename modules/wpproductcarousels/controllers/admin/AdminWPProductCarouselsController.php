<?php

class AdminWPProductCarouselsController extends ModuleAdminController {

    private $_categorySelect = array();

    public function __construct()
    {
        $this->className = 'wpProductCarouselsModel';
        $this->table = 'wpproductcarousels';
        $this->meta_title = $this->l('WP Product Carousels');
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->context = Context::getContext();
        $this->lang = true;
        $this->bootstrap = true;

        $this->_defaultOrderBy = 'position';

        if (Shop::isFeatureActive()){
            Shop::addTableAssociation($this->table, array('type' => 'shop'));
        }

        $this->position_identifier = 'id_wpproductcarousels';

        $this->addRowAction('edit');
        $this->addRowAction('delete');

        $this->fields_list = array(
            'id_wpproductcarousels' => array(
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
            'carousel_type' => array(
                'title' => $this->l('Carousel Content'),
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
                    'href' => self::$currentIndex.'&addwpproductcarousels&token='.$this->token,
                    'desc' => $this->l('Add New Carousel', null, null, false),
                    'icon' => 'process-icon-new'
                ),
                'options' => array(
                    'href' => $this->context->link->getAdminLink('AdminModules') . '&configure=wpproductcarousels',
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
        $this->addJqueryPlugin('wpproductcarousels.admin', __PS_BASE_URI__.'modules/wpproductcarousels/views/js/admin/');
        $this->addJqueryPlugin('autocomplete');
        $this->addCSS(__PS_BASE_URI__.'modules/wpproductcarousels/views/css/admin/wpproductcarousels.css');
    }

    /* ------------------------------------------------------------- */
    /*  AJAX PROCESS FOR UPDATING POSITIONS
    /* ------------------------------------------------------------- */
    public function ajaxProcessUpdatePositions()
    {
        $way = (int)(Tools::getValue('way'));
        $id_wpproductcarousels = (int)(Tools::getValue('id'));
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value){
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int)$pos[2] === $id_wpproductcarousels){
                if ($wpProductCarousels = new WPProductCarouselsModel((int)$pos[2])){
                    if (isset($position) && $wpProductCarousels->updatePosition($way, $position)){
                        echo 'ok position '.(int)$position.' for carousel '.(int)$pos[1].'\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update carousel '.(int)$id_wpproductcarousels.' to position '.(int)$position.' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This carousel ('.(int)$id_wpproductcarousels.') can t be loaded"}';
                }

                break;
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  RENDER ADD/EDIT FORM
    /* ------------------------------------------------------------- */
    public function renderForm() {

        $id_default_lang = $this->context->language->id;
        $id_shop = $this->context->shop->id;

        /* Render Form */
        $carousel_types = array(
            array(
                'value' => 'featured',
                'name' => $this->l('Featured products')
            ),
            array(
                'value' => 'new',
                'name' => $this->l('New products')
            ),
            array(
                'value' => 'special',
                'name' => $this->l('Special products')
            ),
            array(
                'value' => 'category',
                'name' => $this->l('All products from certain category')
            ),
            array(
                'value' => 'custom',
                'name' => $this->l('Custom products')
            )
        );

        // Get Categories
        $root_category = Category::getRootCategory($id_default_lang);
        $this->_getCategories($root_category->id_category, $id_shop);

        // Init Fields form array
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Carousel'),
                'icon' => 'icon-cogs'
            ),
            // Inputs
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Carousel Title'),
                    'name' => 'title',
                    'desc' => $this->l('Must be less than 250 characters.'),
                    'size' => 50,
                    'required' => true,
                    'lang' => true
                ),
                array(
                    'type' => 'select',
                    'name' => 'carousel_type',
                    'label' => $this->l('Carousel Content'),
                    'required' => false,
                    'lang' => false,
                    'options' => array(
                        'query' => $carousel_types,
                        'id' => 'value',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'select',
                    'name' => 'select_category',
                    'label' => $this->l('Select a category'),
                    'required' => false,
                    'lang' => false,
                    'options' => array(
                        'query' => $this->_categorySelect,
                        'id' => 'value',
                        'name' => 'name'
                    )
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Add a product'),
                    'name' => 'product_autocomplete',
                    'size' => 50,
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Carousel Content'),
                    'name' => 'carousel_content',
                    'size' => 50
                ),
            ),
            // Submit Button
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'saveProductCarousel'
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

        if ($obj && $obj->carousel_type == 'custom'){
            $carousel_content_products = array();
            $carousel_content = explode(',', $obj->carousel_content);

            foreach ($carousel_content as $pid) {
                $product = new Product($pid, false, $id_default_lang);
                $carousel_content_products[] = array(
                    'id' => $pid,
                    'name' => $product->name,
                    'ref' => $product->reference
                );
            }

            $this->tpl_form_vars['carousel_content_products'] = $carousel_content_products;
        }

        return parent::renderForm();
    }

    /* ------------------------------------------------------------- */
    /*  GET CATEGORIES WITH NICE FORMATTING
    /* ------------------------------------------------------------- */
    private function _getCategories($id_category = 1, $id_shop = false, $recursive = true)
    {
        $id_lang = $this->context->language->id;

        $category = new Category((int) $id_category, (int) $id_lang, (int) $id_shop);

        if (is_null($category->id))
            return;

        if ($recursive){
            $children = Category::getChildren((int) $id_category, (int) $id_lang, true, (int) $id_shop);
            if ($category->level_depth == 0) {
                $depth = $category->level_depth;
            } else {
                $depth = $category->level_depth - 1;
            }

            $spacer = str_repeat('&mdash;', 1 * $depth);
        }

        $this->_categorySelect[] = array(
            'value' =>  (int) $category->id,
            'name' => (isset($spacer) ? $spacer : '') . $category->name
        );

        if (isset($children) && count($children)){
            foreach ($children as $child){
                $this->_getCategories((int) $child['id_category'], (int) $child['id_shop'], true);
            }
        }
    }

}
