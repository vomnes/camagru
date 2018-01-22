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

function addComment(index, username) {
  let message = document.getElementById('content-comment-' + index);
  if (message.value == "") {
    let placeholder = message.placeholder
    message.placeholder = '';
    setTimeout(function(){
      message.placeholder = placeholder;
    }, 100);
    return;
  }
  document.getElementById('comment-list-' + index).innerHTML +=
  "<div class=\"one-comment\">\n<a class=\"comment-owner\">"+username+"</a>\n<a class=\"comment-text\">"+message.value+"</a>\n</div>";
  document.getElementById('content-comment-' + index).value = "";
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
