<?php defined('RESTRICTED') or die('Restricted access'); ?>
<script src="<?=BASE_URL?>/js/libs/saas-connector-lightbox.min.js?APP_ID=TIGGOMARK_APP_ID"></script>
<?php if (isset($_SESSION['do_cron'])) { ?>
    <script>
        var req = new XMLHttpRequest();
        req.open("GET", "<?=BASE_URL?>/cron.php",true);
        req.send(null);
    </script>
<?php } ?>

<?php $this->dispatchTplEvent('beforeBodyClose'); ?>

</body>
</html>
