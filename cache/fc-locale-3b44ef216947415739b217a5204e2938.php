<?php return array (
  'emails.notification.subject' => 'Nova notificação de {$siteTitle}',
  'emails.notification.body' => 'Você tem uma nova notificação de {$siteTitle}:<br />
<br />
{$notificationContents}<br />
<br />
Link: {$url}<br />
<br />
{$principalContactSignature}',
  'emails.notification.description' => 'Esta mensagem é enviada a usuários cadastrados que escolheram habilitar este tipo de notificação via email.',
  'emails.passwordResetConfirm.subject' => 'Confirmação de Redefinição de Senha',
  'emails.passwordResetConfirm.body' => 'Recebemos uma solicitação para redefinir sua senha para o site {$siteTitle}.<br />
<br />
Se você não fez essa solicitação, favor ignorar este e-mail e sua senha não será alterada. Se você deseja redefinir sua senha, clique na URL abaixo.<br />
<br />
Redefinir minha senha: {$url}<br />
<br />
{$principalContactSignature}',
  'emails.passwordResetConfirm.description' => 'Esta mensagem é enviada a um usuário cadastrado quando o mesmo indica que tenha esquecido sua senha ou não consiga efetuar login. Um link é fornecido que permite ao usuário redefinir sua senha.',
  'emails.passwordReset.subject' => 'Senha Redefinida',
  'emails.passwordReset.body' => 'Sua senha foi redefinida com sucesso para uso com o site {$siteTitle}. Favor guardar esse nome de usuário e senha, pois são necessários para todo o trabalho com o periódico.<br />
<br />
Seu usuário: {$username}<br />
Senha: {$password}<br />
<br />
{$principalContactSignature}',
  'emails.passwordReset.description' => 'Esta mensagem é enviada a um usuário cadastrado quando ele redefiniu sua senha com sucesso, seguindo o processo descrito na mensagem PASSWORD_RESET_CONFIRM.',
  'emails.userRegister.subject' => 'Cadastro no Periódico',
  'emails.userRegister.body' => '{$userFullName}<br />
<br />
Agora você foi cadastrado como um usuário em {$contextName}. Incluímos seu nome de usuário e senha neste e-mail, necessários para todo o trabalho neste periódico por meio de seu site. A qualquer momento, você pode pedir para ser removido da lista de usuários da revista entrando em contato comigo.<br />
<br />
Usuário: {$username}<br />
Senha: {$password}<br />
<br />
Atenciosamente,<br />
{$principalContactSignature}',
  'emails.userRegister.description' => 'Esta mensagem é enviada aos usuários recém-cadastrados no sistema, para dar-lhes as boas-vindas e deixar registrado seu login e senha.',
  'emails.userValidate.subject' => 'Valide seu Cadastro',
  'emails.userValidate.body' => '{$userFullName}<br />
<br />
Você criou uma conta no periódico {$contextName}, mas antes de começar a usá-la, você precisa validar sua conta de e-mail. Para fazer isso, basta clicar no link abaixo:<br />
<br />
{$activateUrl}<br />
<br />
Atenciosamente,<br />
{$principalContactSignature}',
  'emails.userValidate.description' => 'Esta mensagem é enviada a um novo usuário cadastrado, para validação do cadastro.',
  'emails.reviewerRegister.subject' => 'Cadastrado como Avaliador em {$contextName}',
  'emails.reviewerRegister.body' => 'Devido à sua experiência, tomamos a liberdade de cadastrar seu nome no banco de dados de avaliadores para {$contextName}. Isso não implica qualquer forma de compromisso de sua parte, mas simplesmente nos permite lhe contatar com uma submissão para uma possível avaliação. Ao ser convidado(a) a avaliar, você terá a oportunidade de ver o título e o resumo do artigo em questão e poderá sempre aceitar ou recusar o convite. Você também pode pedir a qualquer momento para remover seu nome desta lista de avaliadores.<br />
<br />
Estamos fornecendo a você um nome de usuário e senha, que são usados em todas as interações com o periódico por meio de seu site. Você pode, por exemplo, atualizar seu perfil, incluindo seus interesses de avaliação.<br />
<br />
Usuário: {$username}<br />
Senha: {$password}<br />
<br />
Atenciosamente,<br />
{$principalContactSignature}',
  'emails.reviewerRegister.description' => 'Esta mensagem é enviada a um avaliador recém-cadastrado para dar-lhe as boas-vindas e deixar registrado o seu nome de login e senha.',
  'emails.publishNotify.subject' => 'Nova Edição Publicada',
  'emails.publishNotify.body' => 'Caros leitores:<br />
<br />
{$contextName} acaba de publicar sua edição mais recente em {$contextUrl}. Convidamos a consultar o sumário abaixo e, em seguida, visitar o site para verificar os artigos e itens de interesse.<br />
<br />
Agradecemos pelo interesse em nosso trabalho,<br />
{$editorialContactSignature}',
  'emails.publishNotify.description' => 'Esta mensagem é enviada para leitores cadastrados através do link "notificação de usuários" na página do Editor. Ela avisa os leitores a respeito de uma nova edição e os convida a acessar o periódico através da URL informada.',
  'emails.lockssExistingArchive.subject' => 'Solicitação para Arquivamento de {$contextName}',
  'emails.lockssExistingArchive.body' => 'Prezado(a) [bibliotecário(a) da universidade]<br />
<br />
{$contextName} &amp;lt;{$contextUrl}&amp;gt;, é um periódico para o qual um membro de sua instituição, [nome do membro], serve como [título da posição]. O periódico está buscando estabelecer um arquivo compatível com LOCKSS (Lots of Copies Keep Stuff Safe) com esta e outras bibliotecas universitárias.<br />
<br />
[Breve descrição do periódico]<br />
<br />
A URL do Manifesto do Publicador LOCKSS para nosso periódico é: {$contextUrl}/gateway/lockss<br />
<br />
Entendemos que você já está participando do LOCKSS. Se pudermos fornecer metadados adicionais para registrar nosso periódico com sua versão do LOCKSS, teremos prazer em fornecê-los.<br />
<br />
Atenciosamente,<br />
{$principalContactSignature}',
  'emails.lockssExistingArchive.description' => 'Esta mensagem solicita ao mantenedor de um repositório LOCKSS que considere incluir este periódico em seu acervo, informando a URL para o Manifesto LOCKSS da editora.',
  'emails.lockssNewArchive.subject' => 'Solicitação de inclusão da revista {$contextName} em seu arquivo',
  'emails.lockssNewArchive.body' => 'Prezado(a) [Bibliotecário(a) da Universidade]<br />
<br />
{$contextName} &amp;lt;{$contextUrl}&amp;gt;, é um periódico no qual um membro de sua instituição, [nome do membro], serve como [título da posição]. O periódico está buscando estabelecer um acervo compatível com o LOCKSS (Lots of Copies Keep Stuff Safe) com esta e outras bibliotecas universitárias.<br />
<br />
[Breve descrição do periódico]<br />
<br />
O Programa LOCKSS &amp;lt;http://lockss.org/&amp;gt;, uma iniciativa internacional entre bibliotecas e editoras, é um exemplo prático de um repositório de preservação e arquivamento distribuído, conforme detalhes adicionais abaixo. O software, que roda em um computador pessoal comum, é gratuito; o sistema é facilmente colocado online; e pouca manutenção é necessária.<br /> 
<br />
Para ajudar no arquivamento de nosso periódico, convidamos você a se tornar um membro da comunidade LOCKSS, para ajudar a coletar e preservar títulos produzidos por seu corpo docente e por outros acadêmicos no mundo todo. Para fazer isso, peça a alguém da sua equipe que visite o site da LOCKSS para obter informações sobre como este sistema opera. Agradeço seu retorno a respeito da viabilidade de fornecer esse suporte de arquivamento para este periódico. <br />
<br />
Atenciosamente,<br />
{$principalContactSignature}',
  'emails.lockssNewArchive.description' => 'Mensagem convida o destinatário a participar da iniciativa LOCKSS e incluir a revista no seu repositório. O e-mail oferece informações iniciais e sobre como participar na iniciativa LOCKSS e formas de se envolver.',
  'emails.submissionAck.subject' => 'Agradecimento pela submissão',
  'emails.submissionAck.body' => '{$authorName}:<br />
<br />
Obrigado por submeter o manuscrito, &quot;{$submissionTitle}&quot; ao periódico {$contextName}. Com o sistema de gerenciamento de periódicos on-line que estamos usando, você poderá acompanhar seu progresso através do processo editorial efetuando login no site do periódico:<br />
<br />
URL da Submissão: {$submissionUrl}<br />
Usuário: {$authorUsername}<br />
<br />
Se você tiver alguma dúvida, entre em contato conosco. Agradecemos por considerar este periódico para publicar o seu trabalho.<br />
<br />
{$editorialContactSignature}',
  'emails.submissionAck.description' => 'Mensagem enviada automaticamente pelo sistema ao autor, quando habilitada, ao ser concluído o processo de submissão de um manuscrito à revista. Oferece informações sobre os mecanismos para acompanhamento da submissão durante o processo editorial, e serve como registro e confirmação da submissão.',
  'emails.submissionAckNotUser.subject' => 'Agradecimento pela submissão',
  'emails.submissionAckNotUser.body' => 'Olá,<br />
<br />
{$submitterName} submeteu o manuscrito, &quot;{$submissionTitle}&quot; ao periódico {$contextName}. <br />
<br />
Se você tiver alguma dúvida, entre em contato conosco. Agradecemos por considerar este periódico para publicar o seu trabalho.<br />
<br />
{$editorialContactSignature}',
  'emails.submissionAckNotUser.description' => 'Quando habilitada, esta mensagem é enviada automaticamente aos coautores informados durante o processo de submissão, que não estão cadastrados no OJS.',
  'emails.editorAssign.subject' => 'Tarefa editorial',
  'emails.editorAssign.body' => '{$editorialContactName}:<br />
<br />
A submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName} lhe foi designada para acompanhar o processo editorial em sua função como Editor de Seção.<br />
<br />
URL da Submissão: {$submissionUrl}<br />
Usuário: {$editorUsername}<br />
<br />
Obrigado.',
  'emails.editorAssign.description' => 'Mensagem notifica o Editor de Seção que uma nova tarefa de acompanhamento de submissão lhe foi designada pelo Editor-Gerente. Oferece informações sobre a submissão e como acessar o sistema.',
  'emails.reviewRequest.subject' => 'A revista {$contextName} solicita avaliação de artigo',
  'emails.reviewRequest.body' => '{$reviewerName}:<br />
