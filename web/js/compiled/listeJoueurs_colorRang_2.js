$(document).ready(function() {
	

    var td_rang = document.getElementsByClassName('rang', 'span');
    console.log(td_rang);
    console.log(td_rang.length);
    for(var i=0; i<td_rang.length; i++) {
        var span = td_rang[i].getElementsByTagName('span')[0];
        alert(span);
        var color = $(span).data('color');
        $(this).css('color', color);
    }
});