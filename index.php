<!--
Copyright (C) 2017  James Taylor (jmztaylor)

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
-->
 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>YAWPA Automator</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.light_blue-red.min.css">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/1.9.32/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!-- Always shows a header, even in smaller screens. -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">YAWPA Automator</span>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title">Menu</span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="#" onclick="showAbout()"><i id="menuIcon" class="mdi mdi-information-outline mdi-24px"></i>About</a>
        <a class="mdl-navigation__link" href="https://github.com"><i id="menuIcon" class="mdi mdi-github-face mdi-24px"></i>Github</a>
      </nav>
    </div>
    <main class="mdl-layout__content">
      <div class="page-content noSelect">
        <form enctype="multipart/form-data" method="POST" class="input-append">
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" name="username" id="username" type="text" />
            <label class="mdl-textfield__label">Username</label>
          </div>
          <div id="entry">
            <div id="field">
              <p>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                  <input name="img1" type="file" id="img1" style="display:none;" />
                  <input id="img2" class="mdl-textfield__input" type="text" readonly/>
                  <label class="mdl-textfield__label">File</label>
                  <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                    <i onclick="document.getElementById('img1').click();" class="material-icons">attach_file</i>
                  </div>
                </div>
              </p>
            </div>
            <br>
            <button type="button" id="button1" onclick="addFile();" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">
              Add file
              </button>
            <button onclick="showWait()" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" type="submit" name="submit" id="submitForm" value="Upload">
              Submit
              </button>
          </div>
        </form>
      </div>
    </main>
  </div>
  </div>
  <button id="mail" onclick="showMail()" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
    <i class="material-icons" >mail</i>
    </button>
  <dialog class="mdl-dialog" id="aboutDialog">
    <h4 class="mdl-dialog__title">About</h4>
    <div class="mdl-dialog__content">
      <p>
        Built by Jmz Software LLC
      </p>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent close">Close</button>
    </div>
  </dialog>
  <dialog class="mdl-dialog" id="waitDialog">
    <div class="mdl-dialog__content">
      <div class="mdl-spinner mdl-js-spinner is-active"></div>
    </div>
  </dialog>
  <dialog class="mdl-dialog" id="mailDialog">
    <h4 class="mdl-dialog__title">Contact Us</h4>
    <div class="mdl-dialog__content">
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="name" />
        <label class="mdl-textfield__label" for="name">Name</label>
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="email" id="email" />
        <label class="mdl-textfield__label" for="email">Email Address</label>
        <span class="mdl-textfield__error">Please enter valid email address</span>
      </div>
      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <textarea class="mdl-textfield__input" type="text" rows="3" id="message"></textarea>
        <label class="mdl-textfield__label" for="message">Message</label>
      </div>
      <div id="checkDiv" class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <textarea class="mdl-textfield__input" type="text" id="user"></textarea>
        <label class="mdl-textfield__label" for="user">Username</label>
      </div>
    </div>
    <div class="mdl-dialog__actions">
      <button type="button" name="send" id="send" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent send">Send</button>
      <button type="button" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent close">Close</button>
    </div>
  </dialog>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</body>

</html>

<?php
if (!empty($_POST)) {
  require('config.php');
  require('upload.php');
  $json = storeImages($_POST['username'], $_FILES);
  print "<dialog class=\"mdl-dialog\" id=\"codeDialog\">\n";
  print "      <h4 class=\"mdl-dialog__title\">Output</h4>\n";
  print "      <div class=\"mdl-dialog__content\">\n";
  print "        <pre>\n";
  echo json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
  print "        </pre>\n";
  print "      </div>\n";
  print "      <div class=\"mdl-dialog__actions\">\n";
  print "        <button type=\"button\" class=\"mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent close\">Close</button>\n";
  print "      </div>\n";
  print "    </dialog>";
  echo "<script> showCode(); </script>";
}
?>