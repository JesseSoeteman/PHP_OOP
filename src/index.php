<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Require the autoloader
require 'vendor/autoload.php';

header("Content-Type: application/json");

use APIReturn\APIReturn;

use ValidateGetPostInput\Statics\RequestType;

use ValidateGetPostInput\Prebuilt\ValidateBoolean;
use ValidateGetPostInput\Prebuilt\ValidateText;
use ValidateGetPostInput\Prebuilt\ValidateVarchar255;
use ValidateGetPostInput\Prebuilt\ValidateVarchar255Regex;
use ValidateGetPostInput\Prebuilt\ValidateNumber;
use ValidateGetPostInput\Prebuilt\ValidateFloat;
use ValidateGetPostInput\Prebuilt\ValidateID;
use ValidateGetPostInput\Prebuilt\ValidateEmail;
use ValidateGetPostInput\Prebuilt\ValidateDate;
use ValidateGetPostInput\Prebuilt\ValidateJSON;

$apiReturn = new APIReturn(post_request);

$boolean; {
    $_boolean = new ValidateBoolean("boolean", RequestType::POST);
    $apiReturn->addError($_boolean->validate());
    $boolean = $_boolean->getValue();
}

$text; {
    $_text = new ValidateText("text", RequestType::POST);
    $apiReturn->addError($_text->validate());
    $text = $_text->getValue();
}

$varchar255; {
    $_varchar255 = new ValidateVarchar255("varchar255", RequestType::POST);
    $apiReturn->addError($_varchar255->validate());
    $varchar255 = $_varchar255->getValue();
}

$varchar255Regex; {
    $_varchar255Regex = new ValidateVarchar255Regex("varchar255Regex", "/^[a-zA-Z0-9]+$/", RequestType::POST);
    $apiReturn->addError($_varchar255Regex->validate());
    $varchar255Regex = $_varchar255Regex->getValue();
}


$number; {
    $_number = new ValidateNumber("number", RequestType::POST);
    $apiReturn->addError($_number->validate());
    $number = $_number->getValue();
}

$float; {
    $_float = new ValidateFloat("float", RequestType::POST);
    $apiReturn->addError($_float->validate());
    $float = $_float->getValue();
}

$id; {
    $_id = new ValidateID("id", RequestType::POST);
    $apiReturn->addError($_id->validate());
    $id = $_id->getValue();
}

$email; {
    $_email = new ValidateEmail("email", RequestType::POST);
    $apiReturn->addError($_email->validate());
    $email = $_email->getValue();
}

$date; {
    $_date = new ValidateDate("date", RequestType::POST);
    $apiReturn->addError($_date->validate());
    $date = $_date->getValue();
}

$json; {
    $_json = new ValidateJSON("json", RequestType::POST);
    $apiReturn->addError($_json->validate());
    $json = $_json->getValue();
}


$apiReturn->APIExitOnError();


$apiReturn->addData([
    "boolean" => $boolean,
    "text" => $text,
    "varchar255" => $varchar255,
    "varchar255Regex" => $varchar255Regex,
    "number" => $number,
    "float" => $float,
    "id" => $id,
    "email" => $email,
    "date" => $date,
    "json" => $json
]);

$apiReturn->APIExit();
