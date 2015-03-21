$(window).load(function() {
    var image = new Image;
    var result = $('body > .music-bar > .album-art').attr('src');
    image.src = result;
    var colorThief = new ColorThief();
    var color = colorThief.getColor(image);
    // Dominant color
    //document.getElementById("#music-bar").style.backgroundColor = 'rgb(' + color.join(',') + ')';
    elements = document.getElementsByClassName("colorize-dominant");
    for(var i = 0; i < elements.length; i++) {
	    elements[i].style.backgroundColor = 'rgb(' + color.join(',') + ')';
	}
});