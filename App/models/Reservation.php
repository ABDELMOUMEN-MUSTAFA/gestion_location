<?php

class Reservation
{
    private $connect;

    public function __construct($database)
    {
        $this->connect = $database;
    }

}