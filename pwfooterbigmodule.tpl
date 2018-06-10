
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

                        {foreach from=$social_link_footer item=social_link}
							<li id="LI_108">
								<a id="{$social_link.class}" rel="nofollow" title="{$social_link.name}" href="{$social_link.url}"></a>
							</li>
                        {/foreach}
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
                            {$shop_addres_footer}
						</li>

					</ul>
				</div>

			</div>
		</div>



