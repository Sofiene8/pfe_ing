<?php

class SJB_Payment_EditInvoice extends SJB_Function
{


    public function isAccessible()
    {

        $allow = false;
        $invoiceID = SJB_Request::getVar('sid', false);
        $passedParametersViaUri = SJB_Request::getVar('passed_parameters_via_uri', false);
        if (!$invoiceID && $passedParametersViaUri) {
            $passedParametersViaUri = SJB_UrlParamProvider::getParams();
            if (isset($passedParametersViaUri[0])) {
                $invoiceID = $passedParametersViaUri[0];
            }
        }
        if (!is_numeric($invoiceID)) {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            exit();
        }
        if (SJB_UserManager::isUserLoggedIn()) {
            $currentUser = SJB_UserManager::getCurrentUser();
            if ($invoiceID) {

                $invoice = SJB_InvoiceManager::getObjectBySID($invoiceID);

                $userSID = $invoice->getPropertyValue('user_sid');
                if ($userSID == $currentUser->getSID()) {
                    $allow = true;
                }
            }
        }
        return $allow;
    }



    public function execute()
    {
        $tp = SJB_System::getTemplateProcessor();

        if (!SJB_UserManager::isUserLoggedIn()) {
            $errors['NOT_LOGGED_IN'] = true;
            $tp->assign("ERRORS", $errors);
            $tp->display("error.tpl");
            return;
        }
        $currentUser = SJB_UserManager::getCurrentUser();

        $template = 'edit_invoice.tpl';
        $errors = [];
        $invoiceErrors = [];

        $invoiceSID = SJB_Request::getVar('sid', false);


        $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($invoiceSID);
        if (empty($invoiceInfo)) {
            echo SJB_System::executeFunction('miscellaneous', '404_not_found');
            return;
        }
        if (SJB_Request::getVar('download_pdf') == 1) {
            // Get invoice ID from POST or GET
            $invoiceSID = $_POST['invoice_sid'] ?? $_POST['sid'] ?? $invoiceSID;

            if ($invoiceSID) {
                $this->downloadInvoicePDF($invoiceSID);
                exit;
            } else {
                echo "Invoice ID not provided";
                exit;
            }
        }
        $product_info = [];
        if (array_key_exists('custom_info', $invoiceInfo['items'])) {
            $product_info = $invoiceInfo['items']['custom_info'];
        }
        $invoiceInfo = array_merge($invoiceInfo, $_REQUEST);
        $invoiceInfo['items']['custom_info'] = $product_info;
        $invoice = new SJB_Invoice($invoiceInfo);
        $invoice->setSID($invoiceSID);
        $userSID = $invoice->getPropertyValue('user_sid');
        $user = SJB_UserManager::getObjectBySID($userSID);
        $taxInfo = $invoice->getPropertyValue('tax_info');
        $products = [];
        if ($user) {
            $productsSIDs = SJB_ProductsManager::getProductsIDsByUserGroupSID($user->getUserGroupSID(), true);
            foreach ($productsSIDs as $key => $productSID) {
                $products[$key] = SJB_ProductsManager::getProductInfoBySID($productSID);
            }
        }



        $addForm = new SJB_Form($invoice);
        $addForm->registerTags($tp);
        $total = $invoice->getPropertyValue('total') + 1.00;
        $total = number_format($total, 2, '.', '');
        $status = $invoice->getPropertyValue('status');
        $tp->assign('total', $total);
        $tp->assign('status', $status);
        $tp->assign('totalWords', $this->convertNumberToFrenchWords($total));
        $tp->assign('products', $products);
        $tp->assign('itemsname', $invoice->getProductNames());
        $tp->assign('invoice_sid', $invoiceSID);
        $tp->assign('invoice_hash', $invoice->getHash());
        $tp->assign('invoice_number', $this->generateInvoiceNumber($invoice));
        $tp->assign('include_tax', $invoiceInfo['include_tax']);
        $tp->assign('user', SJB_UserManager::createTemplateStructureForUser($user));
        $tp->assign('tax', $taxInfo);

        $tp->assign('errors', array_merge($errors, $invoiceErrors));
        $tp->display($template);
    }

