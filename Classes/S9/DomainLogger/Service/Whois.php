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
use TYPO3\Flow\Annotations as Flow;

/**
 * Common base class for search indexer.
 */
class Whois
{

	private $ext = array(
		'.dk' => array(
			'whois.dk-hostmaster.dk',
			'No entries found for the selected source.'
		),
		'.com' => array(
			'whois.crsnic.net',
			'No match for'
		),
		'.net' => array(
			'whois.crsnic.net',
			'No match for'
		),
		'.org' => array(
			'whois.publicinterestregistry.net',
			'NOT FOUND'
		),
		'.us' => array(
			'whois.nic.us',
			'Not Found'
		),
		'.biz' => array(
			'whois.biz',
			'Not found'
		),
		'.info' => array(
			'whois.afilias.net',
			'NOT FOUND'
		),
		'.eu' => array(
			'whois.eurid.eu',
			'FREE'
		),
		'.mobi' => array(
			'whois.dotmobiregistry.net',
			'NOT FOUND'
		),
		'.tv' => array(
			'whois.nic.tv',
			'No match for'
		),
		'.in' => array(
			'whois.inregistry.net',
			'NOT FOUND'
		),
		'.co.uk' => array(
			'whois.nic.uk',
			'No match'
		),
		'.co.ug' => array(
			'wawa.eahd.or.ug',
			'No entries found'
		),
		'.or.ug' => array(
			'wawa.eahd.or.ug',
			'No entries found'
		),
		'.sg' => array(
			'whois.nic.net.sg',
			'NOMATCH'
		),
		'.com.sg' => array(
			'whois.nic.net.sg',
			'NOMATCH'
		),
		'.per.sg' => array(
			'whois.nic.net.sg',
			'NOMATCH'
		),
		'.org.sg' => array(
			'whois.nic.net.sg',
			'NOMATCH'
		),
		'.com.my' => array(
			'whois.mynic.net.my',
			'does not Exist in database'
		),
		'.net.my' => array(
			'whois.mynic.net.my',
			'does not Exist in database'
		),
		'.org.my' => array(
			'whois.mynic.net.my',
			'does not Exist in database'
		),
		'.edu.my' => array(
			'whois.mynic.net.my',
			'does not Exist in database'
		),
		'.my' => array(
			'whois.mynic.net.my',
			'does not Exist in database'
		),
		'.nl' => array(
			'whois.domain-registry.nl',
			'not a registered domain'
		),
		'.ro' => array(
			'whois.rotld.ro',
			'No entries found for the selected'
		),
		'.com.au' => array(
			'whois.ausregistry.net.au',
			'No data Found'
		),
		'.ca' => array(
			'whois.cira.ca',
			'AVAIL'
		),
		'.org.uk' => array(
			'whois.nic.uk',
			'No match'
		),
		'.name' => array(
			'whois.nic.name',
			'No match'
		),
		'.ac.ug' => array(
			'wawa.eahd.or.ug',
			'No entries found'
		),
		'.ne.ug' => array(
			'wawa.eahd.or.ug',
			'No entries found'
		),
		'.sc.ug' => array(
			'wawa.eahd.or.ug',
			'No entries found'
		),
		'.ws' => array(
			'whois.website.ws',
			'No Match'
		),
		'.be' => array(
			'whois.ripe.net',
			'No entries'
		),
		'.com.cn' => array(
			'whois.cnnic.cn',
			'no matching record'
		),
		'.net.cn' => array(
			'whois.cnnic.cn',
			'no matching record'
		),
		'.org.cn' => array(
			'whois.cnnic.cn',
			'no matching record'
		),
		'.no' => array(
			'whois.norid.no',
			'no matches'
		),
		'.se' => array(
			'whois.nic-se.se',
			'No data found'
		),
		'.nu' => array(
			'whois.nic.nu',
			'NO MATCH for'
		),
		'.com.tw' => array(
			'whois.twnic.net',
			'No such Domain Name'
		),
		'.net.tw' => array(
			'whois.twnic.net',
			'No such Domain Name'
		),
		'.org.tw' => array(
			'whois.twnic.net',
			'No such Domain Name'
		),
		'.cc' => array(
			'whois.nic.cc',
			'No match'
		),
		'.nl' => array(
			'whois.domain-registry.nl',
			'is free'
		),
		'.pl' => array(
			'whois.dns.pl',
			'No information about'
		),
		'.pt' => array(
			'whois.dns.pt',
			'No match'
		)
	);
	private  $error;


	/**
	 * @param \S9\DomainLogger\Domain\Model\Domain $domain The domain to check
	 * @return bool
	 */
	public function isAvailable(\S9\DomainLogger\Domain\Model\Domain $domain)
	{
		$this->error = '';
		$domain = trim($domain->getDomainName());
		if (eregi('^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)*[a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?$', $domain) != 1) {
			$this->error = 'Invalid domain (Letters, numbers and hypens only) (' . $domain . ')';
			return false;
		}
		preg_match('@^(http://www\.|http://|www\.)?([^/]+)@i', $domain, $preg_metch_result);
		$f_result = '';
		$domain = $preg_metch_result [2];
		$domain_name_array = explode('.', $domain);
		$domain_domain = strtolower(trim($domain_name_array [count($domain_name_array) - 1]));
		$ext_in_list = false;

		if (array_key_exists('.' . $domain_domain, $this->ext)) {
			$ext_in_list = true;
		}

		/*
		print_r ( array (
				'$preg_metch_result' => $preg_metch_result,
				'$domain' => $domain,
				'$domain_name_array' => $domain_name_array,
				'$domain_domain' => $domain_domain,
				'$ext_in_list' => $ext_in_list
		) );
		*/

		if (strlen($domain) > 0 && $ext_in_list) {
			$server = '';
			$server = $this->ext ['.' . $domain_domain] [0];
			$lookup_result = gethostbyname($server);

			if ($lookup_result == $server) {
				$this->error = 'Error: Invalid extension - ' . $domain_domain . '. / server has outgoing connections blocked to ' . $server . '.';
				return false;
			}

			$fs = fsockopen($server, 43, $errno, $errstr, 10);

			if (!$fs || ($errstr != "")) {
				$this->error = 'Error: (' . $server . ') ' . $errstr . ' (' . $errno . ')';
				return false;
			}

			fputs($fs, "$domain\r\n");
			while (!feof($fs)) {
				$f_result .= fgets($fs, 128);
			}

			fclose($fs);

			if ($domain_domain == 'org') {
				nl2br($f_result);
			}

			if (eregi($this->ext ['.' . $domain_domain] [1], $f_result)) {
				return true;
			} else {
				return false;
			}
		} else {
			$this->error = 'Invalid Domain and/or TLD server entry does not exist';
		}
		return false;
	}


}

?>