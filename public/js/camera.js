function switchPicture(elem, src1, src2) {
  var src = document.getElementById(elem).src;
  src = src.substring(src.indexOf("/public/") + 1);
  if (src == src1) {
    document.getElementById(elem).src = src2;
  } else {
    document.getElementById(elem).src = src1;
  }
}

function camera() {
  var video = document.querySelector("#camera");

  navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia || navigator.oGetUserMedia;

  if (navigator.getUserMedia) {
      navigator.getUserMedia({video: true}, handleVideo, videoError);
  }

  function handleVideo(stream) {
      video.src = window.URL.createObjectURL(stream);
  }

  function videoError(e) {
      // do something
  }
}

function turnOnCamera() {
  camera();
  document.getElementById("camera").style.visibility = 'visible';
  document.getElementById("turn-on-camera").style.visibility = 'hidden';
}

function turnOffCamera() {
  document.getElementById("camera").style.visibility = 'hidden';
  document.getElementById("camera").src = '';
  document.getElementById("turn-on-camera").style.visibility = 'visible';
}
