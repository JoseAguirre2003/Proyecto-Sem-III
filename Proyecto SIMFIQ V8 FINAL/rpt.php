<?php
require('fpdf/fpdf.php');
include "./php/func.php";
include "./php/clases/Productor.php";
if(isset($_GET['tipoMuestra']) && $_GET['tipoMuestra'] == 'Agua')
    $muestraRuta = "./php/clases/MuestraAgua.php";
else if(isset($_GET['tipoMuestra']) && $_GET['tipoMuestra'] == 'Suelo')
    $muestraRuta = "./php/clases/MuestraSuelo.php";
else{ 
    echo "Tipo de muestra no definido";
    exit();
}
include $muestraRuta;
include "./php/clases/MAaProcesar.php";
include "./php/clases/resultados.php";


class PDF extends FPDF
{

    public $ctrlProductor;
    public $ctrlMuestra;
    public $ctrlMAP;
    public $ctrlResult;
    public $Precio = 0;

    protected $widths;
    protected $aligns;

    function SetWidths($w)
    {
        // Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a)
    {
        // Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data)
    {
        // Calculate the height of the row
        $nb = 0;
        for($i=0;$i<count($data);$i++)
            $nb = max($nb,$this->NbLines($this->widths[$i],$data[$i]));
        $h = 5*$nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x,$y,$w,$h);
            // Print the text
            $this->MultiCell($w,5,$data[$i],0,$a);
            // Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if(!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w-$this->rMargin-$this->x;
        $wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
        $s = str_replace("\r",'',(string)$txt);
        $nb = strlen($s);
        if($nb>0 && $s[$nb-1]=="\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i<$nb)
        {
            $c = $s[$i];
            if($c=="\n")
            {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep = $i;
            $l += $cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i = $sep+1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }

function Header()
{
    if($this->PageNo() == 1){
        if(isset($_GET["id"]) && is_numeric($_GET["id"])){
            $ID = $_GET["id"];
            $this->ctrlProductor = new Productor;
        }else{
            echo "ID no definido";
            exit();
        }
    
        $this->ctrlProductor = $this->ctrlProductor->buscarProductor($ID);
    
        $this->setY(12);
        $this->setX(10);
        
        $this->Image('img/Logo.png',25,5,33);
        
        $this->SetFont('Helvetica', 'B', 13);
        
        $this->Text(77, 15, utf8_decode("Prodcutor: ".$this->ctrlProductor['Nombre']));
        
        $this->Text(77, 21, utf8_decode("Ci/Rif:". $this->ctrlProductor['Cedula_RIF']));
        $this->Text(77,27, utf8_decode("Tel: ".$this->ctrlProductor['Contacto']." - Correo: ".$this->ctrlProductor['Correo']));
        $this->Text(77,27, utf8_decode("Tel: ".$this->ctrlProductor['Contacto']." - Correo: ".$this->ctrlProductor['Correo']));
        $this->Text(77,33, utf8_decode("Direccion: ".$this->ctrlProductor['Direccion']));

        $this->SetFont('Arial','B',10);    
        $this->Text(10,48, utf8_decode('Fecha:'));
        $this->SetFont('Arial','',10);    
        $this->Text(25,48, date('d/m/Y'));

    }
    
}

function Footer()
{
    $this->SetFont('helvetica', 'B', 8);
    $this->SetY(-15);
    $this->Cell(95,5,utf8_decode('Página ').$this->PageNo().' / {nb}',0,0,'L');
        
}


}



$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$pdf->SetTopMargin(15);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);



$pdf->setY(60);$pdf->setX(135);
    $pdf->Ln();
    $pdf->ctrlMAP = new MAaProcesar;
    $pdf->ctrlResult = new Resultados;
    if($_GET['tipoMuestra'] == 'Agua'){ 
        $pdf->ctrlMuestra = new MuestraAgua;
        $pdf->ctrlMuestra = $pdf->ctrlMuestra->listarMuestras($pdf->ctrlProductor['ID_Productor']);
        $pdf->SetDrawColor(22, 160, 133);
        $pdf->SetFillColor(22, 160, 133);
        
        foreach($pdf->ctrlMuestra as $dato){
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(0, 7, utf8_decode('Muestra de Agua:'),1,1,'C',1);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(50, 7, utf8_decode('ID:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['ID_Muestra'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Fecha:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Fecha_Ingreso'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Fuente de agua:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Fuente_Agua'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Recibido Por:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Recibido_Por'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Recolectada Por:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Recolectada_Por'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Problemas de Sales:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Problemas_De_Sales'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Tratamiento de pH:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Tratamiento_pH'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Sistema de Riego:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Sistema_Riego'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Cantidad usada:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Cantidad_Usada']. " L/ha",1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('pHMetro:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['pH_Metro'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Conductimetro:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Conductimetro'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Ubicacion:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Ubicacion'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Observaciones generales:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Observaciones_Generales'],1,1,'L',0);

            $pdf->ctrlMAP = new MAaProcesar;
            $pdf->ctrlMAP = $pdf->ctrlMAP->listarMuestrasAProcrsarAgua($dato['ID_Muestra']);
            if($pdf->ctrlMAP){
                foreach($pdf->ctrlMAP as $datoMAP){
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->Cell(0, 7, utf8_decode('Muestra a Procesar:'),1,1,'C',1);
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->Cell(50, 7, utf8_decode('ID:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['IDMuestra_A_Procesar'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Identificador:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Identificador'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Analisis a Realizar:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Analisis_A_Realizar'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Fecha de Toma:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Fecha_De_Toma'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Observaciones:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Observaciones'],1,1,'L',0);

                    $pdf->ctrlResult = new Resultados;
                    $pdf->ctrlResult = $pdf->ctrlResult->buscarResultados($datoMAP['IDMuestra_A_Procesar']);
                    if($pdf->ctrlResult){
                        $pdf->SetTextColor(255, 255, 255);
                        $pdf->Cell(0, 7, utf8_decode('Resultados:'),1,1,'C',1);
                        $pdf->SetTextColor(0, 0, 0);
                        if($pdf->ctrlResult['pH'] != null){
                            $pdf->Cell(50, 7, utf8_decode('pH:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['pH'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Ce'] != null){
                            $pdf->Cell(50, 7, utf8_decode('Ce:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Ce'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Suelo_CIC'] != null){
                            $pdf->Cell(50, 7, utf8_decode('CIC:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Suelo_CIC'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Suelo_Textura'] != null){
                            $pdf->Cell(50, 7, utf8_decode('Suelo_Textura:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Suelo_Textura'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Agua_ParticulasSuspension'] != null){
                            $pdf->Cell(50, 7, utf8_decode('Agua_ParticulasSuspension:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Agua_ParticulasSuspension'],1,1,'L',0);
                        }
                        $pdf->Cell(50, 7, utf8_decode('Costo:'),1,0,'C',0);
                        $pdf->Cell(0, 7, "$".$pdf->ctrlResult['Precio'],1,1,'L',0);
                        $pdf->Precio += (float)$pdf->ctrlResult['Precio'];
                    }else
                        $pdf->Cell(0, 7, utf8_decode('NO HAY RESULTADOS CARGADOS'),1,0,'C',0);
                }
            }else{
                $pdf->Cell(0, 7, utf8_decode('NO HAY MUESTRAS A PROCESAR CARGADAS'),1,0,'C',0);
            }
            $pdf->Ln(10);
        }
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 7, utf8_decode('Costo Total:'),1,0,'C',1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 7, "$".$pdf->Precio,1,1,'L',0);
    }else if($_GET['tipoMuestra'] == 'Suelo'){
        $pdf->ctrlMuestra = new MuestraSuelo;
        $pdf->ctrlMuestra = $pdf->ctrlMuestra->listarMuestras($pdf->ctrlProductor['ID_Productor']);
        $pdf->SetDrawColor(107, 142, 35);
        $pdf->SetFillColor(107, 142, 35);
        
        foreach($pdf->ctrlMuestra as $dato){
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(0, 7, utf8_decode('Muestra de Suelo:'),1,1,'C',1);
            $pdf->SetTextColor(0, 0, 0);
            $pdf->Cell(50, 7, utf8_decode('ID:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['IDMuestraSuelo'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Fecha de Recepcion:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Fecha_Recepcion'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Localidad:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Localidad'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Municipio:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Municipio'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Traido Por:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Traido_Por'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Profundidad:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Profundidad']. "m",1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Uso_Anterior:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Uso_Anterior'],1,1,'L',0);
            $pdf->Cell(50, 7, utf8_decode('Hectaria:'),1,0,'C',0);
            $pdf->Cell(0, 7, $dato['Hectaria']. "m^2",1,1,'L',0);

            $pdf->ctrlMAP = new MAaProcesar;
            $pdf->ctrlMAP = $pdf->ctrlMAP->listarMuestrasAProcrsarAgua($dato['IDMuestraSuelo']);
            if($pdf->ctrlMAP){
                foreach($pdf->ctrlMAP as $datoMAP){
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->Cell(0, 7, utf8_decode('Muestra a Procesar:'),1,1,'C',1);
                    $pdf->SetTextColor(0, 0, 0);
                    $pdf->Cell(50, 7, utf8_decode('ID:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['IDMuestra_A_Procesar'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Identificador:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Identificador'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Analisis a Realizar:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Analisis_A_Realizar'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Fecha de Toma:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Fecha_De_Toma'],1,1,'L',0);
                    $pdf->Cell(50, 7, utf8_decode('Observaciones:'),1,0,'C',0);
                    $pdf->Cell(0, 7, $datoMAP['Observaciones'],1,1,'L',0);

                    $pdf->ctrlResult = new Resultados;
                    $pdf->ctrlResult = $pdf->ctrlResult->buscarResultados($datoMAP['IDMuestra_A_Procesar']);
                    if($pdf->ctrlResult){
                        $pdf->SetTextColor(255, 255, 255);
                        $pdf->Cell(0, 7, utf8_decode('Resultados:'),1,1,'C',1);
                        $pdf->SetTextColor(0, 0, 0);
                        if($pdf->ctrlResult['pH'] != null){
                            $pdf->Cell(50, 7, utf8_decode('pH:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['pH'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Ce'] != null){
                            $pdf->Cell(50, 7, utf8_decode('Ce:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Ce'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Suelo_CIC'] != null){
                            $pdf->Cell(50, 7, utf8_decode('CIC:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Suelo_CIC'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Suelo_Textura'] != null){
                            $pdf->Cell(50, 7, utf8_decode('Suelo_Textura:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Suelo_Textura'],1,1,'L',0);
                        }
                        if($pdf->ctrlResult['Agua_ParticulasSuspension'] != null){
                            $pdf->Cell(50, 7, utf8_decode('Agua_ParticulasSuspension:'),1,0,'C',0);
                            $pdf->Cell(0, 7, $pdf->ctrlResult['Agua_ParticulasSuspension'],1,1,'L',0);
                        }
                        $pdf->Cell(50, 7, utf8_decode('Costo:'),1,0,'C',0);
                        $pdf->Cell(0, 7, "$".$pdf->ctrlResult['Precio'],1,1,'L',0);
                        $pdf->Precio += (float)$pdf->ctrlResult['Precio'];
                    }else
                        $pdf->Cell(0, 7, utf8_decode('NO HAY RESULTADOS CARGADOS'),1,0,'C',0);
                }
            }else{
                $pdf->Cell(0, 7, utf8_decode('NO HAY MUESTRAS A PROCESAR CARGADAS'),1,0,'C',0);
            }
            $pdf->Ln(20);
        }
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 7, utf8_decode('Costo Total:'),1,0,'C',1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 7, "$".$pdf->Precio,1,1,'L',0);
    }else{
        echo "Tipo de muestra no definido";
        exit();
    }

$pdf->Output();
?>