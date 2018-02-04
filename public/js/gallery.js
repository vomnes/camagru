if (getURLParameter('action') == 'gallery') {
  window.onload = function(ev) {
      setURLParameter('offset', '0');
  }

  window.onscroll = function(ev) {
    if ((window.innerHeight + window.pageYOffset) >= document.body.offsetHeight + 120) {
      unlimitedScroll();
    }
  };
}

/* -- Likes -- */

function getNumberLikes(index) {
  var count = document.getElementById('like-text-'+index).innerHTML;
  count = parseInt(count);
  if (isNaN(count)) {
    return 0;
  }
  return count;
}

function updateLikes(index, elem, pictureId) {
  var target = document.getElementById(elem);
  var src = target.src;
  var likes = getNumberLikes(index);
  var xmlhttp = new XMLHttpRequest();
  var changeType = target.getAttribute('value');
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && (this.status == 201 || this.status == 202)) {
      if (changeType == 0) { // +1 Like
        document.getElementById(elem).src = 'public/pictures/like-red-128.png';
        document.getElementById('like-text-'+index).innerHTML = '+'+(likes+1);
        document.getElementById(elem).setAttribute('value', '1');
      } else {  // -1 Like
        document.getElementById(elem).src = 'public/pictures/like-black-128.png';
        if (likes-1 <= 0) {
          document.getElementById('like-text-'+index).innerHTML = '';
        } else {
          document.getElementById('like-text-'+index).innerHTML = '+'+(likes-1);
        }
        document.getElementById(elem).setAttribute('value', '0');
      }
    }
  }
  xmlhttp.open("POST", "index.php?action=gallery&method=updatelikes&id=" + pictureId + "&type=" + changeType, true); // Handle like in db
  xmlhttp.send();
}

/* -- Comments -- */

/* Open comments area */
function showsPictureComments(index, pictureId) {
  var commentArea = document.getElementById("open-comments-" + index);
  if (commentArea.value == "0") {
    // Get from the database the comments of the picture
    getPictureComments(index, pictureId);
    commentArea.value = "1";
  }
  showsDiv("comments-picture-" + index);
}

function getPictureComments(index, pictureId) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var commentsList = JSON.parse(xmlhttp.responseText);
      for (i = 0; i < commentsList.length; i++) {
        let username = commentsList[i]["username"];
        if (i > 0 && commentsList[i-1]["username"] == username) {
          appendComment(index, '', commentsList[i]["content"]);
        } else {
          appendComment(index, username + '<br>', commentsList[i]["content"]);
        }
      }
    }
  }
  xmlhttp.open("GET", "index.php?action=gallery&method=getcomments&id=" + pictureId, true);
  xmlhttp.send();
}

/* Create comment */
function addComment(index, pictureId, username) {
  let message = document.getElementById('content-comment-' + index);
  if (message.value == "") {
    flashPlaceholder(message);
    return;
  }
  createComment(index, pictureId, message.value, username, message);
  document.getElementById('content-comment-' + index).value == "";
}

function flashPlaceholder(element) {
  if (element.value == "") {
    let placeholder = element.placeholder
    element.placeholder = '';
    setTimeout(function(){
      element.placeholder = placeholder;
    }, 100);
  }
}

function createComment(index, pictureId, commentContent, username, element) {
  var formData = new FormData();
  formData.append('content', commentContent);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      appendComment(index, username + '<br>', escapeHtml(commentContent));
      document.getElementById('content-comment-' + index).value = "";
    } else {
      flashPlaceholder(element);
    }
  }
  xmlhttp.open("POST", "index.php?action=gallery&method=postcomment&id=" + pictureId, true); // Add comment in db
  xmlhttp.send(formData);
}

function appendComment(index, username, commentContent) {
  document.getElementById('comment-list-' + index).innerHTML +=
  "<p class=\"one-comment\">\n<i>"+capitalizeFirstLetter(username)+"</i><span class=\"comment-text\">"+commentContent+"</span>\n</p>";
  document.getElementById('content-comment-' + index).value = "";
}

/* Scroll */

function unlimitedScroll() {
  var xmlhttp = new XMLHttpRequest();
  var offset = getURLParameter("offset");
  if (offset == null) {
    offset = 5;
  } else {
    offset = parseInt(offset) + 5;
  }
  xmlhttp.open("GET", "index.php?action=gallery&method=nextpictures&offset=" + offset, true);
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let pagePosition = window.pageYOffset;
      document.getElementById("id-container").innerHTML += xmlhttp.responseText;
      window.scrollTo(0, pagePosition);
      setURLParameter('offset', offset);
    }
  }
  xmlhttp.send();
}

/* Delete picture */

function deletePicture(pictureId, pictureIdCSS) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var pictureArea = document.getElementById(pictureIdCSS);
      pictureArea.parentNode.removeChild(pictureArea);
    }
  }
  xmlhttp.open("POST", "index.php?action=gallery&method=deletepicture&id=" + pictureId, true); // Delete picture in db
  xmlhttp.send();
}
