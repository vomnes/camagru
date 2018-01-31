<?php
$len = count($allPictures) + $offset;
for ($index = $offset; $index < $len; $index++) {
  $id = $allPictures[$index-$offset]["id"];
  $src = $allPictures[$index-$offset]["file_path"];
  $pictureOwner = ucfirst($allPictures[$index-$offset]["username"]);
  $profilePictureOwner = ucfirst($allPictures[$index-$offset]["profile_picture"]);
  $likes = $allPictures[$index-$offset]["totalLikes"];
?>
<div class="gallery" id="gallery-<?php echo $index ?>">
  <!-- Header of the picture -->
  <div class="header-picture">
    <div class="thumbnail">
      <img src="<?php echo $profilePictureOwner ?>" alt="gallery profile picture">
    </div>
    <a class="gallery-username"><?php echo $pictureOwner ?></a>
  </div>
  <!-- Picture -->
  <a href='index.php?action=picture&id=<?php echo $id ?>'>
    <img class="gallery-picture" src="<?php echo $src ?>" alt="gallery picture">
  </a>
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
<?php } ?>
