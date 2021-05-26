<?php

class TransformXML2JSON
{
    /**
     * convert to a json string from SimpleXMLElement
     *
     */
    public function convert2JSONString(\SimpleXMLElement $xmlElement)
    {
        return json_encode($this->toArray($xmlElement));
    }

    /**
     * Convert from SimpleXMLElement to PHP array
     */
    public function toArray(\SimpleXMLElement $xml)
    {
        return array($xml->getName() => $this->getData($xml));
    }

    /**
     * Returns an array of the XML data.
     *
     */
    private function getData(\SimpleXMLElement $xml)
    {
        $xmldata = array();

        // loop through the attributes and append them to the data array with '-' prefix on keys
        foreach ($xml->attributes() as $key => $value) {
            $xmldata['-' . $key] = (string)$value;
        }

        if ($xml->count() > 0) {
            $children = $xml->children();

            // loop through the children
            foreach ($children as $key => $child) {
                $childData = $this->getData($child);

                // decide how to put this into the data array, if the key exists it becomes an array of values
                if (isset($xmldata[$key])) {
                    if (is_array($xmldata[$key])) {
                        $xmldata[$key][] = $childData;
                    } else {
                        $xmldata[$key] = array($xmldata[$key], $childData);
                    }
                } else {
                    $xmldata[$key] = array($childData);
                }
            }

            foreach ($xmldata as $key => $value) {
                if (is_array($value) && count($value) === 1) {
                    $xmldata[$key] = $value[0];
                }
            }
        } else {
            // get the string value of the XML
            $value = (string)$xml;

            // check if this is just a single value element, i.e. <Element>Value</Element>
            if (count($xmldata) === 0) {
                $xmldata = $value;
            } elseif (strlen((string) $xml)) {
                $xmldata['#text'] = (string)$xml;
            }
        }

        return $xmldata;
    }
}