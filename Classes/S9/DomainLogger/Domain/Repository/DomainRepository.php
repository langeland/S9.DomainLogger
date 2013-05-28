<?php
namespace S9\DomainLogger\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "S9.DomainLogger".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Domains
 *
 * @Flow\Scope("singleton")
 */
class DomainRepository extends \TYPO3\Flow\Persistence\Repository {

	// add customized methods here

    /**
     * Returns all objects of this repository
     *
     * @return \TYPO3\Flow\Persistence\QueryResultInterface The query result
     * @api
     * @see \TYPO3\Flow\Persistence\QueryInterface::execute()
     */
    public function findAll() {
        $query = $this->createQuery();

        $query->setOrderings(array('domainName'=>\TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING));

        return $query->execute();
    }

}
?>