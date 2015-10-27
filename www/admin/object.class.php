<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//use PFBC\Form;
//use PFBC\Element;
//require_once("pfbc/PFBC/Form.php");
require_once("forms/blueticket_forms.php");

require_once ('tcpdf/tcpdf.php');
require_once ('tcpdf/tcpdf_barcodes_2d.php');

require_once 'php_socket.class.php';

class printDocument {

    function getSeo($text) {
        $utf8table = array("\xc3\xa1" => "a", "\xc3\xa4" => "a", "\xc4\x8d" => "c", "\xc4\x8f" => "d", "\xc3\xa9" => "e", "\xc4\x9b" => "e", "\xc3\xad" => "i", "\xc4\xbe" => "l", "\xc4\xba" => "l", "\xc5\x88" => "n", "\xc3\xb3" => "o", "\xc3\xb6" => "o", "\xc5\x91" => "o", "\xc3\xb4" => "o", "\xc5\x99" => "r", "\xc5\x95" => "r", "\xc5\xa1" => "s", "\xc5\xa5" => "t", "\xc3\xba" => "u", "\xc5\xaf" => "u", "\xc3\xbc" => "u", "\xc5\xb1" => "u", "\xc3\xbd" => "y", "\xc5\xbe" => "z", "\xc3\x81" => "A", "\xc3\x84" => "A", "\xc4\x8c" => "C", "\xc4\x8e" => "D", "\xc3\x89" => "E", "\xc4\x9a" => "E", "\xc3\x8d" => "I", "\xc4\xbd" => "L", "\xc4\xb9" => "L", "\xc5\x87" => "N", "\xc3\x93" => "O", "\xc3\x96" => "O", "\xc5\x90" => "O", "\xc3\x94" => "O", "\xc5\x98" => "R", "\xc5\x94" => "R", "\xc5\xa0" => "S", "\xc5\xa4" => "T", "\xc3\x9a" => "U", "\xc5\xae" => "U", "\xc3\x9c" => "U", "\xc5\xb0" => "U", "\xc3\x9d" => "Y", "\xc5\xbd" => "Z");
        $text = strtr($text, $utf8table);
        return $text;
    }

    function prepareLine($parLeftStr, $parRightStr, $parLength = 40) {
        $parLeftStr = $this->getSeo($parLeftStr);
        $parRightStr = $this->getSeo($parRightStr);

        if (strlen($parLeftStr) >= ($parLength - strlen($parRightStr))) {
            $parLeftStr = substr($parLeftStr, 0, ($parLength - strlen($parRightStr)) - 2);
        }

        $Lng = $parLength - strlen($parRightStr) - strlen($parLeftStr);

        $tempSpace = "";

        for ($i = 0; $i < $Lng; $i++)
            $tempSpace .= " ";

        $myString = chr(27) . "!" . chr(0) . "\n" . $parLeftStr . $tempSpace . $parRightStr;

        return $myString;
    }

    function prepareLinePdf($parLeftStr, $parRightStr, $parLength = 40) {
        $parLeftStr = $this->getSeo($parLeftStr);
        $parRightStr = $this->getSeo($parRightStr);

        if (strlen($parLeftStr) >= ($parLength - strlen($parRightStr))) {
            $parLeftStr = substr($parLeftStr, 0, ($parLength - strlen($parRightStr)) - 2);
        }

        $Lng = $parLength - strlen($parRightStr) - strlen($parLeftStr);

        $tempSpace = "";

        for ($i = 0; $i < $Lng; $i++)
            $tempSpace .= " ";

        $myString = "\n" . $parLeftStr . $tempSpace . $parRightStr;

        return $myString;
    }

