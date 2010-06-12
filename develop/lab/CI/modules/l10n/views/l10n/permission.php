<?php echo modules::run("l10n/component/show_cate_select"); ?>
<form id="Fadd" name="Fi" method="post" action="/l10n/lang/add_layer">
<ul class="add_cate">
    <li>Add cate:</li>
    <li><input type="text" id="layer0" name="layer0" class="new_layer"></li>
    <li><input type="text" id="layer1" name="layer1" class="new_layer"></li>
    <li><input type="text" id="layer2" name="layer2" class="new_layer"></li>
    <li>
        <input type="hidden" id="new_cate" name="new_cate">
        <input type="hidden" id="loc" name="loc">
        <input type="hidden" id="cate_ids" name="cate_ids">
        <input type="button" id="btn_addcate" value="Add new layer">
    </li>
</ul>
</form>
<script type="text/javascript"> 
(function() {
    var $ = YAHOO.util.Dom.get,
        YUD = YAHOO.util.Dom;
        YUE = YAHOO.util.Event;

    YUE.on('pagecate1', 'change', function(e) {
        var sel_val2 = show_item(2, e.target.value);
        var sel_val3 = show_item(3, sel_val2);
        page_cate_pid = (sel_val3 == undefined) ? sel_val2 : sel_val3;
    });

    YUE.on('pagecate2', 'change', function(e) {
        var sel_val3 = show_item(3, e.target.value);
        page_cate_pid = (sel_val3 == undefined) ? e.target.value : sel_val3;
    });

    YUE.on('pagecate3', 'change', function(e) {
        page_cate_pid = e.target.value;
    });

    var disable_input = function(el) {
        var layer1 = el.value;

        if (layer1.length > 0) {
            for (var i=0; i<3; i++) {
                YUD.getElementsByClassName('new_layer')[i].disabled = true;
            }
            el.disabled = false;
        } else {
            for (var i=0; i<3; i++) {
                YUD.getElementsByClassName('new_layer')[i].disabled = false;
            }
        }
    };

    YUE.on('layer0', 'keyup', function(e) {
        disable_input($('layer0'));
    });

    YUE.on('layer1', 'keyup', function(e) {
        disable_input($('layer1'));
    });

    YUE.on('layer2', 'keyup', function(e) {
        disable_input($('layer2'));
    });

    var PB_new = new YAHOO.widget.Button("btn_addcate");

    PB_new.on('click', function() {
        if ( ! page_cate_pid) {
            alert('You have to choose page cate!');
            $('pagecate1').focus();
        } else {
            var page_cate = [];
            for (var i=1; i<=3; i++) {
                page_cate[(i-1)] = $('pagecate'+i).value;
            }
            $('cate_ids').value = page_cate;
            if ($('layer0').value == '' && $('layer1').value == '' && $('layer2').value == '') {
                alert('You have to input new layer name!');
                $('layer0').focus();
            } else {
                for (var i=0; i<3; i++) {
                    if ($('layer'+i).value.length > 0) {
                        var new_layer = $('layer'+i).value;
                        $('loc').value = i;
                        break;
                    }
                }
                $('new_cate').value = new_layer;
                $('Fadd').submit();
            }
        }
    });
})();
</script>
