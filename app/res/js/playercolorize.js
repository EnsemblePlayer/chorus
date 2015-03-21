$(window).load(function() {
    var image = new Image;
    var result = $('body > .music-bar > .album-art').attr('src');
    image.src = result;
    var colorThief = new ColorThief();
    var colors = colorThief.getPalette(image);
    var color = colorThief.getColor(image);

    /*
     * Sort colors from lightest to darkest based on luminance
     */
    colors.sort(function(a, b) {
    	lumA = (0.299*a[0] + 0.587*a[1] + 0.114*a[2]);
    	lumB = (0.299*b[0] + 0.587*b[1] + 0.114*b[2]);
    	if(lumA < lumB)
    		return 1;
    	if(lumA > lumB)
    		return -1;
    	if(lumA == lumB)
    		return 0;
    });
 	
 	/*
 	 * Dominant Color
 	 */
    dominantElements = document.getElementsByClassName("colorize-dominant");
    for(var i = 0; i < dominantElements.length; i++) {
	  	dominantElements[i].style.backgroundColor = 'rgb(' + color.join(',') + ')';
	}

	inverseDominantElements = document.getElementsByClassName("colorize-dominant-inverse");
	if(inverseDominantElements.length > 0) {
		var inverseDominantColor = color;
		inverseDominantColor[0] = 255 - color[0];
		inverseDominantColor[1] = 255 - color[1];
		inverseDominantColor[2] = 255 - color[2];
	}
    for(var i = 0; i < inverseDominantElements.length; i++) {
	  	inverseDominantElements[i].style.backgroundColor = 'rgb(' + inverseDominantColor.join(',') + ')';
	}

	/*
 	 * Lightest Color
 	 */
	lightestElements = document.getElementsByClassName("colorize-lightest");
	inverseLightestElements = document.getElementsByClassName("colorize-lightest-inverse");
	if(inverseLightestElements.length > 0) {
		var inverseLightestColor = colors[0];
		inverseLightestColor[0] = 255 - color[0];
		inverseLightestColor[1] = 255 - color[1];
		inverseLightestColor[2] = 255 - color[2];
	}

	for(var i = 0; i < lightestElements.length; i++) {
	    lightestElements[i].style.backgroundColor = 'rgb(' + colors[0].join(',') + ')';
	}

	for(var i = 0; i < inverseLightestElements.length; i++) {
	    inverseLightestElements[i].style.backgroundColor = 'rgb(' + inverseLightestColor.join(',') + ')';
	}

	/*
 	 * Darkest Color
 	 */
	darkestElements = document.getElementsByClassName("colorize-darkest");
	inverseDarkestElements = document.getElementsByClassName("colorize-darkest-inverse");
	if(inverseDarkestElements.length > 0) {
		var inverseDarkestColor = colors[colors.length - 1];
		inverseDarkestColor[0] = 255 - color[0];
		inverseDarkestColor[1] = 255 - color[1];
		inverseDarkestColor[2] = 255 - color[2];
	}

	for(var i = 0; i < darkestElements.length; i++) {
	    darkestElements[i].style.backgroundColor = 'rgb(' + colors[colors.length - 1].join(',') + ')';
	}

	for(var i = 0; i < inverseDarkestElements.length; i++) {
	    inverseDarkestElements[i].style.backgroundColor = 'rgb(' + inverseDarkestColor.join(',') + ')';
	}

	/* Print all colors with luminance values along with darkest and lightest colors */
	console.log("----------")
	for(var i = 0; i < colors.length; i++) {
	    console.log(colors[i]);
	    console.log("L: " + (0.299*colors[i][0] + 0.587*colors[i][1] + 0.114*colors[i][2]))
	}

	console.log("darkest: " + colors[0]);
	console.log("lightest: " + colors[colors.length - 1]);
});