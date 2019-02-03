function sound() {
	var audio = new Audio('Sounds/button_click.ogg'); 
 	audio.play();
 }
  
var audio = new Audio("Sounds/" + music + '.mp3'); 

function musicFond(music, status) {
 	audio.play();
}
	
function reload() {
	location.reload();
	document.querySelector('#music').setAttribute("src", "Sounds/" + music + ".mp3");
}

var play = "play";

function pause() {
	play = !play;
	if(play == false) {
		audio.pause();
	} else if(play == true) {
		audio.play();
	}
}
