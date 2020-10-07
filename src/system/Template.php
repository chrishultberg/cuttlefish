<?php

namespace Cuttlefish;

// @link http://stackoverflow.com/questions/62617/whats-the-best-way-to-separate-php-code-and-html
class Template
{

    protected $args;
    protected $file;

    public function __construct($file, $args = array())
    {
        $this->file = $file;
        $this->args = $args;
    }

    public function __get($name)
    {
        return $this->args[ $name ];
    }
    public function render(): void
    {
        $path = BASE_DIR . trim(theme_path(), '/') . DIRECTORY_SEPARATOR . $this->file;
        require $path;
    }
}
