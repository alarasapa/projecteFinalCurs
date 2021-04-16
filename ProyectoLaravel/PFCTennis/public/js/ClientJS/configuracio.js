function init() {
    $("#telefon").on("change", function() {
        let telefon = $("#telefon").val();

        if (isNaN(telefon)) {
            alert("El numero de telefon ha de tenir només numeros");
        } else if (telefon.length < 9) {
            alert("El numero de telfon no té la quantitat de numeros adequada");
        }
    });

    $("#email").on("change", function() {
        comprovarEmail();
    });

    $("#contrasenya").on("change", function() {
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

function comprovarEmail() {
    let tipusDada = $("#email").val();
    //CAMBIAR LO DE EMAIL ACTUAL PARA QUE TOME EL EMAIL DEL USUARIO
    let json = JSON.stringify({ valor: tipusDada, '_token': $('input[name=_token]').val() });

    $.ajax({
        type: 'POST',
        url: '/registrarse/comprovar',
        data: json,
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'content-type': 'application/json'
        },
        success: function(res) {
            if (res == 1)
                alert("Aquest email ja está en ús");
        }
    })
}

function comprovarFormulari() {
    let estat = true;

    if (isNaN($("#telefon").val())) {
        alert("El numero de telefon ha de tenir només numeros");
        estat = false;
    } else if ($("#telefon").val().length != 9) {
        alert("El numero de telfon no té la quantitat de numeros adequada");
        estat = false;
    } else if ($("#contrasenya").val().length < 8) {
        alert("La contrasenya ha de tenir 8 caracters com a mínim");
        estat = false;
    } else if (!isNaN($("#contrasenya").val()) || /^[a-zA-Z]+$/.test($("#contrasenya").val())) {
        alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
        estat = false;
    } else if ($("#contrasenya").val() != $("#password-confirm").val()) {
        alert("La contrasenya de confirmació no és la mateixa a la introduïda");
        estat = false;
    }

    // comprovarEmail();

    return estat;
}