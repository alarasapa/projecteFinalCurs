function init() {
    let submitBtn = $("#submit");

    $("#telefon").change(function() {
        let telefon = $("#telefon").val();
        if (isNaN(telefon)) {
            alert("El numero de telefon ha de tenir només numeros");
        } else if (telefon.length < 9) {
            alert("El numero de telfon no té la quantitat de numeros adequada");
        }
    });

    $("#nickname").change(function() {
        comprovar('nickname')
    });

    $("#email").change(function() {
        comprovar('email')
    });

    $("#password").change(function() {
        let password = $("#password").val();

        if (password.length < 8) {
            alert("La contrasenya ha de tenir 8 caracters com a mínim");
            submitBtn.attr("disabled", true);

        } else if (!isNaN(password) || /^[a-zA-Z]+$/.test(password)) {
            alert("La contrasenya ha de contenir lletres, numeros i a poder ser caracters especials")
            submitBtn.attr("disabled", true);
        } else {
            submitBtn.attr("disabled", false);
        }
    });

    $("#password-confirm").change(function() {
        let password = $("#password").val();
        let passwordConf = $("#password-confirm").val();

        if (password != passwordConf) {
            alert("La contrasenya de confirmació no és la mateixa a la introduïda");
            submitBtn.attr("disabled", true);
        } else {
            submitBtn.attr("disabled", false);
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