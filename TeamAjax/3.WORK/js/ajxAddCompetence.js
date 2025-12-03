$(document).ready(function() {

  $("#btnOK").on("click", function() {

    var data = {
      idUTeacher:   $("input[name='idUTeacher']").val(),
      idUStudent:   $("input[name='idUStudent']").val(),
      idSkill:      $("input[name='idSkill']").val(),
      currentDate:  $("input[name='currentDate']").val(),
      revokedDate:  $("input[name='revokedDate']").val(),
      masteringLevel: $("select[name='masteringLevel']").val()
    };

    console.log("Données saisies :", data);

    $("#result").html(
      "<h2>Valeurs récupérées par le JS :</h2>" +
      "<pre>" + JSON.stringify(data, null, 2) + "</pre>"
    );
  });

});
