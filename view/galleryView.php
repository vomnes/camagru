<script src="public/js/gallery.js"></script>
<h2 id="title-page">Gallery</h2>
<?php
$len = count($allPictures);
for ($index = 1; $index < $len; $index++) {
  $id = $allPictures[$index]["id"];
  $src = $allPictures[$index]["file_path"];
?>
<div class="gallery" id="gallery-<?php echo $index ?>">
  <!-- Header of the picture -->
  <div class="header-picture">
    <div class="thumbnail">
      <img src="public/pictures/profile-picture.jpg" alt="gallery profile picture">
    </div>
    <a class="gallery-username">Valentin</a>
  </div>
  <!-- Picture -->
  <a href='index.php?action=picture&id=<?php echo $id ?>'>
    <img class="gallery-picture" src="<?php echo $src ?>" alt="gallery picture">
  </a>
  <!-- Footer of the picture -->
  <div class="footer-picture">
    <img class="like-icon" id="like-icon-<?php echo $index ?>" onclick="handleLikes(<?php echo $index ?>, 'like-icon-<?php echo $index ?>', 'public/pictures/like-black-128.png', 'public/pictures/like-red-128.png')" src="public/pictures/like-black-128.png" alt="like red">
    <a class="like-text" id="like-text-<?php echo $index ?>">+50</a>
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
</div>
<?php } ?>
