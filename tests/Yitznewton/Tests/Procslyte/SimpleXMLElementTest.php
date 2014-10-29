<?php

namespace Yitznewton\Tests\Procslyte;

use Yitznewton\Procslyte\SimpleXMLElement;

class SimpleXMLElementTest extends \PHPUnit_Framework_TestCase
{
    public function testBasicFunctionality()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<locale>
    <info>hi</info>
</locale>
EOF;

        $xmlObj = new SimpleXMLElement($xml);
        $this->assertInstanceOf('\\Yitznewton\\Procslyte\\SimpleXMLElement', $xmlObj->info);
        $this->assertEquals('hi', (string) $xmlObj->info);
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function testReduceWhenInitialized()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<a>
    <b>hi</b>
    <b>there</b>
</a>
EOF;
        $xmlObj = new SimpleXMLElement($xml);
        $this->assertEquals('there', $xmlObj->b->reduce(function ($cumulative, $current) {
            return $current;
        }, ''));
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function testReduceWhenNotInitialized()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<a>
    <b>hi</b>
    <b>there</b>
</a>
EOF;
        $xmlObj = new SimpleXMLElement($xml);
        $this->assertEquals('hi', $xmlObj->b->reduce(function ($cumulative, $current) {
            return $cumulative;
        }));
    }

    public function testMap()
    {
        $xml = <<<EOF
<?xml version="1.0" encoding="utf-8"?>
<a>
    <b>hi</b>
    <b>there</b>
</a>
EOF;
        $xmlObj = new SimpleXMLElement($xml);
        $this->assertEquals(['hiyo', 'thereyo'], $xmlObj->b->map(function ($item) {
            return $item . 'yo';
        }));
    }
}
