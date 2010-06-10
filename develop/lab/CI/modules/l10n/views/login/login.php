<?php $this->load->view("l10n/l10n/before_body.php"); ?>
<?php if ($is_login) : ?>
<div style="border:1px solid gray; padding:5px;">
    Hello, <?php echo $userid; ?><br/>
    <a href="/l10n/login/logout">logout</a>
</div>
<?php else : ?>
<div style="border:1px solid gray; padding:5px;">
    <form name="f_login" method="post" action="/l10n/login/check">
        id: <input type="text" name="userid"/><br/>
        pw: <input type="password" name="passwd"/><br/>
        <input type="hidden" name="go_url" value="<?php echo $go_url; ?>"/>
        <input type="submit" value="登入"/>
    </form>
</div>
<?php endif ?>
<?php $this->load->view("l10n/l10n/after_body"); ?>
