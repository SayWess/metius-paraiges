var audio = new Audio("Sounds/" + music + '.mp3'); 
var isMusicPaused = getSettings('isMusicPaused');
var sound = getSettings('isSonOn');
var SoundName = getSettings('Son');

function musicFond(music) {
	if(isMusicPaused == true) {
		var currentTime = getSettings('CurrentTimeMusic');
		audio.play();
		audio.currentTime = currentTime;
	}
}
	
function reload() {
	location.reload();
}

function pauses() {
	isMusicPaused = !isMusicPaused;
	if(isMusicPaused == false) {
		audio.pause();
		updateCookie('isMusicPaused', isMusicPaused);
		updateCookie('CurrentTimeMusic', audio.currentTime);
		document.querySelector('.Music-Button').classList.remove('Music-Button--play');
		document.querySelector('.Music-Button').classList.add('Music-Button--paused');
	} else if(isMusicPaused == true) {
		audio.play();
		updateCookie('isMusicPaused', isMusicPaused);
		updateCookie('CurrentTimeMusic', audio.currentTime);
		document.querySelector('.Music-Button').classList.remove('Music-Button--paused');
		document.querySelector('.Music-Button').classList.add('Music-Button--play');
	}
}

function LinkSound() {
	if(sound) {
		var audio = new Audio('Sounds/' + SoundName + '.ogg'); 
		audio.play();
	}
 }

function Sound() {
	sound = !sound;
	if(sound == false) {
		updateCookie('isSonOn', sound);
		document.querySelector('.Sound-Button').classList.remove('Sound-Button--on');
		document.querySelector('.Sound-Button').classList.add('Sound-Button--off');
	} else if(sound == true) {
		updateCookie('isSonOn', sound);
		document.querySelector('.Sound-Button').classList.remove('Sound-Button--off');
		document.querySelector('.Sound-Button').classList.add('Sound-Button--on');
	}
}

function currentTimer() {
	updateCookie('CurrentTimeMusic', audio.currentTime);
}
