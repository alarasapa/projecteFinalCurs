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
        // var token = '{{Session::token()}}';
        let nick = $("#nickname").val();
        let json = JSON.stringify({ tipus: 'nickname', valor: nick });

        $.ajax({
            method: 'POST',
            url: '/registrarse/comprovar',
            data: json,
            dataType: 'JSON',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },

            success: function(res) {
                console.log("OASOASMAO");
            }
        });
    });
}