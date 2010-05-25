<form id="Fimp" name="Fi" method="post" action="/lang/do_imp" enctype="multipart/form-data">
    Importing CSV lang file:
    <select id="import_lang" name="import_lang">
        <option value="0">Using language</option>
    <?php foreach($lang_arr as $lang_item) : ?>
        <option value="<?php echo $lang_item['l_type']?>"><?php echo $lang_item['l_name']?></option>
    <?php endforeach ?>
    </select>
    <input type="file" id="importFile" name="importFile">
    <input type="button" id="btn_import" value=" IMPORT ">
</form>
<script type="text/javascript">
var $ = YAHOO.util.Dom.get,
    PB = new YAHOO.widget.Button("btn_import");

PB.on('click', function() {
    if ($('import_lang').value == 0) {
        alert('Drop down import language, plz!');
    } else if ($('importFile').value == '') {
        alert('Import file not select yet!');
    } else if ($('importFile').value != 'lang_' + $('import_lang').value + '.csv') {
        alert('Import filename dismatch!');
    } else {
        $('Fimp').submit();
    }
});
</script>
