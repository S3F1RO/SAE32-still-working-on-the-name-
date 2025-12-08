$(document).ready(function() {

  //============================================================================
  //  Send ajax to server
  //============================================================================
  jQuery("body").on("click", ".ok", function() {
    // Get data from client
    var idSkill = jQuery("input[name='idSkill']").val();
    var idUStudent = jQuery("input[name='idUStudent']").val();
    var masteringLevel = jQuery("select[name='masteringLevel']").val();
    var revokedDate = jQuery("input[name='revokedDate']").val();

    // Send AJAX to PHP
    sendAjax("ajxAddCompetence.php", {'idUStudent': idUStudent, 'masteringLevel': masteringLevel, 'revokedDate': revokedDate, 'idSkill': idSkill});
  });

  jQuery("body").on("keyup", "input", function(key) {
    if (key.which == 13) {
      // Get data from client
      var idSkill = jQuery("input[name='idSkill']").val();
      var idUStudent = jQuery("input[name='idUStudent']").val();
      var masteringLevel = jQuery("select[name='masteringLevel']").val();
      var revokedDate = jQuery("input[name='revokedDate']").val();

      // Send AJAX to PHP
      sendAjax("ajxAddCompetence.php", {'idUStudent': idUStudent, 'masteringLevel': masteringLevel, 'revokedDate': revokedDate, 'idSkill': idSkill});
    };
  });


  //============================================================================
  //    Receive ajax from server
  //============================================================================
  function receiveAjax(data) {
    if (data['success']) {
      alert("Compétence créée id : " + data['idCompetence'])
      // redirect("getCompetences.php?data['id']")
    } else {
      jQuery("span").html(data["html"]);
    }
  }

  //============================================================================
  //  Usefull functions
  //============================================================================
  function sendAjax(serverUrl, data) {
    jsonData = JSON.stringify(data);
    jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: "data=" + jsonData,
      success: function(data) {
        receiveAjax(data);
      }
    });
  }

  function redirect(serverUrl) {
    window.location.href = serverUrl;
  }

});
