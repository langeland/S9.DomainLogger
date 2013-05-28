<?php
namespace S9\DomainLogger\Domain\Model;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "S9.DomainLogger".       *
 *                                                                        *
 *                                                                        */
use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Domain
 *
 * @Flow\Entity
 */
class Domain
{

	/**
	 * The name
	 * @var string
	 */
	protected $domainName;

	/**
	 * @var integer
	 * @ORM\Column(nullable=TRUE)
	 */
	protected $status;

	/**
	 * @var \DateTime
	 * @ORM\Column(nullable=TRUE)
	 */
	protected $lastExecution;

	/**
	 * @param string $domainName
	 */
	public function setDomainName($domainName)
	{
		$this->domainName = $domainName;
	}

	/**
	 * @return string
	 */
	public function getDomainName()
	{
		return $this->domainName;
	}

	/**
	 * @param \DateTime $lastExecution
	 */
	public function setLastExecution($lastExecution)
	{
		$this->lastExecution = $lastExecution;
	}

	/**
	 * @return \DateTime
	 */
	public function getLastExecution()
	{
		return $this->lastExecution;
	}

	/**
	 * @param int $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}

	/**
	 * @return int
	 */
	public function getStatus()
	{
		return $this->status;
	}


}

?>