<br />
Acredito que você poderia servir como um(a) excelente avaliador(a) do manuscrito, &quot;{$submissionTitle},&quot; que foi submetido ao periódico {$contextName}. O resumo da submissão está inserido abaixo e espero que você considere realizar essa importante tarefa para nós.<br />
<br />
Faça o login no site do periódico antes de {$responseDueDate} para indicar sua disponibilidade, bem como para acessar submissão e registrar sua avaliação e recomendação. O site é {$contextUrl}<br />
<br />
A avaliação em si tem como prazo {$reviewDueDate}.<br />
<br />
Se você não tiver seu nome de usuário e senha para o site do periódico, poderá usar este link para redefinir sua senha (que será enviada por e-mail juntamente com seu nome de usuário). {$passwordResetUrl}<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Agradeço por considerar esta solicitação.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequest.description' => 'Mensagem do Editor de Seção para solicitar ao Avaliador que indique disponibilidade ou não para realizar uma avaliação. Oferece informações sobre a submissão, como título e resumo, além da data para a conclusão dos trabalhos e como acessar o documento. Esta mensagem é usada quando se utiliza o Processo Padrão de Avaliação, definido no Passo 2 de Configuração da Revista. (Caso contrário veja REVIEW_REQUEST_ATTACHED.)',
  'emails.reviewRequestRemindAuto.subject' => 'A revista {$contextName} solicita avaliação de artigo',
  'emails.reviewRequestRemindAuto.body' => '{$reviewerName}:<br />
