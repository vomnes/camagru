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
