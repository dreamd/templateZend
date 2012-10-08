<?php
/*
name				[Twig]
version				[1.9.1]
last modifty	[2012-08-11]
*/
function Twig($includeMod, $includeFunc) {
	$nowFolder = dirname(__FILE__).__SLASH__;
	$includeFunc(array(	"library" => __FUNCTION__,
										"filePath" => array(	$nowFolder."Twig_Autoloader.php"
															)
							));
	Twig_Autoloader::register();
}
?>