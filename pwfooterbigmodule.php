<?php
if (!defined('_PS_VERSION_'))
    exit;

class pwfooterbigmodule extends Module
{
    public function __construct()
    {
        $this->name = strtolower(get_class());
        $this->tab = 'other';
        $this->version = '0.1.1';
        $this->author = 'PrestaWeb.ru';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l("Единный модуль для Footer");
        $this->description = $this->l("Объединяет в себе, разделы Категорий, Социальных страниц и т.д.");

        $this->ps_versions_compliancy = array('min' => '1.6.0.0', 'max' => _PS_VERSION_);
    }

    public function install()
    {

        if (!parent::install()
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', '10')

            OR !Configuration::updateValue('PWFOOTERBIGMODULE_FACEBOOK', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_VK', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_OK', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_TWITTER', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_GOOGLE_PLUS', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_INSTAGRAM', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_YOUTUBE', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_MAIL_RU', '')
            OR !Configuration::updateValue('PWFOOTERBIGMODULE_INFORMATION_PAGE', '')
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
        Configuration::deleteByName('PWFOOTERBIGMODULE_GOOGLE_PLUS');
        Configuration::deleteByName('PWFOOTERBIGMODULE_INSTAGRAM');
        Configuration::deleteByName('PWFOOTERBIGMODULE_YOUTUBE');
        Configuration::deleteByName('PWFOOTERBIGMODULE_MAIL_RU');
        Configuration::deleteByName('PWFOOTERBIGMODULE_INFORMATION_PAGE');


        return parent::uninstall();
    }

    //start_helper
    public function renderForm()
    {


        $fields_form[0] = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Настройка категорий'),
                    'icon' => 'icon-cogs'
                ),

                'input' => array(

                    array(
                        'type' => 'text',
                        'label' => $this->l('Введите количество отображаемых категорий'),
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
                    'title' => $this->l('Настройка социальных сетей'),
                    'icon' => 'icon-cogs'
                ),

                'input' => array(
                    array(
                        'type' => 'text',
                        'label' => $this->l('Facebook Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_FACEBOOK',
                        'desc' => $this->l('Ваш официальный Facebook аккаунт.'),
                        'class' => 'form-control'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Vk.com Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_VK',
                        'desc' => $this->l('Ваш официальный vk.com аккаунт.'),
                        'class' => 'form-control'
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Ok.ru Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_OK',
                        'desc' => $this->l('Ваш официальный ok.ru аккаунт.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Twitter Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_TWITTER',
                        'desc' => $this->l('Ваш официальный Twitter аккаунт.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Google+ Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_GOOGLE_PLUS',
                        'desc' => $this->l('Ваш официальный  Google+ аккаунт.'),
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Instagram Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_INSTAGRAM',
                        'desc' => $this->l('Ваш официальный Instagram аккаунт.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('YouTube Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_YOUTUBE',
                        'desc' => $this->l('Ваш официальный YouTube аккаунт.'),
                    ),
                    array(
                        'type' => 'text',
                        'label' => $this->l('Mail.ru Ссылка:'),
                        'name' => 'PWFOOTERBIGMODULE_MAIL_RU',
                        'desc' => $this->l('Ваш официальный Mail.ru аккаунт.'),
                    ),
                )

            ),
        );

        $fields_form[2] = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->l('Страницы'),
                    'icon' => 'icon-cogs'
                ),

                'input' => array(
                    array(
                        'type' => 'textarea',
                        'label' => $this->l('Введите Название и ссылки на ваши страницы'),
                        'name' => 'PWFOOTERBIGMODULE_INFORMATION_PAGE',
                        'desc' => $this->l('                        
                        Пример: 
                        Моя страница 1|https://mail.ru;
                        Моя страница 2|https://mail2.ru;
                        Моя страница 3|https://mai3.ru;
                        Моя страница 4|https://mail4.ru;
                        Моя страница 5|https://mail5.ru;

                        '),
                        'class' => 'form-control'
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
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false) . '&configure=' . $this->name . '&tab_module=' . $this->tab . '&module_name=' . $this->name;
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
            'PWFOOTERBIGMODULE_GOOGLE_PLUS' => Tools::getValue('PWFOOTERBIGMODULE_GOOGLE_PLUS', Configuration::get('PWFOOTERBIGMODULE_GOOGLE_PLUS')),
            'PWFOOTERBIGMODULE_INSTAGRAM' => Tools::getValue('PWFOOTERBIGMODULE_INSTAGRAM', Configuration::get('PWFOOTERBIGMODULE_INSTAGRAM')),
            'PWFOOTERBIGMODULE_YOUTUBE' => Tools::getValue('PWFOOTERBIGMODULE_YOUTUBE', Configuration::get('PWFOOTERBIGMODULE_YOUTUBE')),
            'PWFOOTERBIGMODULE_MAIL_RU' => Tools::getValue('PWFOOTERBIGMODULE_MAIL_RU', Configuration::get('PWFOOTERBIGMODULE_MAIL_RU')),
            'PWFOOTERBIGMODULE_INFORMATION_PAGE' => Tools::getValue('PWFOOTERBIGMODULE_INFORMATION_PAGE', Configuration::get('PWFOOTERBIGMODULE_INFORMATION_PAGE')),


        );
    }

    public function getContent()
    {
        $output = '';
        $PWFOOTERBIGMODULE_FACEBOOK = strval(Tools::getValue('PWFOOTERBIGMODULE_FACEBOOK'));
        $PWFOOTERBIGMODULE_VK = strval(Tools::getValue('PWFOOTERBIGMODULE_VK'));
        $PWFOOTERBIGMODULE_OK = strval(Tools::getValue('PWFOOTERBIGMODULE_OK'));
        $PWFOOTERBIGMODULE_TWITTER = strval(Tools::getValue('PWFOOTERBIGMODULE_TWITTER'));
        $PWFOOTERBIGMODULE_GOOGLE_PLUS = strval(Tools::getValue('PWFOOTERBIGMODULE_GOOGLE_PLUS'));
        $PWFOOTERBIGMODULE_INSTAGRAM = strval(Tools::getValue('PWFOOTERBIGMODULE_INSTAGRAM'));
        $PWFOOTERBIGMODULE_YOUTUBE = strval(Tools::getValue('PWFOOTERBIGMODULE_YOUTUBE'));
        $PWFOOTERBIGMODULE_MAIL_RU = strval(Tools::getValue('PWFOOTERBIGMODULE_MAIL_RU'));

        $pwfooterbigmodule_information_page = strval(Tools::getValue('PWFOOTERBIGMODULE_INFORMATION_PAGE'));


        if (Tools::isSubmit('submitPWFOOTERBIGMODULE')) {
            $PWFOOTERBIGMODULE_COUNT_CATEGORY = strval(Tools::getValue('PWFOOTERBIGMODULE_COUNT_CATEGORY'));


            if (!ctype_digit($PWFOOTERBIGMODULE_COUNT_CATEGORY)) {
                $output .= $this->displayError($this->l('Enter only the number'));
                //   $helper->fields_value['PWFOOTERBIGMODULE_COUNT_CATEGORY'] = Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY');

                return $output . $this->renderForm();
            }

            if ((!$PWFOOTERBIGMODULE_COUNT_CATEGORY
                || empty($PWFOOTERBIGMODULE_COUNT_CATEGORY)
                || !Validate::isGenericName($PWFOOTERBIGMODULE_COUNT_CATEGORY))
            )
                $output .= $this->displayError($this->l('Invalid Configuration value'));
            else {
                Configuration::updateValue('PWFOOTERBIGMODULE_COUNT_CATEGORY', trim($PWFOOTERBIGMODULE_COUNT_CATEGORY));
                Configuration::updateValue('PWFOOTERBIGMODULE_FACEBOOK', trim($PWFOOTERBIGMODULE_FACEBOOK));
                Configuration::updateValue('PWFOOTERBIGMODULE_VK', trim($PWFOOTERBIGMODULE_VK));
                Configuration::updateValue('PWFOOTERBIGMODULE_OK', trim($PWFOOTERBIGMODULE_OK));
                Configuration::updateValue('PWFOOTERBIGMODULE_TWITTER', trim($PWFOOTERBIGMODULE_TWITTER));
                Configuration::updateValue('PWFOOTERBIGMODULE_GOOGLE_PLUS', trim($PWFOOTERBIGMODULE_GOOGLE_PLUS));
                Configuration::updateValue('PWFOOTERBIGMODULE_INSTAGRAM', trim($PWFOOTERBIGMODULE_INSTAGRAM));
                Configuration::updateValue('PWFOOTERBIGMODULE_YOUTUBE', trim($PWFOOTERBIGMODULE_YOUTUBE));
                Configuration::updateValue('PWFOOTERBIGMODULE_MAIL_RU', trim($PWFOOTERBIGMODULE_MAIL_RU));
                Configuration::updateValue('PWFOOTERBIGMODULE_INFORMATION_PAGE', trim($pwfooterbigmodule_information_page));


                $output .= $this->displayConfirmation($this->l('Settings updated'));
            }
        }
        return $output . $this->renderForm();
    }
    //end_helper


    /**
     * @return array
     */
    public function getInformationColumn()
    {
        $information_page = Configuration::get('PWFOOTERBIGMODULE_INFORMATION_PAGE');
        $information_link_footer = array();

        $string_information_link = explode(";", $information_page);
        foreach ($string_information_link as $information_link) {
            if ((!empty($information_link) and (!preg_match('/^\s+$/', $information_link)) == 1)) {
                $array_information_link = explode("|", $information_link);
                $information_link_footer[] = [
                    'title' => $array_information_link[0],
                    'url' => $array_information_link[1]
                ];
            }


        }
        return $information_link_footer;
    }


    public function hookdisplayFooter($params)
    {
        //Делаем общую таблицу из трех таблиц category , category_lang и category_shop и сортируем по позициям
        $table_category = Db::getInstance()->executeS
        ('SELECT *
        FROM ' . _DB_PREFIX_ . 'category c
        INNER JOIN ' . _DB_PREFIX_ . 'category_lang cl
        ON c.id_category = cl.id_category          
        INNER JOIN ' . _DB_PREFIX_ . 'category_shop cs
        ON c.id_category = cs.id_category
        WHERE id_shop_default = '
            . (int)$this->context->shop->id .
            ' AND active = 1 AND id_parent = '
            . (int)Configuration::get('PS_HOME_CATEGORY') .
            ' ORDER BY cs.position ASC LIMIT '
            . (int)Configuration::get('PWFOOTERBIGMODULE_COUNT_CATEGORY'));
        $information_link_footer = $this->getInformationColumn();

        $this->context->smarty->assign(
            array(
                'table_category' => $table_category,
                'information_link_footer' => $information_link_footer
            )
        );
        $this->context->controller->addCSS(($this->_path) . 'views/css/social-style.css', 'all');
        return $this->display(__FILE__, 'pwfooterbigmodule.tpl');
    }

}


