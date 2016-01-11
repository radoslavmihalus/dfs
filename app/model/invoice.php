<?php

class invoice {

    public $id;
    private $_html = '';
    public $email;
    public $apikey;
    public $id_order_state_invoice;
    public $id_order_state_refund;

    const API_AUTH_KEYWORD = 'SFAPI';
    const SF_URL_CREATE_INVOICE = 'https://moja.superfaktura.sk/invoices/create';
    const SF_URL_PAY_INVOICE = 'https://moja.superfaktura.sk/invoice_payments/add/ajax:1/api:1/import_type:prestashop/import_id:';
    const SF_URL_CREATE_CANCEL = 'https://moja.superfaktura.sk/invoices/cancelFromRegular/0/import_type:prestashop/import_id:';
    const SF_URL_GET_PDF_INVOICE_SLO = 'https://moja.superfaktura.sk/slo/invoices/pdf/0/import_type:prestashop/import_id:';
    const SF_URL_GET_PDF_INVOICE_ENG = 'https://moja.superfaktura.sk/eng/invoices/pdf/0/import_type:prestashop/import_id:';
    const SF_URL_GET_PDF_INVOICE_CZE = 'https://moja.superfaktura.sk/cze/invoices/pdf/0/import_type:prestashop/import_id:';

    private function l($param) {
        return $param;
    }

    public function __construct() {
        $this->id = rand(10000000, 99999999);

        $this->name = "superfaktura";
        $this->tab = "billing_invoicing";
        $this->version = 1.5;
        $this->author = "www.superfaktura.sk";
        $this->need_instance = 1;


//$config = Configuration::getMultiple(array('SUPERFAKTURA_EMAIL', 'SUPERFAKTURA_APIKEY', 'SUPERFAKTURA_ORDER_STATE_REFUND', 'SUPERFAKTURA_ORDER_STATE_INVOICE', 'SUPERFAKTURA_SET_INVOICE_PAID'));

        $this->email = "info@dogforshow.com"; //isset($config['SUPERFAKTURA_EMAIL']) ? $config['SUPERFAKTURA_EMAIL'] : "";
        $this->apikey = "9d40288eee5b6752132ce5e11a0edf49"; //isset($config['SUPERFAKTURA_APIKEY']) ? $config['SUPERFAKTURA_APIKEY'] : "";
        $this->id_order_state_invoice = 0; //isset($config['SUPERFAKTURA_ORDER_STATE_INVOICE']) ? $config['SUPERFAKTURA_ORDER_STATE_INVOICE'] : -1;
        $this->id_order_state_refund = 9999; //isset($config['SUPERFAKTURA_ORDER_STATE_REFUND']) ? $config['SUPERFAKTURA_ORDER_STATE_REFUND'] : 0;
        $this->set_invoice_paid = 1; //isset($config['SUPERFAKTURA_SET_INVOICE_PAID']) ? $config['SUPERFAKTURA_SET_INVOICE_PAID'] : 0;
//parent::__construct();


        $this->displayName = $this->l('SuperFaktura');
        $this->description = $this->l('Prepojenie DOGFORSHOW');

        $this->warning = "";

        if (empty($this->email))
            $this->warning .= $this->l('E-mail musí byť vyplnený.') . ' ';

        if (empty($this->apikey))
            $this->warning .= $this->l('API key musí byť vyplnené.') . ' ';

        if (-1 == $this->id_order_state_invoice)
            $this->warning .= $this->l('Udalosť kedy vytvárať faktúru musí byť vyplnená.') . ' ';

        if (0 == $this->id_order_state_refund)
            $this->warning .= $this->l('Stav objednávky pre vytvorenie dobropisu musí byť vyplnený.') . ' ';

        if (!function_exists("curl_init"))
            $this->warning .= $this->l('Váš web hosting musí podporovať cURL PHP funkcie.') . ' ';

        if (!function_exists("json_encode"))
            $this->warning .= $this->l('Váš web hosting musí podporovať JSON_ENCODE/DECODE funkcie.') . ' ';
    }

