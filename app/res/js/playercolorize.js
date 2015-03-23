$(window).load(function() {
	var img = new Image();
	img.crossOrigin = 'Anonymous';
	img.src = $('body > .music-bar > .album-art').attr('src');
	img.onload = function () {
		var colorThief = new ColorThief();
		var color = colorThief.getColor(img);
		var colors = colorThief.getPalette(img);
	};

	/*
    var image = new Image;
    var result = $('body > .music-bar > .album-art').attr('src');
    image.src = result;
    var colorThief = new ColorThief();
    var colors = colorThief.getPalette(image);
    var color = colorThief.getColor(image);
    */

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
    	var classes = dominantElements[i].className;
    	if(classes.indexOf("colorize-bg") >= 0) {
	  		dominantElements[i].style.backgroundColor = 'rgb(' + color.join(',') + ')';
    	}

    	if(classes.indexOf("colorize-text") >= 0) {
	  		dominantElements[i].style.color = 'rgb(' + color.join(',') + ')';
    	}

	  	if(classes.indexOf("colorize-img") >= 0) {
	  		dominantElements[i].style.backgroundImage = 'linear-gradient(to bottom, rgba(' + color.join(',') 
	  													+ ', 0.7) 0%, rgba(' + color.join(',') + ', 0.7) 100%), ' 
	  													+ dominantElements[i].style.backgroundImage;
	  	}
	}

	inverseDominantElements = document.getElementsByClassName("colorize-dominant-inverse");
	if(inverseDominantElements.length > 0) {
		var inverseDominantColor = color;
		inverseDominantColor[0] = 255 - color[0];
		inverseDominantColor[1] = 255 - color[1];
		inverseDominantColor[2] = 255 - color[2];
	}
    for(var i = 0; i < inverseDominantElements.length; i++) {
	  	var classes = inverseDominantElements[i].className;
	  	if(classes.indexOf("colorize-bg") >= 0) {
	  		inverseDominantElements[i].style.backgroundColor = 'rgb(' + inverseDominantColor.join(',') + ')';
    	}

    	if(classes.indexOf("colorize-text") >= 0) {
	  		inverseDominantElements[i].style.color = 'rgb(' + inverseDominantColor.join(',') + ')';
    	}

	  	if(classes.indexOf("colorize-img") >= 0) {
	  		inverseDominantElements[i].style.backgroundImage = 'linear-gradient(to bottom, rgba(' + inverseDominantColor.join(',') 
	  													+ ', 0.7) 0%, rgba(' + inverseDominantColor.join(',') + ', 0.7) 100%), ' 
	  													+ inverseDominantElements[i].style.backgroundImage;
	  	}
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
	    var classes = lightestElements[i].className;
	  	if(classes.indexOf("colorize-bg") >= 0) {
	  		lightestElements[i].style.backgroundColor = 'rgb(' + colors[0].join(',') + ')';
    	}

    	if(classes.indexOf("colorize-text") >= 0) {
	  		lightestElements[i].style.color = 'rgb(' + colors[0].join(',') + ')';
    	}

	  	if(classes.indexOf("colorize-img") >= 0) {
	  		lightestElements[i].style.backgroundImage = 'linear-gradient(to bottom, rgba(' + colors[0].join(',') 
	  													+ ', 0.7) 0%, rgba(' + colors[0].join(',') + ', 0.7) 100%), ' 
	  													+ lightestElements[i].style.backgroundImage;
	  	}
	}

	for(var i = 0; i < inverseLightestElements.length; i++) {
	    var classes = inverseLightestElements[i].className;
	  	if(classes.indexOf("colorize-bg") >= 0) {
	  		inverseLightestElements[i].style.backgroundColor = 'rgb(' + inverseLightestColor.join(',') + ')';
    	}

    	if(classes.indexOf("colorize-text") >= 0) {
	  		inverseLightestElements[i].style.color = 'rgb(' + inverseLightestColor.join(',') + ')';
    	}

	  	if(classes.indexOf("colorize-img") >= 0) {
	  		inverseLightestElements[i].style.backgroundImage = 'linear-gradient(to bottom, rgba(' + inverseLightestColor.join(',') 
	  													+ ', 0.7) 0%, rgba(' + inverseLightestColor.join(',') + ', 0.7) 100%), ' 
	  													+ inverseLightestElements[i].style.backgroundImage;
	  	}
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
	    var classes = darkestElements[i].className;
	  	if(classes.indexOf("colorize-bg") >= 0) {
	  		darkestElements[i].style.backgroundColor = 'rgb(' + colors[colors.length - 1].join(',') + ')';
    	}

    	if(classes.indexOf("colorize-text") >= 0) {
	  		darkestElements[i].style.color = 'rgb(' + colors[colors.length - 1].join(',') + ')';
    	}

	  	if(classes.indexOf("colorize-img") >= 0) {
	  		darkestElements[i].style.backgroundImage = 'linear-gradient(to bottom, rgba(' + colors[colors.length - 1].join(',') 
	  													+ ', 0.7) 0%, rgba(' + colors[colors.length - 1].join(',') + ', 0.7) 100%), ' 
	  													+ darkestElements[i].style.backgroundImage;
	  	}
	}

	for(var i = 0; i < inverseDarkestElements.length; i++) {
	    var classes = inverseDarkestElements[i].className;
	  	if(classes.indexOf("colorize-bg") >= 0) {
	  		inverseDarkestElements[i].style.backgroundColor = 'rgb(' + inverseDarkestColor.join(',') + ')';
    	}

    	if(classes.indexOf("colorize-text") >= 0) {
	  		inverseDarkestElements[i].style.color = 'rgb(' + inverseDarkestColor.join(',') + ')';
    	}

	  	if(classes.indexOf("colorize-img") >= 0) {
	  		inverseDarkestElements[i].style.backgroundImage = 'linear-gradient(to bottom, rgba(' + inverseDarkestColor.join(',') 
	  													+ ', 0.7) 0%, rgba(' + inverseDarkestColor.join(',') + ', 0.7) 100%), ' 
	  													+ inverseDarkestElements[i].style.backgroundImage;
	  	}
	}

	/* Print all colors with luminance values along with darkest and lightest colors
	console.log("----------")
	for(var i = 0; i < colors.length; i++) {
	    console.log(colors[i]);
	    console.log("L: " + (0.299*colors[i][0] + 0.587*colors[i][1] + 0.114*colors[i][2]))
	}

	console.log("darkest: " + colors[0]);
	console.log("lightest: " + colors[colors.length - 1]);
	*/
});