function mouseTitle(status, content) {
    document.getElementById("btm-description").style.visibility = status;
    document.getElementById("btm-description").innerHTML = content;
}

window.addEventListener('load', function(ev){
  var openMobileMenu = document.getElementById("open-mobile-menu");
  var menu = document.getElementById("mobile-menu");
  menu.style.visibility = 'hidden';
  openMobileMenu.addEventListener('click', function(e){
    if (menu.style.visibility == 'hidden') {
      menu.style.display = 'block';
      menu.style.visibility = 'visible';
    } else {
      menu.style.display = 'none';
      menu.style.visibility = 'hidden';
    }
    e.preventDefault();
  }, false);
  ev.preventDefault();
}, false);

window.addEventListener('scroll', function(e) {
  if (document.getElementById("title-page")) {
    handleTitleScroll();
  }
  e.preventDefault();
}, false);

/* -- Title -- */

function handleTitleScroll() {
  if (window.scrollY >= 71) {
    document.getElementById("title-page-header").innerHTML = document.getElementById("title-page").innerHTML;
    document.getElementById("title-page").style.visibility = 'hidden';
    document.getElementById("title-page-header").style.visibility = 'visible';
  } else {
    document.getElementById("title-page").style.visibility = 'visible';
    document.getElementById("title-page-header").style.visibility = 'hidden';
  }
}

window.addEventListener('resize', function(e) {
    if (window.innerWidth >= 725) {
      var menu = document.getElementById("mobile-menu");
      if (menu.style.visibility == 'visible') {
        menu.style.display = 'none';
        menu.style.visibility = 'hidden';
      }
    }
  e.preventDefault();
}, false);