    function prepareHighLine($parLeftStr, $parRightStr, $parLength = 48) {
        $parLeftStr = $this->getSeo($parLeftStr);
        $parRightStr = $this->getSeo($parRightStr);

        if (strlen($parLeftStr) >= ($parLength - strlen($parRightStr))) {
            $parLeftStr = substr($parLeftStr, 0, ($parLength - strlen($parRightStr)) - 2);
        }

        $Lng = $parLength - strlen($parRightStr) - strlen($parLeftStr);

        $tempSpace = "";

        for ($i = 0; $i < $Lng; $i++)
            $tempSpace .= " ";

        $myString = "\n" . chr(27) . "!" . chr(17) . $parLeftStr . $tempSpace . $parRightStr . chr(27) . "!" . chr(0);

        return $myString;
    }

    function prepareHeaderPdf($par_DocumentNumber = "") {

        $header = "\n"; //chr(27) . chr(116) . chr(18);
//for($i=0;$i<255;$i++)
//{
//    $header .= chr(27) . "!" . chr($i) . "$i - ABC\n";
//}
        $blueticket = blueticket_forms_db::get_instance();
        $blueticket->query("SELECT * FROM invoices WHERE InvoiceNumber='$par_DocumentNumber'");
        $mydocument = $blueticket->row();

        $typeid = $mydocument['TypeID'];
        $customer = $mydocument['CustomerDescription'];
        $deliveryid = $mydocument['DeliveryTypeID'];
        $paymentid = $mydocument['PaymentTypeID'];
        $date = date('d.m.Y', strtotime($mydocument['InvoiceDateTime']));

        $blueticket->query("SELECT * FROM document_types WHERE ID='$typeid'");
        $mytype = $blueticket->row();

        $docname = $mytype['Description'];

        $blueticket->query("SELECT * FROM delivery_types WHERE ID='$deliveryid'");
        $mydelivery = $blueticket->row();

        $delivery = $mydelivery['Description'];

        $blueticket->query("SELECT * FROM payment_types WHERE ID='$paymentid'");
        $mypayment = $blueticket->row();
        $payment = $mypayment['PaymentTypeName'];

        $header .= $this->prepareLinePdf("", "========================================");
        $header .= $this->prepareLinePdf("$docname cislo:", $par_DocumentNumber);
        $header .= $this->prepareLinePdf("", "========================================");
        $header .= $this->prepareLinePdf("Partner:", "");
        $header .= $this->getSeo("\n" . $customer);
        $header .= $this->prepareLinePdf("", "========================================");
        $header .= $this->prepareLinePdf("Datum vystavenia:", $date);
        $header .= $this->prepareLinePdf("Datum dodania:", $date);
        $header .= $this->prepareLinePdf("", "========================================");
        $header .= $this->prepareLinePdf("Forma uhrady:", $payment);
        $header .= $this->prepareLinePdf("Sposob dodania:", $delivery);
        $header .= $this->prepareLinePdf("", "========================================");
//$header .=  prepareLine(" ", " ");

        return $header;
    }

