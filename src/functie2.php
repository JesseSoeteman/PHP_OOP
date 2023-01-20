<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_ALL, 'nl_NL');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
?>
    <h1>Datum</h1>
    <form method="POST">
        <input type="text" name="datum" placeholder="Datum" />
        <input type="submit" value="Verzenden" />
    </form>
<?php
    exit();
}

// Require the autoloader
require 'vendor/autoload.php';

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Prebuilt\ValidateText;

$fouten = array();

$datum_input; {
    $_datum_input = new ValidateText("datum", RequestType::POST);
    $fouten = array_merge($fouten, $_datum_input->validate());
    $datum_input = $_datum_input->getValue();
}

if (count($fouten) > 0) {
?>
    <h1>Er zijn fouten opgetreden</h1>
    <ul>
        <?php
        foreach ($fouten as $fout) {
            echo "<li>" . $fout . "</li>";
        }
        ?>
    </ul>
<?php
    exit();
}

function nlDatum($datum_string, $kort_jaar = false): string
{
    // Dit werkt niet op de server - maar zou het wel moeten doen 
    $datum = DateTime::createFromFormat('Y-m-d', $datum_string);
    if ($datum === false) {
        return $datum_string;
    }

    $datum_string = $datum->format("j F Y");
    if ($kort_jaar) {
        $datum_string = $datum->format("j F 'y");
    }

    return $datum_string;
}

?>

<p>De input is: <?php echo $datum_input; ?></p>

<p>De vertaling werkt niet, omdat de juiste taal niet is geinstalleerd</p>

<p>De datum is: <?php echo nlDatum($datum_input); ?></p>

<p>De datum verkort is: <?php echo nlDatum($datum_input, true); ?></p>
