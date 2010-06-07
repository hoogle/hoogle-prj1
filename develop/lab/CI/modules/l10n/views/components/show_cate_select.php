<ul class="page_cate">
    <li class="page-layers">
        Page cate:
    </li>
    <li class="page-layers">
        <select id="pagecate1" name="layer_procuct">
            <option>=== Select ===</option>
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
YAHOO.util.Event.addListener(window, "load", function() {
    cate_json = YAHOO.lang.JSON.parse('<?php echo json_encode($page_cate); ?>');
    page_cate_pid = 0;

    show_item = function(layer, val) {
        var sel = document.getElementById('pagecate'+layer);
        var opt = [];
        var i = 0;
        for (var item in cate_json[val]) {
            if (i == 0) var sel_val2 = cate_json[val][item]['page_id'];
            opt[i++] = '<option value="' + cate_json[val][item]['page_id'] + '">' + cate_json[val][item]['page_name'] + '</option>';
        }
        sel.innerHTML = opt.join();
        return sel_val2;
    };

    /*
    YAHOO.util.Event.on('pagecate1', 'change', function(e) {
        var sel_val2 = show_item(2, e.target.value);
        var sel_val3 = show_item(3, sel_val2);
        page_cate_pid = (sel_val3 == undefined) ? sel_val2 : sel_val3;
        console.log('pid : ', page_cate_pid);
    });

    YAHOO.util.Event.on('pagecate2', 'change', function(e) {
        var sel_val3 = show_item(3, e.target.value);
        page_cate_pid = (sel_val3 == undefined) ? e.target.value : sel_val3;
        console.log('pid = ', page_cate_pid);
    });

    YAHOO.util.Event.on('pagecate3', 'change', function(e) {
        page_cate_pid = e.target.value;
        console.log('pid => ', page_cate_pid);
    });
     */
});
</script>
