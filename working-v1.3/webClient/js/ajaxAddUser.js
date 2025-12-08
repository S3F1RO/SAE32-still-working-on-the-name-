$(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/

  // On page load

  // On click OK button
  jQuery("body").on("click", ".ok", function() {
    var firstName = jQuery("input[name='firstName']").val();
    var lastName  = jQuery("input[name='lastName']").val();
    var nickname  = jQuery("input[name='nickname']").val();

    sendAjax("ajaxAddUser.php", {
      'firstName': firstName,
      'lastName': lastName,
      'nickname': nickname
    });
  });

  jQuery("body").on("keyup", "input[name='nickname']", function(key) {
    if (key.which == 13) {
      var firstName = jQuery("input[name='firstName']").val();
      var lastName  = jQuery("input[name='lastName']").val();
      var nickname  = jQuery("input[name='nickname']").val();

      sendAjax("ajaxAddUser.php", {
        'firstName': firstName,
        'lastName': lastName,
        'nickname': nickname
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
    redirect("main.php");
  } else {
    redirect("logout.php");
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