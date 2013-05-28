<?php
namespace S9\DomainLogger\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "S9.DomainLogger".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \S9\DomainLogger\Domain\Model\Domain;

/**
 * Domain controller for the S9.DomainLogger package 
 *
 * @Flow\Scope("singleton")
 */
class DomainController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \S9\DomainLogger\Domain\Repository\DomainRepository
	 */
	protected $domainRepository;

	/**
	 * Shows a list of domains
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('domains', $this->domainRepository->findAll());
	}

	/**
	 * Shows a single domain object
	 *
	 * @param \S9\DomainLogger\Domain\Model\Domain $domain The domain to show
	 * @return void
	 */
	public function showAction(Domain $domain) {
		$this->view->assign('domain', $domain);
	}

	/**
	 * Shows a form for creating a new domain object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new domain object to the domain repository
	 *
	 * @param \S9\DomainLogger\Domain\Model\Domain $newDomain A new domain to add
	 * @return void
	 */
	public function createAction(Domain $newDomain) {
		$this->domainRepository->add($newDomain);
		$this->addFlashMessage('Created a new domain.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing domain object
	 *
	 * @param \S9\DomainLogger\Domain\Model\Domain $domain The domain to edit
	 * @return void
	 */
	public function editAction(Domain $domain) {
		$this->view->assign('domain', $domain);
	}

	/**
	 * Updates the given domain object
	 *
	 * @param \S9\DomainLogger\Domain\Model\Domain $domain The domain to update
	 * @return void
	 */
	public function updateAction(Domain $domain) {
		$this->domainRepository->update($domain);
		$this->addFlashMessage('Updated the domain.');
		$this->redirect('index');
	}

	/**
	 * Removes the given domain object from the domain repository
	 *
	 * @param \S9\DomainLogger\Domain\Model\Domain $domain The domain to delete
	 * @return void
	 */
	public function deleteAction(Domain $domain) {
		$this->domainRepository->remove($domain);
		$this->addFlashMessage('Deleted a domain.');
		$this->redirect('index');
	}

}

?>