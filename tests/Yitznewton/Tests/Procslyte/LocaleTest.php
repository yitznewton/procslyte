<?php

namespace Yitznewton\Tests\Procslyte;

use Yitznewton\Procslyte\Locale;

class LocaleTest extends \PHPUnit_Framework_TestCase
{
    public function testTermSet()
    {
        $termSet = new \stdClass();
        $locale = new Locale([], $termSet);
        $this->assertEquals($termSet, $locale->termSet());
    }

    public function testFromXml()
    {
        $locale = Locale::fromXml($this->getTestXml());
        $this->assertInstanceOf('\\Yitznewton\\Procslyte\\Locale', $locale);
        $this->assertTrue($locale->punctuationInQuote());
        $this->assertEquals([
            [
                'form' => 'long',
                'value' => 'accessed',
            ],
        ], $locale->termSet()->accessed);
        $this->assertEquals([
            [
                'form' => 'long',
                'value' => 'anonymous',
            ],
            [
                'form' => 'short',
                'value' => 'anon.',
            ],
        ], $locale->termSet()->anonymous);
        $this->assertEquals([
            [
                'form' => 'long',
                'value' => 'edition',
                'valueMultiple' => 'editions',
            ],
        ], $locale->termSet()->edition);
        $this->assertEquals([
            [
                'form' => 'long',
                'value' => 'reference',
                'valueMultiple' => 'references',
            ],
            [
                'form' => 'short',
                'value' => 'ref.',
                'valueMultiple' => 'refs.',
            ],
        ], $locale->termSet()->reference);
    }

    private function getTestXml()
    {
        /**
         * @codingStandardsIgnoreStart
         */
        return <<< EOF
<?xml version="1.0" encoding="utf-8"?>
<locale xmlns="http://purl.org/net/xbiblio/csl" version="1.0" xml:lang="en-US">
  <info>
    <rights license="http://creativecommons.org/licenses/by-sa/3.0/">This work is licensed under a Creative Commons Attribution-ShareAlike 3.0 License</rights>
    <updated>2012-07-04T23:31:02+00:00</updated>
  </info>
  <style-options punctuation-in-quote="true"/>
  <date form="text">
    <date-part name="month" suffix=" "/>
    <date-part name="day" suffix=", "/>
    <date-part name="year"/>
  </date>
  <date form="numeric">
    <date-part name="month" form="numeric-leading-zeros" suffix="/"/>
    <date-part name="day" form="numeric-leading-zeros" suffix="/"/>
    <date-part name="year"/>
  </date>
  <terms>
    <term name="accessed">accessed</term>
    <term name="anonymous">anonymous</term>
    <term name="anonymous" form="short">anon.</term>
    <term name="edition">
      <single>edition</single>
      <multiple>editions</multiple>
    </term>
    <term name="reference">
      <single>reference</single>
      <multiple>references</multiple>
    </term>
    <term name="reference" form="short">
      <single>ref.</single>
      <multiple>refs.</multiple>
    </term>
  </terms>
</locale>
EOF;
        /**
         * @codingStandardsIgnoreEnd
         */
    }
}
