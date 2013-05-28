<?php
namespace S9\DomainLogger;

/*                                                                        *
 * This script belongs to the FLOW3 package "S9.DomainLogger".            *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use \TYPO3\Flow\Package\Package as BasePackage;

/**
 * The Blog Package
 *
 */
class Package extends BasePackage {

    /**
     * Boot the package. We wire some signals to slots here.
     *
     * @param \TYPO3\Flow\Core\Bootstrap $bootstrap The current bootstrap
     * @return void
     */
    public function boot(\TYPO3\Flow\Core\Bootstrap $bootstrap) {
        $dispatcher = $bootstrap->getSignalSlotDispatcher();
        $dispatcher->connect(
            'S9\DomainLogger\Command\DomainCommandController', 'domainAvailable',
            'S9\DomainLogger\Service\Notification', 'sendDomainNotification'
        );
    }

}

?>