<?php
namespace Aura\Marshal;

use Aura\Marshal\Record\GenericRecord;
use Aura\Marshal\MockRecord;
use Aura\Marshal\Record\Builder;
use Aura\Marshal\MockRecordBuilder;
use Aura\Marshal\Proxy\Builder as ProxyBuilder;
use Aura\Marshal\Proxy\GenericProxy;

/**
 * Test class for Record.
 * Generated by PHPUnit on 2011-11-26 at 14:30:57.
 */
class RecordTest extends \PHPUnit_Framework_TestCase
{
    protected function getData()
    {
        return [
            'foo' => 'bar',
            'baz' => 'dim',
            'zim' => 'gir',
            'related' => new GenericProxy(new MockRelation),
        ];
    }
    
    protected function newGenericRecord()
    {
        $builder = new Builder;
        return $builder->newInstance($this->getData());
    }
    
    protected function newMockRecord()
    {
        $builder = new MockRecordBuilder;
        return $builder->newInstance($this->getData());
    }
    
    public function testMagicArrayAccess()
    {
        $record = $this->newGenericRecord();
        
        // check set/get
        $record->irk = 'doom';
        $this->assertSame('doom', $record->irk);
        
        // check isset/unset
        $this->assertTrue(isset($record->foo));
        unset($record->foo);
        $this->assertFalse(isset($record->foo));
        
        $this->assertFalse(isset($record->newfield));
        
        $record->newfield = 'something';
        $this->assertTrue(isset($record->newfield));
        
        unset($record->newfield);
        $this->assertFalse(isset($record->newfield));
        
        // check relateds
        $actual = $record->related;
        $expect = (object) ['foreign_field' => 'foreign_value'];
        $this->assertEquals($expect, $actual);
    }
    
    public function testMagicPropertyAccess()
    {
        $record = $this->newMockRecord();
        
        // check set/get
        $record->irk = 'doom';
        $this->assertSame('doom', $record->irk);
        
        // check isset/unset
        $this->assertTrue(isset($record->foo));
        unset($record->foo);
        $this->assertFalse(isset($record->foo));
        
        $this->assertFalse(isset($record->newfield));
        
        $record->newfield = 'something';
        $this->assertTrue(isset($record->newfield));
        
        unset($record->newfield);
        $this->assertFalse(isset($record->newfield));
        
        // check relateds
        $actual = $record->related;
        $expect = (object) ['foreign_field' => 'foreign_value'];
        $this->assertEquals($expect, $actual);
    }
}
