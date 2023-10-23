<?php
namespace carry0987\Template;

class Utils
{
    public static function dashPath($path)
    {
        $path = ltrim($path, '/\\');
        $path = rtrim($path, '/\\');
        return str_replace(array('/', '\\', '//', '\\\\'), '::', $path);
    }

    public static function trimPath($path)
    {
        return str_replace(array('/', '\\', '//', '\\\\'), Template::DIR_SEP, $path);
    }

    public static function trimRelativePath($path)
    {
        $hash = substr_count($path, '../');
        $hash = ($hash !== 0) ? substr(md5($hash), 0, 6).'/' : '';
        $path = str_replace('../', '', $path);
        return $hash.$path;
    }

    public static function makePath($path)
    {
        $dirs = explode(Template::DIR_SEP, dirname(self::trimPath($path)));
        if (!is_writeable($dirs[0])) {
            return false;
        }
        $tmp = '';
        foreach ($dirs as $dir) {
            $tmp = $tmp.$dir.Template::DIR_SEP;
            if (!file_exists($tmp) && !mkdir($tmp, 0755, true)) {
                return $tmp;
            }
        }
        return true;
    }

    public static function generateRandom($length, $numeric = 0)
    {
        $seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
        $seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
        $hash = '';
        if (!$numeric) {
            $hash = chr(rand(1, 26) + rand(0, 1) * 32 + 64);
            $length--;
        }
        $max = strlen($seed) - 1;
        for ($i = 0; $i < $length; $i++) {
            $hash = $hash.$seed[mt_rand(0, $max)];
        }
        return $hash;
    }
}
