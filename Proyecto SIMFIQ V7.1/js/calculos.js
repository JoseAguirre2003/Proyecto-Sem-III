//Validaciones de calculos

function validarDatos_Ce(Ce1, Ce2){
    if(isNaN(Ce1) || Ce1 < 1){
        Swal.fire({
            type: 'warning',
            title: 'La primera Conductividad debe ser un numero mayor a 0!',                          
          }); 
        return false
    } 
    if(isNaN(Ce2) || Ce2 < 1){
        Swal.fire({
            type: 'warning',
            title: 'La segunda Conductividad debe ser un numero mayor a 0!',                          
          }); 
        return false
    }  
    return true;
}

function validarDatos_pH(pH1, pH2){
    if(isNaN(pH1) || pH1 < 1 || pH1 > 14){
        Swal.fire({
            type: 'warning',
            title: 'El primer pH debe ser un numero del 1 al 14!',                          
          }); 
        return false
    } 
    if(isNaN(pH2) || pH2 < 1 || pH2 > 14){
        Swal.fire({
            type: 'warning',
            title: 'El segundo pH debe ser un numero del 1 al 14!',                          
          }); 
        return false
    }  
    return true;
}

function validarDatos_PorcentajeParticulasSuspension(peso_seco, peso_inicial){
    if(isNaN(peso_seco) || peso_seco < 1){
        Swal.fire({
            type: 'warning',
            title: 'El Peso Seco debe ser un  numero mayor a 0!',                          
          }); 
        return false
    } 
    if(isNaN(peso_inicial) || peso_inicial < 1){
        Swal.fire({
            type: 'warning',
            title: 'El Peso Inicial debe ser un  numero mayor a 0!',                       
          }); 
        return false
    }  
    return true;
}

function validarDatos_CIC(volumen, molaridad, masa){
    if(isNaN(volumen) || volumen < 1){
        Swal.fire({
            type: 'warning',
            title: 'El Volumen debe ser un  numero mayor a 0!',                          
        }); 
        return false
    }
    if(isNaN(molaridad) || molaridad < 1){
        Swal.fire({
            type: 'warning',
            title: 'El Molaridad debe ser un  numero mayor a 0!',                          
        }); 
        return false
    }
    if(isNaN(masa) || masa < 1){
        Swal.fire({
            type: 'warning',
            title: 'La Masa debe ser un  numero mayor a 0!',                          
        }); 
        return false
    }  
    return true;
}

//Funciones de Calculos

function calcular_pH(pH1, pH2){
    if(validarDatos_pH(pH1, pH2)){
        pH1 = parseFloat(pH1);
        pH2 = parseFloat(pH2);
        return (pH1 + pH2) / 2;
    }
}

function calcular_Ce(Ce1, Ce2){
    if(validarDatos_Ce(Ce1, Ce2)){
        Ce1 = parseFloat(Ce1);
        Ce2 = parseFloat(Ce2);
        return (Ce1 + Ce2) / 2;
    }
}

function Calcular_PorcentajeParticulasSuspension(peso_seco, peso_inicial){
    if(validarDatos_PorcentajeParticulasSuspension(peso_seco, peso_inicial)){
        peso_seco = parseFloat(peso_seco);
        peso_inicial = parseFloat(peso_inicial);
        $peso_seco_en_mg = peso_seco * 1000;
        return ($peso_seco_en_mg / peso_inicial) * 100;
    }
}

function calcularCIC(volumen, molaridad, masa){
    if(validarDatos_CIC(volumen, molaridad, masa)){
        volumen = parseFloat(volumen);
        molaridad = parseFloat(molaridad);
        masa = parseFloat(masa);
        return (volumen * molaridad) / masa;
    }
}

//Eventos

$('#btnCalcular_pH').on('click', e =>{
    $('#resultado_pH').val(calcular_pH($('#phMuestra1').val(), $('#phMuestra2').val()));
});

$('#btnCalcular_CE').on('click', e =>{
    $('#resultado_Ce').val(calcular_Ce($('#Conductividad1').val(), $('#Conductividad2').val()));
});

$('#btnCalcular_CIC').on('click', e =>{
    $('#resultado_CIC').val(calcularCIC($('#volumen').val(), $('#molaridad').val(), $('#masa').val()));
});

$('#btnCalcular_particulas').on('click', e =>{
    $('#resultado_particulas').val(Calcular_PorcentajeParticulasSuspension($('#pesoSeco').val(), $('#pesoInicial').val()));
});

$('#btnCalcular_TodoAgua').on('click', e => {
    $('#resultado_pH').val(calcular_pH($('#phMuestra1').val(), $('#phMuestra2').val()));
    $('#resultado_Ce').val(calcular_Ce($('#Conductividad1').val(), $('#Conductividad2').val()));
    $('#resultado_particulas').val(Calcular_PorcentajeParticulasSuspension($('#pesoSeco').val(), $('#pesoInicial').val()));
});

$('#btnCalcular_TodoSuelo').on('click', e => {
    $('#resultado_pH').val(calcular_pH($('#phMuestra1').val(), $('#phMuestra2').val()));
    $('#resultado_Ce').val(calcular_Ce($('#Conductividad1').val(), $('#Conductividad2').val()));
    $('#resultado_CIC').val(calcularCIC($('#volumen').val(), $('#molaridad').val(), $('#masa').val()));
});