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
						{l s='Stay in touch'}
					</h4>
					<ul>

                    {foreach from=$social_link_footer item=social_link}
					<a class="btn btn-social-icon btn-{$social_link.class}" title="{$social_link.name}" href="{$social_link.url}"><span class="fa fa-{$social_link.class}"></span></a>
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


