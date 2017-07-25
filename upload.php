<?php
/*Copyright (C) 2017  James Taylor (jmztaylor)

This library is free software; you can redistribute it and/or
modify it under the terms of the GNU Lesser General Public
License as published by the Free Software Foundation; either
version 2.1 of the License, or (at your option) any later version.

This library is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public
License along with this library; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA */

function randomString($length)
{
  $key  = '';
  $keys = array_merge(range(0, 9), range('a', 'z'));
  
  for ($i = 0; $i < $length; $i++) {
    $key .= $keys[array_rand($keys)];
  }
  
  return $key;
}

function compressImage($src, $dest)
{
  $info = getimagesize($src);
  
  if ($info['mime'] == 'image/jpeg') {
    $image = imagecreatefromjpeg($src);
    imagejpeg($image, $dest, 60);
    imagedestroy($image);
  } elseif ($info['mime'] == 'image/png') {
    $image = imagecreatefrompng($src);
    imagepng($image, $dest, 7);
    imagedestroy($image);
  } else {
    die('Unknown image file format');
  }
}
function scaleImage($x, $y, $cx, $cy)
{
  list($nx, $ny) = array(
    $x,
    $y
  );
  if ($x >= $cx || $y >= $cx) {
    if ($x > 0)
      $rx = $cx / $x;
    if ($y > 0)
      $ry = $cy / $y;
    if ($rx > $ry) {
      $r = $ry;
    } else {
      $r = $rx;
    }
    $nx = intval($x * $r);
    $ny = intval($y * $r);
  }
  return array(
    $nx,
    $ny
  );
}
function storeImages($username, $files)
{
  require('config.php');
  if (!file_exists($imgFolder)) {
    mkdir($imgFolder, 0777, true);
  }
  $json = array(
    $username => array()
  );
  foreach ($files as $item) {
    if ($item['name'] != '') {
      $info         = pathinfo($item["name"]);
      $ext          = $info['extension'];
      $no_extension = basename($item["name"], '.' . $ext);
      $randString   = randomString(10);
      $thumb_target = $imgFolder . $randString . '_thumb.' . $ext;
      $target       = $imgFolder . $randString . '.' . $ext;
      $source       = $item["tmp_name"];
      
      $thumb = new Imagick($source);
      list($newX, $newY) = scaleImage($thumb->getImageWidth(), $thumb->getImageHeight(), 800, 800);
      $thumb->thumbnailImage($newX, $newY);
      $thumb->writeImage($thumb_target);
      $thumb->clear();
      compressImage($source, $target);
      
      $json[$username][] = array(
        'url' => $siteLink . $target,
        'thumb' => $siteLink . $thumb_target
      );
    }
  }
  return $json;
}
?>
