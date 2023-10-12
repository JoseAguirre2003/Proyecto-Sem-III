var muestras = 1;
$(document).ready(()=>{
    $('#btnAgregarMAP').on('click', ()=>{
        $('#mustrasAProcesar').append('<div><h1>Muestra '+ (muestras+1) +'</h1><div class="imput-box"><label for="identificador">Identificador:</label><input type="text" placeholder="Indentificador" name="muestraAP['+ muestras +'][identificar]" id="identificador"></div><div class="imput-box"><label for="analisisARealizar">Analisis a realizar:</label><input type="text" placeholder="Analisis a realizar" name="muestraAP['+ muestras +'][analisisARealizar]" id="analisisARealizar"></div><div class="imput-box"><label for="fechaDeToma">Fecha de toma:</label><br><input type="date" name="muestraAP['+ muestras +'][fechaDeToma]" id="fechaDeToma"></div><div class="imput-box"><label for="observaciones">Observaciones</label><br><input type="text" placeholder="Observaciones..." name="muestraAP['+ muestras +'][observaciones]" id="observaciones"></div></div>');
        muestras++;
    });
});