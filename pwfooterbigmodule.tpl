<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-2">
					<h4>
						{l s='Categories'}
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
						{l s='Shop'}
					</h4>
					<ul>
						<li class="list-item">
							<a href="{$link->getPageLink('prices-drop')}">{l s='Prices drop'}</a>
						</li>
						<li class="list-item">
							<a href="{$link->getPageLink('new-products')}">{l s='New products'}</a>
						</li>
						<li class="list-item">
							<a href="{$link->getPageLink('best-sales')}">{l s='Best sales'}</a>
						</li>
						
					</ul>
				</div>
				<div class="col-md-2">
					<h4>
						{l s='Information'}
					</h4>
					<ol>
						<li class="list-item">
							Lorem ipsum dolor sit amet
						</li>
						<li class="list-item">
							Consectetur adipiscing elit
						</li>
						<li class="list-item">
							Integer molestie lorem at massa
						</li>
						<li class="list-item">
							Facilisis in pretium nisl aliquet
						</li>
						<li class="list-item">
							Nulla volutpat aliquam velit
						</li>
						<li class="list-item">
							Faucibus porta lacus fringilla vel
						</li>
						<li class="list-item">
							Aenean sit amet erat nunc
						</li>
						<li class="list-item">
							Eget porttitor lorem
						</li>
					</ol>
				</div>
				<div class="col-md-2">
					<h4>
						{l s='Stay in touch'}
					</h4>
					<ul>
<a class="btn btn-social-icon btn-lg btn-instagram"><i class="fa fa-instagram"></i></a>
                    {foreach from=$social_link_footer item=social_link}
												<li class="{$social_link.class}">
													<a href="{$social_link.url}" rel="nofollow" target="_blank" title="{$social_link.name}">{$social_link.name}</a>
												</li>
					{/foreach}
					</ul>
				</div>
				<div class="col-md-2">
					<h4>
						{l s='Our contacts'}
					</h4>
					<ul>
						<li class="list-item">
							<i class="svg svg-phone"></i> <a href="tel:{$ps_shop_phone}" rel="nofollow">{$ps_shop_phone}</a>
						</li>
						<li class="list-item">
							<i class="svg svg-mail"></i> <a href="mailto:{$ps_shop_mail}" rel="nofollow">{$ps_shop_mail}</a>
						</li>
						<li class="list-item">
							{$shop_addres_footer}
						</li>
						
					</ul>
				</div>
				
			</div>
		</div>
	</div>
</div>