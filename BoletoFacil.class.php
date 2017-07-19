<?php

/**
 * Boleto [ MODEL ]
 * Modelo responsável pela Emissão e Cancelamento de boletos, Consultadas de Saldo e Solicitação de Tranferencia de valores da plataforma https://boletobancario.com!
 * 
 * @copyright (c) 2017, Davson Santos, DavTech
 * 
 * $Boleto = new Boleto();
 * $Dados = ['description' => 'Five Pages 2017','amount' => 150.00, 'name' => 'Davson do Nascimento Santos','document' => '615.328.272-53','email'=>'davsonsantos@gmail.com','reference'=>'001'];
 * var_dump($Boleto->emitiBoleto($Dados));
 * var_dump($Boleto->getSaldo());
 * var_dump($Boleto->getTranferencia());
 * var_dump($Boleto->getCancelamento(10051054));
 */
class BoletoFacil {

    //INFORMAÇÕES OBRIGATÓRIAS
    //O token do Favorecido, que pode ser gerado acima
    private $token;
    //Descrição sobre a que se refere o pagamento
    //Formato: Livre com até 400 caracteres - Até 4 linhas
    //Exemplos: Pedido 48192 / TV 40 Polegadas / Cosméticos
    private $description;
    //Valor do boleto ou da parcela no caso de cobrança parcelada
    //Formato: Decimal, separado por ponto. Maior ou igual a 2.30 e menor ou igual a 1000000.00
    private $amount;
    //Nome completo do Pagador
    //Formato: Livre com até 60 caracteres
    private $payerName;
    //CPF ou CNPJ do Pagador
    //Formato: CPF ou CNPJ válido, aceito com ou sem pontuação
    private $payerCpfCnpj;
    //INFORMAÇÕES OPCIONAIS

