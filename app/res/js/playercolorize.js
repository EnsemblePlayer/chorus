$(window).load(function() {
    var image = new Image;
    var result = $('body > .music-bar > .album-art').attr('src');
    image.src = result;
    var colorThief = new ColorThief();
    var colors = colorThief.getPalette(image);
    var color = colorThief.getColor(image);
 	
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
	if(lightestElements.length > 0 || inverseLightestElements.length > 0) {
		lightestColorIndex = 0;
		lightestLum = (0.299*colors[0][0] + 0.587*colors[0][1] + 0.114*colors[0][2]);
		for(var i = 1; i < colors.length; i++) {
			tempLum = (0.299*colors[i][0] + 0.587*colors[i][1] + 0.114*colors[i][2]);
			if(tempLum > lightestLum) {
				lightestColor = i;
				lightestLum = tempLum;
			}
		}
	}

	if(inverseLightestElements.length > 0) {
		var inverseLightestColor = colors[lightestColorIndex];
		inverseLightestColor[0] = 255 - color[0];
		inverseLightestColor[1] = 255 - color[1];
		inverseLightestColor[2] = 255 - color[2];
	}

	for(var i = 0; i < lightestElements.length; i++) {
	    lightestElements[i].style.backgroundColor = 'rgb(' + colors[lightestColorIndex].join(',') + ')';
	}

	for(var i = 0; i < inverseLightestElements.length; i++) {
	    inverseLightestElements[i].style.backgroundColor = 'rgb(' + inverseLightestColor.join(',') + ')';
	}

	/*
 	 * Darkest Color
 	 */
	darkestElements = document.getElementsByClassName("colorize-darkest");
	inverseDarkestElements = document.getElementsByClassName("colorize-darkest-inverse");
	if(darkestElements.length > 0 || inverseDarkestElements.length > 0) {
		darkestColorIndex = 0;
		darkestLum = (0.299*colors[0][0] + 0.587*colors[0][1] + 0.114*colors[0][2]);
		for(var i = 1; i < colors.length; i++) {
			tempLum = (0.299*colors[i][0] + 0.587*colors[i][1] + 0.114*colors[i][2]);
			if(tempLum < darkestLum) {
				darkestColorIndex = i;
				darkestLum = tempLum;
			}
		}
	}

	if(inverseDarkestElements.length > 0) {
		var inverseDarkestColor = colors[darkestColorIndex];
		inverseDarkestColor[0] = 255 - color[0];
		inverseDarkestColor[1] = 255 - color[1];
		inverseDarkestColor[2] = 255 - color[2];
	}

	for(var i = 0; i < darkestElements.length; i++) {
	    darkestElements[i].style.backgroundColor = 'rgb(' + colors[darkestColorIndex].join(',') + ')';
	}

	for(var i = 0; i < inverseDarkestElements.length; i++) {
	    inverseDarkestElements[i].style.backgroundColor = 'rgb(' + inverseDarkestColor.join(',') + ')';
	}

	/* Print all colors with luminance values along with darkest and lightest colors
	console.log("----------")
	for(var i = 0; i < colors.length; i++) {
	    console.log(colors[i]);
	    console.log("L: " + (0.299*colors[i][0] + 0.587*colors[i][1] + 0.114*colors[i][2]))
	}

	console.log("darkest: " + colors[darkestColorIndex] + " (" + darkestLum + ")");
	console.log("lightest: " + colors[lightestColorIndex] + " (" + lightestLum + ")");
	*/
});