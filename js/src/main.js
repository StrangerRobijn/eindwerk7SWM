
$('#myModal').modal() 


jQuery(document).ready(function($){
	var	scrolling = false;
	var contentSections = $('.cd-section'),
		verticalNavigation = $('.cd-vertical-nav'),
		navigationItems = verticalNavigation.find('a'),
		navTrigger = $('.cd-nav-trigger'),
		scrollArrow = $('.cd-scroll-down');

	$(window).on('scroll', checkScroll);

	//smooth scroll to the selected section
	verticalNavigation.on('click', 'a', function(event){
        event.preventDefault();
        smoothScroll($(this.hash));
        verticalNavigation.removeClass('open');
    });

    //smooth scroll to the second section
    scrollArrow.on('click', function(event){
    	event.preventDefault();
        smoothScroll($(this.hash));
    });

	// open navigation if user clicks the .cd-nav-trigger - small devices only
    navTrigger.on('click', function(event){
    	event.preventDefault();
    	verticalNavigation.toggleClass('open');
    });

	function checkScroll() {
		if( !scrolling ) {
			scrolling = true;
			(!window.requestAnimationFrame) ? setTimeout(updateSections, 300) : window.requestAnimationFrame(updateSections);
		}
	}

	function updateSections() {
		var halfWindowHeight = $(window).height()/2,
			scrollTop = $(window).scrollTop();
		contentSections.each(function(){
			var section = $(this),
				sectionId = section.attr('id'),
				navigationItem = navigationItems.filter('[href^="#'+ sectionId +'"]');
			( (section.offset().top - halfWindowHeight < scrollTop ) && ( section.offset().top + section.height() - halfWindowHeight > scrollTop) )
				? navigationItem.addClass('active')
				: navigationItem.removeClass('active');
		});
		scrolling = false;
	}

	function smoothScroll(target) {
        $('body,html').animate(
        	{'scrollTop':target.offset().top},
        	300
        );
	}
});

$('html').mousemove(function(e){
		
    var wx = $(window).width();
    var wy = $(window).height();
    
    var x = e.pageX - this.offsetLeft;
    var y = e.pageY - this.offsetTop;
    
    var newx = x - wx/2;
    var newy = y - wy/2;
    

    
    $('#wrapper div').each(function(){
        var speed = $(this).attr('data-speed');
        if($(this).attr('data-revert')) speed *= -1;
        TweenMax.to($(this), 1, {x: (1 - newx*speed), y: (1 - newy*speed)});
        
    });
    
});


/*Slide*/
$(function() {
    $('a[href*=#]:not([href=#])').click(function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html,body').animate({
            scrollTop: target.offset().top
          }, 750);
          return false;
        }
      }
    });
  });


  //form
  function validate() {


    var name = document.querySelector('input[name="name"]').value;

    if (name==null || name==""){
        alert("Geef een naam in");
        return false;
    }

    
    var subject = document.querySelector('input[name="subject"]').value;

    if (name==null || name==""){
        alert("Geef een onderwerp in");
        return false;
    }
 
    var email = document.querySelector('input[name="email"]').value;
    var atpos = email.indexOf("@");
    var dotpos = email.lastIndexOf(".");

    if(atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length){
        alert("Foutief email adres");
        return false;
    }
    return true;
}



$(document).ready(function() {
    
    /* Every time the window is scrolled ... */
    $(window).scroll( function(){
    
        /* Check the location of each desired element */
        $('.hideme').each( function(i){
            
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            
            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > bottom_of_object ){
                
                $(this).animate({'opacity':'1'}, 400);
                    
            }
            
        }); 
    
    });
    
});


//parallax effect


var lFollowX = 0,
    lFollowY = 0,
    x = 0,
    y = 0,
    friction = 1 / 30;

function moveBackground() {
  x += (lFollowX - x) * friction;
  y += (lFollowY - y) * friction;
  
  translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';

  $('.bg').css({
    '-webit-transform': translate,
    '-moz-transform': translate,
    'transform': translate
  });

  window.requestAnimationFrame(moveBackground);
}

$(window).on('mousemove click', function(e) {

  var lMouseX = Math.max(-100, Math.min(100, $(window).width() / 2 - e.clientX));
  var lMouseY = Math.max(-100, Math.min(100, $(window).height() / 2 - e.clientY));
  lFollowX = (20 * lMouseX) / 190; // 100 : 12 = lMouxeX : lFollow
  lFollowY = (10 * lMouseY) / 190;

});

moveBackground();


var inputReady = true;
var input = $('.404-input');
input.focus();
$('.container').on('click', function(e){
  input.focus();
});

input.on('keyup', function(e){
  $('.new-output').text(input.val());
  // console.log(inputReady);
});

