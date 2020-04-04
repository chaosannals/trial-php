<?php

function timing($symbol, $callback)
{
    $start = microtime(true);
    $result = $callback();
    $interval = number_format(microtime(true) - $start, 10);
    echo str_pad($symbol, 30) . "{$interval}s" . PHP_EOL;
    return $result;
}

function random_set($length, $min = 1, $max = 100000000)
{
    $result = [];
    while (true) {
        $k = random_int($min, $max);
        if (isset($result[$k])) {
            continue;
        }
        $result[$k] = null;
        if (count($result) >= $length) {
            break;
        }
    }
    return $result;
}

function save_data($path, $data)
{
    $text = serialize($data);
    file_put_contents($path, $text);
}

function load_data($path)
{
    $text = file_get_contents($path);
    return unserialize($text);
}

function snake_to_camel($source)
{
    return preg_replace_callback('/_([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

function snake_to_kebab($source)
{
    return str_replace('_', '-', $source);
}

function camel_to_snake($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '_' . strtolower($matches[1]);
    }, $source);
}

function camel_to_kebab($source)
{
    return preg_replace_callback('/([A-Z])/', function ($matches) {
        return '-' . strtolower($matches[1]);
    }, $source);
}

function kebab_to_snake($source)
{
    return str_replace('-', '_', $source);
}

function kebab_to_camel($source)
{
    return preg_replace_callback('/-([a-z])/', function ($matches) {
        return strtoupper($matches[1]);
    }, $source);
}

function in_winnt()
{
    return stripos(PHP_OS, 'win') !== false;
}

function get_phpinfo($what = INFO_ALL)
{
    ob_start();
    phpinfo($what);
    $info = ob_get_contents();
    ob_end_clean();
    return $info;
}

function get_phpini_path()
{
    $info = get_phpinfo(INFO_GENERAL);
    // 匹配命令行的信息。
    preg_match_all('/Configuration\s*File.+?=>\s*(.+?)[\r\n]/', $info, $matches);
    foreach ($matches[1] as $path) {
        if (stripos($path, 'php.ini') !== false) {
            return $path;
        }
    }
    return null;
}

/**
 * 确保缩放比例在限制的范围内。
 *
 * @param string $url
 * @param integer $minWidth
 * @param integer $minHeight
 * @param integer $maxWidth
 * @param integer $maxHeight
 * @return string 图片数据 png 格式
 */
function image_limit($url, $minWidth = 256, $minHeight = 256, $maxWidth = 1024, $maxHeight = 1024)
{
    $data = file_get_contents($url);
    $size = getimagesizefromstring($data);
    $width = $size[0];
    $height = $size[1];
    $tWidth = $width;
    $tHeight = $height;

    // 如果合格就直接输出。
    if (
        $width >= $minWidth &&
        $height >= $minHeight &&
        $width <= $maxWidth &&
        $height <= $maxHeight
    ) {
        return $data;
    }

    // 算出比例
    $rate = $width / $height;
    $minRate = $minWidth / $maxHeight;
    $maxRate = $maxWidth / $minHeight;

    $image = imagecreatefromstring($data);
    if ($rate < $minRate or $rate > $maxRate) {
        // 如果宽高比不在可缩放范围内则居中缩放到最大并填充。
        $im = imagecreatetruecolor($maxWidth, $maxHeight);
        imagealphablending($im, false);
        imagesavealpha($im, true);
        $bg = imagecolorallocatealpha($im, 255, 255, 255, 0);
        imagefill($im, 0, 0, $bg);
        imagecolortransparent($im, $bg);
        $tWidth = $maxWidth;
        $tHeight = $tWidth / $rate;
        if ($tHeight >= $maxHeight) {
            $tHeight = $maxHeight;
            $tWidth = $tHeight * $rate;
        }
        $x = ($maxWidth - $tWidth) / 2;
        $y = ($maxHeight - $tHeight) / 2;
        imagecopyresampled($im, $image, $x, $y, 0, 0, $tWidth, $tHeight, $width, $height);
    } else {
        // 在可等比缩放的比例下等比缩放到最大
        if ($width >= $maxWidth and $height <= $maxHeight) {
            $tWidth = $maxWidth;
            $tHeight = $tWidth / $rate;
        } elseif ($width <= $minWidth and $height >= $minHeight) {
            $tWidth = $minWidth;
            $tHeight = $tWidth / $rate;
        } elseif ($height >= $maxHeight and $width <= $maxWidth) {
            $tHeight = $maxHeight;
            $tWidth = $tHeight * $rate;
        } elseif ($height <= $minHeight and $width >= $minWidth) {
            $tHeight = $minHeight;
            $tWidth = $tHeight * $rate;
        } elseif ($width >= $maxWidth and $height >= $maxHeight) {
            $tWidth = $maxWidth;
            $tHeight = $tWidth / $rate;
            if ($tHeight >= $maxHeight) {
                $tHeight = $maxHeight;
                $tWidth = $tHeight * $rate;
            }
        } elseif ($width <= $minWidth and $height <= $minHeight) {
            $tWidth = $minWidth;
            $tHeight = $tWidth / $rate;
            if ($tHeight <= $minHeight) {
                $tHeight = $minHeight;
                $tWidth = $tHeight * $rate;
            }
        }
        $im = imagecreatetruecolor($tWidth, $tHeight);
        imagecopyresampled($im, $image, 0, 0, 0, 0, $tWidth, $tHeight, $width, $height);
    }

    $file = tmpfile();
    $path = stream_get_meta_data($file)['uri'];
    imagepng($im, $path);
    $result = file_get_contents($path);
    fclose($file);
    imagedestroy($im);
    return $result;
}