    /**
     * Génère un numéro de facture selon le format: #MMJJNUM/AAAA
     * Exemple: #010201/2026 pour la première facture du 02/01/2026
     * 
     * Format: #MMJJNUM/AAAA
     * - MM: Mois (2 chiffres)
     * - JJ: Jour (2 chiffres)
     * - NUM: Numéro séquentiel du jour (2 chiffres, commence à 01)
     * - AAAA: Année (4 chiffres)
     */
    public function generateInvoiceNumber($invoice)
    {


        $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($invoice->getSID());
        $date = isset($invoiceInfo['date']) ? $invoiceInfo['date'] : date('Y-m-d H:i:s');
        $dateOnly = date('Y-m-d', strtotime($date));
        $mois = date('m', strtotime($dateOnly));
        $jour = date('d', strtotime($dateOnly));
        $annee = date('Y', strtotime($dateOnly));


        $invoiceSID = $invoice->getSID();

        $query = "SELECT COUNT(*) as count 
                  FROM invoices 
                  WHERE DATE(date) = ?s
                  AND sid <= ?n and status=?s";

        $result = SJB_DB::query($query, $dateOnly, $invoiceSID,'Paid');

        $count = 0;
        if (!empty($result) && is_array($result)) {
            $row = $result[0];
            $count = isset($row['count']) ? (int)$row['count'] : 0;
        }

        // 4. Générer le numéro
        $numero = str_pad($count, 2, '0', STR_PAD_LEFT);
        return "#{$annee}{$mois}{$jour}{$numero}";
    }

    /**
     * Simple number to French words converter for Tunisian Dinar (dinars and millimes)
     * 1 Dinar = 1000 millimes
     * Example: 345,10 DT = 345 dinars et 100 millimes
     * @param mixed $number The number to convert (can be numeric or string like "345,10")
     * @return string The number in French words
     */
    public function convertNumberToFrenchWords($number)
    {
        // If it's a string with comma, convert to float
        if (is_string($number)) {
            // Remove any non-numeric characters except comma and dot
            $number = preg_replace('/[^0-9,\.]/', '', $number);
            // Replace comma with dot for proper float conversion
            $number = str_replace(',', '.', $number);
        }

        // Convert to float
        $number = floatval($number);

        // Extract dinars (integer part) and millimes (decimal part * 1000)
        $dinars = floor($number);
        $centimes = round(($number - $dinars) * 100); // Get centimes (0.10 → 10)
        $millimes = $centimes * 10; // Convert to millimes (10 → 100)

        if ($dinars == 0 && $millimes == 0) {
            return 'Zéro dinars';
        }

        $frenchWords = [
            0 => 'zéro',
            1 => 'un',
            2 => 'deux',
            3 => 'trois',
            4 => 'quatre',
            5 => 'cinq',
            6 => 'six',
            7 => 'sept',
            8 => 'huit',
            9 => 'neuf',
            10 => 'dix',
            11 => 'onze',
            12 => 'douze',
            13 => 'treize',
            14 => 'quatorze',
            15 => 'quinze',
            16 => 'seize',
            17 => 'dix-sept',
            18 => 'dix-huit',
            19 => 'dix-neuf',
            20 => 'vingt',
            30 => 'trente',
            40 => 'quarante',
            50 => 'cinquante',
            60 => 'soixante',
            70 => 'soixante-dix',
            80 => 'quatre-vingts',
            90 => 'quatre-vingt-dix',
            100 => 'cent',
            200 => 'deux cents',
            300 => 'trois cents',
            400 => 'quatre cents',
            500 => 'cinq cents',
            600 => 'six cents',
            700 => 'sept cents',
            800 => 'huit cents',
            900 => 'neuf cents',
            1000 => 'mille'
        ];

        // Function to convert integer to French words (helper)
        $convertInteger = function ($num) use (&$convertInteger, $frenchWords) {
            if ($num == 0) return '';
            if (isset($frenchWords[$num])) return $frenchWords[$num];

            if ($num < 100) {
                $tens = floor($num / 10) * 10;
                $units = $num % 10;
                if ($units == 0) {
                    return $frenchWords[$tens];
                } elseif ($tens == 70 || $tens == 90) {
                    return $frenchWords[$tens - 10] . '-' . $frenchWords[$units + 10];
                } else {
                    return $frenchWords[$tens] . '-' . $frenchWords[$units];
                }
            } elseif ($num < 1000) {
                $hundreds = floor($num / 100) * 100;
                $remainder = $num % 100;
                if ($remainder == 0) {
                    return $frenchWords[$hundreds];
                } else {
                    return $frenchWords[$hundreds] . ' ' . $convertInteger($remainder);
                }
            } elseif ($num < 10000) {
                $thousands = floor($num / 1000);
                $remainder = $num % 1000;
                if ($thousands == 1) {
                    $result = 'mille';
                } else {
                    $result = $frenchWords[$thousands] . ' mille';
                }
                if ($remainder > 0) {
                    $result .= ' ' . $convertInteger($remainder);
                }
                return $result;
            } else {
                return number_format($num, 0, ',', ' ');
            }
        };

        // Convert dinars
        $dinarsText = '';
        if ($dinars > 0) {
            $dinarsText = $convertInteger($dinars);
        }

        // Convert millimes
        $millimesText = '';
        if ($millimes > 0) {
            $millimesText = $convertInteger($millimes);
        }

        // Build result
        $result = '';
        if (!empty($dinarsText)) {
            $result = ucfirst(trim($dinarsText)) . ($dinars == 1 ? ' dinar' : ' dinars');
        } else {
            $result = 'Zéro dinars';
        }

        if (!empty($millimesText)) {
            $result .= ' et ' . lcfirst(trim($millimesText)) . ' millimes';
        }

        return $result;
    }
    private function getInvoicePDFPath($invoiceSID, $invoiceNumber, $invoiceDate)
    {
        // Extract date components
        $date = strtotime($invoiceDate);
        $year = date('Y', $date);
        $month = date('m', $date);
        $day = date('d', $date);

        // Clean invoice number for filename
        $cleanInvoiceNumber = str_replace(['#', '/'], '', $invoiceNumber);

        // Build the path
        $baseDir = SJB_BASE_DIR . "files/invoices/{$year}/{$month}/{$day}/";
        $filename = "facture_{$cleanInvoiceNumber}.pdf";

        return $baseDir . $filename;
    }

