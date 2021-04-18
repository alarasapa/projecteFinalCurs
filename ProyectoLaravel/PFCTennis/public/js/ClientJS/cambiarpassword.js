function init() {
    $("#contrasenya").change(function() {
        let password = $("#contrasenya").val();

        if (password.length < 8) {
            alert("La contrasenya ha de tenir 8 caracters com a mínim");
        } else if (!isNaN(password) || /^[a-zA-Z]+$/.test(password)) {
            alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
        }
    });

    $("#password-confirm").on("change", function() {
        let password = $("#contrasenya").val();
        let passwordConf = $("#password-confirm").val();

        if (password != passwordConf) {
            alert("La contrasenya de confirmació no és la mateixa a la introduïda");
        }
    });
}

function comprovarFormulari() {
    let estat = true;

    if ($("#contrasenya").val().length < 8) {
        alert("La contrasenya ha de tenir 8 caracters com a mínim");
        estat = false;
    } else if (!isNaN($("#contrasenya").val()) || /^[a-zA-Z]+$/.test($("#contrasenya").val())) {
        alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
        estat = false;
    } else if ($("#contrasenya").val() != $("#password-confirm").val()) {
        alert("La contrasenya de confirmació no és la mateixa a la introduïda");
        estat = false;
    }

    return estat;
}