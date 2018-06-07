<?php
if (!defined('_PS_VERSION_'))
    exit;

class pwfooterbigmodule extends Module
{
    public function __construct()
    {
        $this->name = strtolower(get_class());
        $this->tab = 'other';
        $this->version = '0.1.0';
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
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_FACEBOOK', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_VK', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_OK', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_TWITTER', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_RSS', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_YOUTUBE', '')  
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_GOOGLE_PLUS', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_PINTEREST', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_VIMEO', '') 
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_INSTAGRAM', '') 

			OR !$this->registerHook(Array(
				'displayFooter',
			))
            
        ) return false;

        return true;
    }

    public function uninstall()
    {
        Configuration::deleteByName('PWFOOTERBIGMODULE_COUNT_CATEGORY');
        Configuration::deleteByName('PWFOOTERBIGMODULE_FACEBOOK');
        Configuration::deleteByName('PWFOOTERBIGMODULE_VK');
        Configuration::deleteByName('PWFOOTERBIGMODULE_OK');
        Configuration::deleteByName('PWFOOTERBIGMODULE_TWITTER');
        Configuration::deleteByName('PWFOOTERBIGMODULE_RSS');
        Configuration::deleteByName('PWFOOTERBIGMODULE_YOUTUBE');
        Configuration::deleteByName('PWFOOTERBIGMODULE_GOOGLE_PLUS');
        Configuration::deleteByName('PWFOOTERBIGMODULE_PINTEREST');
        Configuration::deleteByName('PWFOOTERBIGMODULE_VIMEO');
        Configuration::deleteByName('PWFOOTERBIGMODULE_INSTAGRAM');

        return parent::uninstall();
    }

    //start_helper
    public function renderForm()
    {


        $fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings social page'),
					'icon' => 'icon-cogs'
                ),

				'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Number of categories to be displayed'),
                        'name' => 'PWFOOTERBIGMODULE_COUNT_CATEGORY',
                        'size' => 5,
                        'required' => true,
                    ),
					array(
						'type' => 'text',
						'label' => $this->l('Facebook URL'),
						'name' => 'PWFOOTERBIGMODULE_FACEBOOK',
						'desc' => $this->l('Your Facebook fan page.'),
                    ),
                    array(
						'type' => 'text',
						'label' => $this->l('Vk.com URL'),
						'name' => 'PWFOOTERBIGMODULE_VK',
						'desc' => $this->l('Your official vk.com account.'),
                    ),
                    array(
						'type' => 'text',
						'label' => $this->l('Ok.ru URL'),
						'name' => 'PWFOOTERBIGMODULE_OK',
						'desc' => $this->l('Your official ok.ru account.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Twitter URL'),
						'name' => 'PWFOOTERBIGMODULE_TWITTER',
						'desc' => $this->l('Your official Twitter account.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('RSS URL'),
						'name' => 'PWFOOTERBIGMODULE_RSS',
						'desc' => $this->l('The RSS feed of your choice (your blog, your store, etc.).'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('YouTube URL'),
						'name' => 'PWFOOTERBIGMODULE_YOUTUBE',
						'desc' => $this->l('Your official YouTube account.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Google+ URL:'),
						'name' => 'PWFOOTERBIGMODULE_GOOGLE_PLUS',
						'desc' => $this->l('Your official Google+ page.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Pinterest URL:'),
						'name' => 'PWFOOTERBIGMODULE_PINTEREST',
						'desc' => $this->l('Your official Pinterest account.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Vimeo URL:'),
						'name' => 'PWFOOTERBIGMODULE_VIMEO',
						'desc' => $this->l('Your official Vimeo account.'),
					),
					array(
						'type' => 'text',
						'label' => $this->l('Instagram URL:'),
						'name' => 'PWFOOTERBIGMODULE_INSTAGRAM',
						'desc' => $this->l('Your official Instagram account.'),
					),
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
            'PWFOOTERBIGMODULE_FACEBOOK' => Tools::getValue('PWFOOTERBIGMODULE_FACEBOOK', Configuration::get('PWFOOTERBIGMODULE_FACEBOOK')),
            'PWFOOTERBIGMODULE_VK' => Tools::getValue('PWFOOTERBIGMODULE_VK', Configuration::get('PWFOOTERBIGMODULE_VK')),
            'PWFOOTERBIGMODULE_OK' => Tools::getValue('PWFOOTERBIGMODULE_OK', Configuration::get('PWFOOTERBIGMODULE_OK')),
            'PWFOOTERBIGMODULE_TWITTER' => Tools::getValue('PWFOOTERBIGMODULE_TWITTER', Configuration::get('PWFOOTERBIGMODULE_TWITTER')),
            'PWFOOTERBIGMODULE_RSS' => Tools::getValue('PWFOOTERBIGMODULE_RSS', Configuration::get('PWFOOTERBIGMODULE_RSS')),
            'PWFOOTERBIGMODULE_YOUTUBE' => Tools::getValue('PWFOOTERBIGMODULE_YOUTUBE', Configuration::get('PWFOOTERBIGMODULE_YOUTUBE')),
            'PWFOOTERBIGMODULE_GOOGLE_PLUS' => Tools::getValue('PWFOOTERBIGMODULE_GOOGLE_PLUS', Configuration::get('PWFOOTERBIGMODULE_GOOGLE_PLUS')),
            'PWFOOTERBIGMODULE_PINTEREST' => Tools::getValue('PWFOOTERBIGMODULE_PINTEREST', Configuration::get('PWFOOTERBIGMODULE_PINTEREST')),
            'PWFOOTERBIGMODULE_VIMEO' => Tools::getValue('PWFOOTERBIGMODULE_VIMEO', Configuration::get('PWFOOTERBIGMODULE_VIMEO')),
            'PWFOOTERBIGMODULE_INSTAGRAM' => Tools::getValue('PWFOOTERBIGMODULE_INSTAGRAM', Configuration::get('PWFOOTERBIGMODULE_INSTAGRAM')),


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


