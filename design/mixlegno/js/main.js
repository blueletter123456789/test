$(function(){
	
	// each element section
	var navButton = $('.navigation-button');
	var navBar = $('.navigation-bar');
	var navMenu = $('.navigation-wrapper');
	var prevButton = $('.button-wrapper.prev');
	var nextButton = $('.button-wrapper.next');
	var titleWrapper = $('.title-wrapper');
	var videoWrapper = $('.background-wrapper');

	// title setting
	var title = titleWrapper.find();
	var current = 0;
	var next = 1;
	var prev = title.prevObject.length -1;
	var subprev;
	var subnext;
	var video = videoWrapper.find();

	// each fuction definition section
	var titleDisplay =  function(){
		$(title.prevObject[current]).addClass('current');
		$(title.prevObject[next]).addClass('next');
		$(title.prevObject[prev]).addClass('prev');
		titleWrapper.not(title.prevObject[current]).not(title.prevObject[next]).not(title.prevObject[prev]).addClass('hidden');
	}

	var titleRemove = function(){
		titleWrapper.removeClass('prev');
		titleWrapper.removeClass('current');
		titleWrapper.removeClass('next');
		titleWrapper.removeClass('hidden');
	}

	var hiddnePrev = function(){
		$(title.prevObject[prev]).removeClass('hidden');
		$(title.prevObject[prev]).addClass('subprev');
	}

	var hiddneNext = function(){
		$(title.prevObject[next]).removeClass('hidden');
		$(title.prevObject[next]).addClass('subnext');
	}

	// video fade animation
	var currentVideo = function(){
		videoWrapper.removeClass('current');
		$(video.prevObject[current]).addClass('current');
	}

	// navigation animation
	navButton.on('click', function(){
		navMenu.toggleClass('active');
		navBar.toggleClass('close');
	});

	// title initial setting
	titleDisplay();

	// video initial setting
	currentVideo();

	// next button animation
	nextButton.on('click', function(){

		var tmpCurrnet = current;
		current  = prev; 
		next = tmpCurrnet;
		prev = prev == 0 ? title.prevObject.length - 1 : prev - 1;

		hiddnePrev();
		titleRemove();
		titleDisplay();
		setTimeout(function(){
			$(title.prevObject[prev]).removeClass('subprev');
    	},10);
    	currentVideo();
	})

	// prev button animation
	prevButton.on('click', function(){

		var tmpCurrnet = current;
		current  = next; 
		prev = tmpCurrnet;
		next = next == title.prevObject.length - 1 ? 0 : next + 1;

		hiddneNext();
		titleRemove();
		titleDisplay();
		setTimeout(function(){
			$(title.prevObject[next]).removeClass('subnext');
    	},10);
    	currentVideo();
	})


});
