<?php return array (
  'emails.paypalInvestigatePayment.subject' => 'Atividade incomum na conta PayPal',
  'emails.paypalInvestigatePayment.body' => 'O sistema encontrou atividade incomum relacionada ao suporte a pagamentos via PayPal da revista {$contextName}. Esta atividade pode exigir investigação mais profunda ou intervenção manual.<br />
                       <br />
Esta é uma mensagem automática da ferramenta de Pagamento via PayPal do Open Journal Systems.<br />
<br />
Informações detalhadas da notificação:<br />
{$postInfo}<br />
<br />
Informações adicionais (caso informado):<br />
{$additionalInfo}<br />
<br />
Variáveis do servidor:<br />
{$serverVars}<br />
',
  'emails.paypalInvestigatePayment.description' => 'Esta mensagem notifica o contato principal da revista sobre atividades suspeitas, ou atividades que exijam intervenção manual, detectadas pelo Plugin de Pagamento via PayPal.',
);