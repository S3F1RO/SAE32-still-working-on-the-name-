$(document).ready(function () {

    $("#btnOK").click(function () {

        var currentDate    = $("input[name='currentDate']").val();
        var revokedDate    = $("input[name='revokedDate']").val();
        var masteryLevel = $("select[name='masteryLevel']").val();




    sendAjax("ajaxAddUser.php", {
     currentDate: currentDate,
      revokedDate: revokedDate,
      masteryLevel: masteryLevel
    });
  });

/*==============================================================================
  Receive ajax
==============================================================================*/
function redirect(serverUrl) {
  window.location.href = serverUrl;
}

function receiveAjax(data) {

  if (data['success']) {
  
   jQuery("body").html(
      "Bravo ! La compétence a été ajoutée avec succès.<br>" +
      "L'étudiant a maintenant une nouvelle compétence validée !"
    );

  } else {
    // redirect("logout.php");
  }
}

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