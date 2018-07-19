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
    
    
    public function addvp($key, $name, $mixed = null);
    
    /**
     * Retourne la recherche
     *
     * @param      $key
     * @param null $name
     *
     * @return ChainedArray|false|string
     */
    public function getvp($key, $name = null);
}
