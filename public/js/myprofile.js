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

window.onload = function() {
  document.getElementById('email-profile').value = '';
  document.getElementById('password-profile').value = '';
  setSizeFields();
  var previewPicture = document.getElementById("profile-private");
  // Preview the profile picture
  previewPicture.addEventListener('click', function(ev){
    getBase64Image('#upload-profile-picture');
    ev.preventDefault();
  }, false);
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
};

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
  document.getElementById('result-profile').innerHTML = '';
  formData.append('profile_picture', sourcePhoto);
  formData.append('username', document.getElementById('username-profile').value);
  formData.append('email', document.getElementById('email-profile').value);
  formData.append('password', document.getElementById('password-profile').value);
  formData.append('new-password', document.getElementById('newpassword-profile').value);
  formData.append('re-new-password', document.getElementById('renewpassword-profile').value);
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
      console.log(response);
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
