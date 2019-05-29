<?php

namespace MyProject\Services;



class Db
{
  /** @var \PDO */
  private $pdo;

  private static $instance;
  private  function __construct()
  {
      $dbOptions = (require __DIR__ . '/../../settings.php')['db'];
      try {
        $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new \MyProject\Exceptions\DbException('you failed this city: ' . $e->getMessage());
        }
  }

  public static function getInstance(): self 
{
    if (self::$instance === null) {
        self::$instance = new self();
    }

    return self::$instance;
}


//   Третьим аргументом в этот метод будет передаваться имя класса, объекты которого нужно создавать. По умолчанию это будут объекты класса stdClass – это такой встроенный класс в PHP, у которого нет никаких свойств и методов.
  public function query(string $sql, array $params = [], string $className = 'stdClass')
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }


    // чтобы получить id последней вставленной записи в базе
    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}