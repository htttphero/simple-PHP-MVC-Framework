<?php

namespace MyProject\Services;

class Db
{
  /** @var \PDO */
  private $pdo;

  public function __construct()
  {
      $dbOptions = (require __DIR__ . '/../../settings.php')['db'];

      $this->pdo = new \PDO(
          'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
          $dbOptions['user'],
          $dbOptions['password']
      );
      $this->pdo->exec('SET NAMES UTF8');
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
}