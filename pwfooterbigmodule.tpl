
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2">
					<h4>
                        {l s='Категории'}
					</h4>
					<ul>
                        {foreach from=$table_category item=category}
							<li class="list-item">
								<a href="{$link->getCategoryLink({$category.id_category})}">{l s={$category.name}}</a>
							</li>
                        {/foreach}
					</ul>
				</div>
				<div class="col-md-2">
					<h4>
                        {l s='Магазин'}
					</h4>
					<ul>
						<li class="list-item">
							<a href="{$link->getCMSLink(1)}">{l s='ТЕСТ'}</a>
						</li>

						<li class="list-item">
							<a href="{$link->getPageLink('prices-drop')}">{l s='Скидки'}</a>
						</li>
						<li class="list-item">
							<a href="{$link->getPageLink('new-products')}">{l s='Новая продукция'}</a>
						</li>
						<li class="list-item">
							<a href="{$link->getPageLink('best-sales')}">{l s='Популярные товары'}</a>
						</li>

					</ul>
				</div>
				<div class="col-md-2">
					<h4>
                        {l s='Информация'}
					</h4>
					<ul>
                        {foreach from=$information_link_footer item=information}
							<li class="list-item">
								<a href="{$information.url}" title="{$information.title}">{$information.title}</a>
							</li>
                        {/foreach}
					</ul>
				</div>
				<div class="col-md-2">

					<h4>
                        {l s='Подпишитесь'}
					</h4>
					<ul>
							{if !empty(Configuration::get('PWFOOTERBIGMODULE_FACEBOOK'))}
							<li id="LI_108">
								<a id="A_facebook" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_FACEBOOK')}" href="{Configuration::get('PWFOOTERBIGMODULE_FACEBOOK')}"></a>
							</li>
							{/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_VK'))}
								<li id="LI_108">
									<a id="A_vk" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_VK')}" href="{Configuration::get('PWFOOTERBIGMODULE_VK')}"></a>
								</li>
                            {/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_OK'))}
								<li id="LI_108">
									<a id="A_ok" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_OK')}" href="{Configuration::get('PWFOOTERBIGMODULE_OK')}"></a>
								</li>
                            {/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_TWITTER'))}
								<li id="LI_108">
									<a id="A_twitter" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_TWITTER')}" href="{Configuration::get('PWFOOTERBIGMODULE_TWITTER')}"></a>
								</li>
                            {/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_GOOGLE_PLUS'))}
								<li id="LI_108">
									<a id="A_google_plus" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_GOOGLE_PLUS')}" href="{Configuration::get('PWFOOTERBIGMODULE_GOOGLE_PLUS')}"></a>
								</li>
                            {/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_INSTAGRAM'))}
								<li id="LI_108">
									<a id="A_instagram" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_INSTAGRAM')}" href="{Configuration::get('PWFOOTERBIGMODULE_INSTAGRAM')}"></a>
								</li>
                            {/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_YOUTUBE'))}
								<li id="LI_108">
									<a id="A_youTube" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_YOUTUBE')}" href="{Configuration::get('PWFOOTERBIGMODULE_YOUTUBE')}"></a>
								</li>
                            {/if}
                            {if !empty(Configuration::get('PWFOOTERBIGMODULE_MAIL_RU'))}
								<li id="LI_108">
									<a id="A_mail_ru" rel="nofollow" title="{Configuration::get('PWFOOTERBIGMODULE_MAIL_RU')}" href="{Configuration::get('PWFOOTERBIGMODULE_MAIL_RU')}"></a>
								</li>
                            {/if}
					</ul>
				</div>
				<div class="col-md-2">
					<h4>
                        {l s='Контакты'}
					</h4>
					<ul>
						<li class="list-item">
							<a href="tel:{Configuration::get('PS_SHOP_PHONE')}" rel="nofollow">{Configuration::get('PS_SHOP_PHONE')}</a>
						</li>
						<li class="list-item">
							 <a href="mailto:{Configuration::get('PS_SHOP_EMAIL')}" rel="nofollow">{Configuration::get('PS_SHOP_EMAIL')}</a>
						</li>
						<li class="list-item">
        {Configuration::get('PS_SHOP_CITY')}{if !empty(Configuration::get('PS_SHOP_ADDR1'))}, {/if}{Configuration::get('PS_SHOP_ADDR1')}{if !empty(Configuration::get('PS_SHOP_ADDR2'))}, {/if}{Configuration::get('PS_SHOP_ADDR2')}{if !empty(Configuration::get('PS_SHOP_CODE'))}, {/if}{Configuration::get('PS_SHOP_CODE')}
						</li>

					</ul>
				</div>

			</div>
		</div>



