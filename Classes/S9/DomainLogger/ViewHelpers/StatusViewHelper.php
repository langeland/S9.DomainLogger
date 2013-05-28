<?php
namespace S9\DomainLogger\ViewHelpers;

    /*                                                                        *
     * This script belongs to the FLOW3 package "Blog".                      *
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

/**
 * This view helper crops the text of a blog post in a meaningful way.
 *
 * @api
 */
class StatusViewHelper extends \TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper {


    /**
     * Initialize arguments
     *
     * @return void
     */
    public function initializeArguments() {
        parent::initializeArguments();
        $this->registerArgument('code', 'Integer', 'Status code');
    }


    /**
     * Render the read more text
     *
     * @return string cropped text
     */
    public function render() {

        switch($this->arguments['code']) {
            case 0:
                return 'error ' . $this->arguments['code'];
                break;
            case 200:
                return 'success';
                break;
            default:
                return 'warning';
            break;
        }
    }
}


?>