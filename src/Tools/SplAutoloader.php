<?php
namespace snicksnk\Tools;

class Autoloader{

    const NSPACE = 'snicksnk\MaitavrApi';
    const RELATIVE_FILE_PATH_PREFIX = '/../MaitavrApi/';

    function __invoke($className)
    {

        if (strpos($className, self::NSPACE)===0){

            $className = substr(ltrim($className, '\\'), strlen(self::NSPACE)+1);

            $filePathPrefix = __DIR__.self::RELATIVE_FILE_PATH_PREFIX;
            $fileName  = '';
            $namespace = '';
            if ($lastNsPos = strrpos($className, '\\')) {
                $namespace = substr($className, 0, $lastNsPos);
                $className = substr($className, $lastNsPos + 1);
                $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
            }
            $fileName = $filePathPrefix.$fileName.str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

            require $fileName;
        }
    }
}

return new Autoloader();