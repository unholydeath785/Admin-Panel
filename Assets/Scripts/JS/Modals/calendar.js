
var cal_days_labels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
var cal_months_labels = ['January','February','March','April','May','June'
                     ,'July','August','September','October'
                     ,'November','December'];
var cal_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31 , 30, 31, 30, 31];
var cal_current_date = new Date();

const NETWORK_ANALYTICS_CAL_SELECTABLE = new Calendar(cal_current_date.getMonth(), cal_current_date.getFullYear());

function Calendar(month, year) {
  this.month = (isNaN(month) || month == null) ? cal_current_date.getMonth() : month;
  this.year = (isNaN(year) || year == null) ? cal_current_date.getFullYear() : year;
  this.html = '';
}

Calendar.prototype.append = function (selector) {
  $(selector).append(NETWORK_ANALYTICS_CAL_SELECTABLE.getHTML());
}

Calendar.prototype.remove = function (selector) {
  $(selector).find('.calendar-table').remove()
}

Calendar.prototype.next = function () {
  this.month += 1;
  if (this.month > 11) {
    this.year++;
    this.month = 0;
  }
  this.generateHTML();
  this.remove('#calendar');
  this.append('#calendar');
}

Calendar.prototype.prev = function () {
  this.month -= 1;
  if (this.month < 0) {
    this.year--;
    this.month = 11;
  }
  this.generateHTML();
  this.remove('#calendar');
  this.append('#calendar');
}

Calendar.prototype.generateHTML = function () {
  var firstDay = new Date(this.year, this.month, 1);
  var startingDay = firstDay.getDay();
  var monthLength = cal_days_in_month[this.month];
  if (this.month == 1) {
    if ((this.year % 4 == 0 && this.year % 100 != 0) || this.year % 400 == 0) {
      monthLength = 29;
    }
  }
  var monthName = cal_months_labels[this.month];
  var html = '<table class="calendar-table">';
  html += '<tr class="calendar-header"><th colspan="7">';
  html += monthName + "&nbsp;" + this.year;
  html += '</th></tr>';
  html += '<tr class="calendar-header">';
  for (var i = 0; i < 7; i++) {
    html += '<td class="calendar-header-day">';
    html += cal_days_labels[i];
    html += '</td>';
  }

  var day = 1;
  for (var i = 0; i < Math.ceil(monthLength + startingDay) / 7; i++) {
    if (day > monthLength) {
      break;
    } else {
      var dayString = "";
      var dayString2 = "";
      var monthString = "";
      var monthString2 = "";
      var yearString = "";
      if (parseInt(day / 10) <= 0) {
        dayString = "0" + day;
      } else {
        dayString = day;
      }
      if (parseInt((this.month + 1) / 10) <= 0) {
        monthString = "0" + (this.month + 1);
      } else {
        monthString = this.month + 1;
      }
      if (day + 7 > cal_days_in_month[this.month]) {
        dayString2 = "0" + (7 - (cal_days_in_month[this.month] - day));
        if (this.month + 2 >= 10) {
          monthString2 = this.month + 2;
          if (monthString2 > 12) {
            monthString2 = "01";
            yearString = this.year + 1;
          } else {
            yearString = this.year;
          }
        } else {
          monthString2 = "0" + (this.month + 2);
          yearString = this.year;
        }
      } else {
        dayString2 = (day + 7)
        if (this.month + 1 >= 10) {
          monthString2 = this.month + 1;
          if (monthString2 >= 12) {
            monthString2 = "01";
            yearString = this.year + 1;
          } else {
            yearString = this.year;
          }
        } else {
          monthString2 = "0" + (this.month + 1);
          yearString = this.year;
        }
      }
      html += '</tr><tr onclick="weekClick(this)" class="week" id="week-'+(i+1)+'" data-range="'+this.year+'-'+monthString+'-'+dayString+'_'+yearString+'-'+monthString2+'-'+dayString2+'">';
    }
    for (var j = 0; j < 7; j++) {
      html += '<td class="calendar-day">';
      if (day <= monthLength && (i > 0 || j >= startingDay)) {
        html += '<span>' + day + '</span>';
        day++;
      }
      html += '</td>';
    }
  }
  html += '</tr></table>';
  this.html = html;
}

Calendar.prototype.getHTML = function () {
    return this.html;
}
