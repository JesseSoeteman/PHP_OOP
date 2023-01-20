<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
?>
    <h1>Oppervlakte</h1>
    <form method="POST">
        <input type="number" name="lengte" placeholder="Lengte" />
        <input type="number" name="breedte" placeholder="Breedte" />
        <input type="submit" value="Bereken" />
    </form>

    <h1>Volume</h1>
    <form method="POST">
        <input type="text" name="lengte" placeholder="Lengte" />
        <input type="text" name="breedte" placeholder="Breedte" />
        <input type="text" name="hoogte" placeholder="Hoogte" />
        <input type="submit" value="Bereken" />
    </form>
<?php
    exit();
}

// Require the autoloader
require 'vendor/autoload.php';

use ValidateGetPostInput\Statics\RequestType;
use ValidateGetPostInput\Prebuilt\ValidateNumber;

$fouten = array();

$lengte; {
    $_lengte = new ValidateNumber("lengte", RequestType::POST);
    $fouten = array_merge($fouten, $_lengte->validate());
    $lengte = $_lengte->getValue();
}

$breedte; {
    $_breedte = new ValidateNumber("breedte", RequestType::POST);
    $fouten = array_merge($fouten, $_breedte->validate());
    $breedte = $_breedte->getValue();
}

$hoogte; {
    $_hoogte = new ValidateNumber("hoogte", RequestType::POST, false);
    $fouten = array_merge($fouten, $_hoogte->validate());
    $hoogte = $_hoogte->getValue();
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

if ($hoogte == 0) {
?><p>
        De lengte is
        <?= $lengte ?>
        en de breedte is
        <?= $breedte ?>
        dus is de oppervlakte
        <?= berekenKamer($lengte, $breedte) ?>
    </p><?php
    } else {
        ?><p>
        De lengte is
        <?= $lengte ?>
        , de breedte is
        <?= $breedte ?>
        en de hoogte is
        <?= $hoogte ?>
        dus is het volume
        <?= berekenKamer($lengte, $breedte, $hoogte) ?>
    </p><?php
    }

    function berekenKamer(int $lengte, int $breedte, int $hoogte = -1): int
    {
        $oppervlakte = $lengte * $breedte;
        if ($hoogte == -1) {
            return $oppervlakte;
        } else {
            return $oppervlakte * $hoogte;
        }
    }
        ?>

<p>10 x 10 = <?= berekenKamer(10, 10); ?></p>
<p>10 x 10 x 10 = <?= berekenKamer(10, 10, 10); ?></p>