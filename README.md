# BoletoBancario.class.php
Classe de Integração com a Plataforma boletofacil.com

@copyright (c) 2017, Davson Santos - (contato@davsonsantos.com.br)

# Como Utilizar?

- Criando o Objeto
```html
required 'BoletoFacil.class.php';
$Boleto = new Boleto();
```
- Criando um Array para gerar o boleto
```html
$Dados = [
           'description' => 'Descricao do Boleto',
           'amount' => 150.00, ;//valor a ser cobrado
           'name' => 'Nome do Cliente',
           'document' => 'XXX.XXX.XXX-XX', //cpf ou cnpj do cliente (com ou sem pontos)
           'email'=>'email@docliente.com'
         ];
```

- Criação do boleto - Depois do array criado vc pode chamar a classe e passar as informações:
```html
$Boleto->emitiBoleto($Dados)
```

- Outras forma de Utilizar a classe
```html
Verificar seu saldo
$Boleto->getSaldo();

Solicitar transferencias
$Boleto->getTranferencia();

<em>Cancelar boletos emitidos (Somentes boletos não pagos)</em>
$Boleto->getCancelamento(10051054);
```

[![N|Solid](https://www.davsonsantos.com.br/themes/new-blog/images/doarclick.jpg)](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=BA36GAKF3QMFW&lc=BR&item_name=Davson%20Santos&currency_code=BRL&bn=PP%2dDonationsBF%3adoarclick%2ejpg%3aNonHosted)
