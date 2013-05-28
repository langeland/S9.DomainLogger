<?php
namespace S9\DomainLogger\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "S9.DomainLogger".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Standard controller for the S9.DomainLogger package 
 *
 * @Flow\Scope("singleton")
 */
class StandardController extends \TYPO3\Flow\Mvc\Controller\ActionController {

	/**
	 * Index action
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('foos', array(
			'bar', 'baz'
		));
	}

}

?>