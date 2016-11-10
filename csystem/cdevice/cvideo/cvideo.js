//---------------------------------------------------------
// file: cvideo.js
// desc: defines a video object
//---------------------------------------------------------

//----------------------------------------------------------------
// class: CVideo
// desc: defines the cvideo object
//----------------------------------------------------------------
var CVideo = new Class({
	Extends: CSound
	
	/*
	http://www.w3schools.com/tags/av_prop_controller.asp
	buffered - get the buffered ranges of the audio/video
	seekable - get the seekable ranges of the audio/video
	duration - get the duration of the audio/video
	currentTime - get or set the current playback position of the audio/video
	paused - check if the audio/video is paused
	play() - play the audio/video
	pause() - pause the audio/video
	played - check if the audio/video has been played
	defaultPlaybackRate - get or set the default playback rate of the audio/video
	playbackRate - get or set the current playback rate of the audio/video
	volume - get or set the volume of the audio/video
	muted - get or set if the audio/video is muted
	
	
	*/
	
	/*
	http://www.w3schools.com/tags/ref_av_dom.asp
	http://www.w3schools.com/tags/ref_av_dom.asp
	HTML Audio/Video Events
Event	Description
abort	Fires when the loading of an audio/video is aborted
canplay	Fires when the browser can start playing the audio/video
canplaythrough	Fires when the browser can play through the audio/video without stopping for buffering
durationchange	Fires when the duration of the audio/video is changed
emptied	Fires when the current playlist is empty
ended	Fires when the current playlist is ended
error	Fires when an error occurred during the loading of an audio/video
loadeddata	Fires when the browser has loaded the current frame of the audio/video
loadedmetadata	Fires when the browser has loaded meta data for the audio/video
loadstart	Fires when the browser starts looking for the audio/video
pause	Fires when the audio/video has been paused
play	Fires when the audio/video has been started or is no longer paused
playing	Fires when the audio/video is playing after having been paused or stopped for buffering
progress	Fires when the browser is downloading the audio/video
ratechange	Fires when the playing speed of the audio/video is changed
seeked	Fires when the user is finished moving/skipping to a new position in the audio/video
seeking	Fires when the user starts moving/skipping to a new position in the audio/video
stalled	Fires when the browser is trying to get media data, but data is not available
suspend	Fires when the browser is intentionally not getting media data
timeupdate	Fires when the current playback position has changed
volumechange	Fires when the volume has been changed
waiting	Fires when the video stops because it needs to buffer the next frame
*/
}); // end CSound