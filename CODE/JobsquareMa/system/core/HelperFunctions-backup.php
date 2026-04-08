<?php

class SJB_HelperFunctions
{
    const REDIRECT_302 = '302 found';

    public static function isSaas()
    {
        return (bool)SJB_System::getSystemSettings('isSaas');
    }

    public static function getFromSaasDefaultEmail()
    {
        $settings = SJB_System::getSystemSettings('env')['SES'];
        $user = trim(SJB_Settings::getValue('domain'));
        if (empty($user)) {
            $user = SJB_System::getSystemSettings('HTTPHOST');
        }
        $user = preg_replace('/^www\.|\.mysmartjobboard\.\w{3}/ui', '', $user);
        $user = preg_replace('/\.com$/ui', '', $user);
        return $user . '@' . $settings['smtp_sender_domain'];
    }

    public static function isEmailDomainVerified()
    {
        $email = SJB_Settings::getValue('system_email');
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        list(,$emailDomain) = explode('@', $email);
        return SJB_Settings::getValue('email_domain_verified') == $emailDomain;
    }

    /**
     * redirecting user to another page with "303 See Other" status
     *
     * Function redirects user to another page indicated in $url
     *
     * @param string $url URL where it will redirects
     * @param string $redirectType
     */
    public static function redirect($url, $redirectType = '303 See Other')
    {
        if (empty($url)) {
            $request_uri = $_SERVER['REQUEST_URI'];
            $query_string = $_SERVER['QUERY_STRING'];
            $url = str_replace('?' . $query_string, '', $request_uri);
        }
        $url = trim($url);
        header("{$_SERVER['SERVER_PROTOCOL']} {$redirectType}");
        header("Location: {$url}");
        die;
    }

    /**
     * generating hidden items of request form
     *
     * Function generates hidden items of request form
     *
     * @param array $newparam data for hidden items,
     * where keys of array are names of variables
     * and values of arry are values of variables
     * @param bool $pass_all defines unsetting of value of request data named 'action'
     * @return string
     */
    public static function form($newparam = [], $pass_all = false)
    {
        if ($pass_all) {
            $arr = $_REQUEST;
            unset($arr['action']);
        } else {
            $arr = SJB_HelperFunctions::unset_unnecessary($_REQUEST);
        }
        foreach ($newparam as $name => $value) {
            $arr[$name] = $value;
        }
        foreach ($arr as $k => $v) {
            if (is_array($v)) {
                continue;
            }
            $arr[$k] = htmlspecialchars($v);
        }
        $str = '';
        if (isset($arr) && is_array($arr)) {
            foreach ($arr as $name => $value) {
                $str .= '<input type="hidden" name="' . htmlspecialchars($name) . '" value="' . $value . '" />' . "\n";
            }
        }
        return $str;
    }

    /**
     * unsetting unnecessary values of array
     * Function unsets unnecessary values of array
     * @param array $arr processing array
     * @return array processed array
     */
    public static function unset_unnecessary($arr)
    {
        $required_variables = ['sessid'];
        if (is_array($arr)) {
            $tt = [];
            foreach ($required_variables as $r)
                if (isset($arr[$r]))
                    $tt[$r] = $arr[$r];
            return $tt;
        }
    }

    public static function array_sort($array)
    {
        ksort($array);
        if (is_array(current($array))) {
            foreach ($array as $key => $value)
                $sorted_array_keys[$key] = count($value, COUNT_RECURSIVE);
            asort($sorted_array_keys);
            foreach ($sorted_array_keys as $key => $value)
                $sorted_array[$key] = $array[$key];
            return $sorted_array;
        } else {
            asort($array);
            return $array;
        }
    }

