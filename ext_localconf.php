<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-all'][] = 
	'EXT:nwt_replacer/Classes/Replacer.php:&tx_nwtreplacer_replacer->contentPostProc';
$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][] = 
	'EXT:nwt_replacer/Classes/Replacer.php:&tx_nwtreplacer_replacer->contentPostProc';
?>