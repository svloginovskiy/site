<?php

namespace app\Controllers;

use app\Models\Entry;
use app\Repositories\EntryRepository;
use app\Service\View;

class EntryController
{
    private $view;
    private $entryRepo;

    public function __construct(View $view, EntryRepository $entryRepo)
    {
        $this->view = $view;
        $this->entryRepo = $entryRepo;
    }

    public function showEntry(int $number)
    {
        $entry = $this->entryRepo->getEntryById($number);
        $text = $entry->getText();
        $vars = [
            ":num" => $number,
            ":text" => $text
        ];
        $this->view->renderWithVars('entry.php', $vars);
    }

}