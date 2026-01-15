$(document).ready(function(){
 //============================================================================
  //  Send ajax to server
  //============================================================================
  $("#btnOK").on("click", function() {

    var data = {
      mainName: $("input[name='mainName']").val(),
      subName:  $("input[name='subName']").val(),
      domain:   $("input[name='domain']").val(),
      level:    $("input[name='level']").val(),
      color:    $("input[type='color']").val().substring(1),
      idUCreator: $("input[name='idUCreator']").val()
    };

    sendAjax("ajxAddSkill.php", data);

    // // Get file
    //     var file = jQuery("input[type='file']")[0].files[0];

    //     // Get data
    //     var mainName = jQuery("input[name='mainName']").val();
    //     var subName  = jQuery("input[name='subName']").val();
    //     var domain   = jQuery("input[name='domain']").val();
    //     var level    = jQuery("input[name='level']").val();
    //     var color    = jQuery("input[name='color']").val();


    //     // Send file
    //     sendAjaxFile("ajaxAddSkillC.php", file, {
    //         mainName: mainName,
    //         subName: subName,
    //         domain: domain,
    //         level: level,
    //         color: color
          
    //       }, this);
  });

  //============================================================================
  //    Receive ajax from server
  //============================================================================
  function receiveAjax(data) {
    if (data["success"]) {
      redirect('getSkillsAndMasterCompetences.php')
    } else {
      jQuery("span").html(data["html"]);
    }
  }













  
  //============================================================================
  //  Usefull functions
  //============================================================================
  
  function redirect(serverUrl) {
    window.location.href = serverUrl;
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

// --- General function sending file and data to server
function sendAjaxFile(serverUrl, file, data, domElt) {

  // Add file to formData
  var formData = new FormData();
  formData.append("file", file);
  
  // Add data
  for (var key in data) {
    formData.append(key, data[key]);
  }
  //alert (JSON.stringify(formData));
  // Send ajax
  jQuery.ajax({
    type: 'POST',
    url: serverUrl,
    dataType: 'json',
    data: formData,
    processData: false,
    contentType: false,
    cache: false,
    success: function(data) {
      receiveAjax(data, domElt);
    } ,            
  });

}
