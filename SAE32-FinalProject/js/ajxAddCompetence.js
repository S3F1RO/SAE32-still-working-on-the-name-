$(document).ready(function () {

<<<<<<< HEAD
    $("#btnOk").click(function () {
=======
  $("#btnOK").click(function () {
>>>>>>> 780a48325fe3dd51fbf0e49766b57643e8129ff5

    var idUTeacher     = $("select[name='idUTeacher']").val();
    var idUStudent     = $("select[name='idUStudent']").val();
    var idSkill        = $("select[name='idSkill']").val();
    var currentDate    = $("input[name='currentDate']").val();
    var revokedDate    = $("input[name='revokedDate']").val();
    var masteryLevel   = $("select[name='masteryLevel']").val();

    sendAjax("ajaxAddCompetence.php", {
      idUTeacher: idUTeacher,
      idUStudent: idUStudent,
      idSkill: idSkill,
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
      "L'étudiant a maintenant une nouvelle compétence validée !<br>" +
      "ID compétence : " + data['id']
    );

  } else {
    jQuery("body").html("Erreur : " + data['message']);
  }
}

// --- Send AJAX data to server
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
