  $(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/


  // On keyup (login) : send ajax
  jQuery("body").on("click", ".ok", function() {
    var idType = jQuery("select[name='idType']").val();
    var id = jQuery("input[name='id']").val();
    sendAjax("ajxSearchCompetences.php", {'idType': idType, 'id': id});
  });

  jQuery("body").on("keyup", "input[name='id']", function(key) {
    if (key.which == 13) {
      var idType = jQuery("select[name='idType']").val();
      var id = jQuery("input[name='id']").val();
      
      sendAjax("ajxSearchCompetences.php", {'idType': idType, 'id': id});
    }
  });






/*==============================================================================
  Receive ajax from server
==============================================================================*/

  // Receive ajax data
  function receiveAjax(data) {
    // TODO
    if (data['success']) redirect("getCompetences.php?" + data["idType"] + "=" + data["id"]);
    else jQuery("span").html(data["html"]);
  }



















/*==============================================================================
  Usefull functions
==============================================================================*/

  // --- Send AJAX data to server
  function sendAjax(serverUrl, data) {
    jsonData = JSON.stringify(data);
    jQuery.ajax({type: 'POST', url: serverUrl, dataType: 'json', data: "data=" + jsonData,
      success: function(data) {
        receiveAjax(data);
      }
    });
  }



  // --- Redirect
  function redirect(serverUrl) {
    window.location.href = serverUrl;
  }



  // --- Test whether a variable is defined or not
  function defined(myVar) {
    if (typeof myVar != 'undefined') return true;
    return false;
  }

//==============================================================================
});
