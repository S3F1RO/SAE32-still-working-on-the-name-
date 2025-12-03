$(document).ready(function(){

  $("#btnOK").on("click", function() {

    var data = {
      mainName: $("input[name='mainName']").val(),
      subName:  $("input[name='subName']").val(),
      domain:   $("input[name='domain']").val(),
      level:    $("input[name='level']").val(),
      color:    $("input[name='color']").val().replace(/^#/, ''),
      idUCreator: $("input[name='idUCreator']").val()
    };

    console.log("Envoi AJAX :", data);

    sendAjax("ajxAddSkill.php", data);
  });

  function receiveAjax(response) {
    console.log("Réponse serveur :", response);

    $("#debug").html(
      "<h3>Réponse serveur</h3><pre>" +
      JSON.stringify(response, null, 2) +
      "</pre>"
    );
  }

  function sendAjax(serverUrl, data) {
    $.ajax({
      type: "POST",
      url: serverUrl,
      dataType: "json",
      data: { data: JSON.stringify(data) },
      success: function(res) {
        receiveAjax(res);
      },
      error: function(err) {
        console.log("Erreur AJAX :", err);
        $("#debug").html("<p style='color:red;'>Erreur AJAX</p>");
      }
    });
  }

});


