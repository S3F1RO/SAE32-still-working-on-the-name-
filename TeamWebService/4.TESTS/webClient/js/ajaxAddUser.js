$(document).ready(function(){
  //==============================================================================

  /*==============================================================================
  Send ajax to server
  ==============================================================================*/

  // On page load

  // On click OK button
  jQuery("body").on("click", ".ok", function() {
    var firstName = jQuery("input[name='firstName']").val();
    var lastName = jQuery("input[name='lastName']").val();
    var nickname = jQuery("input[name='nickname']").val();
    var passphrase = jQuery("input[name='passphrase']").val();
    
    sendAjax("ajaxAddUser.php", {
      'firstName': firstName,
      'lastName': lastName,
      'nickname': nickname,
      'passphrase': passphrase
    });
  });

  jQuery("body").on("keyup", "input[name='nickname']", function(key) {
    if (key.which == 13) {
      var firstName = jQuery("input[name='firstName']").val();
      var lastName = jQuery("input[name='lastName']").val();
      var nickname = jQuery("input[name='nickname']").val();
      var passphrase = jQuery("input[name='passphrase']").val();
      
      sendAjax("ajaxAddUser.php", {
        'firstName': firstName,
        'lastName': lastName,
        'nickname': nickname,
        'passphrase': passphrase
      });
    }
  });

  /*==============================================================================
  Receive ajax
  ==============================================================================*/
  function redirect(serverUrl) {
    window.location.href = serverUrl;
  }

  function receiveAjax(data) {
    var html = "        <li><span>À ne pas oublier</span> : l'identifiant de votre utilisateur est " + data["idUser"] + "</li>\n";
    html += "        <li>Cet identifiant est nécessaire pour que vous vous connectiez et receviez des certifications. <span>Ne le perdez pas</span></li>\n";
    html += "        <li>\n";
    html += "          <p>Vous avez déjà un compte ? <a href='login.html'>Connectez-vous</a></p>\n";
    html += "        </li>\n";

    if (data['success']) jQuery("ul").html(html);
    else jQuery("span").html(data["html"]);
  };



  // --- Send AJAX data to server
  function sendAjax(serverUrl, data) {
    jsonData = JSON.stringify(data);
    jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: "data=" + jsonData,
      success: function(data) {
        receiveAjax(data);
      }
    });
  }
});