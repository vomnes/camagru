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
      if (document.getElementById("title-page").innerHTML == 'Camera - Access denied') {
        document.getElementById("title-page").innerHTML = 'Camera';
      }
  }

  function videoError(e) {
      if (document.getElementById("title-page").innerHTML != 'Camera - Access denied') {
        document.getElementById("title-page").innerHTML += ' - Access denied';
      }
      console.log('Camera access denied');
  }
}

function turnOnCamera() {
  var on = false;
  cameraOn();
  document.getElementById("camera").onloadeddata = function() {
      if (on == false) {
        document.getElementById("uploaded-picture").src = "";
        changeVisibility(["turn-on-camera", "upload-picture", "uploaded-picture", "turn-on-camera-picture-on"], 'hidden');
        changeVisibility(["take-picture", "upload-new-picture", "stop-camera", "download-picture", "camera"], 'visible');
      }
      on = true;
  };
}

function turnOffCamera() {
  var camera = document.getElementById("camera");
  camera.pause();
  camera.srcObject = null;
  changeVisibility(["canvas", "upload-new-picture", "take-picture", "stop-camera", "download-picture", "camera"], 'hidden');
  changeVisibility(["turn-on-camera", "upload-picture"], 'visible');
}

function changeVisibility(elements, status) {
  elements.forEach(function(elem) {
    document.getElementById(elem).style.visibility = status;
  });
}

window.onload = function() {
  addFilterId();
  var takePicture = document.getElementById("take-picture");
  var downloadPicture = document.getElementById("download-picture");
  var uploadFileButton = document.getElementById("upload-file-btn");
  var uploadPicture = document.getElementById("upload-picture");
  var uploadNewPicture = document.getElementById("upload-new-picture");
  var canvas = document.getElementById("canvas");
  var video = document.getElementById("camera");
  var width = 500;
  var height = 375;

  takePicture.addEventListener('click', function(ev){
      if (takePicture.getAttribute('mode') == "video") {
        takePicture.setAttribute('mode', 'picture');
        takePicture.style.backgroundImage = "url('/public/pictures/re-icon-128.png')";
        canvas.style.visibility = 'visible';
        takepicture();
      } else {
        takePicture.setAttribute('mode', 'video');
        canvas.style.visibility = 'hidden';
        canvas.setAttribute('content', '');
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

  downloadPicture.addEventListener('click', function(ev){
    savePicture();
    ev.preventDefault();
  }, false);

  // -- Upload a picture --

  uploadPicture.addEventListener('click', function(ev){
    uploadFileButton.click();
    ev.preventDefault();
  }, false);

  uploadNewPicture.addEventListener('click', function(ev){
    uploadFileButton.click();
    ev.preventDefault();
  }, false);

  uploadFileButton.onchange = function(e) {
    var camera = document.getElementById("camera");
    changeVisibility(["turn-on-camera", "upload-picture"], 'hidden');
    getBase64Image(uploadFileButton);
    camera.pause();
    camera.srcObject = null;
    document.getElementById("canvas").setAttribute("content", '');
    changeVisibility(["canvas", "camera", "take-picture", "stop-camera"], 'hidden');
    changeVisibility(["upload-new-picture", "download-picture", "turn-on-camera-picture-on"], 'visible');
  }
}

function getBase64Image(elem) {
  var file = elem.files[0];
  var picture = document.getElementById("uploaded-picture");
  picture.style.visibility = 'visible';
  var reader  = new FileReader();
  reader.addEventListener("load", function () {
    picture.src = reader.result;
  }, false);
  if (file) {
    reader.readAsDataURL(file);
  }
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
  if (document.getElementById("download-picture").style.visibility != 'visible') {
    return;
  }
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
  var base64Photo = document.getElementById("canvas").getAttribute('content');
  var base64Image = document.getElementById("uploaded-picture").src;
  var base64 = '';
  // Check image exists
  if (!base64Photo && base64Image.includes('action=camera')) {
    var takePictureBtn = document.getElementById("take-picture");
    if (takePictureBtn.getAttribute('mode') == "video") {
      let borderColor = takePictureBtn.style.borderColor;
      takePictureBtn.style.borderColor = 'Brown';
      setTimeout(function(){
        takePictureBtn.style.borderColor = borderColor;
      }, 100);
    }
    return;
  } else if (base64Photo) {
    base64 = base64Photo;
  } else {
    base64 = base64Image;
  }
  var formData = new FormData();
  formData.append('photo', base64);
  formData.append('filters', JSON.stringify(getUsedFilters()));
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				  if (this.readyState == 4 && this.status == 200) {
            let lastPicture = JSON.parse(xhttp.responseText);
            prependImage('your-photo-scroll', lastPicture['file_path'], 'index.php?action=picture&id=' + lastPicture['id'], 'your-photo', '');
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
