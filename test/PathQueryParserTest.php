<?php

namespace Com\PaulDevelop\Library\Persistence;

use Com\PaulDevelop\Library\Persistence\PathQuery\Compositions;
use Com\PaulDevelop\Library\Persistence\PathQuery\Filter;
use Com\PaulDevelop\Library\Persistence\PathQuery\FilterCollection;
use Com\PaulDevelop\Library\Persistence\PathQuery\Operators;
use Com\PaulDevelop\Library\Persistence\PathQuery\Order;
use Com\PaulDevelop\Library\Persistence\PathQuery\OrderCollection;
use Com\PaulDevelop\Library\Persistence\PathQuery\Parser;
use Com\PaulDevelop\Library\Persistence\PathQuery\ParserResult;
use Com\PaulDevelop\Library\Persistence\PathQuery\SortOrders;
use Com\PaulDevelop\Library\Persistence\PathQuery\ViewParameter;

class PathQueryParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testParsePath()
    {
        $parserResult = Parser::parse('entity[@attribute=value]#from-0,count-1,orderBy-id,order-asc');

        $filter = new FilterCollection();
        $filter->add(new Filter('attribute', Operators::EQUALS, 'value', Compositions::_AND));
        $orderCollection = new OrderCollection();
        $orderCollection->add(new Order(SortOrders::ASCENDING ,'id'));
        $viewParameter = new ViewParameter(0, 1, $orderCollection);
        $this->assertEquals(new ParserResult('entity', $filter, $viewParameter), $parserResult);
    }

    public function testParsePathHavingAttributeValueWithSpace()
    {
        $parserResult = Parser::parse('entity[@attribute=\'foo bar\']#from-0,count-1,orderBy-id,order-asc');

        $filter = new FilterCollection();
        $filter->add(new Filter('attribute', Operators::EQUALS, 'foo bar', Compositions::_AND));
        $orderCollection = new OrderCollection();
        $orderCollection->add(new Order(SortOrders::ASCENDING ,'id'));
        $viewParameter = new ViewParameter(0, 1, $orderCollection);
        $this->assertEquals(new ParserResult('entity', $filter, $viewParameter), $parserResult);
    }

    public function testParsePathHavingAttributeWithNamespace()
    {
        $parserResult = Parser::parse('entity[@namespace:attribute=value]#from-0,count-1,orderBy-id,order-asc');

        $filter = new FilterCollection();
        $filter->add(new Filter('namespace:attribute', Operators::EQUALS, 'value', Compositions::_AND));
        $orderCollection = new OrderCollection();
        $orderCollection->add(new Order(SortOrders::ASCENDING ,'id'));
        $viewParameter = new ViewParameter(0, 1, $orderCollection);
        $this->assertEquals(new ParserResult('entity', $filter, $viewParameter), $parserResult);
    }
}
