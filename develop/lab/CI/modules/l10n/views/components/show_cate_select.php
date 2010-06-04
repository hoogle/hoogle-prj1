<pre>
<?php
$json_str = json_encode($page_cate);
print_r($page_cate);
?>
</pre>
<ul class="page_cate">
    <li class="page_layers">
        <select id="pagecate1" name="layer_procuct">
            <option>Drop it</option>
<?php foreach ($page_cate[0] as $prd => $arr) : ?>
            <option value="<?php echo $prd; ?>"><?php echo $arr['page_name']; ?></option>
<?php endforeach ?>
        </select>
    </li>
    <li class="page_layers">
        <select id="pagecate2" name="layer_category">
            <option>-</option>
        </select>
    </li>
    <li class="page_layers">
        <select id="pagecate3" name="layer_page">
            <option>-</option>
        </select>
    </li>
</ul>
<script type="text/javascript">
(function() {
    var cate_json = '<?php echo $json_str; ?>';

    YAHOO.util.Event.on('pagecate1', 'change', function(e) {
        var val = e.target.value;
        console.log(1);
        console.dir(cate_json.MIIICASA);
        console.log(2);
    });
})();
</script>
