<ul>
{foreach from=$table_category item=category}
  <li><a href="{$link->getCategoryLink({$category.id_category})}">{l s={$category.name}}</a></li>
{/foreach}
</ul>

<a href="{$link->getPageLink('prices-drop')}">{l s='Prices drop'}</a>
<a href="{$link->getPageLink('new-products')}">{l s='New products'}</a>
<a href="{$link->getPageLink('best-sales')}">{l s='Best sales'}</a>