<?php
/**
 * Copyright (c) vdeApps 2018
 */

namespace vdeApps\phpCore\ViewParam;

use vdeApps\phpCore\ChainedArray;

define('VP_DATA', 'data');
define('VP_DEBUG', 'debug');
define('VP_FILTERS', 'filters');
define('VP_INFO', 'info');
define('VP_LIST', 'list');
define('VP_MAILS', 'mails');
define('VP_RESPONSE', 'response');

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
     * retourne le tableau
     * @return array
     */
    public function __invoke()
    {
        return $this->toArray();
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
    public function addResponse($message, $status = 200)
    {
        return $this->addvp(VP_RESPONSE, 'status', $status)
                    ->addvp(VP_RESPONSE, 'message', $message);
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
    public function addvp($key, $name, $mixed = null)
    {
        if (is_array($name)) {
            $this->{$key} = $name;
        } else {
            $this->{$key}->{$name} = $mixed;
        }
        
        return $this;
    }
    
    /**
     * Retourne la recherche
     *
     * @param      $key
     * @param null $name
     *
     * @return ChainedArray|false|string
     */
    public function getvp($key, $name = null)
    {
        $data = $this->get($key);
        
        if (is_null($name)) {
            return $data;
        } else {
            return $data->get($name);
        }
    }
}
