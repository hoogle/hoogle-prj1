<?php
$tab_tags = "";
$tab_contents = "";
foreach ($lang_arr as $k => $lang)
{
    $selected = ( ! $k) ? ' class="selected"' : '';
    $tab_tags.= "    <li{$selected}><a href=\"#{$k}\"><em>{$lang['l_type']}</em></a></li>\n";
    $tab_contents.= "    <div id=\"t{$k}\">\n";
    foreach ($rec[$lang['l_type']] as $k => $arr)
    {
        $tab_contents.= "        <div>{$arr['key_word']} / {$arr['translate']}</div>\n";
    }
    $tab_contents.= "    </div>\n";
}
?>
<div id="map-tab-all" class="yui-navset">
<ul class="yui-nav">
<?php echo $tab_tags; ?>
</ul>
<div class="yui-content">
<?php echo $tab_contents; ?>
</div>
</div>
<script>
(function() { var tabView = new YAHOO.widget.TabView('map-tab-all'); })();
</script>