    function prepareHeader($par_DocumentNumber = "") {

        $header = "\n"; //chr(27) . chr(116) . chr(18);
//for($i=0;$i<255;$i++)
//{
//    $header .= chr(27) . "!" . chr($i) . "$i - ABC\n";
//}
        $blueticket = blueticket_forms_db::get_instance();
        $blueticket->query("SELECT * FROM invoices WHERE InvoiceNumber='$par_DocumentNumber'");
        $mydocument = $blueticket->row();

        $typeid = $mydocument['TypeID'];
        $customer = $mydocument['CustomerDescription'];
        $deliveryid = $mydocument['DeliveryTypeID'];
        $paymentid = $mydocument['PaymentTypeID'];
        $date = date('d.m.Y', strtotime($mydocument['InvoiceDateTime']));

        $blueticket->query("SELECT * FROM document_types WHERE ID='$typeid'");
        $mytype = $blueticket->row();

        $docname = $mytype['Description'];

        $blueticket->query("SELECT * FROM delivery_types WHERE ID='$deliveryid'");
        $mydelivery = $blueticket->row();

        $delivery = $mydelivery['Description'];

        $blueticket->query("SELECT * FROM payment_types WHERE ID='$paymentid'");
        $mypayment = $blueticket->row();
        $payment = $mypayment['PaymentTypeName'];

        $header .= $this->prepareLine("", "========================================");
        $header .= $this->prepareHighLine("$docname cislo:", $par_DocumentNumber);
        $header .= $this->prepareLine("", "========================================");
        $header .= $this->prepareLine("Dodavatel:", "");
        $header .= $this->prepareLine("JD SLOVAKIA s.r.o.", "");
        $header .= $this->prepareLine("K. Nováckeho 8/7", "");
        $header .= $this->prepareLine("971 01", "Prievidza");
        $header .= $this->prepareLine("ICO:", "36 820 989");
        $header .= $this->prepareLine("DIC/IC-DPH:", "SK2022449814");
        $header .= $this->prepareLine("IBAN:", "SK96 0200 0000 0030 9103 4751");
        $header .= $this->prepareLine("SWIFT:", "SUBASKBX");
        $header .= $this->prepareLine("", "========================================");
        $header .= $this->prepareLine("Partner:", "");
        $header .= $this->getSeo("\n" . $customer);
//        if ($par_Desk != '-') {
//            $result = getQuery("SELECT * FROM partners WHERE ID='$par_Desk'");
//            $row = mysql_fetch_assoc($result);
//            mysql_free_result($result);
//            $header .= prepareLine("Cislo zakaznika:", $par_Desk);
//            $header .= prepareLine($row['Name'], "");
//            $header .= prepareLine($row['Address'], "");
//            $header .= prepareLine($row['ZIP'], $row['City']);
//            $header .= prepareLine("ICO:", $row['PID']);
//            $header .= prepareLine("DIC:", $row['VAT']);
//            $header .= prepareLine("IC-DPH:", $row['VATID']);
//        } else
//            $header .= prepareLine("Cislo zakaznika:", $par_Desk);
        $header .= $this->prepareLine("", "========================================");
        $header .= $this->prepareLine("Datum vystavenia:", $date);
        $header .= $this->prepareLine("Datum dodania:", $date);
        $header .= $this->prepareLine("", "========================================");
        $header .= $this->prepareLine("Forma uhrady:", $payment);
        $header .= $this->prepareLine("Sposob dodania:", $delivery);
        $header .= $this->prepareLine("", "========================================");
//$header .=  prepareLine(" ", " ");

        return $header;
    }

    function cut() {
        return chr(29) . chr(86) . chr(1);
    }

    function prepareFooter($parTotal, $parTotalWOTax = 0) {
        $parTotalWOTax = number_format($parTotal / 1.2, 2);
//$footer =  prepareLine(" ", " ");
        $footer .= $this->prepareLine("", "========================================");
        $footer .= $this->prepareLine("Spolu bez DPH:", number_format($parTotalWOTax, 2) . " EUR");
        $footer .= $this->prepareLine("DPH 20%:", number_format($parTotal - $parTotalWOTax, 2) . " EUR");
        $footer .= $this->prepareLine("", "========================================");
//$footer .=  prepareLine(" ", " ");
        $footer .= $this->prepareHighLine("Celkom s DPH:", number_format($parTotal, 2) . " EUR");
//$footer .=  prepareLine(" ", " ");
        $footer .= $this->prepareLine("", "========================================");
        $footer .= $this->prepareLine(" ", " ");
        $footer .= $this->prepareLine(" ", " ");
        $footer .= $this->prepareLine(" ", " ");
        $footer .= $this->prepareLine(" ", " ");
        $footer .= $this->prepareLine(" ", " ");
        $footer .= $this->prepareLine(" ", " ");
        $footer .= "\n";
        $footer .= $this->cut();
        return $footer;
    }

