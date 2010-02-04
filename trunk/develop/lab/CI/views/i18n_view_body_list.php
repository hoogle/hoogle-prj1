<div>字詞列表 | [<a href="/i18n/show/">show data</a>] | [<a href="/i18n/add">新增字詞</a>]</div>
<table border=1>
  <tr align="center">
    <td>key_word</td>
    <td>en_US</td>
    <td>zh_TW</td>
    <td>zh_CN</td>
    <td>ja_JP</td>
  </tr>
<? foreach($list as $ary) : ?>
  <tr>
    <td><?=$ary['key_word']?> [<a href="/i18n/del/<?=$ary['id']?>">刪</a>]</td>
    <td><a href="/i18n/edit/en/<?=$ary['id']?>"><?=$ary['en_US_word']?></a></td>
    <td><a href="/i18n/edit/tw/<?=$ary['id']?>"><?=$ary['zh_TW_word']?></a></td>
    <td><a href="/i18n/edit/cn/<?=$ary['id']?>"><?=$ary['zh_CN_word']?></a></td>
    <td><a href="/i18n/edit/jp/<?=$ary['id']?>"><?=$ary['ja_JP_word']?></a></td>
  </tr>
<? endforeach ?>
</table>
