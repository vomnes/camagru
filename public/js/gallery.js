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

function showsDiv(elem) {
  if (document.getElementById(elem).style.visibility == "visible") {
    document.getElementById(elem).style.visibility = "hidden";
    document.getElementById(elem).style.display = "none";
  } else {
    document.getElementById(elem).style.visibility = "visible";
    document.getElementById(elem).style.display = "block";
  }
}

function getNumberLikes(index) {
  var count = document.getElementById('like-text-'+index).innerHTML;
  count = parseInt(count);
  if (isNaN(count)) {
    return 0;
  }
  return count;
}

function handleLikes(index, elem, src1, src2) {
  var src = document.getElementById(elem).src;
  var likes = getNumberLikes(index);
  src = src.substring(src.indexOf("/public/") + 1);
  if (src == src1) {
    document.getElementById(elem).src = src2;
    document.getElementById('like-text-'+index).innerHTML = '+'+(likes+1);
  } else {
    document.getElementById(elem).src = src1;
    if (likes-1 <= 0) {
      document.getElementById('like-text-'+index).innerHTML = '';
    } else {
      document.getElementById('like-text-'+index).innerHTML = '+'+(likes-1);
    }
  }
}

function addComment(index, pictureId, username) {
  let message = document.getElementById('content-comment-' + index);
  if (message.value == "") {
    flashPlaceholder(message);
    return;
  }
  createComment(index, pictureId, message.value, username, element);
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
    } else {
      flashPlaceholder(element);
    }
  }
  xmlhttp.open("POST", "index.php?action=gallery&method=postcomment&id=" + pictureId, true); // Add comment in db
  xmlhttp.send(formData);
}

function appendComment(index, username, commentContent) {
  document.getElementById('comment-list-' + index).innerHTML +=
  "<div class=\"one-comment\">\n<a class=\"comment-owner\">"+username+"</a>\n<a class=\"comment-text\">"+commentContent+"</a>\n</div>";
  document.getElementById('content-comment-' + index).value = "";
}
