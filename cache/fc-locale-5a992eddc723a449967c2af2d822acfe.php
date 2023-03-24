<?php return array (
  'emails.orcidCollectAuthorId.subject' => 'ORCID da submissão',
  'emails.orcidCollectAuthorId.body' => 'Prezado(a) {$authorName},<br>
<br>
Você foi listada(o) como um coautor(a) em uma submissão de manuscrito "{$submissionTitle}" para {$contextName}.<br/>
Para confirmar sua autoria, por favor adicione sua id ORCID a esta submissão, visitando o link fornecido abaixo.<br/>
<br/>
<a href="{$authorOrcidUrl}"><img id="orcid-id-logo" src="https://orcid.org/sites/default/files/images/orcid_16x16.png" width=\'16\' height=\'16\' alt="ORCID iD icon" style="display: block; margin: 0 .5em 0 0; padding: 0; float: left;"/>Registre ou conecte seu ORCID iD</a><br/>
<br/>
<br>
<a href="{$orcidAboutUrl}">Mais informações sobre o ORCID em {$contextName}</a><br/>
<br/>
Se você tiver quaisquer dúvidas, por favor entre em contato comigo.<br/>
<br/>
{$editorialContactSignature}<br/>
',
  'emails.orcidCollectAuthorId.description' => 'Este modelo de e-mail é utilizado para coletar os id ORCID dos coautores.',
  'emails.orcidRequestAuthorAuthorization.description' => 'Este modelo de e-mail é usado para solicitar o acesso ao registro ORCID dos autores.',
  'emails.orcidRequestAuthorAuthorization.body' => 'Prezado(a) {$authorName}, <br>
<br>
Você foi listado como autor na submissão do manuscrito "{$submissionTitle}" to {$contextName}.
<br>
<br>
Permita-nos adicionar seu ID do ORCID a essa submissão e também adicioná-lo ao seu perfil do ORCID na publicação. <br>
Visite o link para o site oficial do ORCID, faça o login com seu perfil e autorize o acesso seguindo as instruções. <br>
<a href="{$authorOrcidUrl}"> <img id ="orcid-id-logo" src = "https://orcid.org/sites/default/files/images/orcid_16x16.png" width = \'16 \' height = \'16 \' alt = "Ícone ORCID iD" style = "display: block; margin: 0 .5em 0 0; padding: 0; float: left;" /> Registre ou conecte seu ORCID ID </a> <br/>
<br>
<br>
<a href="{$orcidAboutUrl}"> Mais sobre o ORCID em {$contextName} </a> <br/>
<br>
Se você tiver alguma dúvida, entre em contato comigo. <br>
<br>
{$principalContactSignature} <br>
',
  'emails.orcidRequestAuthorAuthorization.subject' => 'Solicitando acesso ao registro ORCID',
);