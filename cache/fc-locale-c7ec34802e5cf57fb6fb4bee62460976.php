<?php return array (
  'emails.orcidCollectAuthorId.subject' => 'Submission ORCID',
  'emails.orcidCollectAuthorId.body' => 'Dear {$authorName},<br/>
<br/>
You have been listed as an author on a manuscript submission to {$contextName}.<br/>
To confirm your authorship, please add your ORCID id to this submission by visiting the link provided below.<br/>
<br/>
<a href="{$authorOrcidUrl}"><img id="orcid-id-logo" src="https://orcid.org/sites/default/files/images/orcid_16x16.png" width=\'16\' height=\'16\' alt="ORCID iD icon" style="display: block; margin: 0 .5em 0 0; padding: 0; float: left;"/>Register or connect your ORCID iD</a><br/>
<br/>
<br>
<a href="{$orcidAboutUrl}">More information about ORCID at {$contextName}</a><br/>
<br/>
If you have any questions, please contact me.<br/>
<br/>
{$principalContactSignature}<br/>
',
  'emails.orcidCollectAuthorId.description' => 'This email template is used to collect the ORCID id\'s from authors.',
  'emails.orcidRequestAuthorAuthorization.subject' => 'Requesting ORCID record access',
  'emails.orcidRequestAuthorAuthorization.body' => 'Dear {$authorName},<br>
<br>
You have been listed as an author on the manuscript submission "{$submissionTitle}" to {$contextName}.
<br>
<br>
Please allow us to add your ORCID id to this submission and also to add the submission to your ORCID profile on publication.<br>
Visit the link to the official ORCID website, login with your profile and authorize the access by following the instructions.<br>
<a href="{$authorOrcidUrl}"><img id="orcid-id-logo" src="https://orcid.org/sites/default/files/images/orcid_16x16.png" width=\'16\' height=\'16\' alt="ORCID iD icon" style="display: block; margin: 0 .5em 0 0; padding: 0; float: left;"/>Register or Connect your ORCID iD</a><br/>
<br>
<br>
<a href="{$orcidAboutUrl}">More about ORCID at {$contextName}</a><br/>
<br>
If you have any questions, please contact me.<br>
<br>
{$principalContactSignature}<br>
',
  'emails.orcidRequestAuthorAuthorization.description' => 'This email template is used to request ORCID record access from authors.',
);