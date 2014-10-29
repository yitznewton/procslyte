<?php

namespace Yitznewton\Procslyte;

class Locale
{
    private $styleOptions;
    private $termSet;

    /**
     * @param array $styleOptions
     * @param \stdClass $termSet
     */
    public function __construct(array $styleOptions, \stdClass $termSet)
    {
        $this->styleOptions = $styleOptions;
        $this->termSet = $termSet;
    }

    /**
     * @return bool
     */
    public function punctuationInQuote()
    {
        return \igorw\get_in($this->styleOptions, ['punctuationInQuote'], false);
    }

    /**
     * @return \stdClass
     */
    public function termSet()
    {
        return $this->termSet;
    }

    /**
     * @param string $xml
     * @return Locale
     */
    public static function fromXml($xml)
    {
        $xmlObj = new \SimpleXMLElement($xml);
        $styleOptions = ['punctuationInQuote' => self::extractPunctuationInQuote($xmlObj)];
        $termSet = self::extractTermSet($xmlObj);
        return new Locale($styleOptions, $termSet);
    }

    private static function extractPunctuationInQuote(\SimpleXMLElement $xmlObj)
    {
        $simpleXmlPunctuation = (string) $xmlObj->{'style-options'}['punctuation-in-quote'];
        return $simpleXmlPunctuation === 'true';
    }

    private static function extractTermSet(\SimpleXMLElement $xmlObj)
    {
        $termSet = new \stdClass();

        foreach ($xmlObj->terms->term as $term) {
            $termName = (string) $term['name'];

            if (!isset($termSet->$termName)) {
                $termSet->$termName = [];
            }

            $form = (string) $term['form'] ?: 'long';
            $entry = self::extractEntry($term, $form);

            array_push($termSet->$termName, $entry);
        }

        return $termSet;
    }

    private static function extractEntry(\SimpleXMLElement $term, $form)
    {
        if ($term->single) {
            return [
                'form' => $form,
                'value' => (string) $term->single,
                'valueMultiple' => (string) $term->multiple,
            ];
        } else {
            return [
                'form' => $form,
                'value' => (string) $term,
            ];
        }
    }
}
