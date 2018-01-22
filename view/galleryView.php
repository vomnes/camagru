<h2 id="title-page">Gallery</h2>
<!-- One picture of the gallery -->
<div class="gallery" id="gallery-1">
  <!-- Header of the picture -->
  <div class="header-picture">
    <div class="thumbnail">
      <img src="public/pictures/profile-picture.jpg" alt="gallery profile picture">
    </div>
    <a class="gallery-username">Valentin</a>
  </div>
  <!-- Picture -->
  <img class="gallery-picture" src="public/pictures/illustration-2.jpg" alt="gallery picture">
  <!-- Footer of the picture -->
  <div class="footer-picture">
    <img class="like-icon" id="like-icon-1" onclick="handleLikes(1, 'like-icon-1', 'public/pictures/like-black-128.png', 'public/pictures/like-red-128.png')" src="public/pictures/like-black-128.png" alt="like red">
    <a class="like-text" id="like-text-1">+50</a>
    <button class="open-comments" onclick='showsDiv("comments-picture-1")'>Comments</button>
  </div>
  <!-- Comment of the picture -->
  <div class="comments-picture" id="comments-picture-1">
    <div id="comment-list-1">
        <div class="one-comment">
          <a class="comment-owner">Valentin</a>
          <a class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras id hendrerit tortor. Duis rutrum enim nec nisl faucibus, ut laoreet arcu elementum. Nunc elementum porta semper.</a>
        </div>
        <div class="one-comment">
          <a class="comment-owner">Antoine</a>
          <a class="comment-text">Consectetur adipiscing elit.</a>
        </div>
        <div class="one-comment">
          <a class="comment-owner">Sophie</a>
          <a class="comment-text">Duis rutrum enim nec nisl faucibus, ut laoreet arcu elementum. Nunc elementum porta semper.</a>
        </div>
      </div>
    <div class="new-comment">
      <fieldset>
        <textarea type="text" name="comment" class="content-comment" id="content-comment-1" placeholder="Your comment ..." title="Content of your comment" cols="40" rows="5"></textarea>
      </fieldset>
      <p><input class="put-comment" type="submit" value="" onclick="addComment(1, 'username')"></p>
    </div>
  </div>
</div>
<!-- Done -->
