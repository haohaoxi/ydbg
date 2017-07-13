;(function($){

  $.fn.getDate = function(settings) {

    var opts = $.extend($.fn.getDate.defaults, settings);
    var _this = $(this);
    var _parse = function(m) { return (m < 10) ? '0'+m : m; }
      var week = ['日','一','二','三','四','五','六'];
      var date = new Date();
      timestr = '';
      timestr += ([date.getFullYear(),'/',_parse(date.getMonth()+1),'/',_parse(date.getDate())]).join('');
      if(opts['showWeek'] == 1) timestr += '<i></i>星期' + week[date.getDay()];

      var _getTime = function(){
        var d2 = new Date();
        return [_parse(d2.getHours()), _parse(d2.getMinutes()), _parse(d2.getSeconds())].join(':');
      }

      var _retTimeStr = function() {
        if(opts['showTime'] == 1) {
        return timestr + '<i></i>' + _getTime();
        }
        return timestr; 
      }
      
      _this.html(_retTimeStr());
    if(opts['loop'] == 1) {
      setInterval(function(){ _this.html(_retTimeStr()); }, 1000);
    }
  };

  $.fn.getDate.defaults = {
    "loop" : 1,
    "showWeek" : 1,
    "showTime" : 1
  };
  
})( jQuery );