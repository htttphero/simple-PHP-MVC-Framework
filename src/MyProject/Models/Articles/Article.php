<?php

namespace MyProject\Models\Articles;

use MyProject\Models\ActiveRecordEntity;
use MyProject\Models\Users\User;
class Article extends ActiveRecordEntity
{
 
    protected $name;

 
    protected $text;

 
    protected $authorId;

 
    protected $createdAt;

    
    public function __set($name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

  
    public function getId(): int
    {
        return $this->id;
    }

    
    public function getName(): string
    {
        return $this->name;
    }

 
    public function getText(): string
    {
        return $this->text;
    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }
}