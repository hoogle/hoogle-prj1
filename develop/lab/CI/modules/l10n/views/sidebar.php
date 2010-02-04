<?php if ($userid) : ?>
<div>hello, <?php echo $userid; ?> | <a href="/login/logout">logout</a></div>
<?php else : ?>
<div>Hi, guest! <a href="/login/">login</a></div>
<?php endif ?>
<br/>
<ul>
    <li>list 1</li>
    <li>list 2</li>
    <li>list 3</li>
    <li>list 4</li>
    <li>list 5</li>
</ul>
