<?php
require 'fpdf/fpdf.php';
require 'C:/xampp/htdocs/v6.4/php/clases/connection.php';

class PDF_MC_Table extends FPDF
{
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
        for ($i = 0; $i < count($data); $i++)
            $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        // Issue a page break first if needed
        $this->CheckPageBreak($h);
        // Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'C';
            // Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            // Draw the border
            $this->Rect($x, $y, $w, $h);
            // Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            // Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        // Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        // If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }

    function NbLines($w, $txt)
    {
        // Compute the number of lines a MultiCell of width w will take
        if (!isset($this->CurrentFont))
            $this->Error('No font has been set');
        $cw = $this->CurrentFont['cw'];
        if ($w == 0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', (string)$txt);
        $nb = strlen($s);
        if ($nb > 0 && $s[$nb - 1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j)
                        $i++;
                } else
                    $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else
                $i++;
        }
        return $nl;
    }
}

class PDF extends PDF_MC_Table
{
    function Header()
    {
        $this->SetFont('Times', 'B', 20);
        $this->Image('img/logo.png', 0, 0, 70);
        $this->setXY(60, 15);
        $this->Cell(100, 8, 'Informe de Productores', 0, 1, 'C', 0);
        $this->Ln(40);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(170, 10, 'Todos los derechos reservados', 0, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 20);

$pdf->SetX(10);
$pdf->SetFont('Helvetica', 'B', 12);
$pdf->Cell(10, 8, 'ID', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Identificador', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Analisis a realizar', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Fecha de toma', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Observaciones', 1, 1, 'C', 0);

$pdf->SetFillColor(233, 229, 235);
$pdf->SetDrawColor(61, 61, 61);
$pdf->SetFont('Arial', '', 12);

try {
    $conn = new Conexion();
    $db = $conn->conectar();

    // Modificar la consulta SQL para unir las tablas y filtrar las muestras a procesar
    $query = "SELECT MAP.IDMuestra_A_Procesar,MAP.Identificador, MAP.Analisis_A_Realizar, MAP.Fecha_De_Toma, MAP.Observaciones
              FROM muestra_a_procesar MAP
              INNER JOIN msueloxmap MS ON MAP.IDMuestra_A_Procesar = MS.IDMuestraAProcesar
              WHERE MS.IDMuestraSuelo = " . $_GET['idMuestra'];
    
    $stmt = $db->query($query);

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Cell(10, 8, $row['IDMuestra_A_Procesar'], 1, 0, 'C', 0);
        $pdf->Cell(40, 8, $row['Identificador'], 1, 0, 'C', 0);
        $pdf->Cell(40, 8, $row['Analisis_A_Realizar'], 1, 0, 'C', 0);
        $pdf->Cell(40, 8, $row['Fecha_De_Toma'], 1, 0, 'C', 0);
        $pdf->Cell(40, 8, $row['Observaciones'], 1, 1, 'C', 0);
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$pdf->Output();
