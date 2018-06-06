<ul>
{foreach from=$table_category key=categoryId item=category}
  <li>{$categoryId} - {$category.name}</li>
{/foreach}
</ul>