<script id="camera-script" src="public/js/camera.js"></script>
<h2 id="title-page">Camera</h2>
<div id="camera-area" class="border-style">
  <img onclick="turnOnCamera()" id="turn-on-camera" src="public/pictures/lens-close.png" onmouseover="switchPicture('turn-on-camera', 'public/pictures/lens-close.png', 'public/pictures/lens.png')" onmouseout="switchPicture('turn-on-camera', 'public/pictures/lens-close.png', 'public/pictures/lens.png')" alt="camera lens close" title="Turn on camera">
  <input type="file" style="display:none;" id="upload-file-btn" accept=".jpg, .jpeg, .png"><img id="upload-picture" src="public/pictures/upload-picture-black-512.png" onmouseover="switchPicture('upload-picture', 'public/pictures/upload-picture-black-512.png', 'public/pictures/upload-picture-color-512.png');" onmouseout="switchPicture('upload-picture', 'public/pictures/upload-picture-black-512.png', 'public/pictures/upload-picture-color-512.png');" alt="upload picture" title="Upload picture"></input>
  <img id="uploaded-picture" src="">
  <canvas id="canvas"></canvas>
  <video autoplay="true" id="camera"></video>
  <img onclick="turnOffCamera()" id="stop-camera" src="public/pictures/no-camera-128.png" alt="no camera">
  <img onclick="turnOnCamera()" id="turn-on-camera-picture-on" src="public/pictures/lens.png" alt="camera lens" title="Turn on camera">
  <img id="upload-new-picture" src="public/pictures/upload-picture-black-512.png" onmouseover="switchPicture('upload-new-picture', 'public/pictures/upload-picture-black-512.png', 'public/pictures/upload-picture-color-512.png');" onmouseout="switchPicture('upload-new-picture', 'public/pictures/upload-picture-black-512.png', 'public/pictures/upload-picture-color-512.png');" alt="upload picture" title="Upload picture">
  <div id="take-picture" mode="video"></div>
  <img id="download-picture" src="public/pictures/download-picture-black-128.png" alt="upload picture" onmouseover="switchPicture('download-picture', 'public/pictures/download-picture-black-128.png', 'public/pictures/download-picture-color-128.png')" onmouseout="switchPicture('download-picture', 'public/pictures/download-picture-black-128.png', 'public/pictures/download-picture-color-128.png')">
  <div id="applied-filter"></div>
</div>
<div id="filter-area" class="border-style">
  <img src="public/pictures/filters/basketball.png">
  <img src="public/pictures/filters/crooks-and-castles.png">
  <img src="public/pictures/filters/plane.png">
  <img src="public/pictures/filters/white-mask.png">
  <img src="public/pictures/filters/fireball-two.png">
  <img src="public/pictures/filters/prison.png">
  <img src="public/pictures/filters/table.png">
  <img src="public/pictures/filters/cheese.png">
  <img src="public/pictures/filters/hamburgers.png">
  <img src="public/pictures/filters/cutting-board.png">
  <img src="public/pictures/filters/spare-ribs.png">
  <img src="public/pictures/filters/bananas.png">
  <img src="public/pictures/filters/bananas-left.png">
  <img src="public/pictures/filters/jaguar.png">
  <img src="public/pictures/filters/owl-right.png">
  <img src="public/pictures/filters/owl-two.png">
  <img src="public/pictures/filters/bottle.png">
  <img src="public/pictures/filters/bottle-2.png">
  <img src="public/pictures/filters/laurel-gold.png">
  <img src="public/pictures/filters/laurel-wreath.png">
  <img src="public/pictures/filters/tiger.png">
</div>
<div id="your-photo-area">
  <h3 style="text-align:center;font-size:1.2em;margin:2px;" >Your pictures</h3>
  <div id="your-photo-scroll">
    <?php
    $len = count($userPictures);
    for ($i = 0; $i < $len; $i++) { ?>
      <a href='index.php?action=picture&id=<?php echo $userPictures[$i]["id"]?>'><img class="your-photo" src="<?php echo $userPictures[$i]["file_path"]?>"></a>
    <?php } ?>
  </div>
</div>
