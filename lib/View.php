<?php

class View
{
    public function render($template, array $params = [])
    {
        ob_start();
        extract($params);
        require($template);

        return ob_get_clean();
    }
}