    function getPrinter($par_DocumentNumber) {
        $blueticket = blueticket_forms_db::get_instance();
        $blueticket->query("SELECT * FROM invoices WHERE InvoiceNumber='$par_DocumentNumber'");
        $mydocument = $blueticket->row();

        $typeid = $mydocument['TypeID'];

        $blueticket->query("SELECT * FROM document_types WHERE ID='$typeid'");
        $mytype = $blueticket->row();

        return $mytype['PrinterAddress'];
    }

    function print_document($par_DocumentNumber) {
        $serialorder = new phpSerial();
        $serialorder->deviceSet($this->getPrinter($par_DocumentNumber));

//        $blueticket = new blueticket_forms_db();
        $blueticket = blueticket_forms_db::get_instance();
        $blueticket->query("SELECT * FROM invoices_items WHERE InvoiceNumber='$par_DocumentNumber'");
        $mydocumentitems = $blueticket->result();
        $total = 0;
        $total_wo_tax = 0;

        $message = $this->prepareHeader($par_DocumentNumber);

        foreach ($mydocumentitems as $row) {
            $message .= $this->prepareLine($row['Name'], "");
            $message .= $this->prepareLine("DPH %:" . number_format($row['TAXPercent'], 2), "Mnoz.:" . number_format($row['Quantity'], 2) . " ks x JC:" . number_format($row['Price'], 2));
            $subtotal = number_format($row['Price'] * $row['Quantity'], 2);
            $total = $subtotal + $total;
            $total_wo_tax = $total_wo_tax + ($subtotal / (1 + ($row['TaxPercent'] / 100)));
            $message .= $this->prepareLine("Spolu za polozku:", number_format($subtotal, 2));
            //getQuery("DELETE FROM print_kitchen WHERE ID=" . $row["ID"]);
        }

        $message .= $this->prepareFooter($total, $total_wo_tax);

        $serialorder->sendMessage($message);
    }

}

class InvoicePDF extends TCPDF {

    public function Header() {
        $bt = new blueticket_objects();

        $this->SetY(15);
        $this->SetFont('freesans', 'B', 8);
//$this->Cell(0, 10, '<em>' . $bt->getTranslatedText('LicenseOwner') . '</em>', 0, false, 'C', FALSE, '', 1);
        $this->MultiCell(175, 10, nl2br($bt->getTranslatedText('LicenseOwner')), 0, 'C', 0, 1, '', '', true, null, true);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('freesans', 'I', 8);
        $this->Cell(0, 10, 'Generované systémom blueticket™ (http://www.blueticket.eu)', 0, false, 'C');
    }

