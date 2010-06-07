<?php if ( ! empty($userid)) : ?>
<div>hello, <?php echo $userid; ?> | <a href="/l10n/login/logout">logout</a></div>
<?php else : ?>
<div>Hi, guest! <a href="/l10n/login/">login</a></div>
<?php endif ?>
<br/>
<ul>
    <li><a href="/l10n/lang/list_all">Item record list</a></li>
    <li><a href="/l10n/lang/gen">Generate files</a></li>
    <li><a href="/l10n/lang/changes">Changes</a></li>
    <li><a href="/l10n/lang/export">Export (CSV)</a></li>
    <li><a href="/l10n/l10n/permission">Permission setting</a></li>
</ul>
