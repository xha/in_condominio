    $(function() {
    });

    function calcula_canon() {
        var tipo = trae('local-tipo_alquiler').value;
        var monto = trae('local-monto_alquiler');
        var canon = trae('canon');
        
        if (tipo==1) {
            if (canon.value=="") canon.value = 0;
            if (monto.value > 100) monto.value = 100;
            monto.value = (parseFloat(monto.value) * canon.value) / 100;
        }
    }
    
    function enviar_data(valor) {
        trae('evento-semaforo').value = valor;
        document.forms['w0'].submit();
    }
