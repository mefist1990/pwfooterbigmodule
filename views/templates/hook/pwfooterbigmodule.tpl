<ul>
{foreach from=$category_url item=url}
  <li><a href="/{$url.url}" title="">{$url.name}</a></li>
{/foreach}
</ul>