    public static function getUrlContentByCurl($url, $params = [], $curlParams = [])
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt_array($ch, $curlParams);
        if ($params) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        $xmlString = curl_exec($ch);
        if ($xmlString === false) {
            throw new Exception("Curl error: " . curl_error($ch) . " with code " . curl_errno($ch));
        }
        curl_close($ch);
        return $xmlString;
    }

    /**
     * @static
     * @param int $filesize filesize in bytes
     * @return array
     */
    public static function getFileSizeAndSizeToken($filesize = 0)
    {
        // set filesize for template
        $sizeTokens = ['bytes', 'Kb', 'Mb', 'Gb'];
        $sizeToken = $sizeTokens[0];
        $i = 0;
        while ($filesize > 1024) {
            $i++;
            $filesize = $filesize / 1024;
            $sizeToken = isset($sizeTokens[$i]) ? $sizeTokens[$i] : '';
        }
        return ['filesize' => $filesize, 'size_token' => $sizeToken];
    }

    public static function makeXLSExportFile($exportData, $exportFileName, $title)
    {
        $excel = new PHPExcel();
        $excel->getActiveSheet()->setTitle($title);

        $row = 1;
        foreach ($exportData as $exportItem) {
            $col = 0;
            if ($row == 1) {
                foreach ($exportItem as $name => $value) {
                    $excel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $name);
                    $excel->getActiveSheet()->getStyleByColumnAndRow($col, 1)->applyFromArray([
                        'font' => [
                            'bold' => true
                        ],
                        'alignment' => [
                            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
                        ],
                        'borders' => [
                            'allborders' => [
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                            ]
                        ]
                    ]);
                    $col++;
                }
                $row = 2;
                $col = 0;
            }
            foreach ($exportItem as $fieldKey => $fieldVal) {
                if (strpos($fieldKey, '.ZipCode') !== false) {
                    $excel->getActiveSheet()->setCellValueExplicitByColumnAndRow($col, $row, $fieldVal, PHPExcel_Cell_DataType::TYPE_STRING);
                } else {
                    $excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $fieldVal);
                }
                $excel->getActiveSheet()->getStyleByColumnAndRow($col, $row)->applyFromArray([
                    'borders' => [
                        'allborders' => [
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        ]
                    ]
                ]);
                $col++;
            }
            $row++;
        }

        $export_files_dir = SJB_System::getSystemSettings('EXPORT_FILES_DIRECTORY');

        $objWriter = new PHPExcel_Writer_Excel5($excel);
        $objWriter->save($export_files_dir . '/' . $exportFileName);
    }

    public static function makeCSVExportFile($exportData, $exportFileName)
    {
        $exportFilesDir = SJB_System::getSystemSettings("EXPORT_FILES_DIRECTORY");
        $filePath = $exportFilesDir . '/' . $exportFileName;
        $file = fopen($filePath, 'wb+');
        fwrite($file, "\xEF\xBB\xBF");

        $row = 1;
        foreach ($exportData as $exportFields) {
            if ($row == 1) {
                $exportProperties = array_keys($exportFields);
                fputcsv($file, $exportProperties, ';');
            }
            fputcsv($file, $exportFields, ';');
            $row++;
        }
    }

    /**
     * @static
     * @param SJB_TemplateProcessor $tp
     * @param $string
     * @return string
     */
    public static function findSmartyRestrictedTagsInContent(SJB_TemplateProcessor $tp, $string)
    {
        $restrictedTags = [
            $tp->left_delimiter . 'php' . $tp->right_delimiter,
            $tp->left_delimiter . 'include_php',
            $tp->left_delimiter . 'eval',
        ];

        foreach ($restrictedTags as $tag) {
            if (stristr($string, $tag))
                return true;
        }

        return false;
    }

    public static function getClearVariablesToAssign($value)
    {
        if (is_array($value)) {
            $result = [];
            foreach ($value as $key => $val) {
                if (is_array($val)) {
                    $result[strip_tags($key)] = self::getClearVariablesToAssign($val);
                } else {
                    $result[strip_tags($key)] = htmlentities($val, ENT_QUOTES, "UTF-8");
                }
            }
            return $result;
        }
        return htmlentities($value, ENT_QUOTES, "UTF-8");
    }

    public static function getSiteUrl()
    {
        return SJB_System::getSystemSettings('SITE_URL');
    }

    public static function getUserSiteUrl()
    {
        return SJB_System::getSystemSettings('USER_SITE_URL');
    }

    public static function getAdminSiteUrl()
    {
        return SJB_System::getSystemSettings('ADMIN_SITE_URL');
    }

    public static function getCharSets()
    {
        return ['ARMSCII-8', 'ASCII', 'BIG5', 'BIG5-HKSCS', 'C99', 'CP850', 'CP862', 'CP866', 'CP874', 'CP932', 'CP936', 'CP949', 'CP950', 'CP1131', 'CP1133', 'CP1250', 'CP1251', 'CP1252', 'CP1253', 'CP1254', 'CP1255', 'CP1256', 'CP1257', 'CP1258', 'EUC-CN', 'EUC-JP', 'EUC-KR', 'EUC-TW', 'GB18030', 'GBK', 'Georgian-Academy', 'Georgian-PS', 'HP-ROMAN8', 'HZ', 'ISO-2022-CN', 'ISO-2022-CN-EXT', 'ISO-2022-JP', 'ISO-2022-JP-1', 'ISO-2022-JP-2', 'ISO-2022-KR', 'ISO-8859-1', 'ISO-8859-2', 'ISO-8859-3', 'ISO-8859-4', 'ISO-8859-5', 'ISO-8859-6', 'ISO-8859-6', 'ISO-8859-7', 'ISO-8859-8', 'ISO-8859-8', 'ISO-8859-9', 'ISO-8859-10', 'ISO-8859-11', 'ISO-8859-11', 'ISO-8859-12', 'ISO-8859-13', 'ISO-8859-14', 'ISO-8859-15', 'ISO-8859-16', 'JAVA', 'JOHAB', 'KOI8-R', 'KOI8-RU', 'KOI8-T', 'KOI8-U', 'MacArabic', 'MacCentralEurope', 'MacCroatian', 'MacCyrillic', 'MacGreek', 'MacHebrew', 'MacIceland', 'Macintosh', 'MacRoman', 'MacRomania', 'MacThai', 'MacTurkish', 'MacUkraine', 'MuleLao-1', 'NEXTSTEP', 'PT154', 'RK1048', 'SHIFT_JIS', 'TCVN', 'TIS-620', 'UCS-2', 'UCS-2BE', 'UCS-2LE', 'UCS-4', 'UCS-4BE', 'UCS-4LE', 'UTF-7', 'UTF-8', 'UTF-16', 'UTF-16BE', 'UTF-16LE', 'UTF-32', 'UTF-32BE', 'UTF-32LE', 'VISCII'];
    }

    /**
     * @param $content
     * @return string
     */
    public static function clearNonPrintedCharacters($content)
    {
        if ($content) {
            //0-8, 11,12, 15-31
            $nonPrintedSymbolsPattern = '/[\x00-\x08\x0B\x0C\x0E-\x1F]/u';
            if (preg_match($nonPrintedSymbolsPattern, $content)) {
                $content = preg_replace($nonPrintedSymbolsPattern, '', $content);
            }
        }
        return $content;
    }

    public static function whmcsCall($action, $params)
    {
        $settings = SJB_System::getSystemSettings('env')['WHMCS'];
        $params = array_merge($params, [
            'action' => $action,
            'username' => $settings['whmcs_user'],
            'password' => md5($settings['whmcs_pass']),
            'responsetype' => 'json',
        ]);
        $response = false;
        try {
            $response = SJB_HelperFunctions::getUrlContentByCurl($settings['whmcs_url'] . '/includes/api.php', $params);
        } catch (Exception $e) {
            SJB_Error::getInstance()->addError($e->getMessage(), ['exception' => $e]);
        }

        return @json_decode($response, true);
    }

    public static function whmcsEncode($string)
    {
        openssl_public_encrypt($string, $encrypted, '-----BEGIN CERTIFICATE-----
MIIDXTCCAkWgAwIBAgIJAPEt+SU3z5XmMA0GCSqGSIb3DQEBCwUAMEUxCzAJBgNV
BAYTAktHMRMwEQYDVQQIDApTb21lLVN0YXRlMSEwHwYDVQQKDBhJbnRlcm5ldCBX
aWRnaXRzIFB0eSBMdGQwHhcNMTYwNDA1MTIzODM5WhcNMTcwNDA1MTIzODM5WjBF
MQswCQYDVQQGEwJLRzETMBEGA1UECAwKU29tZS1TdGF0ZTEhMB8GA1UECgwYSW50
ZXJuZXQgV2lkZ2l0cyBQdHkgTHRkMIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIB
CgKCAQEAqwkeBcLYibuqWO42M7/dF6ssls7v3FZr/8vsr6aFm6Jd3D5+5cuLwB5r
pP6QqySY5pT3eLSscYd8KF1kiGtpxu7tx5LCe7ncMGwAzQLDF5H3Lr1fNWuJVjlg
UsnOjFcRdRWwJh2gkRCsgm861cc1zTCQVyaRfu7gpt3cXkcODMxOxpGcTp48kv2f
I2LnAPeqzm9b15FPeiMuCL6GcliY+yWp69QHijTIRTnKatG/aYBc7k10XbxS5Y5J
1jPByAeYP5bBg8b0gExm/iHahPB3O1zm0E3SJx7zFjzRotCgKdrGxBnCHfmfk6VN
r9XhZ5bqpQKldjaWE+oGcU8lqz1/mQIDAQABo1AwTjAdBgNVHQ4EFgQUpbURAG4M
1XwP09bgvKpuDgT72PIwHwYDVR0jBBgwFoAUpbURAG4M1XwP09bgvKpuDgT72PIw
DAYDVR0TBAUwAwEB/zANBgkqhkiG9w0BAQsFAAOCAQEAfputzakYDONfpHDCN8b7
aZjumyAy9pGv3nTCHXuhxXGBYinXaW/HYws4R5Q49/JsNVtF5pmJeq8nX3IV5DCB
lEXhep4vIg291o8d5TkLGKHHXADFCa4MOdR01gfMe05H2DMF+uurziJCdeR0kb2u
XwW6IdZ0EY7Wb0xQCRFMIznWsXKBaO04VrpG62ZU+jejv+oRrDoh7FLAdMSDtbZc
hzuQsycmZCwohoRj/b/JyDLc7Oyom38PawLrOz9OY/uq4UnT4VRtVnnWi0MaWs9t
mDcOOrLVvq9/qbjnG9YBzygh9IxWmsHLAP2IqN7B/J14qTFpWxZY0RDaW4qGVFRJ
BA==
-----END CERTIFICATE-----');
        return $encrypted;
    }

    public static function getCustomDomainUrl()
    {
        $url = SJB_System::getSystemSettings('USER_SITE_URL');
        if (SJB_Settings::getSettingByName('domain')) {
            $url = str_replace($_SERVER['HTTP_HOST'], SJB_Settings::getSettingByName('domain'), $url);
        }
        return $url;
    }

    public static function getBillingUrl()
    {
        $billingUrl = 'https://www.smartjobboard.com/ca';
        if (SJB_H::isSaas()) {
            $billingUrl = SJB_System::getSystemSettings('env')['WHMCS']['whmcs_url'];
        }
        return $billingUrl;
    }

    public static function html2pdf($html, $filename, $footerText = false)
    {
        for ($i = 0; $i < ob_get_level(); $i++) {
            ob_end_clean();
        }
        $pdf = new ExceptionThrowingTCPDF();
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->setPrintHeader(false);

        if ($footerText != false) {
            $pdf->footerText = $footerText;
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        } else {
            $pdf->setPrintFooter(false);
        }

        switch (SJB_I18N::getInstance()->getCurrentLanguage()) {
            case 'ja':
                $font = 'cid0jp';
                break;
            case 'zh':
                $font = 'cid0cs';
                break;
            case 'hi':
                $font = 'akshar';
                break;
            case 'fr':
            case 'pt':
                $html = str_replace('à', '&agrave;', $html);
            default:
                $font = 'freesans';
//                $font = 'dejavusans';
//                $font = 'footer-social';
        }
        $pdf->SetFont($font, '', 12, '', true);
//        $pdf->addFont('footer-social', 'TrueTypeUnicode', 'templates/Bootstrap/assets/fonts/footer-social.ttf', 32);
//        $pdf->SetFont($font, 'TrueTypeUnicode', 12, 'templates/Bootstrap/assets/fonts/footer-social.woff', true);
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, false, false, '');

        $pdf->Output($filename, 'D');
    }

    public static function isThemeSupportsDND($theme = false)
    {
        return true;
        if (!$theme) {
            $theme = SJB_Settings::getValue('TEMPLATE_USER_THEME');
        }
        return !in_array($theme, ['Breeze', 'Bootstrap', 'Flow', 'Simplicity']);
    }
}

class SJB_H extends SJB_HelperFunctions
{
}

class ExceptionThrowingTCPDF extends TCPDF
{
    public $footerText = false;

    public function Error($msg) {
        $this->_destroy(true);
        throw new Exception('PDF generation failed: ' . $msg);
    }

    public function Footer() {
        if ($this->footerText != false) {
            $this->SetY(-15);
            $this->SetX(140);
            $this->SetFont('times', 'I', 8);
//            $this->Cell(0, 20, $this->footerText, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        }

        $image_file = SJB_HelperFunctions::getSiteUrl() . '/templates/Jobsquare/assets/images/pdfFooter.png';
        $this->Image($image_file, 10, 275, 190, '', 'png', '', 'T', false, 300, '', false, false, 0, false, false, false);

    }
}