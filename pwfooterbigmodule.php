<?php
if (!defined('_PS_VERSION_'))
    exit;

class pwfooterbigmodule extends Module
{
    public function __construct()
    {
        $this->name = strtolower(get_class());
        $this->tab = 'other';
        $this->version = 0.1.0;
        $this->author = 'PrestaWeb.ru';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l("Footer Big Module");
        $this->description = $this->l("Creates a common module for footer, with all the functions");
        
        $this->ps_versions_compliancy = array('min' => '1.6.0.0', 'max' => _PS_VERSION_);
    }

    public function install()
    {
        
        if ( !parent::install()
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', '10') 
			OR !$this->registerHook(Array(
				'displayFooter',
			))
            
        ) return false;

        return true;
    }

    public function uninstall()
    {
        Configuration::deleteByName('PWFOOTERBIGMODULE_COUNT_CATEGORY');
        return parent::uninstall();
    }

    //start_helper
    public function renderForm()
    {
        $fields_form = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Settings'),
                    'icon' => 'icon-cogs'
                ),
                'input' => array(
                    
                    array(
                        'type' => 'text',
                        'label' => $this->l('Number of categories to be displayed'),
                        'name' => 'PWFOOTERBIGMODULE_COUNT_CATEGORY',
                        'size' => 5,
                        'required' => true,
                    )

                ),
                'submit' => array(
                    'title' => $this->l('Save'),
                )
            ),
        );

        $helper = new HelperForm();
        $helper->show_toolbar = false;
        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'submitPWFOOTERBIGMODULE';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );

        return $helper->generateForm(array($fields_form));
    }

    public function getConfigFieldsValues()
    {
        return array(
            'PWFOOTERBIGMODULE_COUNT_CATEGORY' => Tools::getValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY')),

        );
    }
    public function getContent()
    {
        $output = '';
        if (Tools::isSubmit('submitPWFOOTERBIGMODULE'))
        {
             $PWFOOTERBIGMODULE_COUNT_CATEGORY = strval(Tools::getValue('PWFOOTERBIGMODULE_COUNT_CATEGORY'));
        

        if (!ctype_digit($PWFOOTERBIGMODULE_COUNT_CATEGORY)){
            $output .= $this->displayError($this->l('Enter only the number'));
            return $output.$this->renderForm();
        }

        if ((!$PWFOOTERBIGMODULE_COUNT_CATEGORY
          || empty($PWFOOTERBIGMODULE_COUNT_CATEGORY)
          || !Validate::isGenericName($PWFOOTERBIGMODULE_COUNT_CATEGORY)))
            $output .= $this->displayError($this->l('Invalid Configuration value'));
        else{
            Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', $PWFOOTERBIGMODULE_COUNT_CATEGORY);
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
        }
        return $output.$this->renderForm(); 
    }
    //end_helper

    

    


	public function hookdisplayFooter($params){
        (int)$count_category = Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY');
        //Делаем общую таблицу из трех таблиц category , category_lang и category_shop и сортируем по позициям

        $table_category = Db::getInstance()->executeS('
        SELECT *
        FROM '._DB_PREFIX_.'category c
        
        INNER JOIN '._DB_PREFIX_.'category_lang cl
        ON c.id_category = cl.id_category
            
        INNER JOIN '._DB_PREFIX_.'category_shop cs
        ON c.id_category = cs.id_category
        WHERE id_shop_default = 1 AND active = 1 AND id_parent = 2
        ORDER BY cs.position ASC
        LIMIT '. $count_category);
        $this->context->smarty->assign('table_category', $table_category);
        return $this->display(__FILE__, 'pwfooterbigmodule.tpl');
	}


}