    public function downloadInvoicePDF($invoiceSID)
    {
        if (!$invoiceSID || !is_numeric($invoiceSID)) {
            header('HTTP/1.1 400 Bad Request');
            exit('Invalid invoice SID');
        }

        $currentUser = SJB_UserManager::getCurrentUser();
        $invoice = SJB_InvoiceManager::getObjectBySID($invoiceSID);

        // Verify user has access to this invoice
        $userSID = $invoice->getPropertyValue('user_sid');
        if ($userSID != $currentUser->getSID()) {
            echo "Access denied";
            exit;
        }

        $invoiceInfo = SJB_InvoiceManager::getInvoiceInfoBySID($invoiceSID);
        $invoiceNumber = $this->generateInvoiceNumber($invoice);

        $pdfPath = $this->getInvoicePDFPath($invoiceSID, $invoiceNumber, $invoiceInfo['date']);

             if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
            
            // Generate new PDF
            // IMPORTANT: Use the ORIGINAL invoice date, not current date
            $user = SJB_UserManager::getObjectBySID($userSID);
            $taxInfo = $invoice->getPropertyValue('tax_info');
            $htmlContent = $this->generateInvoiceHTML($invoiceInfo, $user, $taxInfo, $invoiceNumber);
            
            // Generate PDF with original invoice date
            $pdfPath = $this->generateAndSavePDF($htmlContent, $invoiceNumber, $invoiceInfo['date']);
        
        
        // Serve the PDF
        $this->serveExistingPDF($pdfPath, $invoiceNumber);
    }


