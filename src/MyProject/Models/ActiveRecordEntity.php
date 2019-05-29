<?php

namespace MyProject\Models;

use MyProject\Services\Db;

abstract class ActiveRecordEntity
{

    // добавили protected-свойство ->id и public-геттер для него – у всех наших сущностей будет id, и нет необходимости писать это каждый раз в каждой сущности – можно просто унаследовать;
    protected $id;

   
    public function getId(): int
    {
        return $this->id;
    }

    // перенесли public-метод __set() – теперь все дочерние сущности будут его иметь
    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }
    
    // перенесли метод underscoreToCamelCase(), так как он используется внутри метода __set()
    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    // public-метод findAll() будет доступен во всех классах-наследниках
    
    //заменим третий параметр Article::class на  static::class это позднее статическое связывание
    //по этому код будет  зависеть от класса, в котором он вызывается, а не в котором он описан .

    //так же заменим второй параметр на полчение табилицы с помощью позжнего связывания.
    public static function findAll(): array
    {
        $db = Db::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }
    
    // бъявили абстрактный protected static метод getTableName(), который должен вернуть строку – имя таблицы. Так как метод абстрактный, то все сущности, которые будут наследоваться от этого класса, должны будут его реализовать. Благодаря этому мы не забудем его добавить в классах-наследниках.
    abstract protected static function getTableName(): string;


    // Этот метод вернёт либо один объект, если он найдётся в базе, либо null – что будет говорить об его отсутствии.
    public static function getById(int $id) 
    {
        $db = Db::getInstance();
        $entities = $db->query(
            'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
            [':id' => $id],
            static::class
        );
        return $entities ? $entities[0] : null;
    }

    // метод, который будет преобразовывать строки типа authorId в author_id. чтоб соответствовать структуре базы данных
    private function camelCaseToUnderscore(string $source): string
    {
    return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    // метод, который прочитает все свойства объекта и создаст асоциативный массив вида  
    // [
    //     'название_свойства1' => значение свойства1,
    //     'название_свойства2' => значение свойства2
    // ]
    private function mapPropertiesToDbFormat(): array
    {
    $reflector = new \ReflectionObject($this);
    $properties = $reflector->getProperties();

    $mappedProperties = [];
    foreach ($properties as $property) {
        $propertyName = $property->getName();
        $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
        $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
    }

    return $mappedProperties;
    }

    //  метод save() может быть вызван как у объекта, который уже есть в базе данных, так и у нового (если мы создали его с помощью new Article и заполнили ему свойства). Для первого нам нужно будет выполнить UPDATE-запрос, а для второго - INSERT-запрос. Если  у объекта, которому соответствует запись в базе, свойство id не равно null
    //  то выполняем update а иначе insert
    public function save() 
    {
    $mappedProperties = $this->mapPropertiesToDbFormat();
    var_dump($mappedProperties);
    }

}