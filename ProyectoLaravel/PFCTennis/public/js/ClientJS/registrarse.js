var emailValido = true;
var nifValido = true;
var targetaSanitariaValido = true;

function init() {

    $("#telefon").on("change", function() {
        let telefon = $("#telefon").val();
        if (isNaN(telefon)) {
            alert("El numero de telefon ha de tenir només numeros");
        } else if (telefon.length < 9) {
            alert("El numero de telfon no té la quantitat de numeros adequada");
        }
    });

    $("#nif").on("change", function() {
        let valor = $("#nif").val();

        let json = JSON.stringify({ tipusDada: 'nif', valor: valor, '_token': $('input[name=_token]').val() });

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
                if (res == 1) {
                    alert("Aquest NIF ja está en ús");
                    nifValido = false;
                } else {
                    nifValido = true;
                }
            }
        })

    });

    $("#targetaSanitaria").on("change", function() {
        let valor = $("#targetaSanitaria").val();

        let json = JSON.stringify({ tipusDada: 'targetaSanitaria', valor: valor, '_token': $('input[name=_token]').val() });

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
                if (res == 1) {
                    alert("Aquesta targeta sanitària ja está en ús");
                    targetaSanitariaValido = false;
                } else {
                    targetaSanitariaValido = true;
                }
            }
        })
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
    let valor = $("#email").val();

    let json = JSON.stringify({ tipusDada: 'email', valor: valor, '_token': $('input[name=_token]').val() });

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
            if (res == 1) {
                alert("Aquest email ja está en ús");
                emailValido = false;
            } else {
                emailValido = true;
            }
        }
    })
}

function comprovarFormulari() {
    let estat = true;

    if (!emailValido) {
        alert("Aquest email ja está en ús");
        estat = false;
    } else if (!nifValido) {
        alert("Aquest NIF ja está en ús");
        estat = false;
    } else if (!targetaSanitariaValido) {
        alert("Aquest targeta sanitaria ja está en ús");
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

    return estat;
}