Este é apenas um lembrete amigável do nosso pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName}. Esperávamos ter recebido sua resposta até {$responseDueDate}, assim este email foi gerado e enviado automaticamente com o passar dessa data.
<br />
Acredito que você serviria como um(a) excelente avaliador(a) do manuscrito. O resumo da submissão está inserido abaixo e espero que você considere realizar essa importante tarefa para nós.<br />
<br />
Faça login no site do periódico para indicar se você fará a avaliação ou não, bem como para acessar a submissão e registrar sua avaliação e recomendação. O site é {$contextUrl}<br />
<br />
A avaliação em si tem como prazo {$reviewDueDate}.<br />
<br />
Se você não tiver seu nome de usuário e senha para o site do periódico, poderá usar este link para redefinir sua senha (que será enviada por e-mail juntamente com seu nome de usuário). {$passwordResetUrl}<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Agradeço por considerar esta solicitação.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestRemindAuto.description' => 'Este e-mail é automaticamente enviando quando o prazo para confirmação de um avaliador vence (veja as Opções para avaliação em Configurações > Fluxo de trabalho > Avaliação) e a opção de habilitar acesso 1-clique para o avaliador está desabilitada. Tarefas agendadas devem ser habilitadas e configuradas (veja o arquivo de configuração do site).',
  'emails.reviewRequestOneclick.subject' => 'Solicita avaliação de artigo',
  'emails.reviewRequestOneclick.body' => '{$reviewerName}:<br />
<br />
Eu acredito que você seria um(a) excelente parecerista para o manuscrito, &quot;{$submissionTitle},&quot; que foi submetido ao periódico {$contextName}. O resumo da submissão segue abaixo e eu espero que você considere o aceite desta tarefa importante.<br />
<br />
Por gentileza, logue no site do periódico até {$responseDueDate} para indicar se você aceita fazer o parecer ou não, além de acessar a submissão para registrar sua avaliação e recomendação.<br />
<br />
O prazo para entrega do parecer é {$reviewDueDate}.<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Obrigado por considerar este pedido.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestOneclick.description' => 'Mensagem do Editor de Seção para solicitar ao Avaliador que indique disponibilidade ou não para realizar uma avaliação. Oferece informações sobre a submissão, como título e resumo, além da data para a conclusão dos trabalhos e como acessar o documento. Esta mensagem é usada quando se utiliza o Processo Padrão de Avaliação, definido no Passo 2 de Configuração da Revista e a opção de acesso de avaliadores com 1-clique esteja habilitada.',
  'emails.reviewRequestRemindAutoOneclick.subject' => 'Solicita avaliação de artigo',
  'emails.reviewRequestRemindAutoOneclick.body' => '{$reviewerName}:<br />
Este é apenas um lembrete amigável do nosso pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName}. Esperávamos ter recebido sua resposta até {$responseDueDate}, assim este email foi gerado e enviado automaticamente com o passar dessa data.
<br />
Eu acredito que você seria um ótimo(a) parecerista para o manuscrito. O resumo da submissão segue abaixo e eu espero que você considere o aceite desta tarefa tão importante para nós.<br />
<br />
Por gentileza, logue no site do periódico para indicar se você irá aceitar dar o parecer ou não, e também para acessar a submissão e registrar sua avaliação e recomendação.<br />
<br />
O prazo para envio do parecer é {$reviewDueDate}.<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Obrigado por considerar este pedido.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestRemindAutoOneclick.description' => 'Esse e-mail é enviado automaticamente quando a data de limite de confirmação do avaliador termina (consulte Opções de avaliação em Configurações> Fluxo de trabalho> Avaliação) e o acesso do avaliador com 1-clique está ativado. As tarefas agendadas devem ser ativadas e configuradas (consulte o arquivo de configuração do site).',
  'emails.reviewRequestAttached.subject' => 'A revista {$contextName} solicita avaliação de artigo',
  'emails.reviewRequestAttached.body' => '{$reviewerName}:<br />
<br />
Eu acredito que você seria um ótimo(a) parecerista para o manuscrito, &quot;{$submissionTitle},&quot; e estou pedindo que considere aceitar esta importante tarefa para nós. As Diretrizes de Avaliação deste periódico seguem abaixo, e a submissão está anexa ao email. Sua avaliação da submissão, junto à sua recomendação, devem ser enviadas por email para mim até {$reviewDueDate}.<br />
<br />
Por gentileza, indique se você aceita dar o parecer ou não por e-mail até {$responseDueDate}.<br />
<br />
Obrigado por considerar este pedido.<br />
<br />
{$editorialContactSignature}<br />
<br />
<br />
Diretrizes de Avaliação<br />
<br />
{$reviewGuidelines}<br />
',
  'emails.reviewRequestAttached.description' => 'Este email é enviado pelo Editor de Seção para um Avaliador solicitando que ele aceite ou decline a tarefa de dar um parecer para uma submissão. A submissão é enviada anexada ao e-mail. A mensagem é utilizada quando o Processo de Avaliação por Anexo de E-mail é selecionado em Gerenciamento > Configurações > Fluxo de Trabalho > Avaliação. (Alternativamente veja REVIEW_REQUEST)',
  'emails.reviewRequestSubsequent.subject' => 'Solicitação de avaliação de artigo',
  'emails.reviewRequestSubsequent.body' => '{$reviewerName}:<br />
<br />
Esta mensagem é referente ao manuscrito &quot;{$submissionTitle},&quot; que está sendo avaliado para publicação pelo periódico {$contextName}.<br />
<br />
Após a avaliação da versão anterior do manuscrito, os autores submeteram uma versão revisada do artigo. Nós apreciaríamos se você pudesse ajudar com um parecer.<br />
<br />
Por gentileza, logue no site do periódico até {$responseDueDate} para indicar se você irá aceitar dar o parecer ou não, e também para acessar a submissão e registrar sua avaliação e recomendação. O site é {$contextUrl}<br />
<br />
O prazo para envio do parecer é {$reviewDueDate}.<br />
<br />
Caso você não possua login e senha para o site deste periódico, você pode usar este link para solicitar uma nova senha (que lhe será, então, enviada por email junto ao seu login). {$passwordResetUrl}<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Obrigado por considerar este pedido.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestSubsequent.description' => 'Este e-mail do Editor de Seção para um Avaliador, que solicita ao usuário aceitar ou recusar a tarefa de avaliar uma submissão para uma segunda ou maior rodada de avaliação. Ele fornece informações sobre a submissão, como o título e resumo, uma data de limite de avaliação, e como acessar a própria submissão. Essa mensagem é usada quando o Processo de Avaliação Padrão é selecionado em Configurações> Fluxo de trabalho> Avaliação. (Caso contrário, consulte REVIEW_REQUEST_ATTACHED_SUBSEQUENT.)',
  'emails.reviewRequestOneclickSubsequent.subject' => 'Solicitação de avaliação de artigo',
  'emails.reviewRequestOneclickSubsequent.body' => '{$reviewerName}:<br />
