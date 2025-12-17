$(document).ready(function(){
  //==============================================================================

  /*==============================================================================
  Send ajax to server
  ==============================================================================*/

  // On click "Continuer →" button
  $("body").on("click", ".btn-continue", function() {
    var firstName = $("input[name='firstName']").val().trim();
    var lastName = $("input[name='lastName']").val().trim();
    var nickname = $("input[name='nickname']").val().trim();
    var password = $("input[name='password']").val().trim();
    
    if(!firstName || !lastName || !password){
      alert("Veuillez remplir tous les champs obligatoires (*)");
      return;
    }

    sendAjax("ajaxAddUser.php", {
      'firstName': firstName,
      'lastName': lastName,
      'nickname': nickname,
      'password': password
    });
  });

  // Trigger ajax on "Enter" key in nickname or password field
  $("body").on("keyup", "input[name='nickname'], input[name='password']", function(e) {
    if (e.which == 13) { // Enter key
      var firstName = $("input[name='firstName']").val().trim();
      var lastName = $("input[name='lastName']").val().trim();
      var nickname = $("input[name='nickname']").val().trim();
      var password = $("input[name='password']").val().trim();

      if(!firstName || !lastName || !password){
        alert("Veuillez remplir tous les champs obligatoires (*)");
        return;
      }

      sendAjax("ajaxAddUser.php", {
        'firstName': firstName,
        'lastName': lastName,
        'nickname': nickname,
        'password': password
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
      var idUser = data["idUser"];
      $("body").html("ID utilisateur reçu : " + idUser);
    } else {
      var html = data["html"];
      $("span").html(html);
    }
  };

  // --- Send AJAX data to server
  function sendAjax(serverUrl, data) {
    var jsonData = JSON.stringify(data);
    $.ajax({
      type: 'POST',
      url: serverUrl,
      dataType: 'json',
      data: { data: jsonData },
      success: function(data) {
        receiveAjax(data);
      }
    });
  }
});
