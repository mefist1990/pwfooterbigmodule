<?php
/**
* 2007-2018 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2018 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Pwfooterbigmodule extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'pwfooterbigmodule';
        $this->tab = 'others';
        $this->version = '0.1.0';
        $this->author = 'PrestaWeb.ru';
        $this->need_instance = 1;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Footer Big Module');
        $this->description = $this->l('Creates a common module for footer, with all the functions');

        $this->confirmUninstall = $this->l('');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', '10');

        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() &&
            $this->registerHook('header') &&
            $this->registerHook('backOfficeHeader') &&
            $this->registerHook('displayFooter');
    }

    public function uninstall()
    {
        Configuration::deleteByName('PWFOOTERBIGMODULE_COUNT_CATEGORY');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

public function getContent()
{
    $output = null;
 
    if (Tools::isSubmit('submit'.$this->name))
    {
        $PWFOOTERBIGMODULE_COUNT_CATEGORY = strval(Tools::getValue('PWFOOTERBIGMODULE_COUNT_CATEGORY'));
        

        if (!ctype_digit($PWFOOTERBIGMODULE_COUNT_CATEGORY))
        {
            $output .= $this->displayError($this->l('Enter only the number'));
            return $output.$this->displayForm();
        }

        if ((!$PWFOOTERBIGMODULE_COUNT_CATEGORY
          || empty($PWFOOTERBIGMODULE_COUNT_CATEGORY)
          || !Validate::isGenericName($PWFOOTERBIGMODULE_COUNT_CATEGORY)))
            $output .= $this->displayError($this->l('Invalid Configuration value'));
        else
        {
            Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', $PWFOOTERBIGMODULE_COUNT_CATEGORY);
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }



    }
    return $output.$this->displayForm();
}

    public function displayForm()
{

    $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
     

    $fields_form[0]['form'] = array(
        'legend' => array(
            'title' => $this->l('Settings'),
        ),
        'input' => array(
            array(
                'type' => 'text',
                'label' => $this->l('Number of categories to be displayed'),
                'name' => 'PWFOOTERBIGMODULE_COUNT_CATEGORY',
                'size' => 5,
                'required' => true
            )

        ),
        'submit' => array(
            'title' => $this->l('Save'),
            'class' => 'btn btn-default pull-right'
        )
    );
     
    $helper = new HelperForm();
     

    $helper->module = $this;
    $helper->name_controller = $this->name;
    $helper->token = Tools::getAdminTokenLite('AdminModules');
    $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;
     

    $helper->default_form_language = $default_lang;
    $helper->allow_employee_form_lang = $default_lang;
     

    $helper->title = $this->displayName;
    $helper->show_toolbar = true;        
    $helper->toolbar_scroll = true;      
    $helper->submit_action = 'submit'.$this->name;
    $helper->toolbar_btn = array(
        'save' =>
        array(
            'desc' => $this->l('Save'),
            'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
            '&token='.Tools::getAdminTokenLite('AdminModules'),
        ),
        'back' => array(
            'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
            'desc' => $this->l('Back to list')
        )
    );
     

    $helper->fields_value['PWFOOTERBIGMODULE_COUNT_CATEGORY'] = Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY');
    return $helper->generateForm($fields_form);
}
    /**
    * Add the CSS & JavaScript files you want to be loaded in the BO.
    */
    public function hookBackOfficeHeader()
    {
        if (Tools::getValue('module_name') == $this->name) {
            $this->context->controller->addJS($this->_path.'views/js/back.js');
            $this->context->controller->addCSS($this->_path.'views/css/back.css');
        }
    }

    /**
     * Add the CSS & JavaScript files you want to be added on the FO.
     */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    public function hookDisplayFooter()
    {
        //Делаем общую таблицу из трех таблиц category , category_lang и category_shop и сортируем по позициям
        $rewriting_settings = Configuration::get('PS_REWRITING_SETTINGS');
        (int)$count_category = Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY');
        $table_category = Db::getInstance()->executeS('
        SELECT *
        FROM '._DB_PREFIX_.'category pwc
        
        INNER JOIN '._DB_PREFIX_.'category_lang pwcl
        ON pwc.id_category = pwcl.id_category
            
        INNER JOIN '._DB_PREFIX_.'category_shop pwcs
        ON pwc.id_category = pwcs.id_category
        WHERE id_shop_default = 1 AND active = 1 AND id_parent = 2
        ORDER BY pwcs.position ASC
        LIMIT '. $count_category);

        if($rewriting_settings == 1){
                $category_url = array(
                array
            (
                'name' => '',
                'link_rewrite'  => '',
                'url'  => ''
            )
            );
            //ddd($table_category);
            foreach($table_category as $key=>$category)
            {
                $category_url[$key]['name'] = $category['name'];
                $category_url[$key]['link_rewrite'] = $category['link_rewrite'];
                $category_url[$key]['url'] = $category['id_category'] . '-' .$category['link_rewrite'];
            }
        }
        if($rewriting_settings == 0){
            //ddd('stop');
            $category_url = array(
                array
            (
                'name' => '',
                'link_rewrite'  => '',
                'url'  => ''
            )
            );
            foreach($table_category as $key=>$category)
            {
                $category_url[$key]['name'] = $category['name'];
                $category_url[$key]['link_rewrite'] = $category['link_rewrite'];
                $category_url[$key]['url'] = "index.php?id_category=".$category['id_category']."&controller=category";
            }
        }
        $this->context->smarty->assign('category_url', $category_url);
        return $this->display(__FILE__, 'pwfooterbigmodule.tpl');

    }

  
}
