
$(document).ready(function() {
	$("td").click(function(){
		if($(this).closest('tbody').attr("id") == 'maintbody'){	// this prevent to get click event on 'URL INSERT table'
			$(this).focus();
			document.location.href = currentFocusTd().attr("name");
		}
	});
	$("td").focus(function(){
		$("td").removeClass('cellfocus');
		$(this).addClass('cellfocus');
		$('#showUrlDiv').html($(this).attr("name"));
		//alert($(this).attr("name"));
		//$('#showUrlDiv').html($(this).attr("name"));
	});
	$("#mycell td:first").focus();
	
	var timeStamp = 0;
	 $(document).mousemove(function() {
		if(timeStamp == 100000){
			timeStamp = 0;
		}
		timeStamp++;
        document.getElementById('imgBlackman').style.webkitTransform ='rotateZ(' + (timeStamp * 8.0) + 'deg)';
    });
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

var itemIndex = function(){
	return yIndex()*currentFocusTd().parent().children().length + xIndex();
}

$(document).keydown(function (e) {
	if ( event.which == 37 ) {		//left
		currentFocusTd().prev().focus();
		event.preventDefault();
	}else if ( event.which == 39 ) {//right
		currentFocusTd().next().focus();
		event.preventDefault();
	}else if ( event.which == 38 ) {//up
		$('#maintbody').children().eq(yIndex()-1).children().eq(xIndex()).focus();
		event.preventDefault();
	}else if ( event.which == 40 ) {//down
		$('#maintbody').children().eq(yIndex()+1).children().eq(xIndex()).focus();
		event.preventDefault();
	}else if( event.which == 13) { //enter
		document.location.href = currentFocusTd().attr("name");
	}else {
		//alert(event.which);
	}
});

//$(document).keypress(function(event) {
//});
