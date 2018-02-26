<?php
// Including all required classes
require_once('class/BCGFontFile.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');

// Including the barcode technology
$type=isset($_GET['type']) ? $_GET['type'] : 'BCGcode39';
require_once('class/'.$type.'.barcode.php');

// Loading Font
$font = new BCGFontFile('./font/Arial.ttf', 18);

// Don't forget to sanitize user inputs
$text = isset($_GET['text']) ? $_GET['text'] : 'XGL';

// The arguments are R, G, B for color.
$black=isset($_GET['black']) ? $_GET['black'] :'000000';
$white=isset($_GET['white']) ? $_GET['white'] :'ffffff';
$color_black = new BCGColor(hexdec(substr($black, 0, 2)),hexdec(substr($black, 2, 2)), hexdec(substr($black, 4, 2)));
$color_white = new BCGColor(hexdec(substr($white, 0, 2)), hexdec(substr($white, 2, 2)), hexdec(substr($white, 4, 2)));
$scale=isset($_GET['scale']) ? $_GET['scale'] :2;
$thickness=isset($_GET['thickness']) ? $_GET['thickness'] :30;

$drawException = null;
try {
    $code = new $type();
    $code->setScale($scale); // Resolution
    $code->setThickness($thickness); // Thickness
    $code->setForegroundColor($color_black); // Color of bars
    $code->setBackgroundColor($color_white); // Color of spaces
    $code->setFont($font); // Font (or 0)
    $code->parse($text); // Text
} catch(Exception $exception) {
    $drawException = $exception;
}

/* Here is the list of the arguments
1 - Filename (empty : display on screen)
2 - Background color */
$drawing = new BCGDrawing('', $color_white);
if($drawException) {
    $drawing->drawException($drawException);
} else {
    $drawing->setBarcode($code);
    $drawing->draw();
}

// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');
header('Content-Disposition: inline; filename="barcode.png"');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>