    public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 10, $fontstyle = '', $align = 'L') {
        $this->SetXY($x + 20, $y); // 20 = margin left
        $this->SetFont('freesans', $fontstyle, $fontsize);
        $this->Cell($width, $height, $textval, 0, false, $align);
    }

    function prepareHeader($par_DocumentNumber = "") {

        $print = new printDocument();

        $header = $print->prepareHeaderPdf($par_DocumentNumber);

        $this->SetY(35);
        $this->SetFont('freesans', 'B', 8);

        $this->MultiCell(85, 20, nl2br($header), 0, 'L', 0, 1, '120', '', true, null, true);
    }

    public function CreateInvoice($par_DocumentNumber) {
        //if (isset($_SESSION['selected_partner']) && $_SESSION['selected_partner'] > 0) {
        $bt = new blueticket_objects();

// create a PDF object
        $pdf = new InvoicePDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document (meta) information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('blueticket s.r.o.');
        $pdf->SetTitle('blueticket document');
        $pdf->SetSubject('Document');
        $pdf->SetKeywords('PDF');

// add a page
        $pdf->AddPage();
//
        $blueticket = blueticket_forms_db::get_instance();
//
        $blueticket->query("SELECT * FROM invoices_items WHERE InvoiceNumber='$par_DocumentNumber'");
        $myitems = $blueticket->result();
//
//        $myrow = $blueticket->row();
//
//        $partner_id = $myrow['ID'];
//
//// create address box
//        $pdf->CreateTextBox($myrow['Name'], 0, 55, 80, 10, 10, 'B');
//        $pdf->CreateTextBox($myrow['Address'], 0, 60, 80, 10, 10);
//        $pdf->CreateTextBox($myrow['ZIP'] . ' ' . $myrow['City'], 0, 65, 80, 10, 10);
//        $pdf->CreateTextBox($myrow['State'], 0, 70, 80, 10, 10);
//
//// invoice title / number
//        if ($par_purchase == TRUE)
//            $pdf->CreateTextBox($bt->getTranslatedText('PurchaseCard') . ' #201012345', 0, 90, 120, 20, 16);
//        else
//            $pdf->CreateTextBox($bt->getTranslatedText('IssueCard') . ' #201012345', 0, 90, 120, 20, 16);
// date, order ref
        $pdf->prepareHeader($par_DocumentNumber);
        //$pdf->CreateTextBox($bt->getTranslatedText('Date') . ': ' . date('d-m-Y'), 0, 100, 0, 10, 10, '', 'R');
//$pdf->CreateTextBox('Order ref.: #6765765', 0, 105, 0, 10, 10, '', 'R');
//items
// list headers
        $pdf->CreateTextBox($bt->getTranslatedText('Quantity'), 0, 120, 20, 10, 10, 'B', 'C');
        $pdf->CreateTextBox($bt->getTranslatedText('Name'), 20, 120, 90, 10, 10, 'B');
        $pdf->CreateTextBox($bt->getTranslatedText('Price'), 110, 120, 30, 10, 10, 'B', 'R');
        $pdf->CreateTextBox($bt->getTranslatedText('Subtotal'), 140, 120, 30, 10, 10, 'B', 'R');

        $pdf->Line(20, 129, 195, 129);

        $currY = 128;
        $total = 0;
        foreach ($myitems as $row) {
            $btdb = blueticket_forms_db::get_instance();

            $price = $row['Price'];

            $btdb->query("SELECT * FROM items WHERE RegistrationNumber='" . $row['Barcode'] . "'");
            $myrow = $btdb->row();
            $tax = $myrow['TaxID'];
            $type = $myrow['TypeID'];
            $btdb->query("SELECT * FROM units WHERE ID='" . $myrow['UnitID'] . "'");
            $myrow = $btdb->row();

            $unit = $myrow['Name'];

            $btdb->query("SELECT * FROM taxes WHERE ID='$tax'");
            $myrow = $btdb->row();

            $tax = $myrow['Value'];

            //$btdb->query("INSERT INTO current_accounting(CartNr,RegistrationNumber,Name,Price,Unit,Tax,Qty,TypeID,Printed) VALUES('$partner_id','" . $row['reg'] . "', '" . $row['name'] . "',$price,'$unit',$tax, " . $row['qty'] . ", $type, 0)");
            $pdf->CreateTextBox($row['Quantity'], 0, $currY, 20, 10, 10, '', 'C');
            $pdf->CreateTextBox($row['Barcode'] . ' - ' . $row['Name'], 20, $currY, 90, 10, 10, '');
            $pdf->CreateTextBox(number_format($row['Price'], 2, '.', ' ') . ' €', 110, $currY, 30, 10, 10, '', 'R');
            $amount = $row['Quantity'] * $row['Price'];
            $pdf->CreateTextBox(number_format($amount, 2, '.', ' ') . ' €', 140, $currY, 30, 10, 10, '', 'R');
            $currY = $currY + 5;
            $total = $total + $amount;
        }
        $pdf->Line(20, $currY + 4, 195, $currY + 4);

//footer
//
// output the total row
        $pdf->CreateTextBox($bt->getTranslatedText('Total'), 5, $currY + 5, 135, 10, 10, 'B', 'R');
        $pdf->CreateTextBox(number_format($total, 2, '.', ' ') . ' €', 140, $currY + 5, 30, 10, 10, 'B', 'R');

// some payment instructions or information
        $pdf->setXY(20, $currY + 30);
        $pdf->SetFont('freesans', '', 10);
        $pdf->MultiCell(175, 10, $bt->getTranslatedText('InvoiceFooter'), 0, 'L', 0, 1, '', '', true, null, true);

//Close and output PDF document
        $pdf->Output('doc_' . $par_DocumentNumber . '.pdf', 'D');

//        } else {
//            header('location: index.php?report=partners');
//        }
    }

}

