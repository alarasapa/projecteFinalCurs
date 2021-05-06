// $("#formulari").on("click", function(){

//     if ($("#formulari").is(":checked")){
//         $("#formulariTaula").css("display", "block");
//         $("#formulariTaula").css("visibility", "visible");
//     } else {
//         $("#formulariTaula").css("display", "none");
//         $("#formulariTaula").css("visibility", "hidden");
//     }

// });

$("#afegirCamp").on("click", function(){
    $('tbody').append(
        "<tr>" +
            '<td><input type="date" name="dataInici" class="form-control"></td>' +
            '<td><input type="date" name="dataFi" class="form-control"></td>' +
            '<td><input type="time" name="horaInici" class="form-control"></td>' +
            '<td><input type="time" name="horaFi" class="form-control"></td>' +
        "</tr>"
    );
});