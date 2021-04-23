var emailValido = true;
var nifValido = true;

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
        comprovarNif();
    });

    $("#email").on("change", function() {
        comprovarEmail();
    });

    $("#targetaSanitaria").on("change", function() {
        comprovarTargetaSanitaria();
    });
}

function comprovarTargetaSanitaria() {
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
}

function comprovarNif() {
    let valor = $("#nif").val();

    let json = JSON.stringify({ tipusDada: 'nif', valor: valor, dadaActual: nifActual, '_token': $('input[name=_token]').val() });

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
}

function comprovarEmail() {
    let valor = $("#email").val();

    let json = JSON.stringify({ tipusDada: 'email', valor: valor, dadaActual: emailActual, '_token': $('input[name=_token]').val() });

    $.ajax({
        type: 'POST',
        url: '/configuracio/comprovar',
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
        alert("Aquest email ja està en ús");
        estat = false;
    } else if (!nifValido) {
        alert("Aquest NIF ja està en ús");
        estat = false;
    } else if (!targetaSanitariaValido) {
        alert("Aquesta targeta sanitaria ja està en ús");
        estat = false;
    }

    return estat;
}