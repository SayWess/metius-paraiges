function sound() {
	var audio = new Audio('Sounds/button_click.ogg'); 
 	audio.play();
 }
  
var audio = new Audio("Sounds/" + music + '.mp3'); 
var isMusicPaused = getSettings('isMusicPaused');

function musicFond(music, status) {
	if(isMusicPaused == true) {
		var currentTime = getSettings('CurrentTimeMusic');
		audio.play();
		audio.currentTime = currentTime;
	}
}
	
function reload() {
	location.reload();
}

var play = isMusicPaused;

function pauses() {
	play = !play;
	if(play == false) {
		audio.pause();
		updateCookie('isMusicPaused', play);
		updateCookie('CurrentTimeMusic', audio.currentTime);
		$('#Music-Button').css('background-image', 'linear-gradient(135deg, rgba(255,0,0,.4), rgba(255, 0, 0, 0))')
		document.getElementById('Music-Button').style.borderColor = '#c00';
	} else if(play == true) {
		audio.play();
		updateCookie('isMusicPaused', play);
		updateCookie('CurrentTimeMusic', audio.currentTime);
		document.getElementById('Music-Button').style.backgroundImage = 'linear-gradient(135deg, rgba(0,255,0,.3), rgba(255, 0, 0, 0))';
		document.getElementById('Music-Button').style.borderColor = '#060';
	}
}

function currentTimer() {
	updateCookie('CurrentTimeMusic', audio.currentTime);
}
