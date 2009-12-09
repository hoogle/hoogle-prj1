<?php
// default lang & type
$lang = 'tw';
putenv('LANG=zh_TW.UTF-8');
setlocale(LC_ALL, 'zh_TW.UTF-8');

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tw';

if ('tw' == $lang) {
    putenv('LANG=zh_TW.UTF-8'); // mapping locale/zh_TW/LC_MESSAGES(if zh_TWs mapping /zh_TWs/LC_M..)
    setlocale(LC_ALL, 'zh_TW.UTF-8'); // bsd use zh_TW.UTF-8
} else if ('cn' == $lang) {
    putenv('LANG=zh_CN.UTF-8');
    setlocale(LC_ALL, 'zh_CN.UTF-8'); // bsd use zh_CN.UTF-8
} else if ('jp' == $lang) {
    putenv('LANG=ja_JP.UTF-8');
    setlocale(LC_ALL, 'ja_JP.UTF-8'); // or use en
} else if ('en' == $lang) {
    putenv('LANG=en_US');
    setlocale(LC_ALL, 'en_US'); // or use en
}

define('PACKAGE', 'hello');

// gettext setting
bindtextdomain(PACKAGE, 'locale'); // or $your_path/locale, ex: /var/www/test/locale
//bindtextdomain(PACKAGE, '/home/laudieh/www/frontend/test/locale'); // or $your_path/locale, ex: /var/www/test/locale
textdomain(PACKAGE);


// main program
echo gettext("Hello World!");
echo '<br>';
echo _("This is book.");
echo '<br>';
echo _("Hello World!");
//echo '<br>';
//echo _("New, line!");
?>
<blockquote>
<a href="?lang=tw">TW</a><br>
<a href="?lang=cn">CN</a><br>
<a href="?lang=jp">JP</a><br>
<a href="?lang=en">EN</a>
</blockquote>

