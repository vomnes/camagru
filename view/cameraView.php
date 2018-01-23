<script id="camera-script" src="public/js/camera.js"></script>
<h2 id="title-page">Camera</h2>
<div id="camera-area">
  <img onclick="turnOnCamera()" id="turn-on-camera" src="public/pictures/lens-close.png" onmouseover="switchPicture('turn-on-camera', 'public/pictures/lens-close.png', 'public/pictures/lens.png')" onmouseout="switchPicture('turn-on-camera', 'public/pictures/lens-close.png', 'public/pictures/lens.png')" alt="camera lens close">
  <video onclick="turnOffCamera()" autoplay="true" id="camera"></video>
  <div id="take-picture"
    onmouseover="if (document.getElementById('camera').style.visibility == 'visible') {document.getElementById('camera-area').style.backgroundColor = 'white'}"
    onmouseout="if (document.getElementById('camera').style.visibility == 'visible') {document.getElementById('camera-area').style.backgroundColor = '#EFEFEF'}">
  </div>
</div>
