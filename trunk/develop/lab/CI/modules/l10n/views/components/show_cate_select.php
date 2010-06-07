<ul class="page_cate">
    <li class="page-layers">
        <select id="pagecate1" name="layer_procuct">
            <option>Drop it</option>
<?php foreach ($page_cate[0] as $prd => $arr) : ?>
            <option value="<?php echo $prd; ?>"><?php echo $arr['page_name']; ?></option>
<?php endforeach ?>
        </select>
    </li>
    <li class="page-layers">
        <select id="pagecate2" name="layer_category"></select>
    </li>
    <li class="page-layers">
        <select id="pagecate3" name="layer_page"></select>
    </li>
</ul>
<script type="text/javascript">
(function() {
    var cate_json = YAHOO.lang.JSON.parse('<?php echo json_encode($page_cate); ?>');

    var show_item = function(layer, val) {
        var sel = document.getElementById('pagecate'+layer);
        var opt = [];
        var i = 0;
        for (var item in cate_json[val]) {
            if (i == 0) var first_value = cate_json[val][item]['page_id'];
            opt[i++] = '<option value="' + cate_json[val][item]['page_id'] + '">' + cate_json[val][item]['page_name'] + '</option>';
        }
        sel.innerHTML = opt.join();
        return first_value;
    };

    YAHOO.util.Event.on('pagecate1', 'change', function(e) {
        var first_value = show_item(2, e.target.value);
        show_item(3, first_value);
    });

    YAHOO.util.Event.on('pagecate2', 'change', function(e) {
        show_item(3, e.target.value);
    });
})();
</script>
