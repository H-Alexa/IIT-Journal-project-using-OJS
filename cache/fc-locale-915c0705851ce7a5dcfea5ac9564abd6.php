<?php return array (
  'plugins.generic.usageStats.settings.logging' => 'Access log options',
  'plugins.generic.usageStats.settings.createLogFiles' => 'Create log files',
  'plugins.generic.usageStats.settings.createLogFiles.description' => 'Activating this option will make the plugin create access log files inside the files directory. Those files should be used to extract the usage statistics data. If you don\'t want to create more access log files you can leave this option disabled and use your own server log access files.',
  'plugins.generic.usageStats.settings.logParseRegex' => 'Parse log files regex',
  'plugins.generic.usageStats.settings.logParseRegex.description' => 'The default regex used can parse apache access log files in combined format and also the plugin\'s log files. If your access log files are in a different format you will have to insert a regex capable of parsing them and giving the expected values. See UsageStatsLoader::_getDataFromLogEntry() for more information.',
  'plugins.generic.usageStats.settings.saved' => 'Usage statistics plugin settings saved',
  'plugins.generic.usageStats.settings.dataPrivacyOption' => 'Data privacy option',
  'plugins.generic.usageStats.settings.dataPrivacyOption.saltFilepath' => 'File path for the anonymizing salt',
  'plugins.generic.usageStats.settings.dataPrivacyOption.saltFilepath.invalid' => 'The salt file is not writable.',
  'plugins.generic.usageStats.settings.dataPrivacyOption.requirements' => 'To ensure data privacy, you must specify a file readable and writable by the web user to contain a randomly generated salt value.  This file must NOT be backed up to ensure privacy protection. The salt is randomly generated either using: the function mcrypt_create_iv, which requires the PHP mcrypt; the function openssl_random_pseudo_bytes, which requires the PHP openssl; the file /dev/urandom, which works only on *nix systems; or the function mt_rand, which is not cryptographically safe. Thus, if you are using a Windows server, please ensure that you install either the PHP mcrypt or openssl enabled in order to have the cryptographically safe generated salt.',
  'plugins.generic.usageStats.settings.dataPrivacyOption.description' => 'Activate this option to use a plugin version that respects privacy legislations, i.e. that is logging hashed IP addresses, informs the users about the tracking and provides an opt-out option for users. Note: when using this option you will not be able to use the geo features of the plugin.',
  'plugins.generic.usageStats.settings.dataPrivacyOption.requiresSalt' => 'Enabling data privacy requires a salt file.',
  'plugins.generic.usageStats.settings.dataPrivacyOption.excludesCity' => 'Enabling data privacy excludes City as an optional statistic.',
  'plugins.generic.usageStats.settings.dataPrivacyOption.excludesRegion' => 'Enabling data privacy excludes Region as an optional statistic.',
  'plugins.generic.usageStats.settings.dataPrivacyCheckbox' => 'Respect data privacy',
  'plugins.generic.usageStats.settings.optionalColumns' => 'Optional statistic information',
  'plugins.generic.usageStats.settings.optionalColumns.description' => 'Enable or disable the collection of the following optional information. This will influence on the possible statistics reports you can retrieve, and also will have an impact on the database size. DO NOT CHANGE unless you fully understand what you\'re doing.',
  'plugins.generic.usageStats.settings.optionalColumns.cityRequiresRegion' => 'The optional column "City" requires the optional column "Region".',
  'plugins.generic.usageStats.settings.archives' => 'Archives',
  'plugins.generic.usageStats.settings.compressArchives.description' => 'Activate this option to compress archived log files using gzip tool (you will have to configure the gzip setting inside config.inc.php). If you have a high traffic site it\'s a good idea to enable this, so you can save some extra disk space.',
  'plugins.generic.usageStats.settings.compressArchives' => 'Compress archives',
  'plugins.generic.usageStats.settings.statsDisplayOptions' => 'Statistics display options',
  'plugins.generic.usageStats.settings.statsDisplayOptions.contextWide' => 'These settings will only be applied to usage statistics on {$contextName}.',
  'plugins.generic.usageStats.settings.statsDisplayOptions.display' => 'Display submission statistics chart for reader',
  'plugins.generic.usageStats.settings.statsDisplayOptions.chartType' => 'Choose the type of the chart to display the download statistics',
  'plugins.generic.usageStats.settings.statsDisplayOptions.chartType.bar' => 'Bar',
  'plugins.generic.usageStats.settings.statsDisplayOptions.chartType.line' => 'Line',
  'plugins.generic.usageStats.settings.statsDisplayOptions.datasetMaxCount' => 'Define the maximum number of data to present at the same time for an specific x-axis point. A higher value can generate hard to understand charts. Something between 3 and 5 is safe.',
  'plugins.generic.usageStats.usageStatsLoaderName' => 'Usage statistics file loader task',
  'plugins.generic.usageStats.openFileFailed' => 'The file {$file} could not be opened and was rejected.',
  'plugins.generic.usageStats.invalidLogEntry' => 'The line number {$lineNumber} from the file {$file} is not a valid log entry and the file was rejected.',
  'plugins.generic.usageStats.removeUrlError' => 'The line number {$lineNumber} from the file {$file} contains an url that the system can\'t remove the base url from.',
  'plugins.generic.usageStats.loadDataError' => 'Couldn\'t load data extracted from file {$file}. The file was moved to stage again.',
  'plugins.generic.usageStats.pluginNotEnabled' => 'Usage statistics plugin is disabled. No log files processed.',
  'plugins.generic.usageStats.processingPathNotEmpty' => 'The directory {$directory} is not empty. This could indicate a previously failed process, or a concurrently running process. This file will be automatically reprocessed if you are also using scheduledTasksAutoStage.xml, otherwise you will need to manually move any orphaned files in the processing directory back into the stage directory.',
  'plugins.generic.usageStats.displayName' => 'Usage Statistics',
  'plugins.generic.usageStats.description' => 'Present data objects usage statistics. Can use server access log files to extract statistics.',
  'plugins.reports.usageStats.report.displayName' => 'PKP Usage statistics report',
  'plugins.reports.usageStats.report.description' => 'PKP Default usage statistics report (COUNTER ready)',
  'plugins.generic.usageStats.optout.displayName' => 'Usage Statistics Privacy Information',
  'plugins.generic.usageStats.optout.description' => 'Usage Statistics Privacy Information',
  'plugins.generic.usageStats.optout.title' => 'Usage Statistics Information',
  'plugins.generic.usageStats.optout.shortDesc' => 'We log anonymous usage statistics. Please read the <a href="{$privacyInfo}">privacy information</a> for details.',
  'plugins.generic.usageStats.optout.done' => '
		<p>You successfully opted out of usage statistics collection. While you see this message no statistics will be collected from your usage of this site. Click the below button to revert your decision.</p>',
  'plugins.generic.usageStats.optin' => 'Opt In',
  'plugins.generic.usageStats.optout' => 'Opt Out',
  'plugins.generic.usageStats.optout.cookie' => '
		<p>If you wish you can opt-out of the data collection process. By clicking the opt-out button below, you can actively decide against participating in the statistical analysis. When clicking the opt-out button a <em>cookie</em> is being created on your system to store your decision. If the privacy settings of your browser lead to cookies being automatically deleted you will have to opt-out again the next time you access this website. The cookie is only valid for one browser. If you use a different browser, you will have to opt out again. No individual information is stored within this cookie. This cookie lease is valid for one year after your last access.</p>
		<p>Please bear in mind that general server logs are not affected by your decision to opt-out of the detailed evaluation process. Please refer to our general <a href="{$privacyStatementUrl}">privacy statement</a>.</p>',
  'plugins.reports.usageStats.metricType' => 'PKP/COUNTER',
  'plugins.reports.usageStats.metricType.full' => 'Public Knowledge Project statistics (COUNTER ready)',
  'plugins.generic.usageStats.statsSum' => 'Sum all file downloads',
  'plugins.generic.usageStats.noStats' => 'Download data is not yet available.',
  'plugins.generic.usageStats.monthInitials' => 'Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec',
  'plugins.generic.usageStats.downloads' => 'Downloads',
  'plugins.generic.usageStats.settings.statsDisplayOptions.siteWide.ojs2' => 'Each journal can override these settings from the journal\'s plugins page.',
  'plugins.generic.usageStats.optout.description.long.ojs2' => '
		<h3>General Privacy Information</h3>
		<p>Please refer to our general <a href="{$privacyStatementUrl}">privacy statement</a>.</p>
		<h3>Usage Statistics</h3>
		<p>In order to be able to analyse usage and impact of our journal and the published articles, we collect and log access to the journal’s homepage, issues, articles, galleys and supplementary files. In the process all data is anonymised. No personal information is logged. IP addresses are anonymised by being hashed (using <em>SHA 256</em>) in combination with a <em>secure 64 characters long salt</em> that is automatically <em>randomly generated and overridden on a daily basis</em>. Therefore IP addresses cannot be reconstructed.</p>
		<p>The following information is collected next to the anonymised IP addresses:</p>
		<ul>
		<li>Access type (i.e. administrative)</li>
		<li>Request time</li>
		<li>Requested URL</li>
		<li>HTTP status code</li>
		<li>Browser</li>
		</ul>
		<p>The collected data is only used for evaluation purposes. No IP addresses are mapped to user IDs. It is technically impossible to trace a specific set of data to a specific IP address.</p>',
  'plugins.generic.usageStats.settings.statsDisplayOptions.siteWide.omp' => 'Each press can override these settings from the press\'s plugins page.',
  'plugins.generic.usageStats.optout.description.long.omp' => '
		<h3>General Privacy Information</h3>
		<p>Please refer to our general <a href="{$privacyStatementUrl}">privacy statement</a>.</p>
		<h3>Usage Statistics</h3>
		<p>In order to be able to analyse usage and impact of our publications, we collect and log access to the homepage, categories, series, books and files. In the process all data is anonymised. No personal information is logged. IP addresses are anonymised by being hashed (using <em>SHA 256</em>) in combination with a <em>secure 64 characters long salt</em> that is automatically <em>randomly generated and overridden on a daily basis</em>. Therefore IP addresses cannot be reconstructed.</p>
		<p>The following information is collected next to the anonymised IP addresses:</p>
		<ul>
		<li>Access type (i.e. administrative)</li>
		<li>Request time</li>
		<li>Requested URL</li>
		<li>HTTP status code</li>
		<li>Browser</li>
		</ul>
		<p>The collected data is only used for evaluation purposes. No IP addresses are mapped to user IDs. It is technically impossible to trace a specific set of data to a specific IP address.</p>',
);