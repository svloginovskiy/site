<?php

namespace app\Service;

class View
{
    private const RES_DIR = __DIR__ . '/../../resources/';
    private const TEMPLATE_SUFFIX = '_template.php';
    private const HTML_BASE = self::RES_DIR . 'html_base' . self::TEMPLATE_SUFFIX;
    public function __construct()
    {
    }

    public function render(string $VIEWNAME, array $vars = [])
    {

        $bodyTemplate = $VIEWNAME . self::TEMPLATE_SUFFIX;
        $VIEWBODY = file_get_contents(self::RES_DIR . $bodyTemplate);
        extract($vars);
        include self::HTML_BASE;
    }
}
