<script src="public/js/myprofile.js"></script>
<h2 id="title-page">Your profile</h2>
<div id="profile-area">
  <div id="profile-picture">
    <div class="thumbnail-profile">
      <img id="profile-private" src="<?php echo $profileData['profile_picture'] ?>" alt="user's profile picture">
    </div>
    <form id="profile-form" enctype="multipart/form-data" action="" method="post" autocomplete="off">
      <input type="hidden" style="display:none;" name="MAX_FILE_SIZE" value="30000" />
      <input id="upload-profile-picture" name="userfile" style="display:none;" type="file" accept=".jpg, .jpeg, .png"/>
  </div>
  <div id="profile-data">
    <label for="name">Username</label><br><input id="username-profile" type="text" name="username" maxlength="64" placeholder="<?php echo $profileData['username'] ?>"><br>
    <label for="email">Email address</label><br><input id="email-profile" type="text" name="email" maxlength="128" autocomplete="off" placeholder="<?php echo $profileData['email'] ?>"><br>
    <p>Comment notification <input id="notif-status" type="button"
    <?php var_dump($profileData['comments_notification']) ?>
    <?php if ($profileData['comments_notification'] == '1') {
      echo "value=\"On\" origin=\"On\"";
    } else {
      echo "value=\"Off\" origin=\"Off\"";
    }?>/></p>
    <h3>Change password</h3>
    <label for="password">Current password</label><br><input id="password-profile" size="16" type="password" name="password" maxlength="255"><br>
    <label for="newpassword">New password</label><br><input id="newpassword-profile" size="16" type="password" name="re-password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"><br>
    <label for="renewpassword">Re-enter new password</label><br><input id="renewpassword-profile" size="16" type="password" name="re-password" maxlength="255" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"<br><br>
    <input id="send-update-profile" type="submit" value="Save"/>
    <p id="result-profile" style="color: Brown" ></p>
  </div>
  </form>
</div>
