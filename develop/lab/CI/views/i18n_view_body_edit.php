<div>更新字詞 | [<a href="/i18n/show/">show data</a>] | <a href="/i18n/">字詞列表</a></div>
<form name="Fi" method="post" action="/i18n/upd">
  <ul class="i18n_edit">
    <li>key: <input type="text" name="key_word" value="<?=$key_value['key_word']?>"/></li>
    <li>正體中文: <input type="text" name="zh_TW_word" value="<?=$key_value['zh_TW_word']?>"/></li>
    <li>簡体中文: <input type="text" name="zh_CN_word" value="<?=$key_value['zh_CN_word']?>"/></li>
    <li>日本語: <input type="text" name="ja_JP_word" value="<?=$key_value['ja_JP_word']?>"/></li>
    <li>English: <input type="text" name="en_US_word" value="<?=$key_value['en_US_word']?>"/></li>
  </ul>
  <input type="hidden" name="id" value="<?=$key_value['id']?>"/>
  <input type="submit" name="send" value="更新"/>
</form>