class PDFPrinter extends TCPDF {

    public function CreateTextBox($textval, $x = 0, $y, $width = 0, $height = 10, $fontsize = 4, $fontstyle = '', $align = 'L') {
        $this->SetXY($x, $y);
        $this->SetFont('freesans', $fontstyle, $fontsize);
        $this->Cell($width, $height, $textval, 0, false, $align);
    }

    public function CreateBarcode($code, $x, $y, $w, $h, $text = false) {
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => $text,
            'font' => 'courier',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $this->write1DBarcode($code, 'C39', $x, $y, $w, $h, 0.8, $style, 'N');
    }

    public function CreateQRCode($code, $x, $y, $w, $h) {
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'courier',
            'fontsize' => 8,
            'stretchtext' => 4
        );

        $this->write2DBarcode($code, 'QRCODE', $x, $y, $w, $h, $style, 'N');
    }

}

class blueticket_objects {

    public $lang = 'sk';

    function __construct() {
//$this->lang = 'sk';
    }

    public function generateMainScreen() {
//        $form = new Form("form-main");
//        $button = new Element\Button("Číselníky");
//        $form->addElement($button);
//        $form->render();
    }

    public function getTranslatedText($par_Text, $par_lang = 'sk') {
        $par_lang = $this->lang;

        return $par_Text;
    }

    function generateForms() {
        $form = blueticket_forms::get_instance();

        $form->table("forms");

        $form->nested_table($this->getTranslatedText('form_fields'), 'form_name', 'form_fields', 'form_name');

        return $form->render();
    }

    function generateUsers() {
        $form = blueticket_forms::get_instance();

        //$form= new blueticket_forms();

        $form->table("tbl_user");
        $form->default_tab("tbl_user");
        $form->columns("registration_date, active, name, surname, email, state, password, lang, premium_expiry_date, kennels, owners, handlers, dogs");
        $form->order_by('id', 'DESC');


        $form->subselect('kennels', 'SELECT COUNT(*) FROM tbl_userkennel WHERE user_id = {id}');
        $form->subselect('owners', 'SELECT COUNT(*) FROM tbl_userowner WHERE user_id = {id}');
        $form->subselect('handlers', 'SELECT COUNT(*) FROM tbl_userhandler WHERE user_id = {id}');
        $form->subselect('dogs', 'SELECT COUNT(*) FROM tbl_dogs WHERE user_id = {id}');

        $form->highlight_row('active', '=', 0, '#FFD6D6');
        $form->highlight('kennels', '>', 0, '#B4E274');
        $form->highlight('kennels', '=', 0, '#EDEBE4');
        $form->highlight('owners', '>', 0, '#B4E274');
        $form->highlight('owners', '=', 0, '#EDEBE4');
        $form->highlight('handlers', '>', 0, '#B4E274');
        $form->highlight('handlers', '=', 0, '#EDEBE4');
        $form->highlight('dogs', '>', 0, '#B4E274');
        $form->highlight('dogs', '=', 0, '#EDEBE4');

        $form->sum('active,kennels,owners,handlers,dogs');

        $this->generateKennels($form);
        $this->generateOwners($form);
        $this->generateHandlers($form);
        $this->generateDogs($form);
        $this->generatePayments($form);

        return $form->render();
    }

    function generateKennels($form = NULL) {
        if ($form != NULL) {
            $kennel = $form->nested_table($this->getTranslatedText("Kennels"), "id", "tbl_userkennel", "user_id");
            $kennel->order_by('id', 'DESC');
        } else {
            $kennel = blueticket_forms::get_instance();
            $kennel->table("tbl_userkennel");
            $kennel->order_by('id', 'DESC');
            $this->generateDogs($kennel);

            return $kennel->render();
        }
    }

