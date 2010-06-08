<?php
$file_name = 'index';
$main_items = array(
    'home'  => array('url' => '/l10n', 'text' => 'Home'),
);
$option_items = array(
    'add' => array('url' => '/l10n/lang/add', 'text' => 'Add new'),
    'list_all' => array('url' => '/l10n/lang/list_all', 'text' => 'List all'),
    'chenges' => array('url' => '/l10n/lang/changes', 'text' => 'Changes'),
    'export' => array('url' => '/l10n/lang/export', 'text' => 'Export'),
);
$menu_items = ( ! $lang_perm) ? $main_items : array_merge($main_items, $option_items);

?>
<div id="navigation" class="yui-menu yui-menu-horizontal yui-menubuttonnav">
    <div class="yui-menu-content">
        <ul>
<?php
        $i = 0;
        foreach ($menu_items as $index => $data) :
            $i++;
            $class = '';
            $selected = '';
            if ($file_name.'.html' === $data['url']) :
                $selected = ' on';
            endif;
            switch (true) :
                case ($i===1) :
                    $class = ' first-of-type';
                    break;
            endswitch;
?>
            <li<?php echo (isset($data['items'])) ? '' : ' class="yui-menuitem"'; ?>>
<?php       if (isset($data['items'])) : ?>
                <a class="yui-menu-label <?php echo $index; ?><?php echo $class; ?>" href="<?php echo $data['url']; ?>"><em><?php echo $data['text']; ?></em></a>
<?php       else : ?>
                <a class="yui-menuitem-content <?php echo $index; ?><?php echo $class; ?>" href="<?php echo $data['url']; ?>"><?php echo $data['text']; ?></a>
<?php       endif; ?>
<?php       if (isset($data['items'])) : ?>
                <div class="yui-menu">
                    <div class="yui-menu-content">
                        <ul>
<?php
                $y = 0;
                foreach ($data['items'] as $sub_index => $sub_data) :
                    $y++;
                    $sub_class = '';
                    switch (true) :
                        case ($y===1) :
                            $sub_class = ' first-of-type';
                            break;
                    endswitch;
?>
                            <li class="yui-menuitem">
                                <a class="yui-menuitem-content" href="<?php echo $sub_data['url']; ?>"><?php echo $sub_data['text']; ?></a>
                            </li>
<?php           endforeach ?>
                        </ul>
                    </div>
                </div>
<?php       endif ?>
            </li>
<?php   endforeach ?>
        </ul>
    </div>
</div>