$('.four-oh-four-form').on('submit', function(e){
  e.preventDefault();
  var val = $(this).children($('.404-input')).val().toLowerCase();
  var href;

	 if (val === 'kittens'){
    showKittens();
  }else {
    resetForm();
  }
});

function resetForm(withKittens){
  var message = "Sorry that command is not recognized."
  var input = $('.404-input');

  if (withKittens){
    $('.kittens').removeClass('kittens');
    message = "Huzzzzzah Kittehs!"
  }

  $('.new-output').removeClass('new-output');
  input.val('');
  $('.terminal').append('<p class="prompt">' + message + '</p><p class="prompt output new-output"></p>');

  $('.new-output').velocity(
    'scroll'
  ), {duration: 100}
}

	function showKittens(){
		$('.terminal').append("<div class='kittens'>"+
								 "<p class='prompt'>	                             ,----,         ,----,                                          ,---,</p>" +
								 "<p class='prompt'>       ,--.                ,/   .`|       ,/   .`|                     ,--.              ,`--.' |</p>" +
								 "<p class='prompt'>   ,--/  /|    ,---,     ,`   .'  :     ,`   .'  :     ,---,.        ,--.'|   .--.--.    |   :  :</p>" +
								 "<p class='prompt'>,---,': / ' ,`--.' |   ;    ;     /   ;    ;     /   ,'  .' |    ,--,:  : |  /  /    '.  '   '  ;</p>" +
								 "<p class='prompt'>:   : '/ /  |   :  : .'___,/    ,'  .'___,/    ,'  ,---.'   | ,`--.'`|  ' : |  :  /`. /  |   |  |</p>" +
								 "<p class='prompt'>|   '   ,   :   |  ' |    :     |   |    :     |   |   |   .' |   :  :  | | ;  |  |--`   '   :  ;</p>" +
								 "<p class='prompt'>'   |  /    |   :  | ;    |.';  ;   ;    |.';  ;   :   :  |-, :   |   \\ | : |  :  ;_     |   |  '</p>" +
								 "<p class='prompt'>|   ;  ;    '   '  ; `----'  |  |   `----'  |  |   :   |  ;/| |   : '  '; |  \\  \\    `.  '   :  |</p>" +
								 "<p class='prompt'>:   '   \\   |   |  |     '   :  ;       '   :  ;   |   :   .' '   ' ;.    ;   `----.   \\ ;   |  ;</p>" +
								 "<p class='prompt'>'   : |.  \\ |   |  '     '   :  |       '   :  |   '   :  ;/| '   : |  ; .'  /  /`--'  /  `--..`;  </p>" +
								 "<p class='prompt'>|   | '_\\.' '   :  |     ;   |.'        ;   |.'    |   |    \\ |   | '`--'   '--'.     /  .--,_   </p>" +
								 "<p class='prompt'>'   : |     ;   |.'      '---'          '---'      |   :   .' '   : |         `--'---'   |    |`.  </p>" +
								 "<p class='prompt'>;   |,'     '---'                                  |   | ,'   ;   |.'                    `-- -`, ; </p>" +
								 "<p class='prompt'>'---'                                              `----'     '---'                        '---`'</p>" +
								 "<p class='prompt'>                                                              </p></div>");

		
		var lines = $('.kittens p');
		$.each(lines, function(index, line){
			setTimeout(function(){
				$(line).css({
					"opacity": 1
				});

				textEffect($(line))
			}, index * 100);
		});

		$('.new-output').velocity(
			'scroll'
		), {duration: 100}

		setTimeout(function(){
			var gif;

			$.get('http://api.giphy.com/v1/gifs/random?api_key=dc6zaTOxFJmzC&tag=kittens', function(result){
				gif = result.data.image_url;
				$('.terminal').append('<img class="kitten-gif" src="' + gif + '"">');
				resetForm(true);
			});
		}, (lines.length * 100) + 1000);
	}

	function textEffect(line){
		var alpha = [';', '.', ',', ':', ';', '~', '`'];
		var animationSpeed = 10;
		var index = 0;
		var string = line.text();
		var splitString = string.split("");
		var copyString = splitString.slice(0);

		var emptyString = copyString.map(function(el){
		    return [alpha[Math.floor(Math.random() * (alpha.length))], index++];
		})

		emptyString = shuffle(emptyString);

		$.each(copyString, function(i, el){
		    var newChar = emptyString[i];
		    toUnderscore(copyString, line, newChar);

		    setTimeout(function(){
		      fromUnderscore(copyString, splitString, newChar, line);
		    },i * animationSpeed);
		  })
	}

	function toUnderscore(copyString, line, newChar){
		copyString[newChar[1]] = newChar[0];
		line.text(copyString.join(''));
	}

	function fromUnderscore(copyString, splitString, newChar, line){
		copyString[newChar[1]] = splitString[newChar[1]];
		line.text(copyString.join(""));
	}


	function shuffle(o){
	    for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
	    return o;
	};