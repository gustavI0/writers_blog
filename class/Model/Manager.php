<?php
namespace Blog\Model;

use \PDO;

abstract class Manager {

    const USERNAME = 'root';
    const PASSWORD = 'root';
    const HOST = 'localhost';
    const DB = 'blog';
    const TABLE_NAME = 'undefined';
	
    /**
     * Fonction de connexion à la bdd via PDO
     * @return obj PDO
     */
    protected function dbConnect() 
    {
        $db_user = self::USERNAME;
        $db_pwd = self::PASSWORD;
        $db_host = self::HOST;
        $db_name = self::DB;

        $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $db;
    }

    /**
     * Fonction de sélection de tous les champs d'une table
     * @return string Query
     */
    protected function findAll()
    {
        return 'SELECT * FROM ' . static::TABLE_NAME . ' ORDER BY creation_date DESC';
    }

    /**
     * Fonction de sélection de certains items d'une table
     * @param  string $column Intitulé de la colonne
     * @param  int $id     ID de l'item à trouver
     * @return string         Query
     */
    protected function find($column, $id, $order = null)
    {
        return 'SELECT * FROM ' . static::TABLE_NAME . ' WHERE ' . $column . ' = ' . $id . $order . '';
    }

    /**
     * Fonction de création d'un commentaire dans la bdd
     * @return string Query
     */
    protected function create($columns, $binded)
    {
        return 'INSERT INTO ' . static::TABLE_NAME . '(' . $columns . ') 
            VALUES(' . $binded . ')';
    }

    /**
     * Fonction d'effacement d'un item dans la bdd
     * @param  int $id Id de l'item à effacer
     * @return string     Query
     */
    protected function delete($id)
    {
        return 'DELETE FROM ' . static::TABLE_NAME . ' WHERE id = ' . $id . '';
    }

    /**
     * Fonction de mise à jour d'un billet
     * @return string Query
     */
    protected function update($binded, $column)
    {
        return 'UPDATE ' . static::TABLE_NAME . ' SET ' . $binded . ' WHERE ' . $column . '';
    }

}