<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$targ_w = $targ_h = 150;
	$jpeg_quality = 90;

	$src = './demos/demo_files/image5.jpg';

	$img_r = imagecreatefromjpeg($src);

	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );

	imagecopyresampled($dst_r,$img_r,0,0,intval($app['POST']['x']),intval($app['POST']['y']), $targ_w,$targ_h, intval($app['POST']['w']),intval($app['POST']['h']));

	header('Content-type: image/jpeg');
	imagejpeg($dst_r,null,$jpeg_quality);

	exit;
}
?>