$(document).ready(function(){

//==============================================================================
// Send ajax to server
//==============================================================================

jQuery("body").on("click", "#btnOK", function() {

  var idCompetence = jQuery("input[name='idCompetence']").val();

  sendAjax("ajxInputCompetence.php", {
    idCompetence: idCompetence
  });

});

//==============================================================================
// Receive ajax
//==============================================================================

function redirect(serverUrl) {
  window.location.href = serverUrl;
}

function receiveAjax(data) {

  if (data['success']) {
    // REDIREC vers getCompetence.php?idCompetence=id
    redirect(data['url']);
  } else {
    alert(data['message'] || "Erreur AJX");
  }
}

//==============================================================================
// Send AJAX data to server
//==============================================================================

function sendAjax(serverUrl, data) {
  jsonData = JSON.stringify(data);
  jQuery.ajax({
    type: 'POST',
    url: serverUrl,
    dataType: 'json',
    data: "data=" + jsonData,
    success: function(data) {
      receiveAjax(data);
    }
  });
}

});
