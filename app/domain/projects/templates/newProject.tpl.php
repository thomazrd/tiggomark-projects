
<?php
 defined('RESTRICTED') or die('Restricted access');
$project = $this->get('values');

?>

<div class="pageheader">

    <div class="pull-right padding-top">
        <a href="<?=BASE_URL ?>/projects/showAll" class="backBtn"><i class="far fa-arrow-alt-circle-left"></i> <?php echo $this->__('links.go_back') ?></a>
    </div>

    <div class="pageicon"><span class="fa fa-suitcase"></span></div>
    <div class="pagetitle">
        <h5><?php echo $this->__('label.administration') ?></h5>
        <h1><?php echo $this->__('headline.new_project') ?></h1>
    </div>

</div><!--pageheader-->

<div class="maincontent">
    <div class="maincontentinner">

        <?php echo $this->displayNotification(); ?>

        <div class="tabbedwidget tab-primary projectTabs">

            <ul>
                <li><a href="#projectdetails"><?php echo $this->__('tabs.projectdetails'); ?></a></li>
            </ul>

            <div id="projectdetails">

                <?php echo $this->displaySubmodule('projects-projectDetails'); ?>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
            tiggomark.projectsController.initProjectTabs();
            tiggomark.projectsController.initProjectsEditor();

        }
    );

</script>
