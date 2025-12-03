$(document).ready(function () {

    $("#btnOk").click(function () {

        var idUCreator = $("input[name='idUCreator']").val();
        var mainName   = $("input[name='mainName']").val();
        var subName    = $("input[name='subName']").val();
        var domain     = $("select[name='domain']").val(); // MENU DÉROULANT
        var level      = $("input[name='level']").val();
        var imgUrl     = $("input[name='imgUrl']").val();
        var color      = $("input[name='color']").val();

        var dataToSend = {
            idUCreator: idUCreator,
            mainName: mainName,
            subName: subName,
            domain: domain,
            level: level,
            imgUrl: imgUrl,
            color: color
        };

        sendAjax("ajxAddSkill.php", dataToSend);
    });


    function sendAjax(serverUrl, data) {

        var jsonData = JSON.stringify(data);

        $.ajax({
            type: 'POST',
            url: serverUrl,
            dataType: 'json',
            data: "data=" + jsonData,

            success: function (response) {
                receiveAjax(response);
            },

            error: function (xhr, status, error) {
                console.log("Erreur AJAX :", error);
                $("body").html("<span style='color: red;'>Erreur AJAX</span>");
            }
        });
    }


    function receiveAjax(data) {

        console.log("Réponse serveur :", data);

        if (data.success === true) {

            $("body").html(
                "<b>Skill ajouté avec succès !</b><br>" +
                "ID Skill : " + data.id + "<br>" +
                "Nom principal : " + data.mainName
            );

        } else {

            $("body").html(
                "<span style='color:red;'>Erreur : " + data.message + "</span>"
            );
        }
    }

});
