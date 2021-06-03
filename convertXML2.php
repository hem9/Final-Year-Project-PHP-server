<?php

/*

This function takes in the old tag and replaces it with the new tag

The same function can also be sued to change only the attribute names, by keeping 
the old and new tags same


*/

function transformTags($xml, $oldTag, $newTag, $oldAttribute = null, $newAttribute = null)
{
    $domDoc = new DOMDocument();
    $domDoc->loadXML($xml);

    $domnodes = $domDoc->getElementsByTagName($oldTag);
    $toRemove = array();
    foreach ($domnodes as $node)
    {

    	if($oldTag != $newTag && $newTag != ""){

	        $newNode = $domDoc->createElement($newTag);
	        
	        

	         foreach ($node->attributes as $attribute) {
			        $newNode->setAttribute($attribute->name, $attribute->value);
			    }
			 foreach (iterator_to_array($node->childNodes) as $child) {
			        $newNode->appendChild($node->removeChild($child));
			    }

			    $node->parentNode->replaceChild($newNode, $node);


	    

    	}
    	else if($oldTag != $newTag && $newTag == ""){

    	
			
			foreach (iterator_to_array($node->childNodes) as $child) {
			        $node->parentNode->appendChild($node->removeChild($child));
			    }

		
			    $toRemove[] = $node;
    	}
    	else if($oldTag == $newTag){
    
	        if(($oldAttribute != null || $oldAttribute != "") && $node->hasAttribute($oldAttribute)){

	        		
	        		$node->setAttribute($newAttribute, $node->getAttribute($oldAttribute));
	        		$node->removeAttribute($oldAttribute);
	        	}
	        	



    	}
    }

    if(count($toRemove) > 0){
    	foreach ($toRemove as $node)
		    {
		        $node->parentNode->removeChild($node);
		    }
	}

    return $domDoc->saveXML();
}
?>