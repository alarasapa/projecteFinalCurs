function enviarPeticio(idTipus, idUsuari){
    let peticio = JSON.stringify({ nomTipus: 'soci', idTipus: idTipus, idUsuari: idUsuari, '_token': $('input[name=_token]').val() });
    
    $.ajax({
        type: 'POST',
        url: '/soci/apuntarse',
        data: peticio,
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'content-type': 'application/json'
        },
        success: function(res){
            console.log(res);
        }
    });
}