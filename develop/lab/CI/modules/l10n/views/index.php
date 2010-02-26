<?php if ($div == "show") : ?>
<?php   echo modules::run("lang/index"); ?>
<?php elseif ($div == "add") : ?>
<?php   $this->load->view("lang/add"); ?>
<?php elseif ($div == "edit") : ?>
<?php   $this->load->view("lang/edit"); ?>
<?php elseif ($div == "changes") : ?>
<?php   echo modules::run("lang/changes"); ?>
<?php else : ?>
<?php   $this->load->view("l10n/home"); ?>
<?php endif ?>
