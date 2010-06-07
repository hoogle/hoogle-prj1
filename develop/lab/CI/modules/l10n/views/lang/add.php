<?php echo modules::run("l10n/component/show_cate_select"); ?>
<form id="Fadd" name="Fi" method="post" action="/l10n/lang/ins">
  <ul>
    <li>key: <input type="text" name="key_word"/></li>
<?php foreach($lang_perm as $lang_item) : ?>
    <li><?php echo $lang_item['l_name']?>: <input type="text" name="<?php echo $lang_item['l_type']?>_word"></li>
<?php endforeach ?>
  </ul>
  <input type="hidden" id="page_id" name="page_id">
  <input type="button" id="btn_new" name="send" value=" ADD NEW ">
</form>

<script type="text/javascript">
(function() {
    YAHOO.util.Event.on('pagecate1', 'change', function(e) {
        var sel_val2 = show_item(2, e.target.value);
        var sel_val3 = show_item(3, sel_val2);
        page_cate_pid = (sel_val3 == undefined) ? sel_val2 : sel_val3;
    });

    YAHOO.util.Event.on('pagecate2', 'change', function(e) {
        var sel_val3 = show_item(3, e.target.value);
        page_cate_pid = (sel_val3 == undefined) ? e.target.value : sel_val3;
    });

    YAHOO.util.Event.on('pagecate3', 'change', function(e) {
        page_cate_pid = e.target.value;
    });

    var PB_new = new YAHOO.widget.Button("btn_new");

    PB_new.on('click', function() {
        if ( ! page_cate_pid) {
            alert('You have to choose page cate!');
        } else {
            YAHOO.util.Dom.get('page_id').value = page_cate_pid;
            YAHOO.util.Dom.get('Fadd').submit();
        }
    });
})();
</script>
