<ul>
{foreach from=$table_category key=categoryId item=category}
  <li><a href="/{$category.id_category}-{$category_url[$categoryId]}" title="">{$category.name}</a></li>
{/foreach}
</ul>