<br />
Esta mensagem é referente ao manuscrito &quot;{$submissionTitle},&quot; que está sendo considerado para publicação pelo periódico {$contextName}.<br />
<br />
Após uma avaliação da versão anterior do manuscrito, os autores submeteram uma versão revisada do artigo. Nós agradeceríamos se você pudesse ajudar com um parecer.<br />
<br />
Por gentileza, logue no site do periódico até {$responseDueDate} para indicar se você irá aceitar dar o parecer ou não, e também para acessar a submissão e registrar sua avaliação e recomendação.<br />
<br />
O prazo para envio do parecer é {$reviewDueDate}.<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Obrigado por considerar este pedido.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestOneclickSubsequent.description' => 'Este e-mail do Editor de Seção para um Avaliador solicita que o avaliador aceite ou recuse a tarefa de avaliar uma submissão para uma segunda ou maior rodada de avaliação. Ele fornece informações sobre a submissão, como título e resumo, uma data limite para avaliação e como acessar a própria submissão. Esta mensagem é usada quando o processo de avaliação está selecionado em Configuração > Fluxo de Trabalho > Avaliação e a opção "Habilitar acesso 1-clique" na área do avaliador está ativada.',
  'emails.reviewRequestAttachedSubsequent.subject' => 'Solicitação de avaliação de artigo',
  'emails.reviewRequestAttachedSubsequent.body' => '{$reviewerName}:<br />
<br />
Esta mensagem é referente ao manuscrito &quot;{$submissionTitle},&quot; que está sendo considerado para publicação pelo periódico {$contextName}.<br />
<br />
Após a avaliação da versão anterior do manuscrito, os autores submeteram uma versão revisada do artigo. Nós agradeceríamos se você pudesse ajudar com uma avaliação.<br />
<br />
As Diretrizes de Avaliação deste periódico seguem abaixo e a submissão está anexa ao e-mail. Sua avaliação da submissão, junto à recomendação, deve ser enviada por e-mail até {$reviewDueDate}.<br />
<br />
Por gentileza, envie um email de retorno até{$responseDueDate} indicando se você poderá dar o parecer ou não.<br />
<br />
Obrigado por considerar este pedido.<br />
<br />
{$editorialContactSignature}<br />
<br />
<br />
Diretrizes de Avaliação<br />
<br />
{$reviewGuidelines}<br />
',
  'emails.reviewRequestAttachedSubsequent.description' => 'Esta mensagem é enviada pelo Editor de seção ao avaliador, perguntando se estaria disponível para enviar a avaliação de uma submissão em uma segunda rodada ou superior. A mensagem inclui a submissão como anexo. Ela é usada quando o processo de avaliação via e-mail é escolhido em  Configurações > Fluxo de trabalho > Avaliação.  (Caso contrário, veja REVIEW_REQUEST_SUBSEQUENT.)',
  'emails.reviewCancel.subject' => 'Cancelamento de solicitação de avaliação',
  'emails.reviewCancel.body' => '{$reviewerName}:<br />
<br />
Nós decidimos cancelar o pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; para o periódico {$contextName}. Nós pedimos desculpas por qualquer inconveniência que isso lhe causou e esperamos poder contar com sua assistência no processo de avaliação por pares deste periódico no futuro.<br />
<br />
Se tiver alguma dúvida, por gentileza, entre em contato comigo.',
  'emails.reviewCancel.description' => 'Mensagem enviada pelo Editor de Seção com um processo de avaliação em andamento, notificando que o processo em questão foi cancelado.',
  'emails.reviewReinstate.subject' => 'Solicitação de revisão restabelecida',
  'emails.reviewReinstate.body' => '{$reviewerName}:<br />
<br />
Nós gostaríamos de convidá-lo(a) novamente para dar um parecer à submissão, &quot;{$submissionTitle},&quot; para o periódico {$contextName}. Nós esperamos que você possa nos ajudar no processo de avaliação por pares deste periódico.<br />
<br />
Se tiver alguma dúvida, por favor, entre em contato comigo.',
  'emails.reviewReinstate.description' => 'Este e-mail é enviado pelo Editor de Seção a um Avaliador que possui uma avaliação de uma submissão em andamento para notificá-lo de que uma avaliação cancelada foi restabelecida.',
  'emails.reviewConfirm.subject' => 'Disponível para realizar avaliação',
  'emails.reviewConfirm.body' => 'Prezados editores, <br />
<br />
Eu tenho disponibilidade para dar um parecer para a submissão, &quot;{$submissionTitle},&quot; para o periódico {$contextName}. Agradeço por lembrar de mim, e pretendo enviar o parecer até {$reviewDueDate}, se não antes.<br />
<br />
Atenciosamente,
<br />
{$reviewerName}',
  'emails.reviewConfirm.description' => 'Mensagem enviada pelo Avaliador ao Editor de Seção, em resposta à solicitação de avaliação, para notificar disponibilidade para realizar a tarefa e de que a mesma será concluída no prazo especificado.',
  'emails.reviewDecline.subject' => 'Indisponível para realizar avaliação',
  'emails.reviewDecline.body' => 'Editores(as):<br />
<br />
Temo não poder dar um parecer à submissão &quot;{$submissionTitle},&quot; para o periódico {$contextName} no momento. Agradeço por lembrar de mim, e fiquem à vontade para me convidar novamente em um outro momento.<br />
<br />
{$reviewerName}',
  'emails.reviewDecline.description' => 'Mensagem enviada pelo Avaliador ao Editor de Seção, em resposta à solicitação de avaliação, para notificar sua NÃO disponibilidade para realizar a tarefa, rejeitando a solicitação.',
  'emails.reviewAck.subject' => 'Agradecimento pela avaliação',
  'emails.reviewAck.body' => '{$reviewerName}:<br />
<br />
Agradeço por enviar o parecer da submissão &quot;{$submissionTitle},&quot; para o periódico {$contextName}. Nós apreciamos sua contribuição para manter a qualidade dos trabalhos que publicamos.',
  'emails.reviewAck.description' => 'Mensagem enviada pelo Editor de Seção ao Avaliador para confirmar recebimento e agradecer o avaliador pela conclusão da avaliação.',
  'emails.reviewRemind.subject' => 'Lembrete de solicitação de avaliação',
  'emails.reviewRemind.body' => '{$reviewerName}:<br />
