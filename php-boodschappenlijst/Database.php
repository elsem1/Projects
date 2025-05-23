<?php



// Maak verbinding met de database en voert een query uit.
class Database
{

    public $connection;
    public $statement;
    public function __construct($config, $username = 'root', $password = 'root')
    {

        $dsn = "mysql:" . http_build_query($config, '', ';');

        try {
            $this->connection = new PDO($dsn, $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            // Toon de foutmelding en stop het script
            exit("Database connection failed: " . $e->getMessage());
        }
    }
    public function query($query, $params = [])
    {

        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }

    public function get()
    { // Generieke functie die gekopieerd en aangepast kan worden voor allerlei dingen
        return $this->statement->fetchAll();
    }
}
