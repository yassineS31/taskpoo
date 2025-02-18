<?php

/**
 * @return PDO
 */

 class MySQLBDD implements interfaceBDD{
public function connexion():PDO{
    return  new PDO('mysql:host=localhost;port=3307;
    dbname=task', 'root', '123');

 }
 }