<?php
	session_start();
	$h=100;
	$w=300;
	$i=imagecreatetruecolor($w,$h);
	$colors[0]=imagecolorallocate($i, 187, 187, 187);	//bg: grey
	$colors[1]=imagecolorallocate($i, 0, 0, 0);			//black
	$colors[3]=imagecolorallocate($i, 120, 50, 50);		//red
	$colors[4]=imagecolorallocate($i, 0, 0, 255);		//blue
	$colors[2]=imagecolorallocate($i, 128, 0, 255);		//violet
	$colori=imagecolorallocate($i, 150, 150, 150);
	$ccount=count($colors)-1;
	imagefilledrectangle($i, 0, 0, $w-1, $h-1, $colors[0]);

	$charset="23456789ABCDEFGHJKLMNPQRTUVWXY23456789";
	$font="./".mt_rand(1,12).".ttf";
	$fontsize=28;
	$size=mt_rand(5,8);

	$tw=imagettfbbox($fontsize, 0, $font, "C");

	$ty=($h+abs($tw[1]-$tw[7]))/2-5;
	$tw=abs($tw[2]-$tw[0]);
	$tx=($w-$tw*($size+1))/2;

	for($k=0;$k<50;++$k)
		imagettftext($i, 25, 0, mt_rand(0,$w), mt_rand(0,$h), $colori, $font, $charset[mt_rand(0,37)]);
	$res='';
	for($k=0; $k<$size; ++$k){
		$str=$charset[mt_rand(0,37)];
		imagettftext($i, $fontsize, mt_rand(-20,20), ($tx+$k*$tw), $ty, $colors[mt_rand(1,$ccount)], $font, $str);
		$res.=$str;
	}
	//imagefilter($i,IMG_FILTER_EDGEDETECT);
	$_SESSION['captcha']=$res;
	header('Content-type: image/png');
	imagepng($i);
	imagedestroy($i);
?>
