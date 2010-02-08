<?php foreach ($rec as $lang => $trans) : ?>
<ul id="changes">
    <li class="first"><?php echo $lang; ?></li>
<?php foreach ($trans as $k => $arr) : ?>
    <li><?php echo $arr['key_word']." / ".$arr['translate']; ?></li>
<?php endforeach ?>
</ul>
<?php endforeach ?>
