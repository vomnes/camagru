function setSizeFields() {
  let usernameField = document.getElementById("username-profile").placeholder;
  let emailField = document.getElementById("email-profile").placeholder;
  var size;
  if (usernameField.length > emailField.length) {
    size = usernameField.length - 2;
  } else {
    size = emailField.length - 2;
  }
  if (size < 15) {
    size = 15;
  }
  document.getElementById("username-profile").size = size;
  document.getElementById("email-profile").size = size;
}

window.onload = function() {
  setSizeFields();
};
