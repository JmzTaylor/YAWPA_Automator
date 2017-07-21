/*Copyright (C) 2017  James Taylor (jmztaylor)

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
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA */

var fileId = 2;
var fileId2 = 3;

function showAbout() {
  var dialog = document.querySelector('#aboutDialog');
  if (!dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  dialog.showModal();
  dialog.querySelector('.close').addEventListener('click', function() {
    dialog.close();
  });
}

function showMail() {
  var dialog = document.querySelector('#mailDialog');
  if (!dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  dialog.showModal();
  dialog.querySelector('.close').addEventListener('click', function() {
    dialog.close();
  });
  dialog.querySelector('.send');
}

function showCode() {
  var dialog = document.querySelector('#codeDialog');
  if (!dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  dialog.showModal();
  dialog.querySelector('.close').addEventListener('click', function() {
    dialog.close();
  });
}

function showWait() {
  var dialog = document.querySelector('#waitDialog');
  if (!dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
  }
  dialog.showModal();
}

function addElement(parentId, elementTag, elementId, html) {
  var p = document.getElementById(parentId);
  var newElement = document.createElement(elementTag);
  newElement.setAttribute('id', elementId);
  newElement.innerHTML = html;
  p.appendChild(newElement);
}

function addFile() {
  fileId++;
  fileId2++;
  var html = '<div class="mdl-textfield mdl-js-textfield mdl-textfield--file"><input name="img' + fileId + '" type="file" id="img' + fileId + '" style="display:none;"/><input id="img' + fileId2 + '" class="mdl-textfield__input" type="text" readonly/><label class="mdl-textfield__label">File</label><div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file"><i onclick="document.getElementById(&quot;img' + fileId + '&quot;).click();" class="material-icons">attach_file</i></div></div>';
  addElement('field', 'p', 'file-' + fileId, html);
  fileId++;
  fileId2++;
}

document.getElementById('field').addEventListener('change', function(event) {
  var elem = event.target;
  var something = elem.name.replace(/\D/g, '');
  var newId = Number(something) + 1;
  document.getElementById('img' + newId).value = elem.files[0].name;
});

function removeElement(elementId) {
  var element = document.getElementById(elementId);
  element.parentNode.removeChild(element);
}

document.getElementById('field').addEventListener('change', function(event) {
  var elem = event.target;
  var something = elem.name.replace(/\D/g, '');
  var newId = Number(something) + 1;
  document.getElementById('img' + newId).value = elem.files[0].name;
});

$(document).ready(function() {
  $('#send').click(function() {
    $.ajax({
      url: 'mail.php',
      data: {
        user: $('#user').val(),
        name: $('#name').val(),
        email: $('#email').val(),
        message: $('#message').val()
      },
      success: function(result) {
        alert(result)
      }
    });
  });
});