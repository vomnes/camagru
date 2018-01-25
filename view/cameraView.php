<script id="camera-script" src="public/js/camera.js"></script>
<h2 id="title-page">Camera</h2>
<div id="camera-area">
  <img onclick="turnOnCamera()" id="turn-on-camera" src="public/pictures/lens-close.png" onmouseover="switchPicture('turn-on-camera', 'public/pictures/lens-close.png', 'public/pictures/lens.png')" onmouseout="switchPicture('turn-on-camera', 'public/pictures/lens-close.png', 'public/pictures/lens.png')" alt="camera lens close">
  <video autoplay="true" id="camera"></video>
  <!-- <img id="filter-1" class="filter" src="public/pictures/filters/SimpleBrownFrame.png" width="166" height="125"> -->
  <canvas id="canvas"></canvas>
  <img onclick="turnOffCamera()" id="stop-camera" src="public/pictures/no-camera-128.png" alt="no camera">
  <div id="take-picture" mode="video"></div>
  <img id="upload-picture" src="public/pictures/download-picture-black-128.png" alt="upload picture" onmouseover="switchPicture('upload-picture', 'public/pictures/download-picture-black-128.png', 'public/pictures/download-picture-color-128.png')" onmouseout="switchPicture('upload-picture', 'public/pictures/download-picture-black-128.png', 'public/pictures/download-picture-color-128.png')">
</div>
<div id="your-photo-area-before">
  <h3 style="text-align:center;font-size:1.2em;margin:2px;" >Your pictures</h3>
  <div id="your-photo-scroll-before">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
    <img class="your-photo" src="public/pictures/illustration-3.jpg">
  </div>
</div>
<div id="filter-area" class="border-style">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
  <img src="public/pictures/filters/border-picture.jpg">
</div>
