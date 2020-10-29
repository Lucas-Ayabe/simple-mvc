<?php
namespace Core;

class View
{
    private array $vars = [];
    private const FORBIDDEN_VAR = "viewTemplaFile";

    public function __get($name)
    {
        return $this->vars[$name];
    }

    public function __set($name, $value)
    {
        if ($name === self::FORBIDDEN_VAR) {
            throw new \Exception(
                "Cannot bind variable named '" . self::FORBIDDEN_VAR . "'"
            );
        }

        $this->vars[$name] = $value;
    }

    public function load(string $viewTemplateFile)
    {
        if (array_key_exists(self::FORBIDDEN_VAR, $this->vars)) {
            throw new \Exception(
                "Cannot bind variable named '" . self::FORBIDDEN_VAR . "'"
            );
        }

        extract($this->vars);
        ob_start();
        include __DIR__ . "/../App/Views/$viewTemplateFile";
        return ob_get_clean();
    }

    public function render(string $viewTemplateFile)
    {
        echo $this->load($viewTemplateFile);
    }
}
