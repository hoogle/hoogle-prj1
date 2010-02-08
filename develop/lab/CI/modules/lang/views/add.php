<?php if ($lang_arr) : ?>

<form name="Fi" method="post" action="/l10n/ins">
  <ul>
    <li>key: <input type="text" name="key_word"/></li>
<?php foreach($lang_arr as $lang_item) : ?>
    <li><?php echo $lang_item['l_name']?>: <input type="text" name="<?php echo $lang_item['l_type']?>_word"/></li>
<?php endforeach ?>
  </ul>
  <input type="submit" name="send" value=" ADD NEW "/>
</form>

<?php else : ?>

<?php $this->load->view("login/please_login.php"); ?>

<?php endif ?>
