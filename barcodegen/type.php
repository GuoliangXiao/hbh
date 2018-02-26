<?php
$dir = './class/';
$files = array();
if(@$handle = opendir($dir)) {
    while(($file = readdir($handle)) !== false) {
        if($file != ".." && $file != ".") {
            if(is_dir($dir."/".$file)) {
            } else {
                $files[] = $file;
            }

        }
    }
    closedir($handle);
}

$class=array();
foreach ($files as $key => $value) {
	if(substr($value, -12)=='.barcode.php'){
		$class[]=substr($value, 0, strlen($value)-12);
	}
}
//var_dump($class);
echo json_encode($class);