    /**
     * @Param reference;
      //</b>Código de referência da cobrança</b>
      //Este código fica associado à(s) cobrança(s) criada(s) por esta requisição e é útil para vincular as transações do Boleto Fácil às vendas registradas no seu sistema
      //Formato: Livre com até 255 caracteres

      /**
     * @Param duedate;
     * <b>Data de Vencimento</b> 
     * Data de vencimento do boleto ou da primeira parcela, no caso de cobrança parcelada
     * Para parcelamento as prestações terão vencimento com 1 mês de intervalo, a partir da data informada
     * Formato: dd/mm/aaaa
     * Valor padrão: Se não definido será 3 dias após a data de emissão
     */
    /**
     * @Param installments;
     * <b>Número de parcelas da cobrança</b>
     * Se igual a 1, será gerado um boleto simples, se 2 ou mais, será gerado um carnê
     * Formato: Número inteiro maior ou igual a 1 e menor ou igual a 12
     * Valor padrão: 1
     */
    /**
     * @Param maxOverdueDays;
     * <b>Número máximo de dias que o boleto poderá ser pago após o vencimento</b>
     * Zero significa que o boleto não poderá ser pago após o vencimento
     * Formato: Número inteiro maior ou igual a 0 e menor ou igual a 90
     * Valor padrão: 0
     */
    /**
     * @Param fine
     * <b>Multa para pagamento após o vencimento</b>
     * Só é efetivo se maxOverdueDays for maior que zero
     * Formato: Decimal, separado por ponto. Maior ou igual a 0.00 e menor ou igual a 20.00 (2.00 é o valor máximo permitido por lei)
     * Valor padrão: 0.00
     */
    /**
     * @Param interest
     * <b>Juros para pagamento após o vencimento</b>
     * Só é efetivo se maxOverdueDays for maior que zero
     * Formato: Decimal, separado por ponto. Maior ou igual a 0.00 e menor ou igual a 20.00 (1.00 é o valor máximo permitido por lei)
     * Valor padrão: 0.00
     */
    /**
     * @Param discountAmount
     * <b>Valor do desconto</b>
     * Formato: Decimal, separado por ponto. Maior ou igual a 0.00 e menor que o valor da cobrança (amount)
     * Valor padrão: 0.00
     */
    /**
     * @Param discountDays
     * <b>Dias concessão de desconto para pagamento antecipado. Exemplo: Até 10 dias antes do vencimento.</b>
     * Formato: Número inteiro maior ou igual a -1
     * Valor padrão: -1
     * Atenção: Valor igual a 0 (zero) significa conceder desconto até a data do vencimento
     */
    /**
     * @Param emial
     * <b>Endereço de email do comprador</b>
     * Formato: Endereço de email válido, com até 80 caracteres
     */
    /**
     * @Param emailSecond
     * <b>Endereço de email secundário do comprador</b>
     * Formato: Endereço de email secundário válido, com até 80 caracteres
     */
    /**
     * @Param payerPhone
     * <b>Telefone do comprador</b>
     * Formato: Livre com até 25 caracteres
     */
    /**
     * @Param payerBirthDate
     * <b>Data de nascimento do comprador</b>
     * Formato: dd/mm/aaaa
     */
    /**
     * @Param billingAddressStreet
     * <b>Nome da rua/logradouro do comprador</b>
     * Formato: Formato: Livre com até 80 caracteres
     */
    /**
     * @Param billingAddressNumber
     * <b>Número da residência do comprador</b>
     * Formato: Livre com até 30 caracteres
     */
    /**
     * @Param billingAddressComplement
     * <b>Complemento do endereço do comprador</b>
     * Formato: Livre com até 30 caracteres
     */
    /**
     * @Param billingAddressCity
     * <b>Cidade comprador</b>
     * Formato: Livre com até 60 caracteres
     */
    /**
     * @Param billingAddressState
     * <b>Estado do comprador</b>
     * Formato: Nome do estado ou UF válida
     */
    /**
     * @Param billingAddressPostcode
     * <b>CEP do comprador</b>
     * Formato: CEP válido com ou sem hífen
     */
    /**
     * @Param notifyPayer
     * <b>Define se o Boleto Fácil enviará emails de notificação sobre esta cobrança para o comprador</b>
     * O email com o boleto ou carnê só será enviado ao comprador se este parâmetro for igual a true e o endereço de email do comprador estiver presente
     * O lembrete de vencimento só será enviado se as condições acima forem verdadeiras e se na configuração do Favorecido os lembretes estiverem ativados
     * Formato: true ou false
     * Valor padrão: true
     */
    /**
     * @Param notificationUrl;
     * <b>Define uma URL de notificação para que o Boleto Fácil envie notificações ao seu sistema sempre que houver algum evento de pagamento desta cobrança.</b>
     * Se preferir, você pode configurar uma URL de notificação para todas as suas cobranças no tópico Notificação de pagamentos.
     * Formato: Endereço de URL com até 255 caracteres
     */
    /**
     * @Param feeSchemaToken
     * <b>Define o token de um esquema de taxas e comissionamento alternativo</b>
     */

    /**
     * @Param splitRecipient
     * <b>Destinatário da divisão de receitas (split), caso os boletos sejam emitidos pelo "dono" do esquema de taxas e comissionamento (split invertido)</b>
     */
    public $Url;
    public $Result;
    public $Errors;
    public $Data;
    public $ReturnJson;

    function __construct() {
        $this->token = PAYMENT_BOLETO_FACIL_TOKEN;
    }

    public function emitiBoleto(array $Dados) {
        if (PAYMENT_ENV == 'sandbox'):
            $this->Url = 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/issue-charge?token=' . $this->token;
        else:
            $this->Url = 'https://boletobancario.com/boletofacil/integration/api/v1/issue-charge?token=' . $this->token;
        endif;
        $this->Data = $Dados;
        $this->Clear();

        $this->DadosObrigatorios($Dados);
        $this->getUrl();
        return $this->Result;
    }

