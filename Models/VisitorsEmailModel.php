<?php

namespace LeProf\Models;

use LeProf\Models\Model;

class VisitorsEmailModel extends Model
{
    protected $id;
    protected $email;
    protected $visitorId;

    public function __construct()
    {
        $this->table = 'visitorsEmail';
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
     * Get the value of email
     *
     * @return void
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param [string] $email
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of visitorId
     *
     * @return void
     */
    public function getVisitorId()
    {
        return $this->visitorId;
    }

    /**
     * Set the value of visitorId
     *
     * @param [int] $visitorId
     * @return self
     */
    public function setVisitorId($visitorId)
    {
        $this->visitorId = $visitorId;
        return $this;
    }
}