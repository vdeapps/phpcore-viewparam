<?php
/**
 * Copyright (c) vdeApps 2018
 */

namespace vdeApps\phpCore\ViewParam;

use vdeApps\phpCore\ChainedArray;

class ViewParam extends ChainedArray implements ViewParamInterface
{
    /*
     * 'infogene' => [],    //Info général sur la page
                'filters'  => [], //Liste des filtres dispo
                'list'     => [      // Gestion des listes
                                     'entreprise' => [],
                                     'communes'   => [],
                                     'pays'       => [],
                ],
                'data'     => [   // Les données
                                  'rowsEntreprises' => [],
                                  'rowsAgences'     => [],
                                  'people'          => $rows,
                ],
     */
    
    
    /**
     * Retourne une nouvelle instance
     *
     * @param array $data
     *
     * @return ViewParam
     */
    public static function getInstance($data = [])
    {
        $classname = __CLASS__;
        
        return new $classname($data);
    }
    
    /**
     * @param     $message
     * @param int $status
     *
     * @return $this
     * @internal param $name
     * @internal param awcArray $mixed
     *
     */
    public function addResponse($message, $status = STATUS_POST_OK)
    {
        return $this->addTo('response', 'statut', $status)
                    ->addTo('response', 'message', $message);
    }
    
    /**
     * Ajout dans la liste
     *
     * @param           $key
     * @param     mixed $name si string=>valeur=$mixed, si Array valeur=$name
     * @param null      $mixed
     *
     * @return $this
     */
    protected function addTo($key, $name, $mixed = null)
    {
        if (is_array($name)) {
            $this->aData[$key] = $name;
        } else {
            $this->aData[$key][$name] = $mixed;
        }
        
        return $this;
    }
    
    /**
     * retourne le tableau
     * @return array
     */
    public function __invoke()
    {
        return $this->getAData();
    }
    
    /**
     * @param string   $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addInfogene($name, $mixed = null)
    {
        return $this->addTo('infogene', $name, $mixed);
    }
    
    /**
     * @param string   $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addFilter($name, $mixed = null)
    {
        return $this->addTo('filters', $name, $mixed);
    }
    
    /**
     * @param string   $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addList($name, $mixed = null)
    {
        return $this->addTo('list', $name, $mixed);
    }
    
    /**
     * @param string   $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addData($name, $mixed = null)
    {
        return $this->addTo('data', $name, $mixed);
    }
    
    /**
     * @param string   $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addMails($name, $mixed = null)
    {
        return $this->addTo('emails', $name, $mixed);
    }
    
    /**
     * @param string   $name
     * @param awcArray $mixed
     *
     * @return $this
     */
    public function addDebug($name, $mixed = null)
    {
        return $this->addTo('debug', $name, $mixed);
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getDebug($name = null)
    {
        return $this->getFrom('debug', $name);
    }
    
    /**
     * Retourne la recherche
     *
     * @param      $key
     * @param null $name
     *
     * @return \App\Webcore\awcArray|false|string
     */
    protected function getFrom($key, $name = null)
    {
        $data = $this->get($key);
        
        if (is_null($name)) {
            return $data;
        } else {
            return $data->get($name);
        }
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getMails($name = null)
    {
        return $this->getFrom('emails', $name);
    }
    
    /**
     * @param $key
     * @param $name
     * @param $mixed
     *
     * @return $this
     */
    public function addOther($key, $name, $mixed = null)
    {
        return $this->addTo($key, $name, $mixed);
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getInfoGene($name = null)
    {
        return $this->getFrom('infogene', $name);
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getFilter($name = null)
    {
        return $this->getFrom('filters', $name);
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getList($name = null)
    {
        return $this->getFrom('list', $name);
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getData($name = null)
    {
        return $this->getFrom('data', $name);
    }
    
    /**
     * @param $name
     *
     * @return mixed
     */
    public function getOther($key, $name = null)
    {
        return $this->getFrom($key, $name);
    }
}
