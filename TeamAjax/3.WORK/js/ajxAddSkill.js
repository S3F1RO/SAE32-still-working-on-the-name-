$(document).ready(function(){
//==============================================================================

/*==============================================================================
  Send ajax to server
==============================================================================*/

  // On page load

  // On click OK button
  jQuery("body").on("click", "#btnOK", function() {

    var mainName = jQuery("input[name='mainName']").val();
    var subName  = jQuery("input[name='subName']").val();
    var domain  = jQuery("input[name='domain']").val();
    var level  = jQuery("input[name='number']").val();
    var color  = jQuery("input[name='color']").val();

    sendAjax("ajxAddSkill.php", {
      mainName: mainName,
      subName: subName,
      domain:domain,
      level:level,
      color:color,
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

    var id = data["id"];           // récupère l'id
    var nickname = data["nickname"]; // récupère le nickname

    jQuery("body").html(
      "ID utilisateur reçu : " + id +
      "Nickname reçu : " + nickname
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