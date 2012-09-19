
$(document).ready(function() {
	$("td").click(function(){
		$(this).focus();
	});
	$("td").focus(function(){
		$("td").removeClass('cellfocus');
		$(this).addClass('cellfocus');
	});
	$("#mycell td:first").focus();
});

var currentFocusTd = function(){
	return $(".cellfocus");
};

var xIndex = function(){
	return currentFocusTd().index();
}

var yIndex = function(){
	return currentFocusTd().parent().index();
}

$(document).keydown(function (e) {
	if ( event.which == 37 ) {	//left
		currentFocusTd().prev().focus();
		event.preventDefault();
	}else if ( event.which == 39 ) {//right
		currentFocusTd().next().focus();
		event.preventDefault();
	}else if ( event.which == 38 ) {//up
		$('tbody').children().eq(yIndex()-1).children().eq(xIndex()).focus();
		event.preventDefault();
	}else if ( event.which == 40 ) {//down
		$('tbody').children().eq(yIndex()+1).children().eq(xIndex()).focus();
		event.preventDefault();
	}else if( event.which == 13) { //enter
		alert(xIndex() + ', '+ yIndex());
	}else {
	//	alert(event.which);
	}
});

//$(document).keypress(function(event) {
//});
