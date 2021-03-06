<?php

require_once 'Customweb/Annotation/Cache/Annotation.php';
require_once 'Customweb/Annotation/Parser/AnnotationMatcher.php';


class Customweb_Annotation_Parser_AnnotationsMatcher{

	public function matches($string, &$annotations){
		$annotations = array();
		$annotationMatcher = new Customweb_Annotation_Parser_AnnotationMatcher();
		
		while (true) {
			if (preg_match('~(?P<leadingSpace>\s)?(?=@)~', $string, $matches, PREG_OFFSET_CAPTURE)) {
				$offset = $matches[0][1];
				
				if (isset($matches['leadingSpace'])) {
					$offset ++;
				}
				
				$string = substr($string, $offset);
			} else {
				// no more annotations
				break;
			}
			
			if (($length = $annotationMatcher->matches($string, $data)) !== false) {
				$string = substr($string, $length);
				
				list($name, $params) = $data;
				$annotations[$name] = new Customweb_Annotation_Cache_Annotation($name, $params);
			} else {
				// Move on !
				$string = substr($string, 1);
			}
		}
	}
}