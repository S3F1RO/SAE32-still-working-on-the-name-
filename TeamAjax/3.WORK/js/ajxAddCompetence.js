$(document).ready(function () {

    $("#btnAddCompetence").click(function () {

        var idUTeacher     = $("select[name='idUTeacher']").val();
        var idUStudent     = $("select[name='idUStudent']").val();
        var idSkill        = $("select[name='idSkill']").val();
        var masteringLevel = $("input[name='masteringLevel']").val();
        var currentDate    = $("input[name='currentDate']").val();

        var dataToSend = {
            idUTeacher: idUTeacher,
            idUStudent: idUStudent,
            idSkill: idSkill,
            masteringLevel: masteringLevel,
            currentDate: currentDate
        };

        sendAjax("ajaxAddCompetence.php", dataToSend);
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
                $("body").html("<span style='color:red;'>Erreur AJAX</span>");
            }
        });
    }


    function receiveAjax(data) {

        console.log("Réponse Serveur:", data);

        if (data.success === true) {

            $("body").html(
                "<b>Compétence ajoutée !</b><br>" +
                "ID compétence : " + data.id
            );

        } else {

            $("body").html(
                "<span style='color:red;'>Erreur : " + data.message + "</span>"
            );
        }
    }

});
