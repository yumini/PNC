$(function () {
 if (!Modernizr.inputtypes.date) {
 	$("input[type='date']").attr('data-date-format','YYYY/MM/DD');
 	$("input[type='date']").datetimepicker({
	pickDate: true,                 //en/disables the date picker
    pickTime: false,                 //en/disables the time picker
    showToday: true,                 //shows the today indicator
    language:'es'                  //sets language locale
    
 	});
 }
 $("input[required='required']").addClass("input-required");

var menu = $('#main-menu');
var menu_offset = menu.offset();
$(window).on('scroll', function() {
  	console.log("scroll..");
  	console.log($(window).scrollTop())
  	console.log(menu_offset.top);
    if($(window).scrollTop() > menu_offset.top) {
      menu.addClass('navbar-fixed-top');
    } else {
      menu.removeClass('navbar-fixed-top');
    }
});

});