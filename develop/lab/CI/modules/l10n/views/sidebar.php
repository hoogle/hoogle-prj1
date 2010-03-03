<?php if ($userid) : ?>
<div>hello, <?php echo $userid; ?> | <a href="/login/logout">logout</a></div>
<?php else : ?>
<div>Hi, guest! <a href="/login/">login</a></div>
<?php endif ?>
<br/>
<ul>
    <li><a href="/lang/list_all">Item record list</a></li>
    <li><a href="/lang/gen">Generate files</a></li>
    <li><a href="/lang/changes">Changes</a></li>
    <li><a href="/l10n/permission">Permission setting</a></li>
</ul>