    function generateMessages() {
        $form = blueticket_forms::get_instance();
        
        $form->table("tbl_messages");
        $form->order_by('id', 'DESC');
        
        return $form->render();
    }

    function generateOwners($form = NULL) {
        if ($form != NULL) {
            $owner = $form->nested_table($this->getTranslatedText("Owners"), "id", "tbl_userowner", "user_id");
            $owner->order_by('id', 'DESC');
        } else {
            $owner = blueticket_forms::get_instance();
            $owner->table("tbl_userowner");
            $owner->order_by('id', 'DESC');
            $this->generateDogs($owner);

            return $owner->render();
        }
    }

    function generateHandlers($form = NULL) {
        if ($form != NULL) {
            $handler = $form->nested_table($this->getTranslatedText("Handlers"), "id", "tbl_userhandler", "user_id");
            $handler->order_by('id', 'DESC');
        } else {
            $handler = blueticket_forms::get_instance();
            $handler->table("tbl_userhandler");
            $handler->order_by('id', 'DESC');
            return $handler->render();
        }
    }

    function generateDogs($form = NULL) {
        if ($form != NULL) {
            $dog = $form->nested_table($this->getTranslatedText("Dogs"), "id", "tbl_dogs", "user_id");
            $dog->order_by('id', 'DESC');
        } else {
            $dog = blueticket_forms::get_instance();
            $dog->table("tbl_dogs");
            $dog->order_by('id', 'DESC');
            return $dog->render();
        }
    }

    function generatePayments($form = NULL) {
        if ($form != NULL) {
            $payment = $form->nested_table($this->getTranslatedText("Payments"), "id", "tbl_payments", "user_id");
            $payment->order_by('id', 'DESC');
        } else {
            $payment = blueticket_forms::get_instance();
            $payment->table("tbl_payments");
            $payment->order_by('id', 'DESC');
            return $payment->render();
        }
    }
    
    function generateTimeline()
    {
            $timeline = blueticket_forms::get_instance();
            $timeline->table("tbl_timeline");
            $timeline->order_by('id', 'DESC');
            return $timeline->render();
    }

    function generateMenu() {
        $return = '<div style="width:100%; height:50px;padding-left:5px">';

        $return .= '<a href="?report=users" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Users</a>';
        $return .= '<a href="?report=kennels" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Kennels</a>';
        $return .= '<a href="?report=owners" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Owners</a>';
        $return .= '<a href="?report=handlers" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Handlers</a>';
        $return .= '<a href="?report=dogs" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Dogs</a>';
        $return .= '<a href="?report=payments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Payments</a>';
        $return .= '<a href="?report=messages" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Messages</a>';
        $return .= '<a href="?report=timeline" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Timeline</a>';
        $return .= '<a href="?report=forms" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Forms</a>';
//        $return .= '<a href="?report=docs" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Doklady</a>';
//        $return .= '<a href="?report=movements" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Pohyby</a>';
//        $return .= '<a href="?report=payments" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Platby</a>';
//        $return .= '<a href="?report=partners" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Partneri</a>';
//        $return .= '<a href="?report=doctypes" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Typy dokladov</a>';
//        $return .= '<a href="?report=desks" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Rozlozenia</a>';
//        $return .= '<a href="?report=groups" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Skupiny</a>';
//        $return .= '<a href="?report=units" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Jednotky</a>';
//        $return .= '<a href="?report=trans" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Preklad</a>';
//        $return .= '<a href="?report=users" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Uzivatelia</a>';
//        $return .= '<a href="?report=logout" class="btn btn-primary" style="width:100px; height:30px; margin-top:5px; margin-right:5px">Odhlásiť</a>';

        $return .= '</div>';

        $return .= '<div style="clear:both"></div>';

        return $return;
    }

}
