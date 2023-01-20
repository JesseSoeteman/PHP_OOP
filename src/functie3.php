<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
setlocale(LC_ALL, 'nl_NL');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
?> <h1>Mag stemmen</h1>
    <form method="POST">
        <input type="text" name="leeftijd" placeholder="Leeftijd" />
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

$leeftijd; {
    $_leeftijd = new ValidateText("leeftijd", RequestType::POST);
    $fouten = array_merge($fouten, $_leeftijd->validate());
    $leeftijd = $_leeftijd->getValue();
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

function magStemmen($leeftijd): bool
{
    $result = false;
    if (is_numeric($leeftijd)) {
        $result = $leeftijd >= 18;
    }
    return $result;
}

?>

<p>De input is: <?php echo $leeftijd; ?></p>

<p>Mag stemmen: <?php echo magStemmen($leeftijd) ? "Ja" : "Nee"; ?></p>
<p>Functie Waarde: <?php echo var_dump(magStemmen($leeftijd)); ?></p>

<?php

?> 
<br />
17 
<?php
if (magStemmen(17)) {
    echo "Mag stemmen";
} else {
    echo "Mag niet stemmen";
}

?> 
<br />
18 
<?php
if (magStemmen(18)) {
    echo "Mag stemmen";
} else {
    echo "Mag niet stemmen";
}

?> 
<br />
19 
<?php
if (magStemmen(19)) {
    echo "Mag stemmen";
} else {
    echo "Mag niet stemmen";
}