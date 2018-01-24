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
      if (document.getElementById("title-page").innerHTML == 'Camera<br>Camera access denied') {
        document.getElementById("title-page").innerHTML = 'Camera';
      }
  }

  function videoError(e) {
      if (document.getElementById("title-page").innerHTML != 'Camera<br>Camera access denied') {
        document.getElementById("title-page").innerHTML += '<br>Camera access denied';
      }
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
        setPosition();
        changeVisibility(["camera", "take-picture", "stop-camera", "upload-picture", "your-photo-area", "your-photo-scroll"], 'visible');
      }
      on = true;
  };
}

function turnOffCamera() {
  document.getElementById("camera").pause();
  document.getElementById("camera").src = "";
  changeVisibility(["camera", "canvas", "take-picture", "stop-camera", "upload-picture", "your-photo-area", "your-photo-scroll"], 'hidden');
  document.getElementById("turn-on-camera").style.visibility = 'visible';
  document.getElementById('camera-area').style.backgroundColor = 'white';
  document.getElementById("camera-area").classList.remove("border-style");
  document.getElementById('camera-area').style.left = "50%";
  document.getElementById('camera-area').style.transform = "translateX(-50%)";
  location.reload();
}

window.onresize = function(event) {
  setPosition()
};

function setPosition() {
  if (document.documentElement.clientWidth > 1040) {
    document.getElementById('camera-area').style.left = "5%";
    document.getElementById('camera-area').style.transform = "translateX(-5%)";
    document.getElementById('your-photo-area').style.right = "5%";
    document.getElementById('your-photo-area').style.transform = "translateX(10%)";
  } else {
    document.getElementById('camera-area').style.left = "50%";
    document.getElementById('camera-area').style.transform = "translateX(-50%)";
    document.getElementById('your-photo-area').style.left = "50%";
    document.getElementById('your-photo-area').style.transform = "translateX(-50%)";
  }
}

function changeVisibility(elements, status) {
  elements.forEach(function(elem) {
    document.getElementById(elem).style.visibility = status;
  });
}

window.onload = function() {
  var takePicture = document.getElementById("take-picture");
  var canvas = document.getElementById("canvas");
  var video = document.getElementById("camera");
  var width = 500;
  var height = 375;

  takePicture.addEventListener('click', function(ev){
      if (takePicture.getAttribute('mode') == "video") {
        takePicture.setAttribute('mode', 'picture');
        takePicture.style.backgroundImage = "url('/public/pictures/re-icon-128.png')";
        document.getElementById("canvas").style.visibility = 'visible';
        takepicture();
      } else {
        takePicture.setAttribute('mode', 'video');
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
