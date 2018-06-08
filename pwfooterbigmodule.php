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


        $fields_form[0]  = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings category'),
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
                    
				)
			),
		);

        $fields_form[1] = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings social page'),
					'icon' => 'icon-cogs'
                ),

				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Facebook URL'),
						'name' => 'PWFOOTERBIGMODULE_FACEBOOK',
                        'desc' => $this->l('Your Facebook fan page.'),
                        'class' => 'form-control'
                    ),
                    array(
						'type' => 'text',
						'label' => $this->l('Vk.com URL'),
						'name' => 'PWFOOTERBIGMODULE_VK',
                        'desc' => $this->l('Your official vk.com account.'),
                        'class' => 'form-control'
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
       // ddd($fields_form);
        return $helper->generateForm($fields_form);
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
        $PWFOOTERBIGMODULE_FACEBOOK = strval(Tools::getValue('PWFOOTERBIGMODULE_FACEBOOK'));
        $PWFOOTERBIGMODULE_VK = strval(Tools::getValue('PWFOOTERBIGMODULE_VK'));
        $PWFOOTERBIGMODULE_OK = strval(Tools::getValue('PWFOOTERBIGMODULE_OK'));
        $PWFOOTERBIGMODULE_TWITTER = strval(Tools::getValue('PWFOOTERBIGMODULE_TWITTER'));
        $PWFOOTERBIGMODULE_RSS = strval(Tools::getValue('PWFOOTERBIGMODULE_RSS'));
        $PWFOOTERBIGMODULE_YOUTUBE = strval(Tools::getValue('PWFOOTERBIGMODULE_YOUTUBE'));
        $PWFOOTERBIGMODULE_GOOGLE_PLUS = strval(Tools::getValue('PWFOOTERBIGMODULE_GOOGLE_PLUS'));
        $PWFOOTERBIGMODULE_PINTEREST = strval(Tools::getValue('PWFOOTERBIGMODULE_PINTEREST'));
        $PWFOOTERBIGMODULE_VIMEO = strval(Tools::getValue('PWFOOTERBIGMODULE_VIMEO'));
        $PWFOOTERBIGMODULE_INSTAGRAM = strval(Tools::getValue('PWFOOTERBIGMODULE_INSTAGRAM'));

        
        if (Tools::isSubmit('submitPWFOOTERBIGMODULE')){
             $PWFOOTERBIGMODULE_COUNT_CATEGORY = strval(Tools::getValue('PWFOOTERBIGMODULE_COUNT_CATEGORY'));
        

            if (!ctype_digit($PWFOOTERBIGMODULE_COUNT_CATEGORY)){
                $output .= $this->displayError($this->l('Enter only the number'));
             //   $helper->fields_value['PWFOOTERBIGMODULE_COUNT_CATEGORY'] = Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY');

                return $output.$this->renderForm();
            }

        if ((!$PWFOOTERBIGMODULE_COUNT_CATEGORY
          || empty($PWFOOTERBIGMODULE_COUNT_CATEGORY)
          || !Validate::isGenericName($PWFOOTERBIGMODULE_COUNT_CATEGORY)))
            $output .= $this->displayError($this->l('Invalid Configuration value'));
        else{
            Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', $PWFOOTERBIGMODULE_COUNT_CATEGORY);
            Configuration::updateValue('PWFOOTERBIGMODULE_FACEBOOK', $PWFOOTERBIGMODULE_FACEBOOK);
            Configuration::updateValue('PWFOOTERBIGMODULE_VK', $PWFOOTERBIGMODULE_VK);
            Configuration::updateValue('PWFOOTERBIGMODULE_OK', $PWFOOTERBIGMODULE_OK);
            Configuration::updateValue('PWFOOTERBIGMODULE_TWITTER', $PWFOOTERBIGMODULE_TWITTER);
            Configuration::updateValue('PWFOOTERBIGMODULE_RSS', $PWFOOTERBIGMODULE_RSS);
            Configuration::updateValue('PWFOOTERBIGMODULE_YOUTUBE', $PWFOOTERBIGMODULE_YOUTUBE);
            Configuration::updateValue('PWFOOTERBIGMODULE_GOOGLE_PLUS', $PWFOOTERBIGMODULE_GOOGLE_PLUS);
            Configuration::updateValue('PWFOOTERBIGMODULE_PINTEREST', $PWFOOTERBIGMODULE_PINTEREST);
            Configuration::updateValue('PWFOOTERBIGMODULE_VIMEO', $PWFOOTERBIGMODULE_VIMEO);
            Configuration::updateValue('PWFOOTERBIGMODULE_INSTAGRAM', $PWFOOTERBIGMODULE_INSTAGRAM);
            


            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
        }
        return $output.$this->renderForm(); 
        }
    //end_helper

    public function FunctionSocialLinkFooter()
    {
        $url_facebook = strval(Configuration::get('PWFOOTERBIGMODULE_FACEBOOK'));
        $url_vk = strval(Configuration::get('PWFOOTERBIGMODULE_VK'));
        $url_ok = strval(Configuration::get('PWFOOTERBIGMODULE_OK'));
        $url_twitter = strval(Configuration::get('PWFOOTERBIGMODULE_TWITTER'));
        $url_rss = strval(Configuration::get('PWFOOTERBIGMODULE_RSS'));
        $url_youtube = strval(Configuration::get('PWFOOTERBIGMODULE_YOUTUBE'));
        $url_google_plus = strval(Configuration::get('PWFOOTERBIGMODULE_GOOGLE_PLUS'));
        $url_vimeo = strval(Configuration::get('PWFOOTERBIGMODULE_VIMEO'));
        $url_instagram = strval(Configuration::get('PWFOOTERBIGMODULE_INSTAGRAM'));



        if ((!empty($url_facebook) and  (!preg_match('/^\s+$/', $url_facebook)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'facebook',
            'url' => $url_facebook,
            'name' => $this->l('Facebook') 
        ];
        }
        if ((!empty($url_vk) and  (!preg_match('/^\s+$/', $url_vk)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'vk',
            'url' => $url_vk,
            'name' => $this->l('Vk.com') 
        ];
        }
        if ((!empty($url_ok) and  (!preg_match('/^\s+$/', $url_ok)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'ok',
            'url' => $url_ok,
            'name' => $this->l('Ok.ru') 
        ];
        }
        if ((!empty($url_twitter) and  (!preg_match('/^\s+$/', $url_twitter)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'twitter',
            'url' => $url_twitter,
            'name' => $this->l('Twitter') 
        ];
        }
        if ((!empty($url_rss) and  (!preg_match('/^\s+$/', $url_rss)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'rss',
            'url' => $url_rss,
            'name' => $this->l('RSS') 
        ];
        }
        if ((!empty($url_youtube) and  (!preg_match('/^\s+$/', $url_youtube)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'youtube',
            'url' => $url_youtube,
            'name' => $this->l('Youtube') 
        ];
        }
        if ((!empty($url_google_plus) and  (!preg_match('/^\s+$/', $url_google_plus)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'google_plus',
            'url' => $url_google_plus,
            'name' => $this->l('Google Plus') 
        ];
        }
        if ((!empty($url_vimeo) and  (!preg_match('/^\s+$/', $url_vimeo)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'vimeo',
            'url' => $url_vimeo,
            'name' => $this->l('Vimeo') 
        ];
        }
        if ((!empty($url_instagram) and  (!preg_match('/^\s+$/', $url_instagram)) == 1)) {
                   $social_link_footer[] = [
            'class' => 'instagram',
            'url' => $url_instagram,
            'name' => $this->l('Instagram') 
        ];
        }

        return $social_link_footer;
        
    }

    public function FunctionShopPhoneFooter()
    {
        $ps_shop_phone = Configuration::get('PS_SHOP_PHONE');
        return $ps_shop_phone;
    }

    public function FunctionShopMailFooter()
    {
        $ps_shop_mail = Configuration::get('PS_SHOP_EMAIL');
        return $ps_shop_mail;
    }

    public function FunctionShopAddresFooter()
    {
        $ps_shop_phone_str = $ps_shop_email_str = $ps_shop_addr1_str = $ps_shop_addr2_str = $ps_shop_code_str = $ps_shop_city_str = '';
        $ps_shop_phone = Configuration::get('PS_SHOP_PHONE');
        $ps_shop_email = Configuration::get('PS_SHOP_EMAIL');
        $ps_shop_addr1 = Configuration::get('PS_SHOP_ADDR1');
        $ps_shop_addr2 = Configuration::get('PS_SHOP_ADDR2');
        $ps_shop_code = Configuration::get('PS_SHOP_CODE');
        $ps_shop_city = Configuration::get('PS_SHOP_CITY');
        $ps_shop_country_id = Configuration::get('PS_SHOP_COUNTRY_ID');
        
        if (!empty($ps_shop_city) ) {
            $ps_shop_city_str = ', ';
        }
        if (!empty($ps_shop_addr1) ) {
            $ps_shop_addr1_str = ', ';
        }
        if (!empty($ps_shop_addr2) ) {
            $ps_shop_addr2_str = ', ';
        }        
        $shop_addres_footer = 
        $ps_shop_city . $ps_shop_city_str . 
        $ps_shop_addr1 . $ps_shop_addr1_str . 
        $ps_shop_addr2 . $ps_shop_addr2_str . 
        $ps_shop_code;

        ///ddd($shop_addres_footer);
        return $shop_addres_footer;

    }


	public function hookdisplayFooter($params){
        (int)$PWFOOTERBIGMODULE_COUNT_CATEGORY = Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY');
        
        //Делаем общую таблицу из трех таблиц category , category_lang и category_shop и сортируем по позициям

        $table_category = Db::getInstance()->executeS
        ('SELECT *
        FROM '._DB_PREFIX_.'category c
        INNER JOIN '._DB_PREFIX_.'category_lang cl
        ON c.id_category = cl.id_category          
        INNER JOIN '._DB_PREFIX_.'category_shop cs
        ON c.id_category = cs.id_category
        WHERE id_shop_default = '
        .(int)$this->context->shop->id.
        ' AND active = 1 AND id_parent = '
        .(int)Configuration::get('PS_HOME_CATEGORY').
        ' ORDER BY cs.position ASC LIMIT '
        . $PWFOOTERBIGMODULE_COUNT_CATEGORY);
        $shop_addres_footer = $this->FunctionShopAddresFooter();
        $social_link_footer = $this->FunctionSocialLinkFooter();
        $ps_shop_phone = $this->FunctionShopPhoneFooter();
        $ps_shop_mail = $this->FunctionShopMailFooter();
       // ddd($social_link_footer);
        $this->context->smarty->assign('shop_addres_footer', $shop_addres_footer);
        $this->context->smarty->assign('social_link_footer', $social_link_footer);
        $this->context->smarty->assign('ps_shop_phone', $ps_shop_phone);
        $this->context->smarty->assign('table_category', $table_category);
        $this->context->smarty->assign('ps_shop_mail', $ps_shop_mail);
        //ddd($this->_path);
        $this->context->controller->addCSS(($this->_path).'assets/css/bootstrap.css', 'all'); 
       // $this->context->controller->addCSS(($this->_path).'assets/css/docs.css', 'all'); 
        $this->context->controller->addCSS(($this->_path).'assets/css/font-awesome.css', 'all'); 
        $this->context->controller->addJs(($this->_path).'assets/js/docs.js', 'all'); 
        $this->context->controller->addJs(($this->_path).'assets/js/jquery.js', 'all'); 
        return $this->display(__FILE__, 'pwfooterbigmodule.tpl');
	}


}


