<?php

ob_start();
?>
<style type="text/css">
    table{border-collapse: collapse;width: 100%;color: #717375;font-size: 10pt; font-family: helvetica;line-height: 6mm; }
    table strong{color: #000}
    em{font-size: 9pt;}
    td.right{
        text-align :right;
    }


    h1,h2,h3,h4,h5{color: #686868
    }
    table.border td{border-bottom :1px solid #CFD1D2; padding: 3mm 0.4mm}
    table.border th { background: #03395F; color: #fff; font-weight: normal; border-bottom:solid 1px #186aa3; padding: 3mm 1mm ; text-align: left; }

    table.myborder td{border-bottom :1px solid #CFD1D2; padding: 3mm 0.4mm}
    table.myborder th { background: #fff; color: #262626; font-weight: normal; border-bottom:solid 1px #CFD1D2; padding: 3mm 1mm ; text-align: left; }
</style>

<page backtop="10mm" backleft="5mm" backright="5mm" backbottom="30mm" footer="page; date;">

    <table  style="vertical-align: top;">
        <tr>
            <td style="width: 100%; text-align: center;">
                <h1 style="color: #0C5290;">Facture</h1>
            </td>
        </tr>
    </table>
    <br>
    <hr>
    <br>



    <table style="vertical-align: top;">

        <tr>
            <td style="width: 80%;">
                <img src="<?= dirname($_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR).'/resources/views/'?>invoices/Template/invoice/logo.png"  style="width: 100px;" alt="">
            </td>
            <td style="width: 20%">
                <h4>Date: <?= date('d/M/Y' , strtotime($inv->created_at)) ?></h4>
            </td>
        </tr>
    </table>


    <br>
    <br>

    <table style="vertical-align: top;">

        <tr>
            <td style="width: 50%;text-align: left">
                Nous :
                <br>
                <strong>Pollen Plus</strong>
                <br>Lomé TOGO
                <br>Phone:  +228 92363533

            </td>



            <td style="width: 50%; text-align: right">
                Info : <br>
                <b>Facture : #000<?= $inv->id  +  102547?></b>
                <br>
                <b>Compte :</b> <?= $inv->account ?>
                <br>
                <strong><?= $customer->name ?></strong>
                <br><?= $customer->address ?>
                <br>Phone: <?= $customer->phone ?>
            </td>
        </tr>
    </table>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <table class="border">
        <thead>
        <tr>
            <th style="width: 5%;text-align: center;">#</th>
            <th style="width: 5%;text-align: center;">Qty</th>
            <th style="width: 15%;text-align: center;">Product</th>
            <th style="width: 60%;text-align: center;">Description</th>
            <th style="width: 15%;text-align: center;">Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $in):  ?>
            <tr>
                <td style="width: 5%;text-align: center;">#</td>
                <td style="width: 5%;text-align: center;"><?= $in->quantity ?></td>
                <td style="width: 15%;text-align: center;"><?= $in->name ?></td>
                <td style="width: 60%"><small><?= $in->description ?></small></td>
                <td style="width: 15%;text-align: center;"><?=  $subtotal = $in->quantity * $in->price  ?> Frcs</td>
            </tr>
        <?php   endforeach; ?>
        </tbody>
    </table>

    <br>


    <table style="vertical-align: top;">
        <tr>
            <th style="width: 100%;">
                <br>
                <br>
                <br>
                <br>
                <table class="myborder">
                    <tbody>
                    <tr>
                        <th style="width:80%">Subtotal:</th>
                        <td><?= $subtotal ?> Frcs</td>
                    </tr>
                    <tr>
                        <th>Tax (<?= $inv->tax ?>%)</th>
                        <td><?=  $tax ?>Frcs</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td><b style="color: #f42036"><?=   $total ?></b> Frcs TTC</td>
                    </tr>
                    </tbody>
                </table>
            </th>
        </tr>
    </table>
    <br>
    <br>
</page>

<?php
$content = ob_get_clean();
require  'html2pdf/html2pdf.class.php';
try {
    $pdf = new HTML2PDF('P', 'A4' , 'fr', 'true','UTF-8');
    $pdf->pdf->SetDisplayMode('fullpage');
    $pdf->writeHTML($content);
    $pdf->Output('Facture de '.$customer->name.'.pdf', 'D');
} catch (HTML2PDF_exception $e) {
    die($e);
}
?>