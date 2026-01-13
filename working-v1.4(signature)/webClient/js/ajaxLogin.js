$(document).ready(function(){
  //==============================================================================

  /*==============================================================================
  Send ajax to server
  ==============================================================================*/

  // On page load

  // On click OK button
  jQuery("body").on("click", ".ok", function() {
    var idUser = jQuery("input[name='idUser']").val();
    var passphrase = jQuery("input[name='passphrase']").val();
    
    sendAjax("ajaxLogin.php", {
      'idUser': idUser,
      'passphrase': passphrase
    });
  });

  jQuery("body").on("keyup", "input[name='passphrase']", function(key) {
    if (key.which == 13) {
      var idUser = jQuery("input[name='idUser']").val();
      var passphrase = jQuery("input[name='passphrase']").val();
      
      sendAjax("ajaxLogin.php", {
        'idUser': idUser,
        'passphrase': passphrase,
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
    if (data['success']) redirect('getCompetences.php?idS=' + data["idUser"]);
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