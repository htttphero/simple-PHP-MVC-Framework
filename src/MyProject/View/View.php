<?php

namespace MyProject\View;

class View
{
    private $templatesPath;
    private $extraVars = [];

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    public function setVar(string $name, $value)
    {
        $this->extraVars[$name] = $value;
    }

    public function renderHtml(string $templateName, array $vars = [],  int $code = 200)
    {
        http_response_code($code);
        // Функция extract извлекает массив в переменные. То есть она делает следующее: в неё передаётся массив [‘key1’ => 1, ‘key2’ => 2], а после её вызова у нас имеются переменные $key1 = 1 и $key2 = 2.
        extract($this->extraVars);
        extract($vars);
        
        //Буфер вывода.  профит в том, что мы можем обрабатывать ошибки, возникшие в процессе работы с шаблоном.
        ob_start();
        include $this->templatesPath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();
    
        echo $buffer;
    }
}