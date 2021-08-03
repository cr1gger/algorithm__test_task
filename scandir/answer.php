<?php
$allow_extension = ['php', 'html', 'js']; # Не стал выносить в отдельный файл конфига, но могу если нужно

$args = getopt(
    '',
    [
        'path:'
    ]
);
if (empty($args['path'])) throw new Exception('Argument --path cannot be empty');
if (!is_dir($args['path'])) throw new Exception('Path is not dir');

function scanAll($path, $allow_extension = [], $postfix = '.pdf')
{
    $dir = opendir($path);
    while (($line = readdir($dir)) !== false) {
        $filename = $path . DIRECTORY_SEPARATOR . $line;
        if (is_dir($filename) && ($line !== '.' && $line !== '..')) {
            scanAll($filename, $allow_extension, $postfix);
        } else {
            if (!is_dir($filename)) {
                $fileInfo = pathinfo($filename);
                $ext = $fileInfo['extension'] ?? null;
                if (in_array($ext, $allow_extension))
                {
                    copy($filename, $filename.$postfix);
                }
            }
        }
    }
    closedir($dir);
}

scanAll($args['path'], $allow_extension);
