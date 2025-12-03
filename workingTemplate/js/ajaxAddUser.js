$(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/

  // On page load

  // On click OK button
  jQuery("body").on("click", "#btnOK", function() {

    var firstName = jQuery("input[name='firstName']").val();
    var lastName  = jQuery("input[name='lastName']").val();
    var nickname  = jQuery("input[name='nickname']").val();

    sendAjax("ajaxAddUser.php", {
      firstName: firstName,
      lastName: lastName,
      nickname: nickname
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
    var id = data["id"];
    jQuery("body").html("ID utilisateur reçu : " + id);
  } else {
    // redirect("logout.php");/
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