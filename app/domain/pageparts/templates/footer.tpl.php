<?php defined('RESTRICTED') or die('Restricted access'); ?>

<?php $this->dispatchTplEvent('beforeFooterOpen'); ?>
<div class="footer">
    <?php $this->dispatchTplEvent('afterFooterOpen'); ?>
    <span style="color:#1b75bb"><?=$language->__("label.version"); ?> <?=$this->get("version");?></span><br />
    <a href="http://tiggomark.io" target="_blank"><img style="height: 20px" src="<?=BASE_URL?>/images/logo-powered-by-tiggomark.png"></a>
    <?php $this->dispatchTplEvent('beforeFooterClose'); ?>
</div>
<?php $this->dispatchTplEvent('afterFooterOpen'); ?>

