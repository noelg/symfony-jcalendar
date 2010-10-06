<?php $view->extend('::layout') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/dailog.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/calendar.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/dp.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/alert.css') ?>
<?php $view['stylesheets']->add('bundles/calendar/css/wdCalendar/main.css') ?>

<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/jquery.js') ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/Common.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/datepicker_lang_US.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.datepicker.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.alert.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.ifrmdailog.js" defer="defer'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/wdCalendar_lang_US.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/wdCalendar/Plugins/jquery.calendar.js'); ?>
<?php $view['javascripts']->add('bundles/calendar/js/calendar.init.js'); ?>

<script type="text/javascript">
    $(document).ready(function() {
        var options = {
            datafeedUrl: "<?php echo $view['router']->generate('calendar_datafeed') ?>",
            quickAddUrl: "<?php echo $view['router']->generate('calendar_add') ?>",
            quickUpdateUrl: "<?php echo $view['router']->generate('calendar_update') ?>",
            quickDeleteUrl: "<?php echo $view['router']->generate('calendar_delete') ?>",
            editUrl: "<?php echo $view['router']->generate('calendar_edit') ?>"
        }
        initCalendar(options);
    });
</script>

<div id="calhead" style="padding-left:1px;padding-right:1px;">
  <div class="cHead"><div class="ftitle">My Calendar</div>
  <div id="loadingpannel" class="ptogtitle loadicon" style="display: none;">Loading data...</div>
   <div id="errorpannel" class="ptogtitle loaderror" style="display: none;">Sorry, could not load your data, please try again later</div>
  </div>

  <div id="caltoolbar" class="ctoolbar">
    <div id="faddbtn" class="fbutton">
      <div><span title='Click to Create New Event' class="addcal">

      New Event
      </span></div>
  </div>
  <div class="btnseparator"></div>
   <div id="showtodaybtn" class="fbutton">
      <div><span title='Click to back to today ' class="showtoday">
      Today</span></div>
  </div>
    <div class="btnseparator"></div>

  <div id="showdaybtn" class="fbutton">
      <div><span title='Day' class="showdayview">Day</span></div>
  </div>
    <div  id="showweekbtn" class="fbutton fcurrent">
      <div><span title='Week' class="showweekview">Week</span></div>
  </div>
    <div  id="showmonthbtn" class="fbutton">
      <div><span title='Month' class="showmonthview">Month</span></div>

  </div>
  <div class="btnseparator"></div>
    <div  id="showreflashbtn" class="fbutton">
      <div><span title='Refresh view' class="showdayflash">Refresh</span></div>
      </div>
   <div class="btnseparator"></div>
  <div id="sfprevbtn" title="Prev"  class="fbutton">
    <span class="fprev"></span>

  </div>
  <div id="sfnextbtn" title="Next" class="fbutton">
      <span class="fnext"></span>
  </div>
  <div class="fshowdatep fbutton">
          <div>
              <input type="hidden" name="txtshow" id="hdtxtshow" />
              <span id="txtdatetimeshow">Loading</span>

          </div>
  </div>

  <div class="clear"></div>
  </div>
</div>
<div style="padding:1px;">

<div class="t1 chromeColor">
  &nbsp;</div>
<div class="t2 chromeColor">
  &nbsp;</div>
<div id="dvCalMain" class="calmain printborder">
  <div id="gridcontainer" style="overflow-y: visible;">
  </div>
</div>
<div class="t2 chromeColor">

  &nbsp;</div>
<div class="t1 chromeColor">
  &nbsp;
</div>
</div>