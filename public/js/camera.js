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
        changeVisibility(["take-picture", "stop-camera", "upload-picture"], 'visible');
      }
      on = true;
  };
}

function turnOffCamera() {
  document.getElementById("camera").pause();
  document.getElementById("camera").src = "";
  changeVisibility(["canvas", "take-picture", "stop-camera", "upload-picture"], 'hidden');
  document.getElementById("turn-on-camera").style.visibility = 'visible';
  // document.getElementById('camera-area').style.backgroundColor = 'white';
  // document.getElementById("camera-area").classList.remove("border-style");
  location.reload();
}

function changeVisibility(elements, status) {
  elements.forEach(function(elem) {
    document.getElementById(elem).style.visibility = status;
  });
}

//
// function setPosition() {
//   if (document.documentElement.clientWidth > 1040) {
//     document.getElementById('camera-area').style.left = "5%";
//     document.getElementById('camera-area').style.transform = "translateX(-5%)";
//     document.getElementById('your-photo-area-after').style.right = "5%";
//     document.getElementById('your-photo-area-after').style.transform = "translateX(10%)";
//   } else {
//     document.getElementById('camera-area').style.left = "50%";
//     document.getElementById('camera-area').style.transform = "translateX(-50%)";
//     document.getElementById('your-photo-area-after').style.left = "50%";
//     document.getElementById('your-photo-area').style.transform = "translateX(-50%)";
//   }
// }

window.onload = function() {
  addFilterId();
  var takePicture = document.getElementById("take-picture");
  var uploadPicture = document.getElementById("upload-picture");
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

  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
    canvas.setAttribute('content', data);
  }

  uploadPicture.addEventListener('click', function(ev){
    savePicture();
    ev.preventDefault();
  }, false);
}

function addFilterId() {
  var filters = document.getElementById("filter-area").childNodes;
  var index = 0;
  var idName;
  for(var i = 0; i< filters.length;i++)
  {
    if (filters[i].nodeType == 1) {
      filters[i].setAttribute('class', 'filter-picture');
      idName = 'filter-picture-' + index;
      filters[i].setAttribute('id', idName);
      filters[i].setAttribute('onclick', 'selectFilter(\''+ idName+ '\')');
      filters[i].setAttribute('value', '0');
      filters[i].style.border = "2px solid white";
      document.styleSheets[0].insertRule('#'+idName+':hover{cursor:pointer;}', 0);
      index++;
    }
  }
}

function selectFilter(elementId) {
  var element = document.getElementById(elementId);
  if (element.value == 0) {
    element.value = 1;
    element.style.border = "2px solid white";
    var filterToRemove = document.getElementById("apply-" + elementId);
    filterToRemove.parentNode.removeChild(filterToRemove);
  } else {
    element.value = 0;
    element.style.border = "2px solid #3092DE";
    appendImage("applied-filter", element.src, "filter-style", "apply-" + elementId);
  }
}

function savePicture() {
  var photo = document.getElementById("canvas");
  var base64Photo = photo.getAttribute('content');
  if (base64Photo == null) {
    return;
  } else {
    var formData = new FormData();
    formData.append('photo', base64Photo);
    formData.append('filters', JSON.stringify(getUsedFilters()));
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				  if (this.readyState == 4 && this.status == 200) {
            prependImage('your-photo-scroll', xhttp.responseText, 'your-photo', '');
				  }
			  };
				xhttp.open("GET", "index.php?action=camera&method=lastpicture", true); // Get last picture
				xhttp.send();
		}
  }
  xmlhttp.open("POST", "index.php?action=camera&method=savepicture", true); // Create new image
  xmlhttp.send(formData);
}

function getUsedFilters() {
  var filters = document.getElementById("applied-filter").childNodes;
  var usedFilters = [];
  for(var i = 0; i< filters.length;i++)
  {
    if (filters[i].nodeType == 1) {
      usedFilters.push(filters[i].src);
    }
  }
  return usedFilters;
}

function appendImage(parentId, src, className, idName) {
  var img = document.createElement("img");
  img.src = src;
  if (className != '') {
    img.className += className;
  }
  if (idName != '') {
    img.id = idName;
  }
  document.getElementById(parentId).appendChild(img);
}

function prependImage(parentId, src, className, idName) {
  var parent = document.getElementById(parentId);
  var img = document.createElement("img");
  img.src = src;
  if (className != '') {
    img.className += className;
  }
  if (idName != '') {
    img.id = idName;
  }
  parent.appendChild(img);
  parent.insertBefore(img, parent.firstChild);
}
