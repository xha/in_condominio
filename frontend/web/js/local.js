$(document).ajaxStart(function() { Pace.restart(); });
    function calcula_canon() {
        var tipo = $('#local-tipo_alquiler').val();
        var monto = $('#local-monto_alquiler')[0];
        var metro = $('#local-metro')[0];
        var canon = $('#canon')[0];
        
        if (tipo==1) {
            if (canon.value=="") canon.value = 0;
            if (metro.value=="") metro.value = 0;
            monto.value = parseFloat(metro.value) * canon.value;
        }
    }

    function busca_canon() {
        var codvend = $("#local-codvend").val();

        if (codvend != "") {
            $.get('../local/busca-canon',{CodVend :  codvend},function(data){
                $("#canon")[0].value = parseFloat(data);
            });    
        }
    }