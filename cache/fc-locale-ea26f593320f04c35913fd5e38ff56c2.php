<?php return array (
  'plugins.importexport.doaj.displayName' => 'DOAJ Export Plugin',
  'plugins.importexport.doaj.description' => 'Export Journal for DOAJ.',
  'plugins.importexport.doaj.export.contact' => 'Contact DOAJ for inclusion',
  'plugins.importexport.doaj.registrationIntro' => 'If you would like to register articles from within OJS, please enter your DOAJ API Key. Else, you\'ll still be able to export into the DOAJ XML format but you cannot register your articles with DOAJ from within OJS.',
  'plugins.importexport.doaj.settings.form.apiKey' => 'DOAJ API Key',
  'plugins.importexport.doaj.settings.form.apiKey.description' => 'You will find your API key on your DOAJ user page.',
  'plugins.importexport.doaj.settings.form.automaticRegistration.description' => 'OJS will deposit articles automatically to DOAJ. Please note that this may take a short amount of time after publication to process (e.g. depending on your cronjob configuration). You can check for all unregistered articles.',
  'plugins.importexport.doaj.settings.form.testMode.description' => 'Use the DOAJ test API (testing environment) for the registration. Please do not forget to remove this option for the production.',
  'plugins.importexport.doaj.senderTask.name' => 'DOAJ automatic registration task',
  'plugins.importexport.doaj.register.error.mdsError' => 'Deposit was not successful! The DOAJ API returned an error: \'{$param}\'.',
  'plugins.importexport.doaj.cliUsage' => 'Usage:
{$scriptName} {$pluginName} export [xmlFileName] [journal_path] articles objectId1 [objectId2] ...
',
);