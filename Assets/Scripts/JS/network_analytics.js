NETWORK_ANALYTICS_CAL_SELECTABLE.generateHTML();
NETWORK_ANALYTICS_CAL_SELECTABLE.append('#calendar');

var calendarRange = defaultRange();
var rangeIsSet = false;

$('#cal-next').click(function () {
  NETWORK_ANALYTICS_CAL_SELECTABLE.next();
})

$('#cal-prev').click(function () {
  NETWORK_ANALYTICS_CAL_SELECTABLE.prev();
})

function weekClick(ele) {
  if (showing) {
    calendarRange = "?range=" + $(ele).data("range");
    drawChart();
  }
}

function defaultRange() {
  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var year2 = currentDate.getFullYear();
  var month = currentDate.getMonth() + 1;
  var month2 = currentDate.getMonth() + 1;
  var day = currentDate.getDate();
  var day2 = currentDate.getDate() + 7;
  if (month < 10) {
    month = "0" + month;
    month2 = "0" + month2;
  }
  if (day < 10) {
    day = "0" + day;
  }
  if (day2 < 10) {
    day2 = "0" + day2;
  }
  var foo = day2;
  if (parseInt(foo) + 7 > cal_days_in_month[NETWORK_ANALYTICS_CAL_SELECTABLE.month]) {
    day2 = "0" + (day2 - (cal_days_in_month[NETWORK_ANALYTICS_CAL_SELECTABLE.month] - day));
    if (month < 10) {
      month2 = "0" + (month2 + 1);
      if (month2 > 12) {
        year2 += 1;
      }
    }
  }
  var range = "?range=" + year + "-" + month + "-" + day + "_" + year2 + "-" + month2 + "-" + day2;
  return range;
}

function addDays(date, days) {
  var result = new Date(date);
  result.setDate(result.getDate() + days);
  return result;
}

function getMonth(monthInt) {
  switch (monthInt) {
    case 0:
      return "January";
    case 1:
      return "February";
    case 2:
      return "March";
    case 3:
      return "April";
    case 4:
      return "May";
    case 5:
      return "June";
    case 6:
      return "July";
    case 7:
      return "August";
    case 8:
      return "September";
    case 9:
      return "October";
    case 10:
      return "November";
    case 11:
      return "December";
    default:
      return "";
  }
}

function getDateArray(range) {
  range = range.replace("?range=","");
  var rangeArray = range.split("_");
  var day1 = rangeArray[0].substring(8,10);
  var month1 = rangeArray[0].substring(5,7);
  var year1 = rangeArray[0].substring(0,4);
  var day2 = rangeArray[1].substring(8,10);
  var month2 = rangeArray[1].substring(5,7);
  var year2 = rangeArray[1].substring(0,4);
  var date1 = new Date(year1, parseInt(month1) - 1, day1, 0, 0, 0, 0);
  var date2 = new Date(year2, parseInt(month2) - 1, day2, 0, 0, 0, 0);
  var dif = (date2 - date1);
  var current = date1;
  var dateArray = [];
  while (current < date2) {
    dateArray.push(getMonth(current.getMonth()) + " " + current.getDate()
      + ", " + current.getFullYear());
    current = addDays(current, 1);
  }
  return dateArray;
}

google.charts.load('current', {'packages':['line']});
google.charts.setOnLoadCallback(drawChart);

function getSubMonth(mm) {
  switch (mm) {
    case "January":
      return "01";
    case "February":
      return "02";
    case "March":
      return "03";
    case "April":
      return "04";
    case "May":
      return "05";
    case "June":
      return "06";
    case "July":
      return "07";
    case "August":
      return "08";
    case "September":
      return "09";
    case "October":
      return "10";
    case "November":
      return "11";
    case "December":
      return "12";
    default:
  }
}

function getSubDate(writtenDate) {
  var date = "";
  var split1 = writtenDate.split(" ");
  var split2 = split1[1].split(", ");
  var mm = split1[0];
  var dd = "" + parseInt(split2[0].replace(",", ""));
  var yyyy = split1[2];
  var ddDigit = parseInt(dd / 10);
  if (ddDigit == 0) {
    dd = "0" + dd;
  }
  mm = getSubMonth(mm);
  date = yyyy + "-" + mm + "-" + dd
  return date;
}

function drawChart() {
  var data = new google.visualization.DataTable();
  //for new days add column
  data.addColumn('number', 'Hour');
  var columns = 0;
  var range = calendarRange;
  var dateArray = getDateArray(range);
  for (var i = 0; i < dateArray.length; i++) {
    data.addColumn('number',dateArray[i]);
  }

  var rows = $.ajax({
    type: "POST",
    url: "Assets/Scripts/PHP/get_rows.php" + range,
    dataType: "json",
    success: function (value) {
      var countMap = value;
      var map = {};
      for (var i = 0; i < dateArray.length; i++) {
        map[getSubDate(dateArray[i])] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
      }
      for (var key in countMap) {
        var date = key.substring(0,10);
        var index = parseInt(key.substring(11));
        var count = countMap[key];
        var timeline = map[date];
        timeline[index] = count;
        map[date] = timeline;
      }
      for (var i = 0; i < 24; i++) {
        var array = [i];
        for (var key in map) {
          var timeline = map[key];
          array.push(timeline[i]);
        }
        // console.log(array);
        data.addRows([array])
      }
    }
  })

  var options = {
    chart: {
      title: 'Number of Active Sessions',
      subtitle: 'over a span of days'
    },
    width: "90%",
    height: 350
  };

  var chart = new google.charts.Line(document.getElementById('chart_div'));

  chart.draw(data, options);
}
