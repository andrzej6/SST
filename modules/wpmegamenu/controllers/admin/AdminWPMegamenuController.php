<?php

class AdminWPMegamenuController extends ModuleAdminController {


    public function __construct()
    {
        $this->className = 'wpMegamenuModel';
        $this->table = 'wpmegamenu';
        $this->meta_title = $this->l('WP Megamenu');
        $this->deleted = false;
        $this->explicitSelect = true;
        $this->context = Context::getContext();
        $this->lang = true;
        $this->bootstrap = true;

        $this->_defaultOrderBy = 'position';

        if (Shop::isFeatureActive()){
            Shop::addTableAssociation($this->table, array('type' => 'shop'));
        }

        $this->position_identifier = 'id_wpmegamenu';

        $this->addRowAction('edit');
        $this->addRowAction('view');
        $this->addRowAction('delete');


        $this->fields_list = array(
            'id_wpmegamenu' => array(
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

        $this->wpmmCategories = array();
        $this->wpmmCMSPages = '';

    }

    /* ------------------------------------------------------------- */
    /*  INIT PAGE HEADER TOOLBAR
    /* ------------------------------------------------------------- */
    public function initPageHeaderToolbar()
    {
        if (empty($this->display)){
            $this->page_header_toolbar_btn = array(
                'new' => array(
                    'href' => self::$currentIndex.'&addwpmegamenu&token='.$this->token,
                    'desc' => $this->l('Add New Menu', null, null, false),
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

        $this->addCSS(__PS_BASE_URI__.'modules/wpmegamenu/views/css/admin/wpmegamenu.css');

        // Only load these if we are in the view display (menu editor)
        if($this->display == 'view')
        {
            $this->addJqueryUI('ui.sortable');

            $this->addJqueryPlugin('mjs.nestedSortable', __PS_BASE_URI__.'modules/wpmegamenu/views/js/admin/');
            $this->addJqueryPlugin('wpmegamenu', __PS_BASE_URI__.'modules/wpmegamenu/views/js/admin/');
            $this->addJqueryPlugin('autocomplete');

            $this->addJS(_PS_JS_DIR_.'tiny_mce/tiny_mce.js');
            $this->addJS(_PS_JS_DIR_.'tinymce.inc.js');
            $this->addJS(_PS_JS_DIR_.'jquery/plugins/jquery.autosize.min.js');

        }
    }

    /* ------------------------------------------------------------- */
    /*  AJAX PROCESS FOR UPDATING POSITIONS
    /* ------------------------------------------------------------- */
    public function ajaxProcessUpdatePositions()
    {
        $way = (int)(Tools::getValue('way'));
        $id_wpmegamenu = (int)(Tools::getValue('id'));
        $positions = Tools::getValue($this->table);

        foreach ($positions as $position => $value){
            $pos = explode('_', $value);

            if (isset($pos[2]) && (int)$pos[2] === $id_wpmegamenu){
                if ($wpMegamenu = new WPMegamenuModel((int)$pos[2])){
                    if (isset($position) && $wpMegamenu->updatePosition($way, $position)){
                        echo 'ok position '.(int)$position.' for carousel '.(int)$pos[1].'\r\n';
                    } else {
                        echo '{"hasError" : true, "errors" : "Can not update carousel '.(int)$id_wpmegamenu.' to position '.(int)$position.' "}';
                    }
                } else {
                    echo '{"hasError" : true, "errors" : "This carousel ('.(int)$id_wpmegamenu.') can t be loaded"}';
                }

                break;
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  RENDER ADD/EDIT FORM
    /* ------------------------------------------------------------- */
    public function renderForm() {

        // Init Fields form array
        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('Menu'),
                'icon' => 'icon-cogs'
            ),
            // Inputs
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Title'),
                    'name' => 'title',
                    'desc' => $this->l('Must be less than 250 characters.'),
                    'required' => true,
                    'lang' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Description'),
                    'name' => 'description',
                    'desc' => $this->l('Must be less than 125 characters.'),
                    'required' => false,
                    'lang' => true
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Link'),
                    'name' => 'link',
                    'desc' => $this->l('Must be less than 250 characters.'),
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
                array(
                    'type' => 'text',
                    'label' => $this->l('Custom class'),
                    'name' => 'menu_class',
                    'desc' => $this->l('Must be less than 250 characters.'),
                    'required' => false,
                    'lang' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Icon class'),
                    'name' => 'icon_class',
                    'desc' => $this->l('You can use this area to add your iconfont class. Must be less than 250 characters. Ex: "wpicon wpicon-home2". You can see iconfont.css file for complete list of available icons. '),
                    'required' => false,
                    'lang' => false
                ),
            ),
            // Submit Button
            'submit' => array(
                'title' => $this->l('Save'),
                'name' => 'saveMegamenuRoot'
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
    /*  RENDER VIEW
    /* ------------------------------------------------------------- */
    public function renderView()
    {
        $languages = $this->context->language->getLanguages();
        $id_lang = $this->context->language->id;
        $iso = $this->context->language->iso_code;

        $id_wpmegamenu = Tools::getValue('id_wpmegamenu');
        $ajax_url = $this->context->link->getAdminLink('AdminWPMegamenu');

        $menuItems = $this->getMenuItems($id_wpmegamenu);
        $this->getCategories();
        $this->getCMSPages();

        $this->tpl_view_vars = array(
            'languages' => $languages,
            'id_default_lang' => $id_lang,
            'wpmm_id_wpmegamenu' => $id_wpmegamenu,
            'wpmm_ajax_url' => $ajax_url,
            'wpmmMenuItems' => $menuItems,
            'wpmmCategories' => $this->wpmmCategories,
            'wpmmManufacturers' => $this->getManufacturers(),
            'wpmmSuppliers' => $this->getSuppliers(),
            'wpmmCMSPages' => $this->wpmmCMSPages,
            // Rich Text Editor
            'iso' => file_exists(_PS_CORE_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en',
            'path_css' => _THEME_CSS_DIR_,
            'ad' => __PS_BASE_URI__.basename(_PS_ADMIN_DIR_)
            // End - Rich Text Editor
        );

        return parent::renderView();
    }

    /* ------------------------------------------------------------- */
    /*  GET MENU ITEMS
    /* ------------------------------------------------------------- */
    private function getMenuItems($id_wpmegamenu)
    {
        // Check if there is any menu items
        if (WPMegamenuItemsModel::getMenuItemsCount($id_wpmegamenu) == 0){
            return false;
        }

        $id_lang = $this->context->language->id;

        $menuTypes = array(
            'Custom Link / Text' => 1,
            'Category' => 2,
            'Product' => 3,
            'Manufacturer' => 4,
            'Supplier' => 5,
            'Cms Page' => 6,
            'Custom Content' => 7,
            'Divider' => 8,
        );

        $items = WPMegamenuItemsModel::getMenuItems($id_wpmegamenu);

        foreach ($items as $key => $item)
        {
            $wpMegamenu = new WPMegamenuItemsModel($item['id_wpmegamenuitems']);
            $menuItems['items'][$key] = $wpMegamenu;
            $menuItems['items'][$key]->menu_type_name = array_search($wpMegamenu->menu_type, $menuTypes);

            switch ($wpMegamenu->menu_type)
            {
                case 2:
                    // Category Link
                    $catID = $wpMegamenu->link[$id_lang];
                    $category = new Category($catID, $id_lang);
                    $menuItems['items'][$key]->item_info = true;
                    $menuItems['items'][$key]->item_info_label = $this->l('Category: ');
                    $menuItems['items'][$key]->item_info_name = $category->name;
                    $menuItems['items'][$key]->item_info_link = $this->context->link->getCategoryLink($category, null, $id_lang);
                    break;

                case 3:
                    // Product Link
                    $productID = $wpMegamenu->link[$id_lang];
                    $product = new Product($productID, false, $id_lang);
                    $menuItems['items'][$key]->item_info = true;
                    $menuItems['items'][$key]->item_info_label = $this->l('Product: ');
                    $menuItems['items'][$key]->item_info_name = $product->name;
                    $menuItems['items'][$key]->item_info_link = $this->context->link->getProductLink($product, null, $id_lang);
                    break;

                case 4:
                    // Manufacturer Link
                    $manID = $wpMegamenu->link[$id_lang];
                    $manufacturer = new Manufacturer($manID, $id_lang);
                    $menuItems['items'][$key]->item_info = true;
                    $menuItems['items'][$key]->item_info_label = $this->l('Manufacturer: ');
                    $menuItems['items'][$key]->item_info_name = $manufacturer->name;
                    $menuItems['items'][$key]->item_info_link = $this->context->link->getManufacturerLink($manufacturer, null, $id_lang);
                    break;

                case 5:
                    // Supplier Link
                    $supID = $wpMegamenu->link[$id_lang];
                    $supplier = new Supplier($supID, $id_lang);
                    $menuItems['items'][$key]->item_info = true;
                    $menuItems['items'][$key]->item_info_label = $this->l('Supplier: ');
                    $menuItems['items'][$key]->item_info_name = $supplier->name;
                    $menuItems['items'][$key]->item_info_link = $this->context->link->getSupplierLink($supplier, null, $id_lang);
                    break;

                case 6:
                    // CMS Page Link
                    $cmsID = $wpMegamenu->link[$id_lang];
                    $cmsPage = new CMS($cmsID, $id_lang);
                    $menuItems['items'][$key]->item_info = true;
                    $menuItems['items'][$key]->item_info_label = $this->l('CMS Page: ');
                    $menuItems['items'][$key]->item_info_name = $cmsPage->meta_title;
                    $menuItems['items'][$key]->item_info_link = $this->context->link->getCMSLink($cmsPage, null, null, $id_lang);
                    break;
            }

        }

        $menuItems['count'] = WPMegamenuItemsModel::getMenuItemsCount($id_wpmegamenu);

        return $menuItems;
    }

    /* ------------------------------------------------------------- */
    /*  GET CATEGORIES
    /* ------------------------------------------------------------- */
    private function getCategories($id_category = 1, $id_shop = false, $recursive = true)
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

            $spacer = str_repeat('&nbsp;', 1 * $depth);
        }

        $this->wpmmCategories[] = array(
            'value' =>  (int) $category->id,
            'name' => (isset($spacer) ? $spacer : '') . $category->name
        );

        if (isset($children) && count($children)){
            foreach ($children as $child){
                $this->getCategories((int) $child['id_category'], (int) $child['id_shop'], true);
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  GET MANUFACTURERS
    /* ------------------------------------------------------------- */
    private function getManufacturers()
    {
        $id_lang = $this->context->language->id;
        $manArray = array();

        $manufacturers = Manufacturer::getManufacturers(false, $id_lang);

        foreach ($manufacturers as $manufacturer){
            $manArray[] = array(
                'value' => $manufacturer['id_manufacturer'],
                'name' => $manufacturer['name']
            );
        }

        return $manArray;
    }

    /* ------------------------------------------------------------- */
    /*  GET SUPPLIERS
    /* ------------------------------------------------------------- */
    private function getSuppliers()
    {
        $id_lang = $this->context->language->id;
        $supArray = array();

        $suppliers = Supplier::getSuppliers(false, $id_lang);

        foreach ($suppliers as $supplier){
            $supArray[] = array(
                'value' => $supplier['id_supplier'],
                'name' => $supplier['name']
            );
        }

        return $supArray;
    }

    /* ------------------------------------------------------------- */
    /*  GET CMS PAGES
    /* ------------------------------------------------------------- */
    private function getCMSPages()
    {
        $id_lang = $this->context->language->id;

        $cmsCategories = CMSCategory::getCategories($id_lang);

        foreach ($cmsCategories as $key => $value){
            foreach ($value as $catId => $info){
                $cmsPages = CMS::getCMSPages($id_lang, $info['infos']['id_cms_category']);
                $this->wpmmCMSPages .= '<optgroup label="' . $info['infos']['name'] . '">';
                foreach ($cmsPages as $cmsPage){
                    $this->wpmmCMSPages .= '<option value="' . $cmsPage['id_cms'] . '">' . $cmsPage['meta_title'] . '</option>';
                }
                $this->wpmmCMSPages .= '</optgroup>';
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  VIEW - AJAX POST PROCESSES
    /* ------------------------------------------------------------- */

    /*
     * MENU TYPES
     *
     * id : description
     * --   -----------
     *  1 : Custom link
     *  2 : Category link
     *  3 : Product link
     *  4 : Manufacturer link
     *  5 : Supplier link
     *  6 : CMS page link
     *  7 : Custom content
     *  8 : Divider
     *
     */

    /* ------------------------------------------------------------- */
    /*  ADD MENU ITEM
    /* ------------------------------------------------------------- */
    public function ajaxProcessAddMenuItem()
    {
        // Parse the serialized form data
        parse_str(Tools::getValue('formData'), $formData);

        $languages = $this->context->language->getLanguages();
        $id_lang = $this->context->language->id;
        $lang_name = $this->context->language->name;

        $id_wpmegamenu = Tools::getValue('id_wpmegamenu');
        $menu_type = $formData['menu_type'];

        switch ($menu_type){
            case 1:
                $fieldname = 'customlink';
                break;
            case 2:
                $fieldname = 'categorylink';
                break;
            case 3:
                $fieldname = 'productlink';
                break;
            case 4:
                $fieldname = 'manufacturerlink';
                break;
            case 5:
                $fieldname = 'supplierlink';
                break;
            case 6:
                $fieldname = 'cmspagelink';
                break;
            case 7:
                $fieldname = 'customcontent';
                break;
            case 8:
                $fieldname = 'divider';
                break;
            default:
                break;
        }

        // First, check the default language fields, if they are empty, throw an error
        if ( ($formData['wpmm_'.$fieldname.'_title_' . $id_lang] == '') ){

            $ajaxResponse['error'] = true;
            $ajaxResponse['success'] = false;
            $ajaxResponse['errorMessage'] = 'Please fill all the required fields at least in ' . $lang_name . '.';

            die(Tools::jsonEncode($ajaxResponse));
        }

        // If at least default language fields are filled, then do the stuff
        $wpMegamenuItem = new WPMegamenuItemsModel();
        $wpMegamenuItem->id_wpmegamenu = $id_wpmegamenu;

        // Set nleft & nright
        $nright = WPMegamenuItemsModel::getMaxRight($id_wpmegamenu);
        $wpMegamenuItem->nleft = $nright + 1;
        $wpMegamenuItem->nright = $nright + 2;

        // Menu type
        $wpMegamenuItem->menu_type = $menu_type;

        foreach ($languages as $language){

            // Title
            if ($formData['wpmm_'.$fieldname.'_title_' . $language['id_lang']] == ''){
                $title = $formData['wpmm_'.$fieldname.'_title_' . $id_lang];
            } else {
                $title = $formData['wpmm_'.$fieldname.'_title_' . $language['id_lang']];
            }

            // Link
            $link = $formData['wpmm_'.$fieldname.'_link_' . $language['id_lang']];

            $wpMegamenuItem->title[$language['id_lang']] = $title;
            $wpMegamenuItem->link[$language['id_lang']] = $link;
        }

        $response = $wpMegamenuItem->save();

        $ajaxResponse['error'] = false;
        $ajaxResponse['success'] = true;
        $ajaxResponse['successMessage'] = $response;

        die(Tools::jsonEncode($ajaxResponse));

    }

    /* ------------------------------------------------------------- */
    /*  UPDATE MENU ITEM
    /* ------------------------------------------------------------- */
    public function ajaxProcessUpdateMenuItem()
    {
        // Parse the serialized form data
        parse_str(Tools::getValue('formData'), $formData);

        $languages = $this->context->language->getLanguages();
        $id_lang = $this->context->language->id;
        $lang_name = $this->context->language->name;

        $id_wpmegamenuitem = $formData['id_wpmegamenuitem'];
        $menu_type = $formData['menu_type'];

        // First, check the default language fields, if they are empty, throw an error
        if ( ($menu_type == 1 && $formData['wpmm_editmenu_title_' . $id_wpmegamenuitem . '_' . $id_lang] == '') ){

            $ajaxResponse['error'] = true;
            $ajaxResponse['success'] = false;
            $ajaxResponse['errorMessage'] = 'Please fill all the required fields at least in ' . $lang_name . '.';

            die(Tools::jsonEncode($ajaxResponse));
        }

        // If at least default language fields are filled, then do the stuff
        $wpMegamenuItem = new WPMegamenuItemsModel($id_wpmegamenuitem);

        foreach ($languages as $language){

            // Title - only for Custom Link
            if ($menu_type == 1){
                if ($formData['wpmm_editmenu_title_' . $id_wpmegamenuitem . '_' . $language['id_lang']] == ''){
                    $title = $formData['wpmm_editmenu_title_' . $id_wpmegamenuitem . '_' . $id_lang];
                } else {
                    $title = $formData['wpmm_editmenu_title_' . $id_wpmegamenuitem . '_' . $language['id_lang']];
                }
            }

            // Link - only for Custom Link
            if ($menu_type == 1){
                $link = $formData['wpmm_editmenu_link_' . $id_wpmegamenuitem . '_' . $language['id_lang']];
            }

            // Description
            $description = $formData['wpmm_editmenu_description_' . $id_wpmegamenuitem . '_' . $language['id_lang']];

            // Custom Content
            if ($formData['wpmm_editmenu_customcontent_' . $id_wpmegamenuitem . '_' . $language['id_lang']]){
                $customContent = $formData['wpmm_editmenu_customcontent_' . $id_wpmegamenuitem . '_' . $language['id_lang']];
            }

            // Do the assignments
            if (isset($title)){
                $wpMegamenuItem->title[$language['id_lang']] = $title;
            }

            if (isset($link)){
                $wpMegamenuItem->link[$language['id_lang']] = $link;
            }

            $wpMegamenuItem->description[$language['id_lang']] = $description;

            if (isset($customContent)){
                $wpMegamenuItem->content[$language['id_lang']] = $customContent;
            }
        }

        // Non-multilingual stuff
        // Menu Class
        $wpMegamenuItem->menu_class = $formData['wpmm_editmenu_class_' . $id_wpmegamenuitem];

        // Icon Class
        $wpMegamenuItem->icon_class = $formData['wpmm_editicon_class_' . $id_wpmegamenuitem];

        // Menu Layout
        if ($menu_type == 8){
            $wpMegamenuItem->menu_layout = 'menucol-1-1';
        } else {
            if (isset($formData['wpmm_editmenu_layout_' . $id_wpmegamenuitem])){
                if ($formData['wpmm_editmenu_layout_' . $id_wpmegamenuitem] == 'auto'){
                    $wpMegamenuItem->menu_layout = '';
                } else {
                    $wpMegamenuItem->menu_layout = $formData['wpmm_editmenu_layout_' . $id_wpmegamenuitem];
                }
            }
        }

        // Menu Link Target
        if (isset($formData['wpmm_editmenu_target_' . $id_wpmegamenuitem])){
            $wpMegamenuItem->open_in_new = 1;
        } else {
            $wpMegamenuItem->open_in_new = 0;
        }

        // Show Image
        if (isset($formData['wpmm_editmenu_showimage_' . $id_wpmegamenuitem])){
            $wpMegamenuItem->show_image = 1;
        } else {
            $wpMegamenuItem->show_image = 0;
        }

        // SAVE
        $response = $wpMegamenuItem->save();

        $ajaxResponse['error'] = false;
        $ajaxResponse['success'] = true;
        $ajaxResponse['successMessage'] = $response;

        die(Tools::jsonEncode($ajaxResponse));
    }

    /* ------------------------------------------------------------- */
    /*  DELETE MENU ITEM (RECURSIVE)
    /* ------------------------------------------------------------- */
    public function ajaxProcessDeleteMenuItem()
    {
        $itemIds = Tools::getValue('itemIds');

        foreach ($itemIds as $itemId){
            $wpMegamenuItem = new WPMegamenuItemsModel($itemId);
            $wpMegamenuItem->delete();
        }
    }

    /* ------------------------------------------------------------- */
    /*  SAVE THE NESTED STRUCTURE
    /* ------------------------------------------------------------- */
    public function ajaxProcessSaveSortable()
    {
        $menuArray = Tools::getValue('menuArray');

        foreach ($menuArray as $menu){
            if ($menu['item_id']){
                $wpMegamenu = New WPMegamenuItemsModel($menu['item_id']);
                $wpMegamenu->nleft = $menu['left'];
                $wpMegamenu->nright = $menu['right'];
                $wpMegamenu->depth = $menu['depth'];
                $wpMegamenu->update();
            }
        }
    }

    /* ------------------------------------------------------------- */
    /*  RELOAD NESTED STRUCTURE
    /* ------------------------------------------------------------- */
    public function ajaxProcessReloadSortable()
    {
        $languages = $this->context->language->getLanguages();
        $id_lang = $this->context->language->id;

        $id_wpmegamenu = Tools::getValue('id_wpmegamenu');
        $ajax_url = $this->context->link->getAdminLink('AdminWPMegamenu');

        $menuItems = $this->getMenuItems($id_wpmegamenu);

        $this->context->smarty->assign(
            array(
                'languages' => $languages,
                'id_default_lang' => $id_lang,
                'wpmm_id_wpmegamenu' => $id_wpmegamenu,
                'wpmm_ajax_url' => $ajax_url,
                'wpmmMenuItems' => $menuItems
            )
        );

        $renderedSortable = $this->context->smarty->fetch(_PS_MODULE_DIR_.'wpmegamenu/views/templates/admin/wp_megamenu/helpers/view/menu_builder.tpl');

        die(Tools::jsonEncode($renderedSortable));

    }

}