    public function getContent() {
        $this->_html = '<h2>' . $this->displayName . '</h2>';

        if (Tools::isSubmit('btnSubmit')) {
            $errors = array();

            if (!Tools::getValue('email'))
                $errors[] = $this->l('E-mail musí byť vyplnený.');

            if (!Tools::getValue('apikey'))
                $errors[] = $this->l('API key musí byť vyplnené.');

            if (0 == Tools::getValue('id_order_state_refund'))
                $this->warning .= $this->l('Stav objednávky pre vytvorenie dobropisu musí byť vyplnený');


            /* if (empty($errors)) {
              Configuration::updateValue('SUPERFAKTURA_EMAIL', Tools::getValue('email'));
              Configuration::updateValue('SUPERFAKTURA_APIKEY', Tools::getValue('apikey'));
              Configuration::updateValue('SUPERFAKTURA_ORDER_STATE_INVOICE', Tools::getValue('id_order_state_invoice'));
              Configuration::updateValue('SUPERFAKTURA_ORDER_STATE_REFUND', Tools::getValue('id_order_state_refund'));
              Configuration::updateValue('SUPERFAKTURA_SET_INVOICE_PAID', (int) Tools::getValue('set_invoice_paid'));

              $this->_html .= '<div class="conf"><img src="../img/admin/ok.gif" alt="' . $this->l('ok') . '" /> ' . $this->l('Nastavenia uložené') . '</div>';
              } else {
              $this->_html .= '<div class="error"><img src="../img/admin/error2.png" alt="' . $this->l('chyba') . '" /> ' . implode('<br />', $errors) . '</div>';
              }
             * 
             */
        }

        $this->_displayForm();

        return $this->_html;
    }

    private function _displayForm() {
        global $cookie;

        $states = OrderState::getOrderStates((int) ($cookie->id_lang));

        $this->_html .= '<div style="width: 517px; margin: 10px auto;">
            <form action="' . Tools::htmlentitiesUTF8($_SERVER['REQUEST_URI']) . '" method="post">

                <strong>E-mail: <sup>*</sup></strong><br />
                <input type="text" name="email" size="50" value="' . htmlentities(Tools::getValue('email', $this->email), ENT_COMPAT, 'UTF-8') . '" /><br />
                <br />

                <strong>API key: <sup>*</sup></strong><br />
                <input type="text" name="apikey" size="50" value="' . htmlentities(Tools::getValue('apikey', $this->apikey), ENT_COMPAT, 'UTF-8') . '" /><br />
                <br />

                <strong>' . $this->l("Faktúru vytvárať pri") . ': <sup>*</sup></strong><br />
                <select name="id_order_state_invoice">
                    <option value="0"' . ((0 == Tools::getValue('id_order_state_invoice', $this->id_order_state_invoice)) ? ' selected="selected"' : '') . '>vytvorení objednávky</option>
        ';

        foreach ($states AS $state)
            $this->_html .= '<option value="' . $state['id_order_state'] . '"' . (($state['id_order_state'] == Tools::getValue('id_order_state_invoice', $this->id_order_state_invoice)) ? ' selected="selected"' : '') . '>zmene stavu objednávky na "' . stripslashes($state['name']) . '"</option>';

        $this->_html .= '
                </select><br />
                <br />

                <strong>' . $this->l("Pri vytvorení faktúry ju nastaviť ako uhradenú") . ': </strong><br />
                <input type="checkbox" name="set_invoice_paid" value="1"' . (1 == Tools::getValue('set_invoice_paid', $this->set_invoice_paid) ? ' checked="checked"' : '') . ' /><br />
                <br />

                <strong>' . $this->l("Stav objednávky pre vytvorenie dobropisu") . ': <sup>*</sup></strong><br />
                <select name="id_order_state_refund">
        ';

        foreach ($states AS $state)
            $this->_html .= '<option value="' . $state['id_order_state'] . '"' . (($state['id_order_state'] == Tools::getValue('id_order_state_refund', $this->id_order_state_refund)) ? ' selected="selected"' : '') . '>' . stripslashes($state['name']) . '</option>';

        $this->_html .= '
                </select><br />
                <br />


                <input type="submit" name="btnSubmit" value="' . $this->l('Uložiť') . '" class="button" />
            </form>
            </div>
        ';
    }

    private function _request($url, $data = "") {
        $c = curl_init();

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_REFERER => $url,
            CURLOPT_HEADER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array("Authorization: " . self::API_AUTH_KEYWORD . " email=" . $this->email . "&apikey=" . $this->apikey),
            CURLOPT_ENCODING => '',
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_RETURNTRANSFER => true,
        );

        curl_setopt_array($c, $options);

        $result = curl_exec($c);

        $http_code = curl_getinfo($c, CURLINFO_HTTP_CODE);

        curl_close($c);

        if ((false === $result) || (200 != $http_code)) {
            return false;
        }


