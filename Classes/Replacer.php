<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Felix Oertel, networkteam GmbH <oertel@networkteam.com>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * @author Felix Oertel, networkteam.com <oertel@networkteam.com>
 * @version $Id$
 * @package nwt_replacer
 */
class Tx_NwtReplacer_Replacer {
	/**
	 * @var array
	 */
	static protected $patterns = array();

	/**
	 * @var array
	 */
	static protected $markers = array();

	/**
	 * method is executed from a hook to replace your stuff
	 *
	 * writes stuff directly to $GLOBALS[TSFE]->content
	 * @return void
	 */
	public function contentPostProc() {
		$content = $GLOBALS['TSFE']->content;

		foreach (self::$markers as $marker) {
			
			$content = ($marker['ignoreCase']
				? str_ireplace($marker['search'], $marker['replace'], $content)
				: str_replace($marker['search'], $marker['replace'], $content)
			);
		}

		foreach (self::$patterns as $pattern) {
			$content = preg_replace($pattern['search'], $pattern['replace'], $content);
		}

		$GLOBALS['TSFE']->content = $content;
	}

	/**
	 * registeres a simple string to be replaced
	 * 
	 * @see registerPattern for more special patterns
	 * @param string $search
	 * @param string $replace
	 * @param boolean $ignoreCase
	 * @return void
	 */
	static public function registerMarker($search, $replace, $ignoreCase = FALSE) {
		self::$markers[] = array(
			'search'		=> $search,
			'replace' 		=> $replace,
			'ignoreCase' 	=> (bool)$ignoreCase
		);
	}

	/**
	 * registers a pattern to be replaced
	 * 
	 * @see registerMarker to be used for simple strings
	 * @param string $search pattern as used in preg_replace
	 * @param string $replace as used in preg_replace
	 * @return void
	 */
	static public function registerPattern($search, $replace) {
		self::$patterns[] = array(
			'search' => $search,
			'replace' => $replace
		);
	}
}
?>