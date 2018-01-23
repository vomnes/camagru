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

  if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
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
  var on = false;
  cameraOn();
  document.getElementById("camera").onloadeddata = function() {
      if (on == false) {
        document.getElementById("turn-on-camera").style.visibility = 'hidden';
        document.getElementById("camera-area").className += "border-style";
        document.getElementById('camera-area').style.backgroundColor = '#EFEFEF'
        document.getElementById("camera").style.visibility = 'visible';
        document.getElementById("take-picture").style.visibility = 'visible';
        document.getElementById("stop-camera").style.visibility = 'visible';
      }
      on = true;
  };
}

function turnOffCamera() {
  document.getElementById("camera").pause();
  document.getElementById("camera").src = "";
  document.getElementById("camera").style.visibility = 'hidden';
  document.getElementById("canvas").style.visibility = 'hidden';
  document.getElementById("take-picture").style.visibility = 'hidden';
  document.getElementById("turn-on-camera").style.visibility = 'visible';
  document.getElementById("stop-camera").style.visibility = 'hidden';
  document.getElementById('camera-area').style.backgroundColor = 'white';
  document.getElementById("camera-area").classList.remove("border-style");
  location.reload();
}

window.onload = function() {
  var takePicture = document.getElementById("take-picture");
  var canvas = document.getElementById("canvas");
  var video = document.getElementById("camera");
  var width = 500;
  var height = 375;

  takePicture.addEventListener('click', function(ev){
      console.log(takePicture.getAttribute('value'));
      if (takePicture.getAttribute('value') == "video") {
        takePicture.setAttribute('value', 'picture');
        takePicture.style.backgroundImage = "url('/public/pictures/re-icon-128.png')";
        document.getElementById("canvas").style.visibility = 'visible';
        takepicture();
      } else {
        takePicture.setAttribute('value', 'video');
        document.getElementById("canvas").style.visibility = 'hidden';
        takePicture.style.backgroundImage = "";
      }
    ev.preventDefault();
  }, false);

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    canvas.setAttribute('src', data);
  }

  takePicture.addEventListener('mouseout', function(ev){
    if (document.getElementById('camera').style.visibility == 'visible') {
      document.getElementById('camera-area').style.backgroundColor = '#EFEFEF';
    }
    ev.preventDefault();
  }, false);

  takePicture.addEventListener('mouseover', function(ev){
    if (document.getElementById('camera').style.visibility == 'visible') {
      document.getElementById('camera-area').style.backgroundColor = 'white';
    }
    ev.preventDefault();
  }, false);
}