        if (false === strpos($result, "\r\n\r\n")) {
            return false;
        }

        $result = explode("\r\n\r\n", $result);


        return $result[count($result) - 1];
    }

    public function _createInvoice($name, $address, $city, $zip, $carrier, $tel, $item_name, $item_description, $item_unit, $item_price, $state = "Slovakia") { //$order, $cart) {
        $data = array(
            'InvoiceItem' => array()
        );

        $currency = "EUR";

        $data['Client'] = array(
            'name' => $name,
            'address' => $address,
            'city' => $city,
            'zip' => $zip,
            'phone' => $tel,
            'country' => $state
        );

        $data['Invoice'] = array(
            'import_type' => "prestashop",
            'import_id' => $this->id,
            'variable' => $this->id,
            'already_paid' => (1 == 1)
        );

        $data['Invoice']['invoice_currency'] = $currency;

        $data['InvoiceItem'][] = array(
            'name' => $item_name,
            'description' => $item_description,
            'quantity' => 1,
            'unit' => $item_unit,
            'unit_price' => $item_price,
            'tax' => 0
        );

        $response = $this->_request(self::SF_URL_CREATE_INVOICE, array('data' => json_encode($data)));

        if (false == $response) {
            return;
        }

        $response = json_decode($response);

//        if ((isset($response->error) && (0 != $response->error)) || !isset($response->data->Invoice->variable)) {
//            return;
//        }

        return $response;
    }

    public function hookNewOrder($transaction_id, $name, $address, $city, $zip, $carrier, $tel, $item_name, $item_description, $item_unit, $item_price, $state = "Slovakia") {

        $this->id = $transaction_id;

        if (0 != $this->id_order_state_invoice)
            return; // faktura sa vytvara pri inom stave

        return $this->_createInvoice($name, $address, $city, $zip, $carrier, $tel, $item_name, $item_description, $item_unit, $item_price, $state); //$params['order'], $params['cart']);
    }

    public function hookActionPaymentConfirmation($params) {
        if (1 == $this->set_invoice_paid)
            return; // faktura sa nastavila ako uhradena pri vytvarani


        $order = Db::getInstance()->getRow("SELECT o.total_paid, c.iso_code
                                            FROM " . _DB_PREFIX_ . "orders AS o
                                            LEFT JOIN " . _DB_PREFIX_ . "currency AS c ON c.id_currency=o.id_currency
                                            WHERE o.id_order=" . $params['id_order']);

        if ($order) {
//TODO: Typ platby v superfakture: transfer, cash, paypal, credit, cod

            $data['InvoicePayment'] = array(
                'import_type' => "prestashop",
                'import_id' => $params['id_order'],
                'payment_type' => "transfer",
                'amount' => $order['total_paid'],
                'currency' => $order['iso_code'],
                'created' => date('Y-m-d')
            );

            $response = $this->_request(self::SF_URL_PAY_INVOICE . $params['id_order'], array('data' => json_encode($data)));
        }
    }

    public function hookActionOrderStatusUpdate($params) {
        if ($this->id_order_state_refund == $params['newOrderStatus']->id) {
            $response = $this->_request(self::SF_URL_CREATE_CANCEL . $params['id_order']);
        } elseif ($this->id_order_state_invoice == $params['newOrderStatus']->id) {
            $order = new Order($params['id_order']);
            $cart = new Cart($order->id_cart);

            $this->_createInvoice($order, $cart);
        }
    }

    public function hookDisplayPDFInvoice($par_id, $par_lang = 'sk') {

//        $response = $this->_request(self::SF_URL_GET_PDF_INVOICE . $par_id);
//
//        if ("" != $response) {
//
//            header("Pragma: public"); // required
//            header("Expires: 0");
//            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//            header("Cache-Control: private", false); // required for certain browsers
//
//            header("Content-Type: application/force-download");
//            header("Content-Disposition: attachment; filename=\"invoice.pdf\";");
//
//            header("Content-Transfer-Encoding: binary");
//            header("Content-Length: " . strlen($response));
//
//            echo $response;
//
//            exit();
//        }

        switch ($par_lang) {
            case "sk":
                return self::SF_URL_GET_PDF_INVOICE_SLO . $par_id;
                break;
            case "cz":
                return self::SF_URL_GET_PDF_INVOICE_CZE . $par_id;
                break;
            case "en":
                return self::SF_URL_GET_PDF_INVOICE_ENG . $par_id;
                break;
        }
    }

}
