<div>字詞列表 | [<a href="/i18n/show/">show data</a>] | [<a href="/i18n/add">新增字詞</a>]</div>
<ul class="i18n_this_lang">
<? foreach($list as $item) : ?>
<li><?=$item[0]?><br/>==> <span><?php echo sprintf($item[1], $unread_plurks); ?></span></li>
<? endforeach ?>
</ul>

