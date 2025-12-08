$(document).ready(function(){

//==============================================================================
// Send ajax to server
//==============================================================================

jQuery("body").on("click", "#btnOK", function() {

  var idStudent = jQuery("input[name='idStudent']").val();

  sendAjax("ajxInputStudent.php", {
    idStudent: idStudent
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
    // REDIREC vers getCompetence.php?idstudent=id
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
