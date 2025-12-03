$(document).ready(function() {

  //============================================================================
  //  Click sur le bouton OK
  //============================================================================
  $("#btnOK").on("click", function() {

    // Récupération des valeurs du formulaire
    var data = {
      idUTeacher:     $("input[name='idUTeacher']").val(),
      idUStudent:     $("input[name='idUStudent']").val(),
      idSkill:        $("input[name='idSkill']").val(),
      currentDate:    $("input[name='currentDate']").val(),
      revokedDate:    $("input[name='revokedDate']").val(),
      masteringLevel: $("select[name='masteringLevel']").val()   // ⚠ même nom que dans le PHP
    };

    console.log("Données saisies :", data);

    // Affichage brut pour debug
    $("#result").html(
      "<h2>Valeurs récupérées par le JS :</h2>" +
      "<pre>" + JSON.stringify(data, null, 2) + "</pre>"
    );

    // Envoi au PHP AJAX
    sendAjax("ajxAddCompetence.php", data);
  });

  //============================================================================
  //  Réception AJAX
  //============================================================================
  function receiveAjax(data) {

    console.log("Réponse AJAX :", data);

    if (data.success) {

      var id = data.id;   // ID de la compétence créée

      $("#result").html(
        "<h2>Compétence créée avec succès ✅</h2>" +
        "<p>ID de la compétence : <b>" + id + "</b></p>"
      );

    } else {

      $("#result").html(
        "<h2 style='color:red;'>Erreur</h2>" +
        "<p>" + (data.message || "Erreur inconnue") + "</p>" +
        "<pre>" + JSON.stringify(data, null, 2) + "</pre>"
      );
    }
  }

  //============================================================================
  //  Envoi AJAX au serveur
  //============================================================================
  function sendAjax(serverUrl, data) {

    var jsonData = JSON.stringify(data);

    $.ajax({
      type: 'POST',
      url: serverUrl,
      dataType: 'json',
      data: "data=" + jsonData,

      success: function(response) {
        receiveAjax(response);
      },

      error: function(xhr, status, error) {
        console.log("ERREUR AJAX :", status, error);
        console.log("Réponse brute :", xhr.responseText);

        $("#result").html(
          "<h2 style='color:red;'>Erreur AJAX</h2>" +
          "<p>" + status + " - " + error + "</p>" +
          "<pre>" + xhr.responseText + "</pre>"
        );
      }
    });
  }

});
