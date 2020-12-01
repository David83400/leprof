<?php

namespace LeProf\Models;

use LeProf\Core\Manager;

abstract class Model extends Manager
{
    // Table de la base de données
    protected $table;

    public function findAll()
    {
         $sql = $this->executeRequest('SELECT * FROM '. $this->table);
         return $sql->fetchAll();
    }

    // On crée un tableau pour faire une recherche avec des critères
    public function findBy(array $params)
    {
        // On éclate le tableau en 2 tableaux champs => valeurs
        // 1 qui contient les champs, l'autre les valeurs
        $ranges = [];
        $values = [];

        // On boucle pour éclater le tableau
        foreach($params as $range => $value){
            // On crée d'abord le paramètre
            $ranges[] = "$range = ?";
            $values[] = $value;
        }
        
        // On transforme le tableau champs en une chaine de caractères
        $rangesList = implode(' AND ', $ranges);
        
        // On execute la requète
        $sql = $this->executeRequest('SELECT * FROM '.$this->table.' WHERE '. $rangesList, $values)->fetchAll();
        return $sql;
    }
    
    public function find(int $id)
    {
        $sql = $this->executeRequest("SELECT * FROM $this->table WHERE id = $id")->fetch();
        return $sql;
    }

    public function create(Model $model)
    {
        // On éclate le tableau en 3 tableaux champs => valeurs
        // 1 qui contient les champs, l'autre les valeurs, l'autre les points d'interrogation
        $ranges = [];
        $attributes = [];
        $values = [];

        // On boucle pour éclater le tableau
        foreach($model as $range => $value){
            // On crée d'abord le paramètre
            if($value !== null && $range != 'db' && $range != 'table'){
                $ranges[] = $range;
                $attributes[] = "?";
                $values[] = $value;
            } 
        }
        
        // On transforme le tableau ranges en une chaine de caractères
        $rangesList = implode(', ', $ranges);
        $attributesList = implode(', ', $attributes);

        // On execute la requète
        $sql = $this->executeRequest('INSERT INTO '.$this->table.' ('. $rangesList.')VALUES('.$attributesList.')', $values);
        return $sql; 
    }

    public function update(int $id, Model $model)
    {
        // On éclate le tableau en 3 tableaux champs => valeurs
        // 1 qui contient les champs, l'autre les valeurs, l'autre les points d'interrogation
        $ranges = [];
        $values = [];

        // On boucle pour éclater le tableau
        foreach($model as $range => $value){
            // On crée d'abord le paramètre
            if($value !== null && $range != 'db' && $range != 'table'){
                $ranges[] = "$range = ?";
                $values[] = $value;
            }
        }
        $values[] = $id;
        // On transforme le tableau ranges en une chaine de caractères
        $rangesList = implode(', ', $ranges);

        // On execute la requète
        $sql = $this->executeRequest('UPDATE '.$this->table.' SET '. $rangesList.'WHERE id = ?', $values);
        return $sql; 
    }

    public function delete(int $id)
    {
        $sql = $this->executeRequest('DELETE FROM '.$this->table.' WHERE id = ? ', [$id]);
        return $sql;
    }

    public function hydrate(array $data)
    {
        foreach($data as $key => $value){
            // On récupère le nom du setter correspondant à la key
            // => ex : titre => setTitre
            $setter = 'set'.ucfirst($key);

            // On vérifie que le setter existe
            if(method_exists($this, $setter)){
                // On appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }


}