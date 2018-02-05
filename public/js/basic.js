function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function getURLParameter(name) {
  var url = new URL(window.location.href);
  return url.searchParams.get(name);
}

function setURLParameter(name, value) {
  const params = new URLSearchParams(location.search);
  params.set(name, value);
  window.history.replaceState({}, '', `${location.pathname}?${params}`);
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

function appendImage(parentId, src, className, idName) {
  var img = document.createElement("img");
  img.src = src;
  if (className != '') {
    img.className += className;
  }
  if (idName != '') {
    img.id = idName;
  }
  document.getElementById(parentId).appendChild(img);
}

function prependImage(parentId, src, href, className, idName) {
  var parent = document.getElementById(parentId);
  var anchor = document.createElement("a");
  var img = document.createElement("img");
  anchor.href = href;
  img.src = src;
  if (className != '') {
    img.className += className;
  }
  if (idName != '') {
    img.id = idName;
  }
  anchor.appendChild(img);
  parent.appendChild(anchor);
  parent.insertBefore(anchor, parent.firstChild);
}

  function isValidPassword(str)
  {
    return RegExp("^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,254}$").test(str);
  }

  function isValidUsername(str)
  {
    return RegExp("^(?=.*[a-z])[0-9a-zA-Z]{4,64}$").test(str);
  }

  function isValidEmail(str) {
    return RegExp("^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$").test(str);
  }
