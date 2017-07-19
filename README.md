# BoletoBancario.class.php
Classe de Integração com a Plataforma boletofacil.com

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
*Varifcar seu saldo*
$Boleto->getSaldo();

<em>Solicitar transferencias</em>
$Boleto->getTranferencia();

<em>Cancelar boletos emitidos (Somentes boletos não pagos)</em>
$Boleto->getCancelamento(10051054);
```
