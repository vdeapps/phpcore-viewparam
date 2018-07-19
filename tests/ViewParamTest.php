<?php
/**
 * Copyright (c) vdeApps 2018
 */

namespace vdeApps\phpCore\ViewParam;

use PHPUnit\Framework\TestCase;
use vdeApps\phpCore\Dictionary\Dictionary;

class ViewParamTest extends TestCase {
    
    protected $tb = [
        'a' => 1,
        'b' => 2,
        'c' => [
            'ca' => 31,
            'cb' => 32,
            'cc' => 33,
        ],
        'd' => 4,
        'e' => 5,
        'f' => 6,
    ];
    
    protected $dataString = 'Hello World';
    
    public function testConstruct() {
        
        $this->assertInstanceOf(
            ViewParamInterface::class,
            new ViewParam()
        );
        
        $this->assertInstanceOf(
            ViewParamInterface::class,
            ViewParam::getInstance()
        );
        
        $this->assertInstanceOf(
            ViewParamInterface::class,
            ViewParam::getInstance(['test'])
        );
        
        $vp = ViewParam::getInstance();
        $this->assertInstanceOf(
            ViewParamInterface::class,
            $vp->addvp(VP_LIST,$this->tb)
        );
    }
    
    public function testGet() {
        $vp = ViewParam::getInstance();
        $vp->addvp(VP_LIST, 'myList', $this->tb);
        $vp->addvp(VP_DATA, 'myData', $this->tb);
        $vp->addvp(VP_DEBUG, 'forDebug', $this->tb);
        $vp->addvp(VP_FILTERS, 'form', $this->tb);
        $vp->addvp(VP_INFO, 'General', $this->tb);
        $vp->addvp(VP_MAILS, 'mailParams', $this->tb);
        $vp->addvp(VP_RESPONSE, 'responseData', $this->tb);
        $vp->addvp('custom', 'tbTest', $this->tb);
    
        $vp->addvp(VP_DATA, 'dataString', $this->dataString);
        
        
        $this->assertInternalType(
            'array',
            $vp->toArray()
        );
        
        $this->assertArraySubset(
            [
                'list' => [
                    'myList' => [
                        'c' => [
                            'cb' => 32,
                        ],
                    ],
                ],
            ],
            $vp->toArray()
        );
    
        $this->assertArraySubset(
            [
                'custom' => [
                    'tbTest' => [
                        'c' => [
                            'cc' => 33,
                        ],
                    ],
                ],
            ],
            $vp->toArray()
        );
        
        
        $this->assertArraySubset(
            [
                    'c' => [
                        'cb' => 32,
                    ],
                ],
            $vp->getvp(VP_LIST, 'myList')->toArray()
        );
    
        $this->assertInternalType(
            'array',
            $vp->toArray()
        );
    
        $this->assertEquals($this->dataString, $vp->getvp(VP_DATA, 'dataString'));
        
        
        // For create test case
//        echo $vp->toJson();
        $json = '{"list":{"myList":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"data":{"myData":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6},"dataString":"Hello World"},"debug":{"forDebug":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"filters":{"form":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"info":{"General":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"mails":{"mailParams":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"response":{"responseData":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"custom":{"tbTest":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}}}';
        
        $this->assertInternalType(
            'string',
            $vp->toJson()
        );
        
        $this->assertEquals($json, $vp->toJson());
    }
    
}