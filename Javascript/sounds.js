function sound() {
	var audio = new Audio('Sounds/button_click.ogg'); 
 	audio.play();
 }
  
var audio = new Audio("Sounds/" + music + '.mp3'); 

function musicFond(music, status) {
	if(getSettings('isMusicPaused') == true) {
		audio.play();
	}
}
	
function reload() {
	location.reload();
	document.querySelector('#music').setAttribute("src", "Sounds/" + music + ".mp3");
}

var play;

function pauses() {
	play = !play;
	if(play == false) {
		audio.pause();
		updateCookie('isMusicPaused', play);
	} else if(play == true) {
		audio.play();
		updateCookie('isMusicPaused', play);
	}
}