    /**
     * <b>Dados Obrigatórios</b> Validação para emissão do boleto</b>
     * @param array $Dados
     */
    public function DadosObrigatorios() {
        if (empty($this->Data['description'])): $this->Errors = true;endif;
        if (empty($this->Data['amount'])): $this->Errors = true;endif;
        if (empty($this->Data['name'])): $this->Errors = true;endif;
        if (empty($this->Data['document'])): $this->Errors = true;endif;
        if ($this->Errors == TRUE):
            $this->Result = false;
        else:
            $this->Errors = FALSE;
            $this->description = urlencode($this->Data['description']);
            $this->amount = $this->Data['amount'];
            $this->payerName = urlencode($this->Data['name']);
            $this->payerCpfCnpj = $this->Data['document'];
            $this->Url .= '&description=' . $this->description . '&amount=' . $this->amount . '&payerName=' . $this->payerName . '&payerCpfCnpj=' . $this->payerCpfCnpj;
            $this->DadosOpcionais($this->Data);
        endif;
    }

    /**
     * <b>Dados Opcionais</b> Incrementa a URL para paramentros opcionais</b>
     * @param array $Dados
     */
    public function DadosOpcionais() {
        (!empty($this->Data['email']) ? $this->Url .= "&payerEmail=" . $this->Data['email'] : "");
        (!empty($this->Data['reference']) ? $this->Url .= "&reference=" . $this->Data['reference'] : "");
        (!empty($this->Data['installments']) ? $this->Url .= "&installments=" . $this->Data['installments'] : "");
        (!empty($this->Data['maxOverdueDays']) ? $this->Url .= "&maxOverdueDays=" . $this->Data['maxOverdueDays'] : "");
        (!empty($this->Data['interest']) ? $this->Url .= "&interest=" . $this->Data['interest'] : "");
        (!empty($this->Data['discountDays']) ? $this->Url .= "&discountDays=" . $this->Data['discountDays'] : "");
        (!empty($this->Data['emailSecond']) ? $this->Url .= "&payerSecondaryEmail=" . $this->Data['emailSecond'] : "");
        (!empty($this->Data['notifyPayer']) ? $this->Url .= "&notifyPayer=" . $this->Data['notifyPayer'] : "");
        (!empty($this->Data['notificationUrl']) ? $this->Url .= "&notificationUrl=" . $this->Data['notificationUrl'] : "");
        (!empty($this->Data['payerPhone']) ? $this->Url .= "&payerPhone=" . $this->Data['payerPhone'] : "");
        (!empty($this->Data['payerBirthDate']) ? $this->Url .= "&payerBirthDate=" . $this->Data['payerBirthDate'] : "");
        (!empty($this->Data['billingAddressStreet']) ? $this->Url .= "&billingAddressStreet=" . $this->Data['billingAddressStreet'] : "");
        (!empty($this->Data['billingAddressNumber']) ? $this->Url .= "&billingAddressNumber=" . $this->Data['billingAddressNumber'] : "");
        (!empty($this->Data['billingAddressComplement']) ? $this->Url .= "&billingAddressComplement=" . $this->Data['billingAddressComplement'] : "");
        (!empty($this->Data['billingAddressCity']) ? $this->Url .= "&billingAddressCity=" . $this->Data['billingAddressCity'] : "");
        (!empty($this->Data['billingAddressState']) ? $this->Url .= "&billingAddressState=" . $this->Data['billingAddressState'] : "");
        (!empty($this->Data['billingAddressPostcode']) ? $this->Url .= "&billingAddressPostcode=" . $this->Data['billingAddressPostcode'] : "");
        (!empty($this->Data['feeSchemaToken']) ? $this->Url .= "&feeSchemaToken=" . $this->Data['feeSchemaToken'] : "");
        (!empty($this->Data['splitRecipient']) ? $this->Url .= "&feeSchemaToken=" . $this->Data['splitRecipient'] : "");
    }

    /**
     * <b>Consulta de Saldo</>
     * Retorna o Saldo da Conta
     */
    public function getSaldo() {

        if (PAYMENT_ENV == 'sandbox'):
            $this->Url = 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/fetch-balance?token=' . $this->token;
        else:
            $this->Url = 'https://boletobancario.com/boletofacil/integration/api/v1/fetch-balance?token=' . $this->token;
        endif;

        $this->ReturnJson = json_decode(file_get_contents($this->Url), true);
        if ($this->ReturnJson['success']):
            $this->Result = [
                'balance' => $this->ReturnJson['data']['balance'],
                'withheldBalance' => $this->ReturnJson['data']['withheldBalance'],
                'transferableBalance' => $this->ReturnJson['data']['transferableBalance']
            ];
        else:
            $this->Result = false;
        endif;
        return $this->Result;
    }