<br />
Este é apenas um lembrete amigável do nosso pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName}. Esperávamos ter recebido sua avaliação até {$reviewDueDate}, então gostaríamos de recebê-la assim que você conseguir prepará-la.<br />
<br />
Se você não tiver seu nome de usuário e senha para o site do periódico, poderá usar este link para redefinir sua senha (que será enviada por e-mail juntamente com seu nome de usuário). {$passwordResetUrl}<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Por favor, confirme que poderá completar essa contribuição vital ao trabalho do periódico. Aguardo seu retorno.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemind.description' => 'Mensagem enviada pelo Editor de Seção ao Avaliador como lembrete da tarefa de avaliação em andamento ainda não concluída.',
  'emails.reviewRemindOneclick.subject' => 'Lembrete de solicitação de avaliação',
  'emails.reviewRemindOneclick.body' => '{$reviewerName}:<br />
<br />
Este é apenas um lembrete amigável do nosso pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName}. Esperávamos ter recebido sua avaliação até {$reviewDueDate}, então gostaríamos de recebê-la assim que você conseguir prepará-la.<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Por favor, confirme que poderá completar essa contribuição vital ao trabalho do periódico. Aguardo seu retorno.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemindOneclick.description' => 'Mensagem enviada pelo Editor de Seção ao Avaliador como lembrete da tarefa de avaliação em andamento ainda não concluída.',
  'emails.reviewRemindAuto.subject' => 'Lembrete automático de solicitação de avaliação',
  'emails.reviewRemindAuto.body' => '{$reviewerName}:<br />
<br />
Este é apenas um lembrete amigável do nosso pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName}. Esperávamos ter recebido sua avaliação até {$reviewDueDate}, então este email foi gerado automaticamente com o passar daquele prazo. Nós ainda assim ficaríamos gratos em recebê-la assim que você conseguir prepará-la.<br />
<br />
Se você não tiver seu nome de usuário e senha para o site do periódico, poderá usar este link para redefinir sua senha (que será enviada por e-mail juntamente com seu nome de usuário). {$passwordResetUrl}<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Por favor, confirme que poderá completar essa contribuição vital ao trabalho do periódico. Aguardo seu retorno.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemindAuto.description' => 'Mensagem enviada automaticamente ao avaliador quando a data de conclusão de avaliação for ultrapassada (veja as Opções de Avaliação no Passo 2 da Configuração da Revista). Tarefas agendadas devem ser habilitadas e configuradas (veja o arquivo de configuração do sistema).',
  'emails.reviewRemindAutoOneclick.subject' => 'Lembrete automático de solicitação de avaliação',
  'emails.reviewRemindAutoOneclick.body' => '{$reviewerName}:<br />
<br />
Este é apenas um lembrete amigável do nosso pedido de avaliação da submissão, &quot;{$submissionTitle},&quot; ao periódico {$contextName}. Esperávamos ter recebido sua avaliação até {$reviewDueDate}, então este email foi gerado automaticamente com o passar daquele prazo. Nós ainda assim ficaríamos gratos em recebê-la assim que você conseguir prepará-la.<br />
<br />
URL da submissão: {$submissionReviewUrl}<br />
<br />
Por favor, confirme que poderá completar essa contribuição vital ao trabalho do periódico. Aguardo seu retorno.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemindAutoOneclick.description' => 'Mensagem enviada automaticamente ao avaliador quando a data de conclusão de avaliação for ultrapassada (veja as Opções de Avaliação no Passo 2 da Configuração da Revista) e o acesso 1-Clique estiver ativado. Tarefas agendadas devem ser habilitadas e configuradas (veja o arquivo de configuração do sistema).',
  'emails.editorDecisionAccept.subject' => 'Decisão editorial',
  'emails.editorDecisionAccept.body' => '{$authorName}:<br />
