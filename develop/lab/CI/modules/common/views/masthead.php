<div id="header" class="clearfix">
    <div class="logo">
        <a href="/"><img src="/static/images/logo_muchiii.png" alt="logo"></a>
    </div>
    <div class="sel_lang">
<?php if ($lang_arr) : ?>
        <span>
            Now using language:
<select id="use_lang" onchange="location.href='/lang/list_all/'+this.value">
<?php foreach($lang_arr as $lang_item) : ?>
    <option value="<?php echo $lang_item['l_type']?>"<?php echo ($use_lang == $lang_item['l_type']) ? 'selected="selected"' : ''; ?>><?php echo $lang_item['l_name']?></option>
<?php endforeach ?>
</select>
        </span>
<?php endif ?>
    </div>
</div>