    /**
     * <b>Solititar Transferencia</>
     * Return False/True
     */
    public function getTranferencia() {
        if (PAYMENT_ENV == 'sandbox'):
            $this->Url = 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/request-transfer?token=' . $this->token;
        else:
            $this->Url = 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/request-transfer?token=' . $this->token;
        endif;

        $this->ReturnJson = json_decode(file_get_contents($this->Url), true);
        if ($this->ReturnJson['success']):
            $this->Result = true;
        else:
            $this->Result = false;
        endif;
        return $this->Result;
    }

    /**
     * <b>Calecamento de Cobranças</b>
     * @param INT $token Codigo de acesso
     * @param INT $code Codigo de transação do boleto
     */
    function getCancelamento($Code) {
        if (PAYMENT_ENV == 'sandbox'):
            $this->Url = 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/cancel-charge?token=' . $this->token . '&code=' . $Code;
        else:
            $this->Url = 'https://boletobancario.com/boletofacil/integration/api/v1/cancel-charge?token=' . $this->token . '&code=' . $Code;
        endif;

        $this->ReturnJson = json_decode(file_get_contents($this->Url), true);
        if ($this->ReturnJson['success']):
            $this->Result = true;
        else:
            $this->Result = false;
        endif;
        return $this->Result;
    }

    /**
     * <b>Consuta de Situação de Pagamento</b>
     * @param INT $Code Codigo de transação do Pagamento
     * Essa consulta só será realizada após o pagamento do boleto
     * A platagorma enviara um POST para a URL de notificação e retornará os dados de pagamento
     */
    function getNotificacao($Code) {
        if (PAYMENT_ENV == 'sandbox'):
            $this->Url = 'https://sandbox.boletobancario.com/boletofacil/integration/api/v1/fetch-payment-details?paymentToken=' . $Code;
        else:
            $this->Url = 'https://boletobancario.com/boletofacil/integration/api/v1/fetch-payment-details?paymentToken=' . $Code;
        endif;

        $this->ReturnJson = json_decode(file_get_contents($this->Url), true);
        if ($this->ReturnJson['success']):
            $this->Result = [
                'tic_payment_id' => $this->ReturnJson['data']['payment']['id'],
                'tic_payment_date' => $this->ReturnJson['data']['payment']['date'],
                'tic_payment_taxa' => $this->ReturnJson['data']['payment']['fee'],
                'tic_payment_status' => $this->ReturnJson['data']['payment']['status']
            ];
        else:
            $this->Result = false;
        endif;
        return $this->Result;
    }

    /**
     * <b>Monta Url</b>
     * Retorno os dados de um Json
     */
    public function getUrl() {
        $this->ReturnJson = json_decode(file_get_contents($this->Url), true);
        if ($this->ReturnJson['success']):

            $this->Result = [
                'code' => $this->ReturnJson['data']['charges'][0]['code'],
                'dueDate' => $this->ReturnJson['data']['charges'][0]['dueDate'],
                'link' => $this->ReturnJson['data']['charges'][0]['link'],
                'payNumber' => $this->ReturnJson['data']['charges'][0]['payNumber']
            ];
        else:
            $this->Result = false;
            $this->Errors = TRUE;
        endif;
    }

    /**
     * <b>Obter Resultado:</b> Retorna um array associativo com o resultado da classe.
     * @return ARRAY $Result = Array associatico com o erro
     */
    public function getResult() {
        echo $this->Result;
    }

    //Limpa código e espaços!
    private function Clear() {
        array_map('strip_tags', $this->Data);
        array_map('trim', $this->Data);
    }

    /**
     * 
     * @param type $Email
     * @return boolean
     * Validação de email
     */
    public function Email($Email) {
        $Data = (string) $Email;
        $Format = '/[a-z0-9_\.\-]+@[a-z0-9_\.\-]*[a-z0-9_\.\-]+\.[a-z]{2,4}$/';
        if (preg_match($Format, $Data)):
            return true;
        else:
            return false;
        endif;
    }

}
