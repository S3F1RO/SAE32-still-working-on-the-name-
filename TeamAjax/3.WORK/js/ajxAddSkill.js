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
    


        //FILTRE DATA

    // idUCreator : chiffres uniquement
    // if (!/^[0-9]+$/.test(data.idUCreator)) {
    //   alert("idUCreator invalide (chiffres uniquement)");
    //   return;
    // }

    // // mainName : A-Z a-z 0-9 (1-10)
    // if (!/^[A-Za-z0-9]{1,10}$/.test(data.mainName)) {
    //   alert("mainName invalide (1 à 10 caractères alphanumériques)");
    //   return;
    // }

    // // subName : A-Z a-z 0-9 (1-10)
    // if (!/^[A-Za-z0-9]{1,10}$/.test(data.subName)) {
    //   alert("subName invalide (1 à 10 caractères alphanumériques)");
    //   return;
    // }

    // // domain : lettres, chiffres, tirets (1-15)
    // if (!/^[A-Za-z0-9\-]{1,15}$/.test(data.domain)) {
    //   alert("domain invalide (lettres/chiffres/tirets, max 15 caractères)");
    //   return;
    // }

    // // level : chiffres uniquement
    // if (!/^[0-9]+$/.test(data.level)) {
    //   alert("level invalide (chiffres uniquement)");
    //   return;
    // }

    // // imgUrl : max 100 caractères (tout accepté)
    // if (!/^.{0,100}$/.test(data.imgUrl)) {
    //   alert("imgUrl trop long (100 caractères max)");
    //   return;
    // }

    // // color : hexadécimal (sans #)
    // if (!/^[A-Fa-f0-9]{6}$/.test(data.color)) {
    //   alert("Couleur invalide (format HEX, ex : FF00AA)");
    //   return;
    // }

    console.log("Envoi AJAX :", data);

    sendAjax("ajxAddSkill.php", data);
  });



//=========================================================================================

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


