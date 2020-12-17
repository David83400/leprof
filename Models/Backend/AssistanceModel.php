<?php

namespace LeProf\Models\Backend;

use LeProf\Models\Model;

class AssistanceModel extends Model
{
    protected $id;
    protected $titleMessage;
    protected $message;
    protected $messageDate;
    protected $memberId;

    public function __construct()
    {
        $this->table = 'assistanceMessages';
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
     * Get the value of titleMessage
     *
     * @return void
     */
    public function getTitleMessage()
    {
        return $this->titleMessage;
    }

    /**
     * Set the value of titleMessage
     *
     * @param [string] $titleMessage
     * @return self
     */
    public function setTitleMessage($titleMessage)
    {
        $this->titleMessage = $titleMessage;
        return $this;
    }

    /**
     * Get the value of message
     *
     * @return void
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param [string] $message
     * @return self
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get the value of messageDate
     *
     * @return void
     */
    public function getMessageDate()
    {
        return $this->messageDate;
    }

    /**
     * Set the value of messageDate
     *
     * @param [date] $messageDate
     * @return self
     */
    public function setMessageDate($messageDate)
    {
        $this->messageDate = $messageDate;
        return $this;
    }

    /**
     * Get the value of memberId
     *
     * @return void
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * Set the value of memberId
     *
     * @param [int] $memberId
     * @return self
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;
        return $this;
    }
}