// With JQuery
$("#ex6").slider();
$("#ex6").on("slide", function(slideEvt) {
	$("#ex6SliderVal").text(slideEvt.value);
});
$(document).ready(function(){

$('.box1').click(function() {
if($(this).hasClass('box0')) {
    $(this).removeClass('box0');
} else {
    $(this).addClass('box0');
}
});
});

$(document).ready(function(){

$('#set').click(function() {
if($('.box1').hasClass('box0')) {
	$('.box1').removeClass('box0');
}
});

});
