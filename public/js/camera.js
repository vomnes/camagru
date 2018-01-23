function switchPicture(elem, src1, src2) {
  var src = document.getElementById(elem).src;
  src = src.substring(src.indexOf("/public/") + 1);
  if (src == src1) {
    document.getElementById(elem).src = src2;
  } else {
    document.getElementById(elem).src = src1;
  }
}

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

function cameraOn() {
  var video = document.getElementById("camera");

  if (navigator.getUserMedia) {
      navigator.getUserMedia({video: true}, handleVideo, videoError);
  }

  function handleVideo(stream) {
      video.srcObject = stream;
  }

  function videoError(e) {
      console.log('Error to switch on the camera');
  }
}

function turnOnCamera() {
  cameraOn();
  document.getElementById("turn-on-camera").style.visibility = 'hidden';
  document.getElementById("camera-area").className += "shadow";
  document.getElementById("camera").style.visibility = 'visible';
}

function turnOffCamera() {
  document.getElementById("camera").pause();
  document.getElementById("camera").src = '';
  document.getElementById("camera").style.visibility = 'hidden';
  document.getElementById("turn-on-camera").style.visibility = 'visible';
  document.getElementById("camera-area").className -= "shadow";
  location.reload();
}
