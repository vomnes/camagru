function setSizeFields() {
  let usernameField = document.getElementById("username-profile").placeholder;
  let emailField = document.getElementById("email-profile").placeholder;
  var size;
  if (usernameField.length > emailField.length) {
    size = usernameField.length;
  } else {
    size = emailField.length;
  }
  if (size < 15) {
    size = 15;
  }
  document.getElementById("username-profile").size = size;
  document.getElementById("email-profile").size = size;
}

window.addEventListener('load', function(w){
  document.getElementById('email-profile').value = '';
  document.getElementById('password-profile').value = '';
  setSizeFields();
  var getPicture = document.getElementById("profile-private");
  var uploadFileButton = document.getElementById("upload-profile-picture");
  // Set the profile picture
  getPicture.addEventListener('click', function(ev){
    uploadFileButton.click();
    ev.preventDefault();
  }, false);
  uploadFileButton.onchange = function(e) {
    getBase64Image('#upload-profile-picture');
  }
  var notif = document.getElementById('notif-status');
  notif.addEventListener('click', function(ev){
    changeNotificationStatus();
    ev.preventDefault();
  }, false);
  var save = document.getElementById("send-update-profile");
  save.addEventListener('click', function(ev){
    saveChange();
    ev.preventDefault();
  }, false);
  w.preventDefault();
}, false);

function getBase64Image(elem) {
  var file    = document.querySelector(elem).files[0];
  var reader  = new FileReader();
  reader.addEventListener("load", function () {
    document.getElementById('profile-private').src = reader.result;
  }, false);
  if (file) {
    reader.readAsDataURL(file);
  }
}

function changeNotificationStatus() {
  var btn = document.getElementById('notif-status');
  var value = btn.getAttribute('value');
  if (value == "On") {
    btn.setAttribute('value', 'Off');
  } else {
    btn.setAttribute('value', 'On');
  }
}

// Update date profile
function saveChange() {
  var formData = new FormData();
  var sourcePhoto = document.getElementById('profile-private').src;
  if (sourcePhoto.includes('public/pictures')) {
    sourcePhoto = '';
  }
  document.getElementById('send-update-profile').style.border = "2px solid #CCC";
  document.getElementById('result-profile').innerHTML = '';
  if (!checkInput()) {
    document.getElementById('send-update-profile').style.border = "2px solid Brown";
    return;
  }
  formData.append('profile_picture', sourcePhoto);
  formData.append('username', escapeHtml(document.getElementById('username-profile').value));
  formData.append('email', escapeHtml(document.getElementById('email-profile').value));
  formData.append('password', escapeHtml(document.getElementById('password-profile').value));
  formData.append('new-password', escapeHtml(document.getElementById('newpassword-profile').value));
  formData.append('re-new-password', escapeHtml(document.getElementById('renewpassword-profile').value));
  var notif = document.getElementById('notif-status');
  var valueNotif = notif.getAttribute('value');
  if (valueNotif != notif.getAttribute('Origin')) {
    if (valueNotif == "On") {
      formData.append('comments_notification', 1);
    } else if (valueNotif == "Off") {
      formData.append('comments_notification', 0);
    } else {
      formData.append('comments_notification', '');
    }
  } else {
    formData.append('comments_notification', '');
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('send-update-profile').style.border = "2px solid ForestGreen";
      document.getElementById('username-profile').value = '';
      document.getElementById('email-profile').value = '';
      document.getElementById('password-profile').value = '';
      document.getElementById('newpassword-profile').value = '';
      document.getElementById('renewpassword-profile').value = '';
      var response = JSON.parse(xmlhttp.responseText);
      if (response['username']) {
        document.getElementById('username-profile').placeholder = response['username'];
      }
      if (response['email']) {
        document.getElementById('email-profile').placeholder = response['email'];
      }
      if (response['message'] && response['message'] != '') {
        document.getElementById('result-profile').innerHTML = response['message'];
      }
    } else {
      document.getElementById('send-update-profile').style.border = "2px solid Brown";
    }
  }
  xmlhttp.open("POST", "index.php?action=myprofile&method=savechange", true);
  xmlhttp.send(formData);
}

function checkInput() {
  if (document.getElementById('username-profile').value != '') {
    if (!isValidUsername(document.getElementById('username-profile').value)) {
      document.getElementById('result-profile').innerHTML = "Not a valid username<br>Must contain between 4 and 64 characters,<br>only lowercase and uppercase characters and digits<br>";
      return false;
    }
  }
  if (document.getElementById('email-profile').value != '') {
    if (!isValidEmail(document.getElementById('email-profile').value)) {
      document.getElementById('result-profile').innerHTML = "Not a valid email address<br>";
      return false;
    }
  }
  if (document.getElementById('newpassword-profile').value != '') {
    if (document.getElementById('password-profile').value == '') {
      document.getElementById('result-profile').innerHTML = "You want to update your password<br>All the password fields must be filled<br>";
      return false;
    }
    if (document.getElementById('newpassword-profile').value != document.getElementById('renewpassword-profile').value != '') {
      document.getElementById('result-profile').innerHTML = "Cannot update the password<br>Re entered new password is not identique to new password<br>";
      return false;
    }
  }
  return true;
}
