<?php return array (
  'emails.manualPaymentNotification.subject' => 'Notificação de pagamento manual',
  'emails.manualPaymentNotification.body' => 'É necessário realizar o processamento de um pagamento manual de assinatura da revista {$contextName}, pelo usuário {$userFullName} (login &quot;{$userName}&quot;).<br />
<br />
O item adquirido é &quot;{$itemName}&quot;.<br />
Valor em ({$itemCurrencyCode}): {$itemCost}<br />
<br />
Esta é uma mensagem automática da ferramenta de Pagamento manual do Open Journal Systems.',
  'emails.manualPaymentNotification.description' => 'Mensagem automática notificando editor-gerente que um pagamento manual foi realizado e exige processamento.',
);