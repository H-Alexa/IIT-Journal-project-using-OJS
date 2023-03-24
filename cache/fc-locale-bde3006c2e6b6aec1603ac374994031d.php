<?php return array (
  'installer.additionalLocales' => 'Additional locales',
  'installer.administratorAccount' => 'Administrator Account',
  'installer.administratorAccountInstructions' => 'This user account will become the site administrator and have complete access to the system. Additional user accounts can be created after installation.',
  'installer.checkNo' => '<span class="pkp_form_error formError">NO</span>',
  'installer.checkYes' => 'Yes',
  'installer.clientCharset' => 'Client character set',
  'installer.clientCharsetInstructions' => 'The encoding to use for data sent to and received from browsers.',
  'installer.configFileError' => 'The configuration file <tt>config.inc.php</tt> does not exist or is not readable.',
  'installer.connectionCharset' => 'Connection character set',
  'installer.contentsOfConfigFile' => 'Contents of configuration file',
  'installer.databaseDriver' => 'Database driver',
  'installer.databaseDriverInstructions' => '<strong>Database drivers listed in brackets do not appear to have the required PHP extension loaded and installation will likely fail if selected.</strong><br />Any unsupported database drivers listed above are listed solely for academic purposes and are unlikely to work.',
  'installer.databaseHost' => 'Host',
  'installer.databaseHostInstructions' => 'Leave the hostname blank to connect using domain sockets instead of over TCP/IP. This is not necessary with MySQL, which will automatically use sockets if "localhost" is entered, but is required with some other database servers such as PostgreSQL.',
  'installer.databaseName' => 'Database name',
  'installer.databasePassword' => 'Password',
  'installer.databaseSettings' => 'Database Settings',
  'installer.databaseUsername' => 'Username',
  'installer.filesDir' => 'Directory for uploads',
  'installer.fileSettings' => 'File Settings',
  'installer.form.clientCharsetRequired' => 'A client character set must be selected.',
  'installer.form.databaseDriverRequired' => 'A database driver must be selected.',
  'installer.form.databaseNameRequired' => 'The database name is required.',
  'installer.form.emailRequired' => 'A valid email address for the administrator account is required.',
  'installer.form.filesDirRequired' => 'The directory to be used for storing uploaded files is required.',
  'installer.form.localeRequired' => 'A locale must be selected.',
  'installer.form.passwordRequired' => 'A password for the administrator account is required.',
  'installer.form.passwordsDoNotMatch' => 'The administrator passwords do not match.',
  'installer.form.separateMultiple' => 'Separate multiple values with commas',
  'installer.form.usernameAlphaNumeric' => 'The administrator username can contain only alphanumeric characters, underscores, and hyphens, and must begin and end with an alphanumeric character.',
  'installer.form.usernameRequired' => 'A username for the administrator account is required.',
  'installer.installationWrongPhp' => '<br/><strong>WARNING: Your current version of PHP does not meet the minimum requirements for installation. It is recommended to upgrade to a more recent release of PHP.</strong>',
  'installer.installErrorsOccurred' => 'Errors occurred during installation',
  'installer.installerSQLStatements' => 'SQL statements for installation',
  'installer.installFileError' => 'The installation file <tt>dbscripts/xml/install.xml</tt> does not exist or is not readable.',
  'installer.installFilesDirError' => 'The directory specified for uploaded files does not exist or is not writable.',
  'installer.installParseDBFileError' => 'Error parsing the database installation file <tt>{$file}</tt>.',
  'installer.installMigrationError' => 'Error executing the migration class <tt>{$class}</tt>.',
  'installer.installParseEmailTemplatesFileError' => 'Error parsing the email template file <tt>{$file}</tt>.',
  'installer.installParseFilterConfigFileError' => 'Error parsing the filter configuration file <tt>{$file}</tt>.',
  'installer.unsupportedUpgradeError' => 'Upgrade unsupported. See docs/UPGRADE-UNSUPPORTED for details.',
  'installer.locale' => 'Locale',
  'installer.locale.maybeIncomplete' => 'Marked locales may be incomplete.',
  'installer.localeSettings' => 'Locale Settings',
  'installer.oaiSettings' => 'OAI Settings',
  'installer.oaiRepositoryIdInstructions' => 'A unique identifier used to identify metadata records indexed from this site using the <a href="https://www.openarchives.org/" target="_blank">Open Archives Initiative</a> Protocol for Metadata Harvesting.',
  'installer.oaiRepositoryId' => 'Repository Identifier',
  'installer.publicFilesDirError' => 'The public files directory does not exist or is not writable.',
  'installer.releaseNotes' => 'Release Notes',
  'installer.preInstallationInstructionsTitle' => 'Pre-Installation Steps',
  'installer.preInstallationInstructions' => '
		<p>1. The following files and directories (and their contents) must be made writable:</p>
		<ul>
			<li><tt>config.inc.php</tt> is writable (optional): {$writable_config}</li>
			<li><tt>public/</tt> is writable: {$writable_public}</li>
			<li><tt>cache/</tt> is writable: {$writable_cache}</li>
			<li><tt>cache/t_cache/</tt> is writable: {$writable_templates_cache}</li>
			<li><tt>cache/t_compile/</tt> is writable: {$writable_templates_compile}</li>
			<li><tt>cache/_db</tt> is writable: {$writable_db_cache}</li>
		</ul>

		<p>2. A directory to store uploaded files must be created and made writable (see "File Settings" below).</p>
	',
  'installer.configureXSLMessage' => '<p>Your PHP installation does not have the XSL module enabled. Either enable it, or configure the xslt_command parameter in your config.inc.php file.</p>',
  'installer.beacon' => 'Beacon',
  'installer.beacon.enable' => 'Provide a unique site ID and OAI base URL to PKP for statistics and security alert purposes only.',
  'installer.unsupportedPhpError' => 'Your server\'s PHP version is not supported by this software. Double-check the installation requirements in docs/README.',
);