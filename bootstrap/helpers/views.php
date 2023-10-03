<?php

use Fux\View\FuxViewComposerManager;

/**
 * Dinamically incldue a view file. The passed view data will be declared variables in the view context.
 *
 * @param string $viewName The path of the view file (with or without php extension, without le starting "/")
 * @param array $viewData An associative array of variables to use in the view context. Each key will be the variable
 * name associated to the value passed.
 * @param string | null $package If it is a string, it represents the name of the Package folder. In the package folder must
 * exists a "Views" folder that will be used as base dir to search for the viewName
 *
 * @return string
 */
function view($viewName, $viewData = [], $package = null)
{
    if (!preg_match("/(.*)\.php/", $viewName)) $viewName .= ".php";

    foreach ($viewData as $varName => $value) {
        ${$varName} = $value;
    }

    if ($package) {
        include(PROJECT_ROOT_DIR . "/app/Packages/$package/Views/$viewName");
    } else {
        include(PROJECT_ROOT_DIR . "/views/$viewName");
    }

    return "";
}

function viewCompose($viewAlias, $ovverideData = [], $params = [])
{
    $fuxView = FuxViewComposerManager::getView($viewAlias);
    if ($fuxView) {
        return view(
            $fuxView->getPath(),
            array_merge($fuxView->getData($params), $ovverideData),
            $fuxView->getPackage()
        );
    }
    return '';
}