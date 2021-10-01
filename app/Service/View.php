<?php

namespace app\Service;

class View
{
    private const RES_DIR = __DIR__ . '/../../resources/';
    private const TEMPLATE_SUFFIX = '_template.php';
    private const HTML_BASE = self::RES_DIR . 'html_base' . self::TEMPLATE_SUFFIX;
    private const HTML_HEADER = self:: RES_DIR . 'html_header' . self::TEMPLATE_SUFFIX;
    public function __construct()
    {
    }

    public function render(string $VIEWNAME, array $vars = [])
    {
        $bodyTemplate = $VIEWNAME . self::TEMPLATE_SUFFIX;
        extract($vars);
        $VIEWBODY = self::RES_DIR . $bodyTemplate;
        $VIEWHEADER = self::HTML_HEADER;
        include self::HTML_BASE;
        foreach ($vars as &$var) {
            unset($var);
        }
    }

    public function renderReact()
    {
        include self::RES_DIR . 'build/index.php';
    }
}
