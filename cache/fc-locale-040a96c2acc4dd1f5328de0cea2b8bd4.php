<?php return array (
  'emails.notification.subject' => 'New notification from {$siteTitle}',
  'emails.notification.body' => 'You have a new notification from {$siteTitle}:<br />
<br />
{$notificationContents}<br />
<br />
Link: {$url}<br />
<br />
{$principalContactSignature}',
  'emails.notification.description' => 'The email is sent to registered users that have selected to have this type of notification emailed to them.',
  'emails.passwordResetConfirm.subject' => 'Password Reset Confirmation',
  'emails.passwordResetConfirm.body' => 'We have received a request to reset your password for the {$siteTitle} web site.<br />
<br />
If you did not make this request, please ignore this email and your password will not be changed. If you wish to reset your password, click on the below URL.<br />
<br />
Reset my password: {$url}<br />
<br />
{$principalContactSignature}',
  'emails.passwordResetConfirm.description' => 'This email is sent to a registered user when they indicate that they have forgotten their password or are unable to login. It provides a URL they can follow to reset their password.',
  'emails.passwordReset.subject' => 'Password Reset',
  'emails.passwordReset.body' => 'Your password has been successfully reset for use with the {$siteTitle} web site. Please retain this username and password, as it is necessary for all work with the journal.<br />
<br />
Your username: {$username}<br />
Password: {$password}<br />
<br />
{$principalContactSignature}',
  'emails.passwordReset.description' => 'This email is sent to a registered user when they have successfully reset their password following the process described in the PASSWORD_RESET_CONFIRM email.',
  'emails.userRegister.subject' => 'Journal Registration',
  'emails.userRegister.body' => '{$userFullName}<br />
<br />
You have now been registered as a user with {$contextName}. We have included your username and password in this email, which are needed for all work with this journal through its website. At any point, you can ask to be removed from the journal\'s list of users by contacting me.<br />
<br />
Username: {$username}<br />
Password: {$password}<br />
<br />
Thank you,<br />
{$principalContactSignature}',
  'emails.userRegister.description' => 'This email is sent to a newly registered user to welcome them to the system and provide them with a record of their username and password.',
  'emails.userValidate.subject' => 'Validate Your Account',
  'emails.userValidate.body' => '{$userFullName}<br />
<br />
You have created an account with {$contextName}, but before you can start using it, you need to validate your email account. To do this, simply follow the link below:<br />
<br />
{$activateUrl}<br />
<br />
Thank you,<br />
{$principalContactSignature}',
  'emails.userValidate.description' => 'This email is sent to a newly registered user to validate their email account.',
  'emails.reviewerRegister.subject' => 'Registration as Reviewer with {$contextName}',
  'emails.reviewerRegister.body' => 'In light of your expertise, we have taken the liberty of registering your name in the reviewer database for {$contextName}. This does not entail any form of commitment on your part, but simply enables us to approach you with a submission to possibly review. On being invited to review, you will have an opportunity to see the title and abstract of the paper in question, and you\'ll always be in a position to accept or decline the invitation. You can also ask at any point to have your name removed from this reviewer list.<br />
<br />
We are providing you with a username and password, which is used in all interactions with the journal through its website. You may wish, for example, to update your profile, including your reviewing interests.<br />
<br />
Username: {$username}<br />
Password: {$password}<br />
<br />
Thank you,<br />
{$principalContactSignature}',
  'emails.reviewerRegister.description' => 'This email is sent to a newly registered reviewer to welcome them to the system and provide them with a record of their username and password.',
  'emails.publishNotify.subject' => 'New Issue Published',
  'emails.publishNotify.body' => 'Readers:<br />
<br />
{$contextName} has just published its latest issue at {$contextUrl}. We invite you to review the Table of Contents here and then visit our web site to review articles and items of interest.<br />
<br />
Thanks for the continuing interest in our work,<br />
{$editorialContactSignature}',
  'emails.publishNotify.description' => 'This email is sent to registered readers via the "Notify Users" link in the Editor\'s User Home. It notifies readers of a new issue and invites them to visit the journal at a supplied URL.',
  'emails.lockssExistingArchive.subject' => 'Archiving Request for {$contextName}',
  'emails.lockssExistingArchive.body' => 'Dear [University Librarian]<br />
<br />
{$contextName} &amp;lt;{$contextUrl}&amp;gt;, is a journal for which a member of your faculty, [name of member], serves as a [title of position]. The journal is seeking to establish a LOCKSS (Lots of Copies Keep Stuff Safe) compliant archive with this and other university libraries.<br />
<br />
[Brief description of journal]<br />
<br />
The URL to the LOCKSS Publisher Manifest for our journal is: {$contextUrl}/gateway/lockss<br />
<br />
We understand that you are already participating in LOCKSS. If we can provide any additional metadata for purposes of registering our journal with your version of LOCKSS, we would be happy to provide it.<br />
<br />
Thank you,<br />
{$principalContactSignature}',
  'emails.lockssExistingArchive.description' => 'This email requests the keeper of a LOCKSS archive to consider including this journal in their archive. It provides the URL to the journal\'s LOCKSS Publisher Manifest.',
  'emails.lockssNewArchive.subject' => 'Archiving Request for {$contextName}',
  'emails.lockssNewArchive.body' => 'Dear [University Librarian]<br />
<br />
{$contextName} &amp;lt;{$contextUrl}&amp;gt;, is a journal for which a member of your faculty, [name of member] serves as a [title of position]. The journal is seeking to establish a LOCKSS (Lots of Copies Keep Stuff Safe) compliant archive with this and other university libraries.<br />
<br />
[Brief description of journal]<br />
<br />
The LOCKSS Program &amp;lt;http://lockss.org/&amp;gt;, an international library/publisher initiative, is a working example of a distributed preservation and archiving repository, additional details are below. The software, which runs on an ordinary personal computer is free; the system is easily brought on-line; very little ongoing maintenance is required.<br />
<br />
To assist in the archiving of our journal, we invite you to become a member of the LOCKSS community, to help collect and preserve titles produced by your faculty and by other scholars worldwide. To do so, please have someone on your staff visit the LOCKSS site for information on how this system operates. I look forward to hearing from you on the feasibility of providing this archiving support for this journal.<br />
<br />
Thank you,<br />
{$principalContactSignature}',
  'emails.lockssNewArchive.description' => 'This email encourages the recipient to participate in the LOCKSS initiative and include this journal in the archive. It provides information about the LOCKSS initiative and ways to become involved.',
  'emails.submissionAck.subject' => 'Submission Acknowledgement',
  'emails.submissionAck.body' => '{$authorName}:<br />
<br />
Thank you for submitting the manuscript, &quot;{$submissionTitle}&quot; to {$contextName}. With the online journal management system that we are using, you will be able to track its progress through the editorial process by logging in to the journal web site:<br />
<br />
Submission URL: {$submissionUrl}<br />
Username: {$authorUsername}<br />
<br />
If you have any questions, please contact me. Thank you for considering this journal as a venue for your work.<br />
<br />
{$editorialContactSignature}',
  'emails.submissionAck.description' => 'This email, when enabled, is automatically sent to an author when they complete the process of submitting a manuscript to the journal. It provides information about tracking the submission through the process and thanks the author for the submission.',
  'emails.submissionAckNotUser.subject' => 'Submission Acknowledgement',
  'emails.submissionAckNotUser.body' => 'Hello,<br />
<br />
{$submitterName} has submitted the manuscript, &quot;{$submissionTitle}&quot; to {$contextName}. <br />
<br />
If you have any questions, please contact me. Thank you for considering this journal as a venue for your work.<br />
<br />
{$editorialContactSignature}',
  'emails.submissionAckNotUser.description' => 'This email, when enabled, is automatically sent to the other authors who are not users within OJS specified during the submission process.',
  'emails.editorAssign.subject' => 'Editorial Assignment',
  'emails.editorAssign.body' => '{$editorialContactName}:<br />
<br />
The submission, &quot;{$submissionTitle},&quot; to {$contextName} has been assigned to you to see through the editorial process in your role as Section Editor.<br />
<br />
Submission URL: {$submissionUrl}<br />
Username: {$editorUsername}<br />
<br />
Thank you.',
  'emails.editorAssign.description' => 'This email notifies a Section Editor that the Editor has assigned them the task of overseeing a submission through the editing process. It provides information about the submission and how to access the journal site.',
  'emails.reviewRequest.subject' => 'Article Review Request',
  'emails.reviewRequest.body' => '{$reviewerName}:<br />
<br />
I believe that you would serve as an excellent reviewer of the manuscript, &quot;{$submissionTitle},&quot; which has been submitted to {$contextName}. The submission\'s abstract is inserted below, and I hope that you will consider undertaking this important task for us.<br />
<br />
Please log into the journal web site by {$responseDueDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation. The web site is {$contextUrl}<br />
<br />
The review itself is due {$reviewDueDate}.<br />
<br />
If you do not have your username and password for the journal\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequest.description' => 'This email from the Section Editor to a Reviewer requests that the reviewer accept or decline the task of reviewing a submission. It provides information about the submission such as the title and abstract, a review due date, and how to access the submission itself. This message is used when the Standard Review Process is selected in Management > Settings > Workflow > Review. (Otherwise see REVIEW_REQUEST_ATTACHED.)',
  'emails.reviewRequestRemindAuto.subject' => 'Article Review Request Reminder',
  'emails.reviewRequestRemindAuto.body' => '{$reviewerName}:<br />
Just a gentle reminder of our request for your review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We were hoping to have your response by {$responseDueDate}, and this email has been automatically generated and sent with the passing of that date.
<br />
I believe that you would serve as an excellent reviewer of the manuscript. The submission\'s abstract is inserted below, and I hope that you will consider undertaking this important task for us.<br />
<br />
Please log into the journal web site to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation. The web site is {$contextUrl}<br />
<br />
The review itself is due {$reviewDueDate}.<br />
<br />
If you do not have your username and password for the journal\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestRemindAuto.description' => 'This email is automatically sent when a reviewer\'s confirmation due date elapses (see Review Options under Settings > Workflow > Review) and one-click reviewer access is disabled. Scheduled tasks must be enabled and configured (see the site configuration file).',
  'emails.reviewRequestOneclick.subject' => 'Article Review Request',
  'emails.reviewRequestOneclick.body' => '{$reviewerName}:<br />
<br />
I believe that you would serve as an excellent reviewer of the manuscript, &quot;{$submissionTitle},&quot; which has been submitted to {$contextName}. The submission\'s abstract is inserted below, and I hope that you will consider undertaking this important task for us.<br />
<br />
Please log into the journal web site by {$responseDueDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation.<br />
<br />
The review itself is due {$reviewDueDate}.<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestOneclick.description' => 'This email from the Section Editor to a Reviewer requests that the reviewer accept or decline the task of reviewing a submission. It provides information about the submission such as the title and abstract, a review due date, and how to access the submission itself. This message is used when the Standard Review Process is selected in Management > Settings > Workflow > Review, and one-click reviewer access is enabled.',
  'emails.reviewRequestRemindAutoOneclick.subject' => 'Article Review Request',
  'emails.reviewRequestRemindAutoOneclick.body' => '{$reviewerName}:<br />
Just a gentle reminder of our request for your review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We were hoping to have your response by {$responseDueDate}, and this email has been automatically generated and sent with the passing of that date.
<br />
I believe that you would serve as an excellent reviewer of the manuscript. The submission\'s abstract is inserted below, and I hope that you will consider undertaking this important task for us.<br />
<br />
Please log into the journal web site to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation.<br />
<br />
The review itself is due {$reviewDueDate}.<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestRemindAutoOneclick.description' => 'This email is automatically sent when a reviewer\'s confirmation due date elapses (see Review Options under Settings > Workflow > Review) and one-click reviewer access is enabled. Scheduled tasks must be enabled and configured (see the site configuration file).',
  'emails.reviewRequestAttached.subject' => 'Article Review Request',
  'emails.reviewRequestAttached.body' => '{$reviewerName}:<br />
<br />
I believe that you would serve as an excellent reviewer of the manuscript, &quot;{$submissionTitle},&quot; and I am asking that you consider undertaking this important task for us. The Review Guidelines for this journal are appended below, and the submission is attached to this email. Your review of the submission, along with your recommendation, should be emailed to me by {$reviewDueDate}.<br />
<br />
Please indicate in a return email by {$responseDueDate} whether you are able and willing to do the review.<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
<br />
Review Guidelines<br />
<br />
{$reviewGuidelines}<br />
',
  'emails.reviewRequestAttached.description' => 'This email is sent by the Section Editor to a Reviewer to request that they accept or decline the task of reviewing a submission. It includes the submission as an attachment. This message is used when the Email-Attachment Review Process is selected in Management > Settings > Workflow > Review. (Otherwise see REVIEW_REQUEST.)',
  'emails.reviewRequestSubsequent.subject' => 'Article Review Request',
  'emails.reviewRequestSubsequent.body' => '{$reviewerName}:<br />
<br />
This regards the manuscript &quot;{$submissionTitle},&quot; which is under consideration by {$contextName}.<br />
<br />
Following the review of the previous version of the manuscript, the authors have now submitted a revised version of their paper. We would appreciate it if you could help evaluate it.<br />
<br />
Please log into the journal web site by {$responseDueDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation. The web site is {$contextUrl}<br />
<br />
The review itself is due {$reviewDueDate}.<br />
<br />
If you do not have your username and password for the journal\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestSubsequent.description' => 'This email from the Section Editor to a Reviewer requests that the reviewer accept or decline the task of reviewing a submission for a second or greater round of review. It provides information about the submission such as the title and abstract, a review due date, and how to access the submission itself. This message is used when the Standard Review Process is selected in Management > Settings > Workflow > Review. (Otherwise see REVIEW_REQUEST_ATTACHED_SUBSEQUENT.)',
  'emails.reviewRequestOneclickSubsequent.subject' => 'Article Review Request',
  'emails.reviewRequestOneclickSubsequent.body' => '{$reviewerName}:<br />
<br />
This regards the manuscript &quot;{$submissionTitle},&quot; which is under consideration by {$contextName}.<br />
<br />
Following the review of the previous version of the manuscript, the authors have now submitted a revised version of their paper. We would appreciate it if you could help evaluate it.<br />
<br />
Please log into the journal web site by {$responseDueDate} to indicate whether you will undertake the review or not, as well as to access the submission and to record your review and recommendation.<br />
<br />
The review itself is due {$reviewDueDate}.<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
&quot;{$submissionTitle}&quot;<br />
<br />
{$submissionAbstract}',
  'emails.reviewRequestOneclickSubsequent.description' => 'This email from the Section Editor to a Reviewer requests that the reviewer accept or decline the task of reviewing a submission for a second or greater round of review. It provides information about the submission such as the title and abstract, a review due date, and how to access the submission itself. This message is used when the Standard Review Process is selected in Management > Settings > Workflow > Review, and one-click reviewer access is enabled.',
  'emails.reviewRequestAttachedSubsequent.subject' => 'Article Review Request',
  'emails.reviewRequestAttachedSubsequent.body' => '{$reviewerName}:<br />
<br />
This regards the manuscript &quot;{$submissionTitle},&quot; which is under consideration by {$contextName}.<br />
<br />
Following the review of the previous version of the manuscript, the authors have now submitted a revised version of their paper. We would appreciate it if you could help evaluate it.<br />
<br />
The Review Guidelines for this journal are appended below, and the submission is attached to this email. Your review of the submission, along with your recommendation, should be emailed to me by {$reviewDueDate}.<br />
<br />
Please indicate in a return email by {$responseDueDate} whether you are able and willing to do the review.<br />
<br />
Thank you for considering this request.<br />
<br />
{$editorialContactSignature}<br />
<br />
<br />
Review Guidelines<br />
<br />
{$reviewGuidelines}<br />
',
  'emails.reviewRequestAttachedSubsequent.description' => 'This email is sent by the Section Editor to a Reviewer to request that they accept or decline the task of reviewing a submission for a second or greater round of review. It includes the submission as an attachment. This message is used when the Email-Attachment Review Process is selected in Management > Settings > Workflow > Review. (Otherwise see REVIEW_REQUEST_SUBSEQUENT.)',
  'emails.reviewCancel.subject' => 'Request for Review Cancelled',
  'emails.reviewCancel.body' => '{$reviewerName}:<br />
<br />
We have decided at this point to cancel our request for you to review the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We apologize for any inconvenience this may cause you and hope that we will be able to call on you to assist with this journal\'s review process in the future.<br />
<br />
If you have any questions, please contact me.',
  'emails.reviewCancel.description' => 'This email is sent by the Section Editor to a Reviewer who has a submission review in progress to notify them that the review has been cancelled.',
  'emails.reviewReinstate.subject' => 'Request for Review Reinstated',
  'emails.reviewReinstate.body' => '{$reviewerName}:<br />
<br />
We would like to reinstate our request for you to review the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We hope that you will be able to assist with this journal\'s review process.<br />
<br />
If you have any questions, please contact me.',
  'emails.reviewReinstate.description' => 'This email is sent by the Section Editor to a Reviewer who has a submission review in progress to notify them that a cancelled review has been reinstated.',
  'emails.reviewConfirm.subject' => 'Able to Review',
  'emails.reviewConfirm.body' => 'Editors:<br />
<br />
I am able and willing to review the submission, &quot;{$submissionTitle},&quot; for {$contextName}. Thank you for thinking of me, and I plan to have the review completed by its due date, {$reviewDueDate}, if not before.<br />
<br />
{$reviewerName}',
  'emails.reviewConfirm.description' => 'This email is sent by a Reviewer to the Section Editor in response to a review request to notify the Section Editor that the review request has been accepted and will be completed by the specified date.',
  'emails.reviewDecline.subject' => 'Unable to Review',
  'emails.reviewDecline.body' => 'Editors:<br />
<br />
I am afraid that at this time I am unable to review the submission, &quot;{$submissionTitle},&quot; for {$contextName}. Thank you for thinking of me, and another time feel free to call on me.<br />
<br />
{$reviewerName}',
  'emails.reviewDecline.description' => 'This email is sent by a Reviewer to the Section Editor in response to a review request to notify the Section Editor that the review request has been declined.',
  'emails.reviewAck.subject' => 'Article Review Acknowledgement',
  'emails.reviewAck.body' => '{$reviewerName}:<br />
<br />
Thank you for completing the review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We appreciate your contribution to the quality of the work that we publish.',
  'emails.reviewAck.description' => 'This email is sent by a Section Editor to confirm receipt of a completed review and thank the reviewer for their contributions.',
  'emails.reviewRemind.subject' => 'Submission Review Reminder',
  'emails.reviewRemind.body' => '{$reviewerName}:<br />
<br />
Just a gentle reminder of our request for your review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We were hoping to have this review by {$reviewDueDate}, and would be pleased to receive it as soon as you are able to prepare it.<br />
<br />
If you do not have your username and password for the journal\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Please confirm your ability to complete this vital contribution to the work of the journal. I look forward to hearing from you.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemind.description' => 'This email is sent by a Section Editor to remind a reviewer that their review is due.',
  'emails.reviewRemindOneclick.subject' => 'Submission Review Reminder',
  'emails.reviewRemindOneclick.body' => '{$reviewerName}:<br />
<br />
Just a gentle reminder of our request for your review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We were hoping to have this review by {$reviewDueDate}, and would be pleased to receive it as soon as you are able to prepare it.<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Please confirm your ability to complete this vital contribution to the work of the journal. I look forward to hearing from you.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemindOneclick.description' => 'This email is sent by a Section Editor to remind a reviewer that their review is due.',
  'emails.reviewRemindAuto.subject' => 'Automated Submission Review Reminder',
  'emails.reviewRemindAuto.body' => '{$reviewerName}:<br />
<br />
Just a gentle reminder of our request for your review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We were hoping to have this review by {$reviewDueDate}, and this email has been automatically generated and sent with the passing of that date. We would still be pleased to receive it as soon as you are able to prepare it.<br />
<br />
If you do not have your username and password for the journal\'s web site, you can use this link to reset your password (which will then be emailed to you along with your username). {$passwordResetUrl}<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Please confirm your ability to complete this vital contribution to the work of the journal. I look forward to hearing from you.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemindAuto.description' => 'This email is automatically sent when a reviewer\'s due date elapses (see Review Options under Settings > Workflow > Review) and one-click reviewer access is disabled. Scheduled tasks must be enabled and configured (see the site configuration file).',
  'emails.reviewRemindAutoOneclick.subject' => 'Automated Submission Review Reminder',
  'emails.reviewRemindAutoOneclick.body' => '{$reviewerName}:<br />
<br />
Just a gentle reminder of our request for your review of the submission, &quot;{$submissionTitle},&quot; for {$contextName}. We were hoping to have this review by {$reviewDueDate}, and this email has been automatically generated and sent with the passing of that date. We would still be pleased to receive it as soon as you are able to prepare it.<br />
<br />
Submission URL: {$submissionReviewUrl}<br />
<br />
Please confirm your ability to complete this vital contribution to the work of the journal. I look forward to hearing from you.<br />
<br />
{$editorialContactSignature}',
  'emails.reviewRemindAutoOneclick.description' => 'This email is automatically sent when a reviewer\'s due date elapses (see Review Options under Settings > Workflow > Review) and one-click reviewer access is enabled. Scheduled tasks must be enabled and configured (see the site configuration file).',
  'emails.editorDecisionAccept.subject' => 'Editor Decision',
  'emails.editorDecisionAccept.body' => '{$authorName}:<br />
<br />
We have reached a decision regarding your submission to {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Our decision is to: Accept Submission',
  'emails.editorDecisionAccept.description' => 'This email from the Editor or Section Editor to an Author notifies them of a final "accept submission" decision regarding their submission.',
  'emails.editorDecisionSendToExternal.subject' => 'Editor Decision',
  'emails.editorDecisionSendToExternal.body' => '{$authorName}:<br />
<br />
We have reached a decision regarding your submission to {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Our decision is to: Send to Review<br />
<br />
Submission URL: {$submissionUrl}',
  'emails.editorDecisionSendToExternal.description' => 'This email from the Editor or Section Editor to an Author notifies them that their submission is being sent to an external review.',
  'emails.editorDecisionSendToProduction.subject' => 'Editor Decision',
  'emails.editorDecisionSendToProduction.body' => '{$authorName}:<br />
<br />
The editing of your submission, &quot;{$submissionTitle},&quot; is complete.  We are now sending it to production.<br />
<br />
Submission URL: {$submissionUrl}',
  'emails.editorDecisionSendToProduction.description' => 'This email from the Editor or Section Editor to an Author notifies them that their submission is being sent to production.',
  'emails.editorDecisionRevisions.subject' => 'Editor Decision',
  'emails.editorDecisionRevisions.body' => '{$authorName}:<br />
<br />
We have reached a decision regarding your submission to {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Our decision is: Revisions Required',
  'emails.editorDecisionRevisions.description' => 'This email from the Editor or Section Editor to an Author notifies them of a final "revisions required" decision regarding their submission.',
  'emails.editorDecisionResubmit.subject' => 'Editor Decision',
  'emails.editorDecisionResubmit.body' => '{$authorName}:<br />
<br />
We have reached a decision regarding your submission to {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Our decision is to: Resubmit for Review',
  'emails.editorDecisionResubmit.description' => 'This email from the Editor or Section Editor to an Author notifies them of a final "resubmit" decision regarding their submission.',
  'emails.editorDecisionDecline.subject' => 'Editor Decision',
  'emails.editorDecisionDecline.body' => '{$authorName}:<br />
<br />
We have reached a decision regarding your submission to {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Our decision is to: Decline Submission',
  'emails.editorDecisionDecline.description' => 'This email from the Editor or Section Editor to an Author notifies them of a final "decline" decision regarding their submission.',
  'emails.editorRecommendation.subject' => 'Editor Recommendation',
  'emails.editorRecommendation.body' => '{$editors}:<br />
<br />
The recommendation regarding the submission to {$contextName}, &quot;{$submissionTitle}&quot; is: {$recommendation}',
  'emails.editorRecommendation.description' => 'This email from the recommending Editor or Section Editor to the decision making Editors or Section Editors notifies them of a final recommendation regarding the submission.',
  'emails.copyeditRequest.subject' => 'Copyediting Request',
  'emails.copyeditRequest.body' => '{$participantName}:<br />
<br />
I would ask that you undertake the copyediting of &quot;{$submissionTitle}&quot; for {$contextName} by following these steps.<br />
1. Click on the Submission URL below.<br />
2. Open any files available under Draft Files and do your copyediting, while adding any Copyediting Discussions as needed.<br />
3. Save copyedited file(s), and upload to Copyedited panel.<br />
4. Notify the Editor that all files have been prepared, and that the Production process may begin.<br />
<br />
{$contextName} URL: {$contextUrl}<br />
Submission URL: {$submissionUrl}<br />
Username: {$participantUsername}',
  'emails.copyeditRequest.description' => 'This email is sent by a Section Editor to a submission\'s Copyeditor to request that they begin the copyediting process. It provides information about the submission and how to access it.',
  'emails.layoutRequest.subject' => 'Request Galleys',
  'emails.layoutRequest.body' => '{$participantName}:<br />
<br />
The submission &quot;{$submissionTitle}&quot; to {$contextName} now needs galleys laid out by following these steps.<br />
1. Click on the Submission URL below.<br />
2. Log into the journal and use the Production Ready files to create the galleys according to the journal\'s standards.<br />
3. Upload the galleys to the Galley Files section.<br />
4. Notify the Editor using Production Discussions that the galleys are uploaded and ready.<br />
<br />
{$contextName} URL: {$contextUrl}<br />
Submission URL: {$submissionUrl}<br />
Username: {$participantUsername}<br />
<br />
If you are unable to undertake this work at this time or have any questions, please contact me. Thank you for your contribution to this journal.',
  'emails.layoutRequest.description' => 'This email from the Section Editor to the Layout Editor notifies them that they have been assigned the task of performing layout editing on a submission. It provides information about the submission and how to access it.',
  'emails.layoutComplete.subject' => 'Galleys Complete',
  'emails.layoutComplete.body' => '{$editorialContactName}:<br />
<br />
Galleys have now been prepared for the manuscript, &quot;{$submissionTitle},&quot; for {$contextName} and are ready for proofreading.<br />
<br />
If you have any questions, please contact me.<br />
<br />
{$participantName}',
  'emails.layoutComplete.description' => 'This email from the Layout Editor to the Section Editor notifies them that the layout process has been completed.',
  'emails.emailLink.subject' => 'Article of Possible Interest',
  'emails.emailLink.body' => 'Thought you might be interested in seeing &quot;{$submissionTitle}&quot; by {$authorName} published in Vol {$volume}, No {$number} ({$year}) of {$contextName} at &quot;{$articleUrl}&quot;.',
  'emails.emailLink.description' => 'This email template provides a registered reader with the opportunity to send information about an article to somebody who may be interested. It is available via the Reading Tools and must be enabled by the Journal Manager in the Reading Tools Administration page.',
  'emails.subscriptionNotify.subject' => 'Subscription Notification',
  'emails.subscriptionNotify.body' => '{$subscriberName}:<br />
<br />
You have now been registered as a subscriber in our online journal management system for {$contextName}, with the following subscription:<br />
<br />
{$subscriptionType}<br />
<br />
To access content that is available only to subscribers, simply log in to the system with your username, &quot;{$username}&quot;.<br />
<br />
Once you have logged in to the system you can change your profile details and password at any point.<br />
<br />
Please note that if you have an institutional subscription, there is no need for users at your institution to log in, since requests for subscription content will be automatically authenticated by the system.<br />
<br />
If you have any questions, please feel free to contact me.<br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionNotify.description' => 'This email notifies a registered reader that the Manager has created a subscription for them. It provides the journal\'s URL along with instructions for access.',
  'emails.openAccessNotify.subject' => 'Issue Now Open Access',
  'emails.openAccessNotify.body' => 'Readers:<br />
<br />
{$contextName} has just made available in an open access format the following issue. We invite you to review the Table of Contents here and then visit our web site ({$contextUrl}) to review articles and items of interest.<br />
<br />
Thanks for the continuing interest in our work,<br />
{$editorialContactSignature}',
  'emails.openAccessNotify.description' => 'This email is sent to registered readers who have requested to receive a notification email when an issue becomes open access.',
  'emails.subscriptionBeforeExpiry.subject' => 'Notice of Subscription Expiry',
  'emails.subscriptionBeforeExpiry.body' => '{$subscriberName}:<br />
<br />
Your {$contextName} subscription is about to expire.<br />
<br />
{$subscriptionType}<br />
Expiry date: {$expiryDate}<br />
<br />
To ensure the continuity of your access to this journal, please go to the journal website and renew your subscription. You are able to log in to the system with your username, &quot;{$username}&quot;.<br />
<br />
If you have any questions, please feel free to contact me.<br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionBeforeExpiry.description' => 'This email notifies a subscriber that their subscription will soon expire. It provides the journal\'s URL along with instructions for access.',
  'emails.subscriptionAfterExpiry.subject' => 'Subscription Expired',
  'emails.subscriptionAfterExpiry.body' => '{$subscriberName}:<br />
<br />
Your {$contextName} subscription has expired.<br />
<br />
{$subscriptionType}<br />
Expiry date: {$expiryDate}<br />
<br />
To renew your subscription, please go to the journal website. You are able to log in to the system with your username, &quot;{$username}&quot;.<br />
<br />
If you have any questions, please feel free to contact me.<br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionAfterExpiry.description' => 'This email notifies a subscriber that their subscription has expired. It provides the journal\'s URL along with instructions for access.',
  'emails.subscriptionAfterExpiryLast.subject' => 'Subscription Expired - Final Reminder',
  'emails.subscriptionAfterExpiryLast.body' => '{$subscriberName}:<br />
<br />
Your {$contextName} subscription has expired.<br />
Please note that this is the final reminder that will be emailed to you.<br />
<br />
{$subscriptionType}<br />
Expiry date: {$expiryDate}<br />
<br />
To renew your subscription, please go to the journal website. You are able to log in to the system with your username, &quot;{$username}&quot;.<br />
<br />
If you have any questions, please feel free to contact me.<br />
<br />
{$subscriptionContactSignature}',
  'emails.subscriptionAfterExpiryLast.description' => 'This email notifies a subscriber that their subscription has expired. It provides the journal\'s URL along with instructions for access.',
  'emails.subscriptionPurchaseIndl.subject' => 'Subscription Purchase: Individual',
  'emails.subscriptionPurchaseIndl.body' => 'An individual subscription has been purchased online for {$contextName} with the following details.<br />
<br />
Subscription Type:<br />
{$subscriptionType}<br />
<br />
User:<br />
{$userDetails}<br />
<br />
Membership Information (if provided):<br />
{$membership}<br />
<br />
To view or edit this subscription, please use the following URL.<br />
<br />
Subscription URL: {$subscriptionUrl}<br />
',
  'emails.subscriptionPurchaseIndl.description' => 'This email notifies the Subscription Manager that an individual subscription has been purchased online. It provides summary information about the subscription and a quick access link to the purchased subscription.',
  'emails.subscriptionPurchaseInstl.subject' => 'Subscription Purchase: Institutional',
  'emails.subscriptionPurchaseInstl.body' => 'An institutional subscription has been purchased online for {$contextName} with the following details. To activate this subscription, please use the provided Subscription URL and set the subscription status to \'Active\'.<br />
<br />
Subscription Type:<br />
{$subscriptionType}<br />
<br />
Institution:<br />
{$institutionName}<br />
{$institutionMailingAddress}<br />
<br />
Domain (if provided):<br />
{$domain}<br />
<br />
IP Ranges (if provided):<br />
{$ipRanges}<br />
<br />
Contact Person:<br />
{$userDetails}<br />
<br />
Membership Information (if provided):<br />
{$membership}<br />
<br />
To view or edit this subscription, please use the following URL.<br />
<br />
Subscription URL: {$subscriptionUrl}<br />
',
  'emails.subscriptionPurchaseInstl.description' => 'This email notifies the Subscription Manager that an institutional subscription has been purchased online. It provides summary information about the subscription and a quick access link to the purchased subscription.',
  'emails.subscriptionRenewIndl.subject' => 'Subscription Renewal: Individual',
  'emails.subscriptionRenewIndl.body' => 'An individual subscription has been renewed online for {$contextName} with the following details.<br />
<br />
Subscription Type:<br />
{$subscriptionType}<br />
<br />
User:<br />
{$userDetails}<br />
<br />
Membership Information (if provided):<br />
{$membership}<br />
<br />
To view or edit this subscription, please use the following URL.<br />
<br />
Subscription URL: {$subscriptionUrl}<br />
',
  'emails.subscriptionRenewIndl.description' => 'This email notifies the Subscription Manager that an individual subscription has been renewed online. It provides summary information about the subscription and a quick access link to the renewed subscription.',
  'emails.subscriptionRenewInstl.subject' => 'Subscription Renewal: Institutional',
  'emails.subscriptionRenewInstl.body' => 'An institutional subscription has been renewed online for {$contextName} with the following details.<br />
<br />
Subscription Type:<br />
{$subscriptionType}<br />
<br />
Institution:<br />
{$institutionName}<br />
{$institutionMailingAddress}<br />
<br />
Domain (if provided):<br />
{$domain}<br />
<br />
IP Ranges (if provided):<br />
{$ipRanges}<br />
<br />
Contact Person:<br />
{$userDetails}<br />
<br />
Membership Information (if provided):<br />
{$membership}<br />
<br />
To view or edit this subscription, please use the following URL.<br />
<br />
Subscription URL: {$subscriptionUrl}<br />
',
  'emails.subscriptionRenewInstl.description' => 'This email notifies the Subscription Manager that an institutional subscription has been renewed online. It provides summary information about the subscription and a quick access link to the renewed subscription.',
  'emails.citationEditorAuthorQuery.subject' => 'Citation Editing',
  'emails.citationEditorAuthorQuery.body' => '{$authorFirstName},<br />
<br />
Could you please verify or provide us with the proper citation for the following reference from your article, {$submissionTitle}:<br />
<br />
{$rawCitation}<br />
<br />
Thanks!<br />
<br />
{$userFirstName}<br />
Copy-Editor, {$contextName}<br />
',
  'emails.citationEditorAuthorQuery.description' => 'This email allows copyeditors to request additional information about references from authors.',
  'emails.revisedVersionNotify.subject' => 'Revised Version Uploaded',
  'emails.revisedVersionNotify.body' => 'Editors:<br />
<br />
A revised version of &quot;{$submissionTitle}&quot; has been uploaded by the author {$authorName}.<br />
<br />
Submission URL: {$submissionUrl}<br />
<br />
{$editorialContactSignature}',
  'emails.revisedVersionNotify.description' => 'This email is automatically sent to the assigned editor when author uploads a revised version of an article.',
  'emails.notificationCenterDefault.subject' => 'A message regarding {$contextName}',
  'emails.notificationCenterDefault.body' => 'Please enter your message.',
  'emails.notificationCenterDefault.description' => 'The default (blank) message used in the Notification Center Message Listbuilder.',
  'emails.editorDecisionInitialDecline.subject' => 'Editor Decision',
  'emails.editorDecisionInitialDecline.body' => '
			{$authorName}:<br />
<br />
We have reached a decision regarding your submission to {$contextName}, &quot;{$submissionTitle}&quot;.<br />
<br />
Our decision is to: Decline Submission',
  'emails.editorDecisionInitialDecline.description' => 'This email is sent to the author if the editor declines their submission initially, before the review stage',
  'emails.statisticsReportNotification.subject' => 'Editorial activity for {$month}, {$year}',
  'emails.statisticsReportNotification.body' => '
{$name}, <br />
<br />
Your journal health report for {$month}, {$year} is now available. Your key stats for this month are below.<br />
<ul>
	<li>New submissions this month: {$newSubmissions}</li>
	<li>Declined submissions this month: {$declinedSubmissions}</li>
	<li>Accepted submissions this month: {$acceptedSubmissions}</li>
	<li>Total submissions in the system: {$totalSubmissions}</li>
</ul>
Login to the journal to view more detailed <a href="{$editorialStatsLink}">editorial trends</a> and <a href="{$publicationStatsLink}">published article stats</a>. A full copy of this month\'s editorial trends is attached.<br />
<br />
Sincerely,<br />
{$principalContactSignature}',
  'emails.statisticsReportNotification.description' => 'This email is automatically sent monthly to editors and journal managers to provide them a system health overview.',
  'emails.announcement.subject' => '{$title}',
  'emails.announcement.body' => '<b>{$title}</b><br />
<br />
{$summary}<br />
<br />
Visit our website to read the <a href="{$url}">full announcement</a>.',
  'emails.announcement.description' => 'This email is sent when a new announcement is created.',
);