function handleTitleScroll() {
  if (window.scrollY >= 71) {
    document.getElementById("title-page").style.visibility = 'hidden';
    document.getElementById("title-page-header").style.visibility = 'visible';
  } else {
    document.getElementById("title-page").style.visibility = 'visible';
    document.getElementById("title-page-header").style.visibility = 'hidden';
  }
}

window.onscroll = function() {
  handleTitleScroll()
};

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

function showsDiv(elem) {
  if (document.getElementById(elem).style.visibility == "visible") {
    document.getElementById(elem).style.visibility = "hidden";
    document.getElementById(elem).style.display = "none";
  } else {
    document.getElementById(elem).style.visibility = "visible";
    document.getElementById(elem).style.display = "block";
  }
}

function getPictureComments(index, pictureId) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var commentsList = JSON.parse(xmlhttp.responseText);
      for (i = 0; i < commentsList.length; i++) {
        appendComment(index, commentsList[i]["username"], commentsList[i]["content"]);
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
      appendComment(index, username, commentContent);
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
  "<div class=\"one-comment\">\n<a class=\"comment-owner\">"+capitalizeFirstLetter(username)+"</a>\n<a class=\"comment-text\">"+commentContent+"</a>\n</div>";
  document.getElementById('content-comment-' + index).value = "";
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}