<br />
Nós chegamos a uma decisão referente a sua submissão para o periódico {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Nossa decisão é de: Aceitar a Submissão',
  'emails.editorDecisionAccept.description' => 'Esta é uma mensagem do Editor/Editor de Seção ao autor para notificá-lo da decisão editorial (final) tomada sobre a submissão.',
  'emails.editorDecisionSendToExternal.subject' => 'Decisão do Editor',
  'emails.editorDecisionSendToExternal.body' => '{$authorName}:<br />
<br />
Nós chegamos a uma decisão referente a sua submissão para o periódico {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Nossa decisão é de: Enviar para avaliação<br />
<br />
URL da submissão: {$submissionUrl}',
  'emails.editorDecisionSendToExternal.description' => 'Este e-mail enviado pelo Editor ou Editor de Seção para um autor serve para notificar o mesmo de que sua submissão foi enviada para avaliadores externos.',
  'emails.editorDecisionSendToProduction.subject' => 'Decisão do Editor',
  'emails.editorDecisionSendToProduction.body' => '{$authorName}:<br />
<br />
A edição de texto da sua submissão, &quot;{$submissionTitle},&quot; está completa. Agora ela está sendo enviada para  editoração.<br />
<br />
URL da submissão: {$submissionUrl}',
  'emails.editorDecisionSendToProduction.description' => 'Este e-mail do Editor ou Editor de Seção para um Autor notifica-os de que seus envios estão sendo enviados para produção.',
  'emails.editorDecisionRevisions.subject' => 'Decisão editorial',
  'emails.editorDecisionRevisions.body' => '{$authorName}:<br />
<br />
Nós chegamos a uma decisão referente a sua submissão para o periódico {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Nossa decisão é de: Revisões Requeridas',
  'emails.editorDecisionRevisions.description' => 'Esta mensagem é enviada pelo Editor ou Editor de Seção ao autor, notificando-o da decisão final de "<strong>Revisões Requeridas</strong>" tomada sobre a sua submissão.',
  'emails.editorDecisionResubmit.subject' => 'Decisão editorial',
  'emails.editorDecisionResubmit.body' => '{$authorName}:<br />
<br />
Nós chegamos a uma decisão referente a sua submissão para o periódico {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Nossa decisão é de: Ressubmeter para Avaliação',
  'emails.editorDecisionResubmit.description' => 'Esta mensagem do Editor/Editor de Seção ao autor notifica sobre a decisão editorial final tomada sobre a submissão.',
  'emails.editorDecisionDecline.subject' => 'Decisão editorial',
  'emails.editorDecisionDecline.body' => '{$authorName}:<br />
<br />
Nós chegamos a uma decisão referente a sua submissão para o periódico {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Nossa decisão é de: Rejeitar a Submissão',
  'emails.editorDecisionDecline.description' => 'Esta mensagem do Editor/Editor de Seção ao autor notifica sobre a decisão final tomada sobre a submissão.',
  'emails.editorRecommendation.subject' => 'Recomendação do Editor',
  'emails.editorRecommendation.body' => '{$editors}:<br />
<br />
A recomendação referente à submissão para o periódico {$contextName}, &quot;{$submissionTitle}&quot; é: {$recommendation}',
  'emails.editorRecommendation.description' => 'Este e-mail do Editor que recomenda ou do Editor de Seção para os Editores que tomam decisões ou Editores de Seção notifica-os de uma recomendação final sobre a submissão.',
  'emails.copyeditRequest.subject' => 'Solicitação de edição de texto',
  'emails.copyeditRequest.body' => '{$participantName}: <br />
<br />
Peço que você realize a revisão textual de &quot;{$submissionTitle}&quot; para {$contextName} seguindo estas etapas. <br />
1. Clique no URL da Submissão abaixo. <br />
2. Abra todos os arquivos disponíveis em "Arquivos de Versão Final" e faça sua revisão textual, adicionando quaisquer discussões em "Discussão da edição de texto" conforme necessário. <br />
3. Salve os arquivos revisados e faça o carregamento no painel "Texto editado". <br />
4. Notifique o Editor de que todos os arquivos foram preparados e que o processo de "Editoração" pode começar. <br />
<br />
URL de {$contextName}: {$contextUrl} <br />
URL de Submissão: {$submitUrl} <br />
Nome de usuário: {$participantUsername}',
  'emails.copyeditRequest.description' => 'Mensagem enviada pelo Editor de Seção solicitando a realização de uma tarefa de edição ao Editor de Texto, com informações sobre e como acessar o documento.',
  'emails.layoutRequest.subject' => 'Solicitação de composições',
  'emails.layoutRequest.body' => '{$participantName}:<br />
<br />
A submissão &quot;{$submissionTitle}&quot; para {$contextName} de provas tipográficas, conforme as seguintes etapas. <br />
1. Clique na URL de Submissão abaixo. <br />
2. Faça login no periódico e use os arquivos Prontos para Produção para criar as provas de acordo com os padrões do periódico. <br />
3. Carregue as provas na seção Arquivos de Prova. <br />
4. Notifique o Editor, usando as Discussões de Produção, informando de que as provas estão carregadas e prontas. <br />
<br />
URL de {$contextName}: {$contextUrl} <br />
URL da submissão: {$submitUrl} <br />
Nome de usuário: {$participantUsername} <br />
<br />
Se você não conseguir realizar esse trabalho no momento ou tiver alguma dúvida, entre em contato comigo. Obrigado por sua contribuição para este periódico.',
  'emails.layoutRequest.description' => 'Mensagem enviada pelo Editor de Seção ao Editor de Layout, solicitando que sejam preparadas as Composições do texto final, com informações de acesso.',
  'emails.layoutComplete.subject' => 'Composições concluídas',
  'emails.layoutComplete.body' => '{$editorialContactName}: <br />
<br />
As provas topográficas já foram preparadas para o manuscrito &quot;{$submissionTitle} &quot; para {$contextName} e estão prontas para a revisão.<br />
<br />
Se você tiver alguma dúvida, favor entrar em contato comigo. <br />
<br />
{$participantName}',
  'emails.layoutComplete.description' => 'Mensagem enviada pelo Editor de Layout ao Editor de Seção, informando sobre a conclusão das composições.',
  'emails.emailLink.subject' => 'Artigo interessante para sua leitura',
  'emails.emailLink.body' => 'Acredito ser de seu interesse o artigo "{$submissionTitle}", de {$authorName}, publicado na revista {$contextName}, V. {$volume}, n. {$number}, Ano {$year}, disponível em "{$articleUrl}".',
  'emails.emailLink.description' => 'Mensagem enviada por um leitor a um colega, sobre um artigo considerado de seu interesse, com link para acesso e informações sobre a revista e a edição onde o documento foi publicado.',
  'emails.subscriptionNotify.subject' => 'Confirmação de assinatura',
  'emails.subscriptionNotify.body' => '{$subscriberName}: <br />
<br />
Agora você foi registrado como assinante em nossa {$contextName}, com a seguinte assinatura: <br />
<br />
{$subscriptionType} <br />
<br />
Para acessar o conteúdo disponível apenas para assinantes, basta fazer login no sistema com seu nome de usuário,  &quot;{$username} &quot;. <br />
<br />
Depois de fazer login no sistema, você poderá alterar os detalhes e a senha do seu perfil a qualquer momento. <br />
<br />
Observe que se você possui uma assinatura institucional, não é necessário que os usuários da sua instituição efetuem login, pois as solicitações de conteúdo da assinatura serão automaticamente autenticadas pelo sistema. <br />
<br />
Se você tiver alguma dúvida, por favor não hesite em contactar-me. <br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionNotify.description' => 'Mensagem notifica o leitor cadastrado que o Editor criou sua Assinatura. Proporciona todas as informações necessárias para acesso ao conteúdo.',
  'emails.openAccessNotify.subject' => 'Nova edição de Acesso Livre',
  'emails.openAccessNotify.body' => 'Leitores: <br />
<br />
{$contextName} acabou de disponibilizar em um formato de acesso aberto a seguinte edição. Convidamos você a verificar o sumário abaixo e, em seguida, visitar nosso site ({$contextUrl}) para conferir os artigos e itens de interesse. <br />
<br />
Obrigado pelo interesse em nosso trabalho, <br />
{$editorialContactSignature}',
  'emails.openAccessNotify.description' => 'Esta mensagem é enviada a leitores cadastrados que solicitam o recebimento do sumário de uma nova edição de Acesso Livre.',
  'emails.subscriptionBeforeExpiry.subject' => 'Aviso de expiração de assinatura',
  'emails.subscriptionBeforeExpiry.body' => '{$subscriberName}: <br />
<br />
Sua assinatura do {$contextName} está prestes a expirar. <br />
<br />
{$subscriptionType} <br />
Data de validade: {$expiryDate} <br />
<br />
Para garantir a continuidade do seu acesso a esta revista, acesse o site da revista e renove sua assinatura. Você pode fazer login no sistema com seu nome de usuário, &quot;{$username}&quot;. <br />
<br />
Se você tiver alguma dúvida, não hesite em contactar-me. <br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionBeforeExpiry.description' => 'Esta mensagem avisa o assinante da proximidade do término da assinatura. Informa a URL da revista e instruções de acesso.',
  'emails.subscriptionAfterExpiry.subject' => 'Expiração de assinatura',
  'emails.subscriptionAfterExpiry.body' => '{$subscriberName}: <br />
<br />
Sua assinatura do {$contextName} expirou. <br />
<br />
{$subscriptionType} <br />
Data de validade: {$expiryDate} <br />
<br />
Para renovar sua assinatura, acesse o site da revista. Você pode fazer login no sistema com seu nome de usuário, &quot;{$username}&quot;. <br />
<br />
Se você tiver alguma dúvida, por favor não hesite em contactar-me. <br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionAfterExpiry.description' => 'Esta mensagem avisa o assinante da expiração da assinatura. Informa a URL da revista e instruções de acesso.',
  'emails.subscriptionAfterExpiryLast.subject' => 'Expiração de assinatura - Lembrete final',
  'emails.subscriptionAfterExpiryLast.body' => '{$subscriberName}: <br />
<br />
Sua assinatura do {$contextName} expirou. <br />
Observe que este é o lembrete final que lhe será enviado por e-mail. <br />
<br />
{$subscriptionType} <br />
Data de validade: {$expiryDate} <br />
<br />
Para renovar sua assinatura, acesse o site da revista. Você pode fazer login no sistema com seu nome de usuário, &quot;{$username}&quot;. <br />
<br />
Se você tiver alguma dúvida, não hesite em contactar-me. <br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionAfterExpiryLast.description' => 'Esta mensagem é o último aviso ao assinante da expiração da assinatura. Informa a URL da revista e instruções de acesso.',
  'emails.subscriptionPurchaseIndl.subject' => 'Aquisição de Assinatura: Individual',
  'emails.subscriptionPurchaseIndl.body' => 'Uma assinatura individual foi comprada on-line para {$contextName} com os seguintes detalhes. <br />
<br />
Tipo de Assinatura: <br />
{$subscriptionType} <br />
<br />
Usuário: <br />
{$userDetails} <br />
<br />
Informações Assinatura (se informado): <br />
{$membership} <br />
<br />
Para visualizar ou editar esta assinatura, use a seguinte URL. <br />
<br />
URL da Assinatura: {$subscriptionUrl} <br />
',
  'emails.subscriptionPurchaseIndl.description' => 'Esta mensagem notifica o Gerente de Assinaturas que uma assinatura individual foi adquirida online. Oferece informações sobre a assinatura e um link para acesso rápido à mesma.',
  'emails.subscriptionPurchaseInstl.subject' => 'Aquisição de Assinatura: Institucional',
  'emails.subscriptionPurchaseInstl.body' => 'Uma assinatura institucional foi comprada on-line para {$contextName} com os seguintes detalhes. Para ativar esta assinatura, use a URL fornecida e defina o status da assinatura como \'Ativo\'. <br />
<br />
Tipo de Assinatura: <br />
{$subscriptionType} <br />
<br />
Instituição: <br />
{$institutionName} <br />
{$institutionMailingAddress} <br />
<br />
Domínio (se fornecido): <br />
{$domain} <br />
<br />
Intervalos de IP (se houver): <br />
{$ipRanges} <br />
<br />
Pessoa de Contato: <br />
{$userDetails} <br />
<br />
Informações sobre a Assinatura (se houver): <br />
{$membership} <br />
<br />
Para visualizar ou editar esta assinatura, use a seguinte URL. <br />
<br />
URL da Assinatura: {$subscriptionUrl} <br />
',
  'emails.subscriptionPurchaseInstl.description' => 'Esta mensagem notifica o Editor Gerente que uma assinatura institucional foi adquirida online. Oferece informações sobre a assinatura e um link para acesso rápido à mesma.',
  'emails.subscriptionRenewIndl.subject' => 'Renovação de Assinatura Individual',
  'emails.subscriptionRenewIndl.body' => 'Uma assinatura individual foi renovada online para {$contextName} com os seguintes detalhes. <br />
<br />
Tipo de Assinatura: <br />
{$subscriptionType} <br />
<br />
Usuário: <br />
{$userDetails} <br />
<br />
Informações sobre a Assinatura (se houver): <br />
{$membership} <br />
<br />
Para visualizar ou editar esta assinatura, use a seguinte URL. <br />
<br />
URL de inscrição: {$subscriptionUrl} <br />
',
  'emails.subscriptionRenewIndl.description' => 'Esta mensagem notifica o Editor Gerente que uma assinatura individual foi renovada online. Oferece informações sobre a assinatura e um link para acesso rápido à mesma.',
  'emails.subscriptionRenewInstl.subject' => 'Renovação de Assinatura Institucional',
  'emails.subscriptionRenewInstl.body' => 'Uma assinatura institucional foi renovada online para {$contextName} com os seguintes detalhes. <br />
<br />
Tipo de Assinatura: <br />
{$subscriptionType} <br />
<br />
Instituição: <br />
{$institutionName} <br />
{$institutionMailingAddress} <br />
<br />
Domínio (se fornecido): <br />
{$domain} <br />
<br />
Intervalos de IP (se houver): <br />
{$ipRanges} <br />
<br />
Pessoa de Contato: <br />
{$userDetails} <br />
<br />
Informações sobre membros (se houver): <br />
{$membership} <br />
<br />
Para visualizar ou editar esta assinatura, use a seguinte URL. <br />
<br />
URL da Assinatura: {$subscriptionUrl} <br />
',
  'emails.subscriptionRenewInstl.description' => 'Esta mensagem notifica o Editor Gerente que uma assinatura institucional foi renovada online. Oferece informações sobre a assinatura e um link para acesso rápido à mesma.',
  'emails.citationEditorAuthorQuery.subject' => 'Edição de citação',
  'emails.citationEditorAuthorQuery.body' => '{$authorFirstName}, <br />
<br />
Você poderia verificar ou fornecer a citação adequada para a seguinte referência do seu artigo, {$submitTitle}: <br />
<br />
{$rawCitation} <br />
<br />
Obrigado! <br />
<br />
{$userFirstName} <br />
Editor de Cópia, {$contextName} <br />
',
  'emails.citationEditorAuthorQuery.description' => 'Solicitação ao autor de detalhes sobre referência, enviada pelo editor de texto.',
  'emails.revisedVersionNotify.subject' => 'Envio de versão atualizada',
  'emails.revisedVersionNotify.body' => 'Editores: <br />
<br />
Uma versão revisada de &quot;{$submissionTitle}&quot; foi carregada pelo autor {$authorName}. <br />
<br />
URL da Submissão: {$submissionUrl} <br />
<br />
{$editorialContactSignature}',
  'emails.revisedVersionNotify.description' => 'Este email é enviado automaticamente ao editor designado quando o autor faz o upload de uma versão revisada de um artigo.',
  'emails.notificationCenterDefault.subject' => 'Uma mensagem sobre {$contextName}',
  'emails.notificationCenterDefault.body' => 'Insira a sua mensagem por gentileza.',
  'emails.notificationCenterDefault.description' => 'A mensagem padrão (em branco) usada no Criador de lista de mensagens do Notification Center.',
  'emails.editorDecisionInitialDecline.subject' => 'Decisão do Editor',
  'emails.editorDecisionInitialDecline.body' => '
			{$authorName}: <br />
<br />
Chegamos a uma decisão sobre sua submissão para {$ contextName}, &quot;{$submissionTitle}&quot;. <br />
<br />
Nossa decisão é: Recusar Submissão',
  'emails.editorDecisionInitialDecline.description' => 'Este email será enviado ao autor se o editor recusar o envio inicialmente, antes da fase de revisão',
  'emails.submissionComment.subject' => 'Comentário sobre a submissão',
  'emails.submissionComment.body' => '',
  'emails.submissionComment.description' => 'Mensagem notifica várias pessoas envolvidas no processo de edição de uma submissão que um comentário foi enviado.',
  'emails.submissionDecisionReviewers.subject' => 'Decisão sobre "{$submissionTitle}"',
  'emails.submissionDecisionReviewers.body' => '',
  'emails.submissionDecisionReviewers.description' => 'Mensagem notifica os avaliadores de uma submissão que o processo de avaliação foi concluído. Inclui informações sobre o artigo e a decisão tomada, além de agradecer pela contribuição.',
  'emails.layoutAck.subject' => 'Agradecimento pelas composições',
  'emails.layoutAck.body' => '',
  'emails.layoutAck.description' => 'Mensagem enviada pelo Editor de Seção ao Editor de Layout, agradecendo pela conclusão das composições.',
  'emails.proofreadAuthorRequest.subject' => 'Solicitação de leitura de provas ao autor',
  'emails.proofreadAuthorRequest.body' => '',
  'emails.proofreadAuthorRequest.description' => 'Mensagem enviada pelo Editor de Seção ao autor, solicitando que verifique o trabalho realizado pelo Editor de Layout, com informações sobre acesso e avisando que somente é possível corrigir erros tipográficos de layout.',
  'emails.proofreadAuthorComplete.subject' => 'Conclusão da leitura de provas pelo autor',
  'emails.proofreadAuthorComplete.body' => '',
  'emails.proofreadAuthorComplete.description' => 'Mensagem enviada pelo Autor ao Editor de Seção, informando a conclusão da Leitura de Provas.',
  'emails.proofreadAuthorAck.subject' => 'Agradecimento pela leitura de provas pelo autor',
  'emails.proofreadAuthorAck.body' => '',
  'emails.proofreadAuthorAck.description' => 'Mensagem enviada pelo Editor de Seção ao autor, agradecendo a conclusão da Leitura de Provas.',
  'emails.proofreadRequest.subject' => 'Solicitação de leitura de provas',
  'emails.proofreadRequest.body' => '',
  'emails.proofreadRequest.description' => 'Mensagem enviada pelo Editor de Seção ao Leitor de Provas, solicitando que verifique o trabalho realizado pelo Editor de Layout e o autor, verificando os comentários e alterações solicitadas. É o último momento para verificar a qualidade do documento e evitar possíveis erros antes da publicação.',
  'emails.proofreadComplete.subject' => 'Leitura de provas concluída',
  'emails.proofreadComplete.body' => '',
  'emails.proofreadComplete.description' => 'Mensagem enviada pelo Leitor de Provas ao Editor de Seção, informando a conclusão da Leitura de Provas.',
  'emails.proofreadAck.subject' => 'Agradecimento pela leitura de provas',
  'emails.proofreadAck.body' => '',
  'emails.proofreadAck.description' => 'Mensagem enviada pelo Editor de Seção ao Leitor de Provas, agradecendo pelo trabalho concluído de Leitura de Provas.',
  'emails.proofreadLayoutComplete.subject' => 'Leitura de provas concluída pelo Editor de Layout',
  'emails.proofreadLayoutComplete.body' => '',
  'emails.proofreadLayoutComplete.description' => 'Mensagem enviada pelo Editor de Layout ao Editor de Seção, informando a conclusão das novas composições, após Leitura de Provas',
  'emails.proofreadLayoutAck.subject' => 'Agradecimento pela leitura de provas pelo Editor de Layout',
  'emails.proofreadLayoutAck.body' => '',
  'emails.proofreadLayoutAck.description' => 'Mensagem enviada pelo Editor de Seção ao Editor de Layout, agradecendo pela conclusão das composições, após a Leitura de Provas',
  'emails.statisticsReportNotification.body' => '
{$name}, <br />
<br />
Seu relatório do estado atual do sistema do mês de {$month}, {$year} está disponível. Suas estatísticas-chave deste mês seguem abaixo.<br />
<ul>
	<li>Novas submissões este mês: {$newSubmissions}</li>
	<li>Submissões rejeitadas este mês: {$declinedSubmissions}</li>
	<li>Submissões aceitas este mês: {$acceptedSubmissions}</li>
	<li>Total de submissões no sistema {$totalSubmissions}</li>
</ul>
Efetue login no site do periódico para obter uma visão mais detalhada das <a href="{$editorialStatsLink}">tendências editoriais</a> e <a href="{$publicationStatsLink}">estatísticas de artigos publicados</a>. Uma cópia completa do relatório de tendencias editoriais deste mês segue anexa.<br />
<br />
Atenciosamente,<br />
{$principalContactSignature}',
  'emails.statisticsReportNotification.description' => 'Este e-mail é automaticamente enviado todo mês aos editores e gerentes do sistema para dar-lhes uma visão geral do estado do sistema.',
  'emails.statisticsReportNotification.subject' => 'Atividade editorial para {$month}, {$year}',
  'emails.announcement.description' => 'Este email é enviado quando um novo comunicado é criado.',
  'emails.announcement.body' => '<b>{$title}</b><br />
<br />
{$summary}<br />
<br />
Visite nosso site para ler o <a href="{$url}"> comunicado completo </a>.',
  'emails.announcement.subject' => '{$title}',
);