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
            $vp->addList($this->tb)
        );
    }
    
    public function testGet() {
        $vp = ViewParam::getInstance();
        $vp->addList('myList', $this->tb);
        $vp->addData('myData', $this->tb);
        $vp->addDebug('forDebug', $this->tb);
        $vp->addFilter('form', $this->tb);
        $vp->addInfogene('General', $this->tb);
        $vp->addMails('mailParams', $this->tb);
        $vp->addResponse('responseData', $this->tb);
        $vp->addOther('custom', 'tbTest', $this->tb);
        
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
            $vp->getList('myList')
        );
    
        $this->assertInternalType(
            'array',
            $vp->getAData()
        );
        
        // For create test case
//        echo $vp->toJson();
        $json = '{"list":{"myList":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"data":{"myData":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"debug":{"forDebug":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"filters":{"form":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"infogene":{"General":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"emails":{"mailParams":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}},"response":{"statut":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6},"message":"responseData"},"custom":{"tbTest":{"a":1,"b":2,"c":{"ca":31,"cb":32,"cc":33},"d":4,"e":5,"f":6}}}';
    
        $this->assertInternalType(
            'string',
            $vp->toJson()
        );
        
        $this->assertEquals($json, $vp->toJson());
    }
    
}