<form id="Fedit" name="Fe" method="post" action="/lang/upd/<?php echo $sid; ?>">
  <ul>
    <li>key: <input type="text" name="key_word" value="<?php echo $list['key_word']; ?>"/></li>
<?php foreach($lang_perm as $lang_item) : ?>
    <li><?php echo $lang_item['l_name']?>: <input type="text" name="<?php echo $lang_item['l_type']?>_word" value="<?php echo $list[$lang_item['l_type']]['translate']; ?>"/> Original: <?php echo $list[$lang_item['l_type']]['original']; ?></li>
<?php endforeach ?>
  </ul>
  <input type="button" id="btn_edit" name="send" value=" UPDATE "/>
</form>

<script type="text/javascript">
var $ = YAHOO.util.Dom.get,
    PB = new YAHOO.widget.Button("btn_edit");

PB.on('click', function() {
    $('Fedit').submit();
});
</script>
