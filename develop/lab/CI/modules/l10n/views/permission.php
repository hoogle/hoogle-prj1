<?php
$tab_tags = "";
foreach ($lang_arr as $k => $lang)
{
    $selected = ($lang['l_type'] == $use_lang) ? ' class="selected"' : '';
    $tab_tags.= "    <li{$selected}><a href=\"#{$k}\"><em>{$lang['l_type']}</em></a></li>\n";
}
?>
<div id="map-tab-all" class="yui-navset">
<ul class="yui-nav">
<?php echo $tab_tags; ?>
</ul>
<div class="yui-content">
test
</div>
</div>
<script type="text/javascript">
(function() { var tabView = new YAHOO.widget.TabView('map-tab-all'); })();
</script>
