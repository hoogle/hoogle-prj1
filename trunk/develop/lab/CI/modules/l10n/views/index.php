<?php $this->load->view("common/before_body.php"); ?>
<div id="hd">
<div class="yui-d3">
<?php $this->load->view("common/masthead.php"); ?>
<?php $this->load->view("common/navigation.php"); ?>
</div>
</div>
<div id="bd">
<div class="yui-d3">
<div class="yui-t4">
<div class="yui-main">
<div class="yui-b">
<?php if ($div == "list") : ?>
<?php echo modules::run("lang", $use_lang); ?>
<?php elseif ($div == "add") : ?>
<?php $this->load->view("lang/add"); ?>
<?php elseif ($div == "edit") : ?>
<?php $this->load->view("lang/edit"); ?>
<?php else : ?>
<?php $this->load->view("l10n/home"); ?>
<?php endif ?>
</div>
</div>
<div class="yui-b">
<?php $this->load->view("l10n/sidebar"); ?>
</div>
</div>
</div>
</div>
<div id="ft">
<div class="yui-d3">
<?php $this->load->view("common/mastfoot"); ?>
</div>
</div>
</div>
<?php $this->load->view("common/after_body.php"); ?>
