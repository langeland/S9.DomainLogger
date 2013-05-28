<?php
namespace S9\DomainLogger\Service;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Fluid".                 *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */
use S9\DomainLogger\Domain\Model\Domain;
use TYPO3\Flow\Annotations as Flow;

/**
 * Common base class for search indexer.
 */
class Notification
{

    /**
     * @param Domain $comment
     * @return void
     */
    public function sendDomainNotification(Domain $domain) {
        $recipient = "jon@klixbull.org"; //recipient
        $mail_body = 'The domain: ' . $domain->getDomainName() . 'is free...'; //mail body
        $subject = 'The domain: ' . $domain->getDomainName() . ' is free...'; //subject
        mail($recipient, $subject, $mail_body); //mail command :)
    }

}

?>