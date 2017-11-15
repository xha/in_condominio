    function procesar_arrendamiento() {
        var mes = document.getElementById('mes').value;
        var mensaje = document.getElementById('mensaje');
        var id_usuario = document.getElementById('id_usuario').value;
        var btn_enviar = document.getElementById('btn_enviar');
        var imag = document.getElementById('imag');

        mensaje.innerHTML = '';
        btn_enviar.disabled = true;
        imag.style.visibility = 'visible';
        $.get('../presupuesto/busca-procesar-arrendamiento',{mes : mes, usuario : id_usuario},function(data){
            var data = $.parseJSON(data);
            
            if (data.salida==1) {
                mensaje.innerHTML = "Proceso realizado con éxito";
            } else {
                mensaje.innerHTML = "Error al procesar";
            }
            
            btn_enviar.disabled = false;
            imag.style.visibility = 'hidden';
        });
    }        

    function buscar_presupuesto() {
        var numerod = trae("numerod");
        var cliente = trae("cliente");
        var descripcion = trae("descripcion");
        var vendedor = trae("vendedor");
        var ubicacion = trae("ubicacion");
        var fecha = trae("fecha");
        var descuento = trae("descuento");
        var sub_total = trae("sub_total");
        var impuesto = trae("impuesto");
        var total = trae("total");
        var tabla = trae('listado_detalle');

        limpiar_campos();
        if (numerod.value!="") {
            $.get('../presupuesto/buscar-encabezado',{numerod : numerod.value},function(data){
                var data = $.parseJSON(data);
                if (data!="") {
                    cliente.value = data[0].CodClie;    
                    descripcion.value = data[0].Descrip;    
                    vendedor.value = data[0].CodVend;    
                    ubicacion.value = data[0].CodUbic;    
                    fecha.value = convertDateFormat(data[0].FechaE);    
                    descuento.value = number_format(data[0].DesctoP);
                    sub_total.value = number_format(data[0].Monto);
                    impuesto.value = number_format(data[0].MtoTax);
                    total.value = number_format(data[0].MtoTotal);    
                    $.get('../presupuesto/buscar-detalle',{numerod : numerod.value},function(data2){
                        var data2 = $.parseJSON(data2);
                        var campos = Array();
                        if (data2!="") {
                            for (i = 0; i < data2.length; i++) {
                                campos.length = 0;
                                campos.push(data2[i].NroLinea);
                                campos.push(data2[i].CodItem);
                                campos.push(data2[i].Descrip1);
                                campos.push(number_format(data2[i].Cantidad,2));
                                campos.push(number_format(data2[i].Precio,2));
                                campos.push(number_format(data2[i].MtoTax,2));
                                campos.push(number_format(data2[i].Descto,2));
                                campos.push(number_format(data2[i].TotalItem,2));
                                tabla.appendChild(add_filas(campos, 'td','','',7));
                            }     
                        }
                    });
                }
            });
        }
    }

    function limpiar_campos(){
        trae("cliente").value = "";
        trae("descripcion").value = "";
        trae("vendedor").value = "";
        trae("ubicacion").value = "";
        trae("fecha").value = "";
        trae("descuento").value = "";
        trae("sub_total").value = "";
        trae("impuesto").value = "";
        trae("total").value = "";
        trae('listado_detalle').innerHTML = "";
        title_tabla();
    }

    function title_tabla() {
        var tabla = trae('listado_detalle');
        var arreglo = new Array();
            arreglo[0] = 'Nro';
            arreglo[1] = 'Código';
            arreglo[2] = 'Descripción';
            arreglo[3] = 'Cantidad';
            arreglo[4] = 'Precio';
            arreglo[5] = 'Tax';
            arreglo[6] = 'Descuento';
            arreglo[7] = 'Total';

        tabla.innerHTML = "";
        tabla.appendChild(add_filas(arreglo, 'th','','',7));
    }