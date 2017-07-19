# BoletoBancario.class.php
Classe de Integração com a Plataforma boletofacil.com


#Como Utilizar?

required 'BoletoFacil.class.php';

//Crei o Objeto da classe
$Boleto = new Boleto();

** Dados Obrigatórios para gerar um boleto **
** Crie um Array com os seguintes item **

$Dados = [
           'description' => 'Descricao do Boleto',
           'amount' => 150.00, ;//valor a ser cobrado
           'name' => 'Nome do Cliente',
           'document' => 'XXX.XXX.XXX-XX', //cpf ou cnpj do cliente (com ou sem pontos)
           'email'=>'email@docliente.com'
         ];
         
- Depois do array criado vc pode chamar a classe e passar as informações:
  ** var_dump($Boleto->emitiBoleto($Dados)); **
  
#Outras várioas de utilização
//Varifcar seu saldo
$Boleto->getSaldo();

//Solicitar transferencias
$Boleto->getTranferencia();

//Cancelar boletos emitidos (Somentes boletos não pagos)
$Boleto->getCancelamento(10051054);
         


Ajude a manter o projeto vivo, estarei sempre disponibilizando novas classes
<form method='post' action='https://www.moip.com.br/Process.do'>
<input type='hidden' name='method' value='donation'/>
<input type='hidden' name='encrypted' value='X9TELUl3w7aSjEp56snNQg=='/>
<input type='hidden' name='type' value='2'/>
<input type='image' name='submit' src='https://www.davsonsantos.com.br/themes/new-blog/images/doarclick.jpg' alt='Davson Santos' border='0' />
</form>
