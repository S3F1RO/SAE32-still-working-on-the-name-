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
    if (data['success']) {
      alert("caca");
      redirect('getCompetences.php?idC=1');
    } else {
      var html = data["html"];
      jQuery("span").html(html);
    }
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