    public function generateInvoiceHTML($invoiceInfo, $user, $taxInfo, $invoiceNumber)
    {
        $userInfo = SJB_UserManager::createTemplateStructureForUser($user);
        $date = date('d/m/Y', strtotime($invoiceInfo['date']));
        $subtotal = isset($invoiceInfo['sub_total']) ? $invoiceInfo['sub_total'] : 0;
        $total = isset($invoiceInfo['total']) ? $invoiceInfo['total'] + 1.00 : 0;
        $taxAmount = isset($taxInfo['tax_amount']) ? $taxInfo['tax_amount'] : 0;

        // Format currency
        $subtotalFormatted = number_format($subtotal, 2, ',', ' ') . ' DT';
        $totalFormatted = number_format($total, 2, ',', ' ') . ' DT';
        $taxAmountFormatted = number_format($taxAmount, 2, ',', ' ') . ' DT';
        $invoice = new SJB_Invoice($invoiceInfo);



        ob_start();

?>
        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <style>
                body {
                    font-family: helvetica;
                    font-size: 11px;
                    color: #000;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                }

                .header td {
                    vertical-align: top;
                }

                .company {
                    text-align: right;
                    font-size: 10px;
                }

                .title {
                    font-size: 20px;
                    color: #ee810b;
                    text-align: right;
                    padding: 10px 0;
                }

                .client {
                    background: #f5f5f5;
                    padding: 6px;
                    font-size: 10px;
                }

                .items th {
                    background: #ee810b;
                    color: #fff;
                    padding: 6px;
                    font-size: 10px;
                }

                .items td {
                    padding: 6px;
                    border-bottom: 1px solid #ccc;
                }

                .totals td {
                    padding: 5px;
                    font-size: 10px;
                }
            </style>
        </head>

        <body>

            <table class="header">
                <tr>
                    <td width="40%">
                        <img src="/templates/Jobsquare/assets/images/logo-jobsquare.jpg" class="text-left">
                    </td>
                    <td width="60%" class="company">
                        <b>Jobsquare.ma</b><br>
                        Adresse : Casablanca, Maroc<br>
                       
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border-bottom:0.3px solid #bbb; height:1px;"></td>
                </tr>
            </table>
            <div class="title">
                Facture
                <span style="font-size:14px; font-weight: normal;">
                    <?php echo $invoiceNumber; ?>
                </span><br>

            </div>
            <div style="text-align:right; font-size:10px;">
                Date : <?php echo $date; ?>
            </div>

            <table class="client">
                <tr>
                    <td>
                        <b>Client :</b> <?php echo htmlspecialchars($userInfo['CompanyName'] ?? $userInfo['FullName']); ?><br>
                        <b>Adresse :</b> <?php echo htmlspecialchars($userInfo['GooglePlace'] ?? ''); ?><br>
                        <b>MF :</b> <?php echo htmlspecialchars($userInfo['CommercialRegister'] ?? ''); ?>
                    </td>
                </tr>
            </table>

            <br>
            <div style="margin-top: 20px; margin-bottom: 20px;">
                <table border="0" cellpadding="5" cellspacing="0" style="width: 650px; border-collapse: collapse;" class="items">
                    <tr style="background-color:#ee810b; color:#ffffff;">
                        <th align="right" width="65%" style="border: 1px solid #ee810b; padding: 6px;">Désignation</th>
                        <th align="right" width="15%" style="border: 1px solid #ee810b; padding: 6px;">Montant HT (DT)</th>
                    </tr>

                    <tr>
                        <td style="border: 1px solid #bbbbbb; padding: 8px;">
                            <b> <?php echo htmlspecialchars($invoice->getProductNames()); ?></b>
                        </td>
                        <td align="right" style="border: 1px solid #bbbbbb; padding: 8px;">
                            <?php echo $subtotalFormatted; ?>
                        </td>
                    </tr>
                </table>



                <table class="totals" style="width: 650px; border-collapse: collapse;" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="51%" valign="middle" style="text-align: right; height: 35px; line-height: 35px; "></td>
                        <td width="18%" valign="middle" style="text-align: center; height: 35px; line-height: 35px;">Total HT</td>
                        <td width="11%" valign="middle" style="border: 1px solid #bbb; text-align: center; height: 35px; line-height: 35px;"><?php echo $subtotalFormatted; ?></td>
                    </tr>
                    <?php if ($taxAmount > 0): ?>
                        <tr>
                            <td width="51%" valign="middle" style="text-align: right; height: 35px; line-height: 35px;"></td>
                            <td width="18%" valign="middle" style="text-align: center; height: 35px; line-height: 35px; ">TVA (19%)</td>
                            <td width="11%" valign="middle" style="border: 1px solid #bbb; text-align: center; height: 35px; line-height: 35px;"><?php echo $taxAmountFormatted; ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td width="51%" valign="middle" style="text-align: right; height: 35px; line-height: 35px;"></td>
                        <td width="18%" valign="middle" style="text-align: center; height: 35px; line-height: 35px; ">Timbre fiscal</td>
                        <td width="11%" valign="middle" style="border: 1px solid #bbb; text-align: center; height: 35px; line-height: 35px;">1,00 DT</td>
                    </tr>
                    <tr>
                        <td width="51%" valign="middle" style="text-align: right; height: 35px; line-height: 35px;"></td>
                        <td width="18%" valign="middle" style="text-align: center; height: 35px; line-height: 35px; "><b>Total TTC</b></td>
                        <td width="11%" valign="middle" style="border: 1px solid #bbb; text-align: center; height: 35px; line-height: 35px; background-color: #edf2fa;"><b><?php echo $totalFormatted; ?></b></td>
                    </tr>
                </table>

            </div>
            <br>

            <div style="font-size:10px;">
                La présente facture est arrêtée à la somme de : <b><?php echo $this->convertNumberToFrenchWords($total); ?></b><br>
                <i>* Sauf erreur ou omission de notre part</i>
            </div>



            <?php if ($invoiceInfo['status'] == 'Paid'): ?>
                <div style="text-align:right; margin-top: 30px;">
                   

                </div>
            <?php endif; ?>
            <br><br><br><br>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="border-bottom:0.3px solid #bbb; height:1px;"></td>
                </tr>
            </table>
            <br>
            <div class="footer" style="background-color: #ee810b;color: #ffffff; text-align: center; height: 20px; line-height: 20px; font-size: 9px; width: 650px;">
               Jobsquare.ma
            </div>

        </body>

        </html>
<?php
        return ob_get_clean();
    }


    private function generateAndSavePDF($htmlContent, $invoiceNumber, $invoiceDate)
{
    // Extract date components from invoice date (not current date)
    $date = strtotime($invoiceDate);
    $year = date('Y', $date);
    $month = date('m', $date);
    $day = date('d', $date);
    
    // Create directory structure
    $baseDir = SJB_BASE_DIR . "files/invoices/{$year}/{$month}/{$day}/";
    
    // Create directory if it doesn't exist
    if (!is_dir($baseDir)) {
        mkdir($baseDir, 0755, true);
    }
    
    // Clean invoice number for filename
    $cleanInvoiceNumber = str_replace(['#', '/'], '', $invoiceNumber);
    $filename = "facture_{$cleanInvoiceNumber}.pdf";
    $filepath = $baseDir . $filename;
    
    // Generate PDF
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    
    // Set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Tanit Online Services');
    $pdf->SetTitle('Facture ' . $invoiceNumber);
    $pdf->SetSubject('Facture');
    $pdf->SetKeywords('Facture, Tanit, Services');
    
    // Remove default header/footer
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    
    // Set margins
    $pdf->SetMargins(15, 15, 5);
    $pdf->SetAutoPageBreak(TRUE, 15);
    
    // Add a page
    $pdf->AddPage();
    
    // Convert HTML to PDF
    $pdf->writeHTML($htmlContent, true, false, true, false, '');
    
    // Save to file
    $pdf->Output($filepath, 'F');
    
    return $filepath;
}

/**
 * Serve existing PDF file for download
 */
private function serveExistingPDF($pdfPath, $invoiceNumber)
{
    if (!file_exists($pdfPath)) {
        header('HTTP/1.1 404 Not Found');
        exit('PDF file not found');
    }
    
    // Clean invoice number for filename
    $cleanInvoiceNumber = str_replace(['#', '/'], '', $invoiceNumber);
    $downloadFilename = "facture_{$cleanInvoiceNumber}.pdf";
    
    // Set headers for PDF download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . $downloadFilename . '"');
    header('Content-Length: ' . filesize($pdfPath));
    header('Cache-Control: private, max-age=0, must-revalidate');
    header('Pragma: public');
    
    // Output the file
    readfile($pdfPath);
    exit;
}
}
