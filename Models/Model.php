<?php

namespace LeProf\Models;

use LeProf\Core\Manager;

abstract class Model extends Manager
{
    // Table of the database
    protected $table;

    /**
     * Select all
     *
     * @return void
     */
    public function findAll()
    {
         $sql = $this->executeRequest('SELECT * FROM '. $this->table);
         return $sql->fetchAll();
    }

    /**
     * Select by $params
     *
     * @param array $params
     * @return void
     */
    public function findBy(array $params)
    {
        // We explode the array into 2 arrays ranges => values
        // One contains ranges, the other values
        $ranges = [];
        $values = [];

        // We loop to explode the table
        foreach($params as $range => $value){
            // We create first the parameter
            $ranges[] = "$range = ?";
            $values[] = $value;
        }
        
        // We transform the ranges array into a string
        $rangesList = implode(' AND ', $ranges);
        
        // We execute request
        $sql = $this->executeRequest('SELECT * FROM '.$this->table.' WHERE '. $rangesList, $values)->fetch();
        return $sql;
    }

    /**
     * Select on many tables
     *
     * @param array $tables
     * @param array $params
     * @return void
     */
    public function findOnManyTables(array $tables, array $params, array $conditions)
    {
        foreach($tables as $table){
            $tablesList = implode(', ', $tables);
        }

        // We explode the array $params into 2 arrays ranges => values
        // One contains ranges, the other values
        $ranges = [];
        $values = [];
        
        // We loop to explode the table
        foreach($params as $range => $value){
            $value = '\''.$value.'\'';
            $ranges[] = "$range = $value";
        }
        
        foreach($conditions as $range => $value){
            $ranges[] = "$range = $value";
        }
        
        // We transform the ranges array into a string
        $rangesList = implode(' AND ', $ranges);
        
        // We execute request
        $sql = $this->executeRequest('SELECT * FROM '.$tablesList.' WHERE '.$rangesList)->fetch();
        return $sql;
    }

    /**
     * Select by $id
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        $sql = $this->executeRequest("SELECT * FROM $this->table WHERE id = $id")->fetch();
        return $sql;
    }

    /**
     * Create in the database
     *
     * @return void
     */
    public function create()
    {
        // We explode the array into 3 arrays ranges => values
        // 1 contain ranges, the other values, the other question marks
        $ranges = [];
        $attributes = [];
        $values = [];

        // We loop to explode the table
        foreach($this as $range => $value){
            // We create first the parameter
            if($value !== null && $range != 'db' && $range != 'table'){
                $ranges[] = $range;
                $attributes[] = "?";
                $values[] = $value;
            } 
        }
        
        // We transform the ranges array into a string
        $rangesList = implode(', ', $ranges);
        $attributesList = implode(', ', $attributes);

        // We execute request
        $sql = $this->executeRequest('INSERT INTO '.$this->table.' ('. $rangesList.')VALUES('.$attributesList.')', $values);
        return $sql; 
    }

    /**
     * Update a line in the database
     *
     * @return void
     */
    public function update()
    {
        // We explode the array into 3 arrays ranges => values
        // 1 contain ranges, the other values, the other question marks
        $ranges = [];
        $values = [];

        // We loop to explode the table
        foreach($this as $range => $value){
            // We create first the parameter
            if($value !== null && $range != 'db' && $range != 'table'){
                $ranges[] = "$range = ?";
                $values[] = $value;
            }
        }
        $values[] = $this->id;
        // We transform the ranges array into a string
        $rangesList = implode(', ', $ranges);

        // We execute request
        $sql = $this->executeRequest('UPDATE '.$this->table.' SET '. $rangesList.'WHERE id = ?', $values);
        return $sql; 
    }

    /**
     * Delete a line in the database
     *
     * @param integer $id
     * @return void
     */
    public function delete(int $id)
    {
        $sql = $this->executeRequest('DELETE FROM '.$this->table.' WHERE id = ? ', [$id]);
        return $sql;
    }

    /**
     * Hydrate method
     *
     * @param [mixed] $data
     * @return void
     */
    public function hydrate($data)
    {
        foreach($data as $key => $value){
            // We get the name of the setter corresponding to the key
            // => ex : titre => setTitre
            $setter = 'set'.ucfirst($key);

            // We verify that the setter exists
            if(method_exists($this, $setter)){
                // We call the setter
                $this->$setter($value);
            }
        }
        return $this;
    }
}