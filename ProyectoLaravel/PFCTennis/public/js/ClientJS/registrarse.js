function init() {
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