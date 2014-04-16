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
});