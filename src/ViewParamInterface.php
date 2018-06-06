<?php
/**
 * Copyright (c) vdeApps 2018
 */

namespace vdeApps\phpCore\ViewParam;

interface ViewParamInterface
{
    
    /**
     * retourne le résultat dans un tableau
     * @return array
     */
    public function __invoke();
    
    /**
     * Retourne une nouvelle instance
     *
     * @param array $data
     *
     * @return ViewParam
     */
    public static function getInstance($data = []);
    
    /**
     * @param          $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addInfogene($name, $mixed);
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getInfoGene($name = null);
    
    /**
     * @param          $name
     * @param awcArray $filter
     *
     * @return $this
     */
    public function addFilter($name, $filter);
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getFilter($name = null);
    
    /**
     * @param          $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addList($name, $mixed);
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getList($name = null);
    
    /**
     * @param          $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addData($name, $mixed);
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getData($name = null);
    
    /**
     * @param $key
     * @param $name
     * @param $mixed
     *
     * @return $this
     */
    public function addOther($key, $name, $mixed);
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getOther($key, $name = null);
    
    /**
     * Return array result
     * @return array
     */
    public function getAData();
}
