<h2 id="title-page">Your profile</h2>
<div id="profile-area">
  <div id="profile-picture">
    <div class="thumbnail-profile">
      <img src="public/pictures/profile/valentin-profile-picture.jpg" alt="user's profile picture">
    </div>
    <form enctype="multipart/form-data" action="" method="post">
      <input type="hidden" name="MAX_FILE_SIZE" value="30000" /><p id="text-upload-profile-picture">Upload a new profile picture : </p><input id="upload-profile-picture" name="userfile" type="file" accept=".jpg, .jpeg, .png"/>
  </div>
  <div id="profile-data">
    <label for="name">Username</label><br><input id="username-profile" type="text" name="username" maxlength="64" placeholder="valentin"><br>
    <label for="name">Email address</label><br><input id="email-profile" type="email" name="email" maxlength="128" placeholder="valentin.omnes@gmail.com"><br>
    <h3>Change password</h3>
    <label for="name">Current password</label><br><input size="16" type="password" name="password" maxlength="255" required><br>
    <label for="name">New password</label><br><input size="16" type="password" name="re-password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br>
    <label for="name">Re-enter new password</label><br><input size="16" type="password" name="re-password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required><br><br>
    <input type="submit" value="Save"/>
  </div>
  </form>
</div>
