function mouseTitle(status, content) {
    document.getElementById("btm-description").style.visibility = status;
    document.getElementById("btm-description").innerHTML = content;
}

window.onload = function() {
  console.log('Loaded');
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
}

window.onresize = function() {
  if (window.innerWidth >= 725) {
    var menu = document.getElementById("mobile-menu");
    if (menu.style.visibility == 'visible') {
      menu.style.display = 'none';
      menu.style.visibility = 'hidden';
    }
  }
}
