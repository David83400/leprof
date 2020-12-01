<?php

namespace LeProf\Models\Frontend;

use LeProf\Models\Model;

class MembersModel extends Model
{
    protected $id;
    protected $lastName;
    protected $firstName;
    protected $nationality;
    protected $pass;
    protected $isAdmin;
    protected $inscriptionDate;

    public function __construct()
    {
        $this->table = 'members';
    }

    /**
     * Get the value of id
     *
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param [int] $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return void
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param [string] $lastName
     * @return self
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get the value of firstName
     *
     * @return void
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param [string] $firstName
     * @return self
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get the value of nationality
     *
     * @return void
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * Set the value of nationality
     *
     * @param [string] $nationality
     * @return self
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
        return $this;
    }

    /**
     * Get the value of pass
     *
     * @return void
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @param [string] $pass
     * @return self
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
        return $this;
    }

    /**
     * Get the value of isAdmin
     *
     * @return void
     */
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @param [boolean] $isAdmin
     * @return self
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
        return $this;
    }

    /**
     * Get the value of inscriptionDate
     *
     * @return void
     */
    public function getInscriptionDate()
    {
        return $this->inscriptionDate;
    }

    /**
     * Set the value of inscriptionDate
     *
     * @param [datetime] $inscriptionDate
     * @return self
     */
    public function setInscriptionDate($inscriptionDate)
    {
        $this->inscriptionDate = $inscriptionDate;
        return $this;
    }
}