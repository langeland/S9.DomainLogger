<?php
namespace S9\DomainLogger\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "S9.DomainLogger".       *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * RunCommand command controller for the S9.DomainLogger package
 *
 * @Flow\Scope("singleton")
 */
class DomainCommandController extends \TYPO3\Flow\Cli\CommandController {


	/**
	 * @Flow\Inject
	 * @var \S9\DomainLogger\Domain\Repository\DomainRepository
	 */
	protected $domainRepository;


	/**
	 * @Flow\Inject
	 * @var \S9\DomainLogger\Service\Whois
	 */
	protected $whois;

	/**
	 * An run command
	 *
	 * The comment of this command method is also used for TYPO3 Flow's help screens. The first line should give a very short
	 * summary about what the command does. Then, after an empty line, you should explain in more detail what the command
	 * does. You might also give some usage example.
	 *
	 * It is important to document the parameters with param tags, because that information will also appear in the help
	 * screen.
	 *
	 * @param string $optionalArgument This argument is optional
	 * @return void
	 */
	public function runCommand($optionalArgument = NULL) {
		$domains = $this->domainRepository->findAll();
        $time = new \DateTime('NOW');
		foreach($domains as $domain){

            $domain->setLastExecution($time);

			$this->outputLine('Analysing: "%s".', array($domain->getDomainName()));

			if($this->whois->isAvailable($domain)){
                $this->outputLine(' %s is available', array($domain->getDomainName()));
                $domain->setStatus(200);
                $this->emitDomainAvailable($domain);
            }else{
                $this->outputLine(' %s is NOT available', array($domain->getDomainName()));
                $domain->setStatus(0);
            }

            $this->domainRepository->update($domain);

		}



	}


    /**
     * @param \S9\DomainLogger\Domain\Model\Domain $domain
     * @return void
     * @Flow\Signal
     */
    protected function emitDomainAvailable(\S9\DomainLogger\Domain\Model\Domain $domain) {}

}

?>