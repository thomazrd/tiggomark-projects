<?php
    defined('RESTRICTED') or die('Restricted access');
?>

<?php $this->dispatchTplEvent('beforePageHeaderOpen'); ?>
<div class="pageheader">
    <?php $this->dispatchTplEvent('afterPageHeaderOpen'); ?>
    <div class="pageicon"><span class="fa <?php echo $this->getModulePicture() ?>"></span></div>
    <div class="pagetitle">
        <h5><?php echo $this->__('headline.calendar'); ?></h5>
        <h1><?php echo $this->__('headline.my_calendar'); ?></h1>
    </div>
    <?php $this->dispatchTplEvent('beforePageHeaderClose'); ?>
</div><!--pageheader-->
<?php $this->dispatchTplEvent('afterPageHeaderClose'); ?>

<div class="maincontent">
    <div class="maincontentinner">

        <a href="<?=BASE_URL?>/calendar/export" class="btn btn-default right exportModal"><?php echo $this->__('datatables.buttons.download'); ?></a>

        <?php echo $this->displayLink(
            'calendar.addEvent',
            "<i class='fa fa-plus'></i> " . $this->__('buttons.add_event'),
            null,
            array('class' => 'btn btn-primary btn-rounded')
        ) ?>

        <div id="calendar"></div>

    </div>
</div>


<script type='text/javascript'>

    <?php $this->dispatchTplEvent('scripts.afterOpen'); ?>

    jQuery(document).ready(function() {

        var events=[<?php foreach ($this->get('calendar') as $calendar) : ?>
            {
                title: <?php echo json_encode($calendar['title']); ?>,
                start: new Date(<?php echo
                    $calendar['dateFrom']['y'] . ',' .
                    ($calendar['dateFrom']['m'] - 1) . ',' .
                    $calendar['dateFrom']['d'] . ',' .
                    $calendar['dateFrom']['h'] . ',' .
                    $calendar['dateFrom']['i'] ?>),
                <?php if (isset($calendar['dateTo'])) : ?>
                end: new Date(<?php echo
                    $calendar['dateTo']['y'] . ',' .
                    ($calendar['dateTo']['m'] - 1) . ',' .
                    $calendar['dateTo']['d'] . ',' .
                    $calendar['dateTo']['h'] . ',' .
                    $calendar['dateTo']['i'] ?>),
                <?php endif; ?>
                <?php if ((isset($calendar['allDay']) && $calendar['allDay'] == true)) : ?>
                allDay: true,
                <?php else : ?>
                allDay: false,
                <?php endif; ?>
                <?php if (isset($calendar['eventType']) && $calendar['eventType'] == 'calendar') : ?>
                url: '<?=BASE_URL ?>/calendar/editEvent/<?php echo $calendar['id'] ?>',
                color: '#00814A'
                <?php else : ?>
                url: '<?=BASE_URL ?>/tickets/showTicket/<?php echo $calendar['id'] ?>?projectId=<?php echo $calendar['projectId'] ?>',
                color:'#BC3600'
                <?php endif; ?>
            },
                    <?php endforeach; ?>];

        tiggomark.calendarController.initCalendar(events);
        tiggomark.calendarController.initExportModal();

    });

    <?php $this->dispatchTplEvent('scripts.beforeClose'); ?>

</script>
