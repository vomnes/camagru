<script src="public/js/gallery.js"></script>
<h2 id="title-page">Picture</h2>
<?php
  $index = 0;
  $id = $pictureData["id"];
  $src = $pictureData["file_path"];
  $pictureOwnerId = $pictureData["userId"];
  $pictureOwner = ucfirst($pictureData["username"]);
  $profilePictureOwner = ucfirst($pictureData["profile_picture"]);
  $likes = $pictureData["totalLikes"];
?>
<div class="gallery" id="gallery-<?php echo $index ?>">
  <!-- Header of the picture -->
  <div class="header-picture">
    <div class="thumbnail">
      <img src="<?php echo $profilePictureOwner ?>" alt="gallery profile picture">
    </div>
    <?php if ($_SESSION["logged_userId"] == $pictureOwnerId) { ?>
      <img src="public/pictures/delete-red-128.png" class="delete-picture" onclick="deletePicture(<?php echo $id ?>, 'gallery-<?php echo $index ?>')" alt="delete picture" title="Delete the picture">
    <?php } ?>
    <a class="gallery-username"><?php echo $pictureOwner ?></a>
  </div>
  <!-- Picture -->
  <img class="gallery-picture" src="<?php echo $src ?>" alt="gallery picture">
  <!-- Footer of the picture -->
  <?php if ($_SESSION["logged_user"] != '' AND $_SESSION["logged_userId"] != '') { ?>
    <div class="footer-picture">
      <img class="like-icon" id="like-icon-<?php echo $index ?>" onclick="updateLikes(<?php echo $index ?>, 'like-icon-<?php echo $index ?>', <?php echo $id ?>)" src="
      <?php if ($hasLiked[$id]) {
        echo "public/pictures/like-red-128.png\" value=\"1\"";
      } else {
        echo "public/pictures/like-black-128.png\" value=\"0\"";
      }
      ?> alt="like red">
      <a class="like-text" id="like-text-<?php echo $index ?>"><?php if ($likes){echo '+' . $likes;}?></a>
      <button class="open-comments" id="open-comments-<?php echo $index ?>" onclick="showsPictureComments('<?php echo $index ?>', '<?php echo $id ?>')" value="0">Comments</button>
    </div>
    <!-- Comment of the picture -->
    <div class="comments-picture" id="comments-picture-<?php echo $index ?>">
      <div id="comment-list-<?php echo $index ?>"></div>
      <div class="new-comment">
        <fieldset>
          <textarea type="text" name="comment" class="content-comment" id="content-comment-<?php echo $index ?>" placeholder="Your comment ..." title="Content of your comment" cols="40" rows="5"></textarea>
        </fieldset>
        <p><input class="put-comment" type="submit" value="" onclick="addComment('<?php echo $index?>', '<?php echo $id?>', '<?php session_start(); echo $_SESSION["logged_user"];?>')"></p>
      </div>
    </div>
  <?php } ?>
</div>
