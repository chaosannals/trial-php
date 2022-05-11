<?php
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
