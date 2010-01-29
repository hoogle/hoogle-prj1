<?php if ($lang_arr) : ?>

<table border=1>
    <tr align="center">
        <td>s_id</td>
        <td>key_word</td>
        <td>translate</td>
        <td>status</td>
    </tr>
<?php foreach($list as $ary) : ?>
    <tr>
        <td><?php echo $ary['s_id']; ?> <a href="/l10n/edit/<?php echo $ary['s_id']?>">[edit]</a></td>
        <td><?php echo $ary['key_word']; ?></td>
        <td><?php echo $ary['translate']; ?></td>
        <td><?php echo $ary['status']; ?></td>
    </tr>
<?php endforeach ?>
</table>

<?php else : ?>

<div>
    <a href="/login/">Please login to cont.</a>
</div>

<?php endif ?>
