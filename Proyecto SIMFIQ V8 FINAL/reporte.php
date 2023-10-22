<?php
require './fpdf/fpdf.php';
require './php/clases/connection.php';

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
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
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
$pdf->SetFont('Helvetica', 'B', 15);
$pdf->Cell(10, 8, 'ID', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Nombre', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'CI o RIF', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Direccion', 1, 0, 'C', 0);
$pdf->Cell(25, 8, 'Municipio', 1, 0, 'C', 0);
$pdf->Cell(30, 8, 'Contacto', 1, 0, 'C', 0);
$pdf->Cell(40, 8, 'Correo', 1, 1, 'C', 0); // 

$pdf->SetFillColor(233, 229, 235);
$pdf->SetDrawColor(61, 61, 61);
$pdf->SetFont('Arial', '', 12);

$pdf->SetWidths(array(10, 40, 25, 30, 25, 30, 40)); // Ajusta el ancho de la celda "Correo" a 40
$pdf->SetAligns(array('C', 'L', 'L', 'L', 'L', 'L', 'L'));

try {
    $conn = new Conexion();
    $db = $conn->conectar();
    
    $query = "SELECT * FROM productor";
    $stmt = $db->query($query);
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $pdf->Row([$row['ID_Productor'], $row['Nombre'], $row['Cedula_RIF'], $row['Direccion'], $row['Municipio'], $row['Contacto'], $row['Correo']]);
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$pdf->Output();
?>
