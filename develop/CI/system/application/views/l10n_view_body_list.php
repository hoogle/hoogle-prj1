<table border=1>
    <tr align="center">
        <td>s_id</td>
        <td>key_word</td>
        <td>translate</td>
        <td>original</td>
        <td>create_time</td>
        <td>update_time</td>
        <td>last_updater</td>
        <td>comment</td>
    </tr>
<? foreach($list as $ary) : ?>
    <tr>
        <td><? echo $ary['s_id']; ?></td>
        <td><? echo $ary['key_word']; ?></td>
        <td><? echo $ary['translate']; ?></td>
        <td><? echo $ary['original']; ?></td>
        <td><? echo $ary['create_time']; ?></td>
        <td><? echo $ary['update_time']; ?></td>
        <td><? echo $ary['last_updater']; ?></td>
        <td><? echo $ary['comment']; ?></td>
    </tr>
<? endforeach ?>
</table>
