<?php

function calcular_Ce($Ce1, $Ce2){
  return ($Ce1 + $Ce2) / 2;
}

function calcular_pH($pH1, $pH2){
  return ($pH1 + $pH2) / 2;
}

function Calcular_PorcentajeParticulasSuspension($peso_seco, $peso_inicial) {
  $peso_seco_en_mg = $peso_seco * 1000;
  return ($peso_seco_en_mg / $peso_inicial) * 100;
}

//SUELOS

/* pH Porcentaje de Hidrógeno en suelo, un simple promedio
ej: 
$pHsuelo 1 = 6
$pHsuelo 2 = 7
pHsuelo = (pHsuelo1 + pHsuelo2) / 2
= (6 + 7) / 2
= 6,5
*/
function calcularpHSuelo($pHsuelo1, $pHsuelo2, $pHsuelo) {
 //Validar los datos, siempre entre 1 y 14
 if (!is_numeric($pHsuelo1) || $pHsuelo1 <= 1 || $pHsuelo1 > 14) {
      return [false, "El pH1 debe ser un número entre 1 y 14"];
    }

 if (!is_numeric($pHsuelo2) || $pHsuelo2 <= 1 || $pHsuelo2 > 14) {
      return [false, "El pH2 debe ser un número entre 1 y 14"];
    }

 $pHsuelo = ($pHsuelo1 + $pHsuelo2) / 2;

    return [true, $pHsuelo];
  }



//CIC capacidad de intercambio catiónico

/* CIC es la capacidad de intercambio catiónico en miliequivalentes por kilogramo (meq/kg).
V es el volumen de sulfato de cobre II utilizado en la titulación en mililitros (mL).
M es la molaridad de la solución de sulfato de cobre II en moles por litro (mol/L).
m es la masa de la muestra de suelo en kilogramos (kg). 
CIC = (V * M) / m 
ej:
$volumen = 100 ml
$molaridad = 1 mol/L
$masa = 100 g

CIC = (V * M) / m
= (100 ml * 1 mol/L) / 100 g
= 1 mol/g*/

function calcularCIC($volumen, $molaridad, $masa) {
 //Validar los datos, siempre mayores a cero
    if ($volumen <= 0) {
      return [false, "El volumen debe ser mayor que 0"];
    }

    if ($molaridad <= 0) {
      return [false, "La molaridad debe ser mayor que 0"];
    }

    if ($masa <= 0) {
      return [false, "La masa debe ser mayor que 0"];
    }

// Calcular la CIC CIC = (V * M) / m
    $cic = ($volumen * $molaridad) / $masa;


    return [true, $cic];
  }

 //CE Conductividad eléctrica suelo, un simple promedio
 /* $CeSuelo 1 = 10
 $CeSuelo 2 = 20
     CeSuelo = (CeSuelo1 + CeSuelo2) / 2
     = (10 + 20) / 2
     = 15 

     Suelo agrícola óptimo: 0,5-2 mS/cm
     Suelo agrícola salino: 2-4 mS/cm
     Suelo agrícola muy salino: >4 mS/cm
     */

 function calcularCeSuelo($CeSuelo1, $CeSuelo2, $CeSuelo) {
 //Validr los datos, mayores a cero
 if (!is_numeric($CeSuelo1) || $CeSuelo1 <= 0) {
      return [false, "El valor debe ser un número mayor que 0"];
    }

 if (!is_numeric($CeSuelo2) || $CeSuelo2 <= 0) {
      return [false, "El valor debe ser un número mayor que 0"];
    }

 $CeSuelo = ($CeSuelo1 + $CeSuelo2) / 2;

    return [true, $ $CeSuelo];
  }

// Textura, tipo de suelo en proceso creativo

  function calculatTexturaDelSuelo9() {



  }



   //AGUAS

// pH Porcentaje de Hidrogeno en agua, un simple promedio
function calcularpHAgua($pHagua1, $pHagua2, $pHagua) {
  // Validar los datos, siempre entre 1 y 14
  if (!is_numeric($pHagua1) || $pHagua1 <= 1 || $pHagua1 > 14) {
    return [false, "El pH debe ser un número entre 1 y 14"];
  }

  if (!is_numeric($pHagua2) || $pHagua2 <= 1 || $pHagua2 > 14) {
    return [false, "El pH debe ser un número entre 1 y 14"];
  }

  $pHagua = ($pHagua1 + $pHagua2) / 2;

  return [true, $pHagua];
}


//CE Conductividad electrica agua, un simple promedio
/*
vaolores normales:
     Agua pura: 0 mS/cm
     Agua de mar: 50-60 mS/cm
     Agua de río: 0,1-50 mS/cm
     Agua de lluvia: 0,01-0,5 mS/cm
     Agua subterránea: 0,1-100 mS/cm*
*/

function calculaCeAgua($CeAgua1, $CeAgua2, $CeAgua) {
  // Validr los datos, mayores a cero
  if (!is_numeric($CeAgua1) || $CeAgua1 <= 0) {
    return [false, "El valor debe ser un número mayor que 0"];
  }

  if (!is_numeric($CeAgua2) || $CeAgua2 <= 0) {
    return [false, "El valor debe ser un número mayor que 0"];
  }

  $CeAgua = ($CeAgua1 + $CeAgua2) / 2;

  return [true, $CeAgua];
}

//porcentaje de particulas en suspension 
/*muestra de agua de al menos 100 ml y se filtra a través de un filtro de membrana de 0,45 μm. El filtrado se coloca en un vaso de precipitados y se deja reposar durante 24 horas.
Al cabo de las 24 horas, se seca el filtrado en una estufa a 105 °C durante 24 horas. El peso seco se determina pesando el filtro con el residuo seco.
% de partículas en suspensión = (peso seco / peso inicial) * 100
ej:
% de partículas en suspensión = (0,1 g / 100 ml) * 100
% de partículas en suspensión = 100 mg/ml * 100
% de partículas en suspensión = 1%
*/

function calcular_porcentaje_particulas_suspension($peso_seco, $peso_inicial, $porcentaje_particulas_suspension) {
 //Convertir el peso seco de gramos a miligramos
 $peso_seco_en_mg = $peso_seco * 1000;

// Calcular 
  $porcentaje_particulas_suspension = ($peso_seco_en_mg / $peso_inicial) * 100;


  return $porcentaje_particulas_suspension;
}


?>