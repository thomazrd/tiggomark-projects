<?php defined('RESTRICTED') or die('Restricted access'); ?>

<?php $this->dispatchTplEvent('beforeUserinfoMenuOpen'); ?>
<div class="userinfo">
    <?php $this->dispatchTplEvent('afterUserinfoMenuOpen'); ?>
    <a href='<?=BASE_URL ?>/users/editOwn/' class="dropdown-toggle profileHandler" data-toggle="dropdown">
        <img src="<?=BASE_URL ?>/api/users?profileImage=<?php echo $this->get('userId'); ?>" class="profilePicture"/>
        <i class="fa fa-caret-down" aria-hidden="true"></i>
    </a>
    <ul class="dropdown-menu">
        <?php $this->dispatchTplEvent('afterUserinfoDropdownMenuOpen'); ?>
        <li>
            <a href='<?=BASE_URL ?>/users/editOwn/'>
                <?=$this->__("menu.my_profile")?>
            </a>


        </li>

        <li>
            <a href='#' onclick="tiggomark.generalController.changeUserPlan();">
               <?=$this->__("menu.change_plan")?>
             </a>
        </li>

        <li class="nav-header border"><?=$this->__("menu.help_support")?></li>
        <li>
            <a href='javascript:void(0);'
               onclick="tiggomark.helperController.showHelperModal('<?php echo $this->get('modal'); ?>', 300, 500);">
                <?=$this->__("menu.what_is_this_page")?>
            </a>
        </li>
        <!--
        <li>
            <a href='https://docs.tiggomark.io' target="_blank">
                <?=$this->__("menu.knowledge_base")?>
            </a>
        </li>
        <li>
            <a href='https://community.tiggomark.io' target="_blank">
                <?=$this->__("menu.community")?>
            </a>
        </li>
        <li>
            <a href='https://tiggomark.io/contact-us' target="_blank">
                <?=$this->__("menu.contact_us")?>
            </a>
        </li>

        -->
        <li class="border">
            <a href='<?=BASE_URL ?>/auth/logout'>
                <?=$this->__("menu.sign_out")?>
            </a>
        </li>
        <?php $this->dispatchTplEvent('beforeUserinfoDropdownMenuClose'); ?>
    </ul>
    <?php $this->dispatchTplEvent('beforeUserinfoMenuClose'); ?>
</div>
<?php $this->dispatchTplEvent('afterUserinfoMenuClose'); ?>
