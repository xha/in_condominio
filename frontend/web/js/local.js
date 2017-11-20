    function calcula_canon() {
        var tipo = trae('local-tipo_alquiler').value;
        var monto = trae('local-monto_alquiler');
        var canon = trae('canon');
        
        if (tipo==1) {
            if (canon.value=="") canon.value = 0;
            if (metro.value=="") metro.value = 0;
            monto.value = (parseFloat(metro.value) * canon.value);
        }
    }