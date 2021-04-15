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
        if (comprovar('email')) {
            alert("Aquest email ja está en ús");
        }
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

function comprovar(tipus) {
    let _token = $("#token").val();
    let tipusDada = $("#" + tipus).val();
    let json = JSON.stringify({ tipus: tipus, valor: tipusDada, '_token': $('input[name=_token]').val() });
    // let form = $("#form").serialize();

    $.ajax({
        method: 'POST',
        url: '/registrarse/comprovar',
        data: json,
        dataType: 'JSON',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        // success: function(res) {
        // }
    }).done(function(res) {
        alert("OASOASMAO: " + res);
    });
}

function comprovarFormulari() {
    let estat = true;

    if (isNaN(telefon)) {
        alert("El numero de telefon ha de tenir només numeros");
        estat = false;
    } else if (telefon.length < 9) {
        alert("El numero de telfon no té la quantitat de numeros adequada");
        estat = false;
    } else if (password.length < 8) {
        alert("La contrasenya ha de tenir 8 caracters com a mínim");
        estat = false;
    } else if (!isNaN(password) || /^[a-zA-Z]+$/.test(password)) {
        alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
        estat = false;
    } else if (password != passwordConf) {
        alert("La contrasenya de confirmació no és la mateixa a la introduïda");
        estat = false;
    } else if (comprovar('email')) {
        alert("Aquest email ja está en ús");
        estat = false;
    }

    return estat;
}