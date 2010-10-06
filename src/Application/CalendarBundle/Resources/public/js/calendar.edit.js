if (!DateAdd || typeof (DateDiff) != "function") {
  var DateAdd = function(interval, number, idate) {
    number = parseInt(number);
    var date;
    if (typeof (idate) == "string") {
      date = idate.split(/\D/);
      eval("var date = new Date(" + date.join(",") + ")");
    }
    if (typeof (idate) == "object") {
      date = new Date(idate.toString());
    }
    switch (interval) {
      case "y":
        date.setFullYear(date.getFullYear() + number);
        break;
      case "m":
        date.setMonth(date.getMonth() + number);
        break;
      case "d":
        date.setDate(date.getDate() + number);
        break;
      case "w":
        date.setDate(date.getDate() + 7 * number);
        break;
      case "h":
        date.setHours(date.getHours() + number);
        break;
      case "n":
        date.setMinutes(date.getMinutes() + number);
        break;
      case "s":
        date.setSeconds(date.getSeconds() + number);
        break;
      case "l":
        date.setMilliseconds(date.getMilliseconds() + number);
        break;
    }
    return date;
  }
}
function getHM(date)
{
  var hour =date.getHours();
  var minute= date.getMinutes();
  var ret= (hour>9?hour:"0"+hour)+":"+(minute>9?minute:"0"+minute) ;
  return ret;
}
function editEvent(options) {
  //debugger;
  var arrT = [];
  var tt = "{0}:{1}";
  for (var i = 0; i < 24; i++) {
    arrT.push({
      text: StrFormat(tt, [i >= 10 ? i : "0" + i, "00"])
    }, {
      text: StrFormat(tt, [i >= 10 ? i : "0" + i, "30"])
    });
  }
  $("#timezone").val(new Date().getTimezoneOffset()/60 * -1);
  $("#stparttime").dropdown({
    dropheight: 200,
    dropwidth:60,
    selectedchange: function() { },
    items: arrT
  });
  $("#etparttime").dropdown({
    dropheight: 200,
    dropwidth:60,
    selectedchange: function() { },
    items: arrT
  });
  var check = $("#IsAllDayEvent").click(function(e) {
    if (this.checked) {
      $("#stparttime").val("00:00").hide();
      $("#etparttime").val("00:00").hide();
    }
    else {
      var d = new Date();
      var p = 60 - d.getMinutes();
      if (p > 30) p = p - 30;
      d = DateAdd("n", p, d);
      $("#stparttime").val(getHM(d)).show();
      $("#etparttime").val(getHM(DateAdd("h", 1, d))).show();
    }
  });
  if (check[0].checked) {
    $("#stparttime").val("00:00").hide();
    $("#etparttime").val("00:00").hide();
  }
  $("#Savebtn").click(function() {
    $("#fmEdit").submit();
  });
  $("#Closebtn").click(function() {
    CloseModelWindow();
  });
  $("#Deletebtn").click(function() {
    if (confirm("Are you sure to remove this event")) {
      var param = [{
        "name": "calendarId",
        value: 8
      }];
      $.post(options.deleteURL,
        param,
        function(data){
          if (data.IsSuccess) {
            alert(data.Msg);
            CloseModelWindow(null,true);
          }
          else {
            alert("Error occurs.\r\n" + data.Msg);
          }
        }
        ,"json");
    }
  });

  $("#stpartdate,#etpartdate").datepicker({
    picker: "<button class='calpick'></button>"
  });
  var cv =$("#colorvalue").val() ;
  if(cv=="")
  {
    cv="-1";
  }
  $("#calendarcolor").colorselect({
    title: "Color",
    index: cv,
    hiddenid: "colorvalue"
  });
  //to define parameters of ajaxform
  var options = {
    beforeSubmit: function() {
      return true;
    },
    dataType: "json",
    success: function(data) {
      if (data.IsSuccess) {
        CloseModelWindow(null,true);
      }
    }
  };
  $.validator.addMethod("date", function(value, element) {
    var arrs = value.split(i18n.datepicker.dateformat.separator);
    var year = arrs[i18n.datepicker.dateformat.year_index];
    var month = arrs[i18n.datepicker.dateformat.month_index];
    var day = arrs[i18n.datepicker.dateformat.day_index];
    var standvalue = [year,month,day].join("-");
    return this.optional(element) || /^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3-9]|1[0-2])[\/\-\.](?:29|30))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1,3,5,7,8]|1[02])[\/\-\.]31)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:16|[2468][048]|[3579][26])00[\/\-\.]0?2[\/\-\.]29)(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?: \d{1,3})?)?$|^(?:(?:1[6-9]|[2-9]\d)?\d{2}[\/\-\.](?:0?[1-9]|1[0-2])[\/\-\.](?:0?[1-9]|1\d|2[0-8]))(?: (?:0?\d|1\d|2[0-3])\:(?:0?\d|[1-5]\d)\:(?:0?\d|[1-5]\d)(?:\d{1,3})?)?$/.test(standvalue);
  }, "Invalid date format");
  $.validator.addMethod("time", function(value, element) {
    return this.optional(element) || /^([0-1]?[0-9]|2[0-3]):([0-5][0-9])$/.test(value);
  }, "Invalid time format");
  $.validator.addMethod("safe", function(value, element) {
    return this.optional(element) || /^[^$\<\>]+$/.test(value);
  }, "$<> not allowed");
  $("#fmEdit").validate({
    submitHandler: function(form) {
      $("#fmEdit").ajaxSubmit(options);
    },
    errorElement: "div",
    errorClass: "cusErrorPanel",
    errorPlacement: function(error, element) {
      showerror(error, element);
    }
  });
  function showerror(error, target) {
    var pos = target.position();
    var height = target.height();
    var newpos = {
      left: pos.left,
      top: pos.top + height + 2
    }
    var form = $("#fmEdit");
    error.appendTo(form).css(newpos);
  }
}