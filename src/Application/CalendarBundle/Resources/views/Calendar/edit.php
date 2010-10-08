<?php $view->extend('::layout.php') ?>
<?php $view['slots']->set('title', 'Calendar details') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/main.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/dp.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/dropdown.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/colorselect.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/calendar.edit.css') ?>

<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/jquery.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/Common.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.form.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.validate.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/datepicker_lang_US.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.datepicker.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.dropdown.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.colorselect.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/calendar.edit.js'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        editEvent({ deleteURL: "<?php echo $view['router']->generate('calendar_delete') ?>"});
    });
</script>


<div>
    <div class="toolBotton">
        <a id="Savebtn" class="imgbtn" href="javascript:void(0);">
            <span class="Save"  title="Save the calendar">Save(<u>S</u>)
            </span>
        </a>
        <?php if ($event): ?>
            <a id="Deletebtn" class="imgbtn" href="javascript:void(0);">
                <span class="Delete" title="Cancel the calendar">Delete(<u>D</u>)</span>
            </a>
        <?php endif ?>
        <a id="Closebtn" class="imgbtn" href="javascript:void(0);">
            <span class="Close" title="Close the window" >Close</span>
        </a>
    </div>
    <div style="clear: both">
    </div>
    <div class="infocontainer">
        <form action="<?php echo $view['router']->generate('calendar_updateDetails') . ($event ? "?id=" . $event->getId() : ""); ?>" class="fform" id="fmEdit" method="post">
            <label>
                <span>                        *Subject:
                </span>
                <div id="calendarcolor">
                </div>
                <input MaxLength="200" class="required safe" id="Subject" name="Subject" style="width:85%;" type="text" value="<?php echo $event ? $event->getSubject() : "" ?>" />
                <input id="colorvalue" name="colorvalue" type="hidden" value="<?php echo $event ? $event->getColor() : "" ?>" />
            </label>
            <label>
                <span>*Time:
                </span>
                <div>
                    <?php
                    if ($event) {
                        $sarr = array($event->getStartTime()->format('n/j/Y'), $event->getStartTime()->format('H:i'));
                        $earr = array($event->getEndTime()->format('n/j/Y'), $event->getEndTime()->format('H:i'));
                    }
                    ?>
                    <input MaxLength="10" class="required date" id="stpartdate" name="stpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo $event ? $sarr[0] : ""; ?>" />
                    <input MaxLength="5" class="required time" id="stparttime" name="stparttime" style="width:40px;" type="text" value="<?php echo $event ? $sarr[1] : ""; ?>" />To
                    <input MaxLength="10" class="required date" id="etpartdate" name="etpartdate" style="padding-left:2px;width:90px;" type="text" value="<?php echo $event ? $earr[0] : ""; ?>" />
                    <input MaxLength="50" class="required time" id="etparttime" name="etparttime" style="width:40px;" type="text" value="<?php echo $event ? $earr[1] : ""; ?>" />
                    <label class="checkp">
                        <input id="IsAllDayEvent" name="IsAllDayEvent" type="checkbox" value="1" <?php echo ($event && $event->getIsAllDayEvent() != 0) ? 'checked' : ''?>/>
                        All Day Event
                    </label>
                </div>
            </label>
            <label>
                <span>Location:</span>
                <input MaxLength="200" id="Location" name="Location" style="width:95%;" type="text" value="<?php echo $event ? $event->getLocation() : ""; ?>" />
            </label>
            <label>
                <span>Remark:</span>
                <textarea cols="20" id="Description" name="Description" rows="2" style="width:95%; height:70px"><?php echo $event ? $event->getDescription() : ""; ?></textarea>
            </label>
            <input id="timezone" name="timezone" type="hidden" value="" />
        </form>
    </div>
</div>