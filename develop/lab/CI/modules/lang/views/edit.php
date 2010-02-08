<?php if ($lang_arr) : ?>

<form name="Fe" method="post" action="/l10n/upd/<?php echo $sid; ?>">
  <ul>
    <li>key: <input type="text" name="key_word" value="<?php echo $list['key_word']; ?>"/></li>
<?php foreach($lang_arr as $lang_item) : ?>
    <li><?php echo $lang_item['l_name']?>: <input type="text" name="<?php echo $lang_item['l_type']?>_word" value="<?php echo $list[$lang_item['l_type']]['translate']; ?>"/> Original: <?php echo $list[$lang_item['l_type']]['original']; ?></li>
<?php endforeach ?>
  </ul>
  <input type="submit" name="send" value=" UPDATE "/>
</form>

<?php else : ?>

<?php $this->load->view("login/please_login.php"); ?>

<?php endif ?>
