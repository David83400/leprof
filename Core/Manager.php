<?php

namespace LeProf\Core;

/**
  * Manage calls to db
  *
  * @author  David Roche <davidroche83400@gmail.com
  *
*/
abstract class Manager
{
    private $db;

    /**
     * Implements a prepared or query request
     *
     * @param [string] $sql
     * @param [mixed] $params
     * @return [mixed]
     */
    protected function executeRequest($sql, $params = null)
    {
        if ($params == null)
        {
            $result = $this->getDb()->query($sql);
        }
        else
        {
            $result = $this->getDb()->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }

    /**
     * Database connexion
     *
     * @return [mixed]
     */
    protected function getDb()
    {
        if ($this->db == null)
        {
            $this->db = new \PDO('mysql:host=localhost;dbname=leProf;charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
        }
        return $this->db;
    }
}