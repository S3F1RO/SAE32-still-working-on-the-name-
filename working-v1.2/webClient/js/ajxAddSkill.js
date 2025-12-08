$(document).ready(function(){

  $("#btnOK").on("click", function() {

    var data = {
      mainName: $("input[name='mainName']").val(),
      subName:  $("input[name='subName']").val(),
      domain:   $("input[name='domain']").val(),
      level:    $("input[name='level']").val(),
      color:    $("input[type='color']").val().substring(1),
      idUCreator: $("input[name='idUCreator']").val()
    };

    console.log("Envoi AJAX :", data);

    sendAjax("ajxAddSkill.php", data);
  });

  function receiveAjax(data) {
    if (data["success"]) {
      alert(data["idSkill"])
    } else {
      jQuery("span").html(data["html"]);
    }
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


