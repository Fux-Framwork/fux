<?php

/**
 * Return the absolute asset URL.
 *
 * @param string $asset The asset path relative to the "/public" directory (or package's "/Assets" directory)
 * @param string | null $package If it is a string, it represents the name of the Package folder. In the package folder must
 * exists an "Assets" folder that will be used as base dir to search for the specified asset
 */
function asset($asset, $package = null)
{
    if (substr($asset, 0, 1) === "/") {
        $asset = substr($asset, 1);
    }
    if ($package) {
        return PROJECT_HTTP_SCHEMA . "://" . DOMAIN_NAME . PROJECT_DIR . "/app/Packages/$package/Assets/" . $asset;
    }
    return PROJECT_HTTP_SCHEMA . "://" . DOMAIN_NAME . PROJECT_DIR . "/public/" . $asset;
}


$__FUX_INCLUDED_ASSETS = [];
function assetOnce($asset, $type)
{
    global $__FUX_INCLUDED_ASSETS;
    if (!isset($__FUX_INCLUDED_ASSETS[$asset . '_' . $type])) {
        $assetURL = asset($asset);
        $__FUX_INCLUDED_ASSETS[$asset . '_' . $type] = true;
        switch ($type) {
            case 'script':
                return "<script src='$assetURL'></script>";
                break;
            case 'CSS':
                return "<link rel='stylesheet' type='text/css' href='$assetURL'>";
                break;
            case 'dynamicCSS':
                return "
                    <script>
                        (function(){
                            var file = document.createElement('link');
                            file.setAttribute('rel', 'stylesheet');
                            file.setAttribute('type', 'text/css');
                            file.setAttribute('href', '$assetURL');
                            document.head.appendChild(file);
                        })();
                    </script>
                ";
                break;
        }
    }
    return '';
}

$__FUX_INCLUDED_EXTERNAL_ASSETS = [];
function assetExternalOnce($assetURL, $type)
{
    global $__FUX_INCLUDED_EXTERNAL_ASSETS;
    if (!isset($__FUX_INCLUDED_EXTERNAL_ASSETS[$assetURL . '_' . $type])) {
        switch ($type) {
            case 'script':
                return "<script src='$assetURL'></script>";
                break;
            case 'CSS':
                return "<link rel='stylesheet' type='text/css' href='$assetURL'>";
                break;
        }
        $__FUX_INCLUDED_EXTERNAL_ASSETS[$assetURL . '_' . $type] = true;
    }
    return '';
}

/**
 * @param string $css language=CSS
 */
function addCssToHead($css)
{
    $css = str_replace("\n", "", $css);
    $css = str_replace("'", "\\'", $css);
    return "
        <script>
            (function(){
                var head = document.head || document.getElementsByTagName('head')[0];
                var style = document.createElement('style');
                head.appendChild(style);
                style.appendChild(document.createTextNode('$css'));
            })();
        </script>
    ";
}