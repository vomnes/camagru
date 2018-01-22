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
