# PHP_OOP
This repository is only for a school exercise.

Bij deze opdracht ga ik voor het grootste gedeelte gebruik maken van een eigen geschreven library. 
Dit is een php library om de input van $_GET en $_POST te valideren. 
Dit zodat ik niet zelf hoeft te valideren of de input wel klopt, maar ook zodat ik deze code niet steeds hoef te schrijven. 
Daarboven op komt dat ik dan niet kleine dingen vergeet te valideren, maar door de hele tijd deze library te gebruiken (en up te daten), hoop ik dit te voorkomen.

De library heet 'ValidateGetPostInput' is te vinden op [GitHub](https://github.com/JesseSoeteman/ValidateGetPostInput) en [Packagist](https://packagist.org/packages/jessesoeteman/validate-get-post-input). 

Hierdoor kan ik de library makkelijk hergebruiken in mijn projecten doormiddel van [composer](https://getcomposer.org).

_**Deze library is nog niet af, maar voor het grootste gedeelte wel.**_

## Inhoudsopgave
Hieronder staan de leerdoelen die ik moet behalen voor deze opdracht:

* [Ik maak op de juiste manier functies in PHP](#ik-maak-op-de-juiste-manier-functies-in-php)
* [Ik ontwerp in PHP een class met properties en methods](#ik-ontwerp-in-php-een-class-met-properties-en-methods)
* [Ik voeg een constructor toe aan een class, zodat bij het maken van een object diverse eigenschappen direct een waarde krijgen](#ik-voeg-een-constructor-toe-aan-een-class-zodat-bij-het-maken-van-een-object-diverse-eigenschappen-direct-een-waarde-krijgen)
* [Ik maak objecten van een zelfgemaakte class en gebruik de proprties en methods van die class](#ik-maak-objecten-van-een-zelfgemaakte-class-en-gebruik-de-proprties-en-methods-van-die-class)
* [Ik maak gebruik van public, private en/of protected om eigenschappen en methods van een class van buitenaf te beschermen](#ik-maak-gebruik-van-public-private-enof-protected-om-eigenschappen-en-methods-van-een-class-van-buitenaf-te-beschermen)
* [Ik maak een child-class die eigenschappen en methods overerft van de parent-class](#ik-maak-een-child-class-die-eigenschappen-en-methods-overerft-van-de-parent-class)
* [Ik voeg meerdere objecten toe aan een sessie en lees deze daarna weer op de juiste manier uit.](#ik-voeg-meerdere-objecten-toe-aan-een-sessie-en-lees-deze-daarna-weer-op-de-juiste-manier-uit)


## Ik maak op de juiste manier functies in PHP
_**[Deze link](https://87275.stu.sd-lab.nl/verprog/oop) gaar naar mijn website voor het eerste leerdoel.**_

_De method die ik hieronder laat zien is onderdeel van één van de classes van de library._

Deze method is een private functie die wordt aangeroepen in de public method `validate()` als het datatype is ingesteld als DataType::STRING (Dit is een constant waarde om de code leerbaarder te maken).
Deze functie valideert of de input een string is en of deze voldoet aan de min en max lengte. (als hierop gecontroleerd moet worden)

### Class properties
`$this->key`_, is de naam van de input._ `$_GET["key]` of `$_POST["key"]`

`$this->value`_, is de input die gevalideerd moet worden._

`$this->errors`_, is een array waar alle errors in worden opgeslagen._

`$this->settings->check_min_max`_, is een boolean die aangeeft of er gecontroleerd moet worden op de min en max lengte._

`$this->settings->min`_, is een integer die aangeeft wat de min lengte in karakters moet zijn._

`$this->settings->max`_, is een integer die aangeeft wat de max lengte in karakters moet zijn._

```php 
/**
 * Validate the value of the $_GET or $_POST input as a string.
 *
 */
private function validateString(): void
{
    // Check if the value is a string.
    if (!is_string($this->value)) {
        array_push($this->errors, "This field `{$this->key}` is not a string");
    }

    // Check if the value needs to be checked for min and max.
    if (!$this->settings->check_min_max || !$this->settings->min > 0 || !$this->settings->max > 0) {
        return;
    }

    // Validating the value for the set min length.
    if (strlen($this->value) < $this->settings->min) {
        $plural_suffix = $this->settings->min == 1 ? "" : "s";
        array_push($this->errors, "This field `{$this->key}` must be at least " . $this->settings->min . " character{$plural_suffix} long");
    }

    // Validating the value for the set max length.
    if (strlen($this->value) > $this->settings->max) {
        $plural_suffix = $this->settings->max == 1 ? "" : "s";
        array_push($this->errors, "This field `{$this->key}` can be at most " . $this->settings->max . " character{$plural_suffix} long");
    }
}
```

## Ik ontwerp in PHP een class met properties en methods
_De class die ik hieronder laat zien is onderdeel van één van de classes van de library, de functie hierboven is onderdeel van deze class._

_De methods heb ik leeggehaald, omdat deze niet relevant zijn voor het onderwerp van deze opdracht en dit bestand anders te groot zou worden._

```php
/** 
 * ValidateGetPostInput class to validate
 * $_GET and $_POST input.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2022-12-24
 */
class ValidateGetPostInput
{

    /**
     * @var string $key The key of the $_GET or $_POST input.
     */
    private string $key = "";
    /**
     * @var string|int|float|bool|object $value The value of the $_GET or $_POST input.
     */
    private string|int|float|bool|object $value;
    /**
     * @var ValidateInputSettings $settings The settings for the validation.
     */
    private ValidateInputSettings $settings;

    /**
     * @var array $errors The errors that occurred during validation.
     */
    private $errors = [];

    /**
     * @var array $PATTERN_DATA_TYPE_COMPATIBILITY The data types that are compatible with the patterns. Pattern::NONE is not included, because it is compatible with all data types.
     */
    private const PATTERN_DATA_TYPE_COMPATIBILITY = [
        Pattern::EMAIL => [DataType::STRING],
        Pattern::REGEX => [DataType::STRING],
    ];

    /**
     * Constructor for the ValidateGetPostInput class.
     *
     * @param string $key The key of the $_GET or $_POST input.
     * @param ValidateInputSettings $settings The settings for the validation.
     */
    public function __construct($key, $settings)
    {
    }

    /**
     * Validate the $_GET or $_POST input.
     *
     * @return array The validation result. An array with elements if there are errors, an empty array if there are no errors.
     */
    public function validate(): array
    {
    }

    /**
     * Get the value of the $_GET or $_POST input.
     *
     * @return string|int|float|bool|object The value of the $_GET or $_POST input.
     */
    public function getValue(): string|int|float|bool|object
    {
    }

    /**
     * Validate the value of the $_GET or $_POST input as a string.
     *
     */
    private function validateString(): void
    {
    }

    /**
     * Validate the value of the $_GET or $_POST input as an number.
     *
     */
    private function validateNumber($data_type = DataType::INTEGER): void
    {
    }

    /**
     * Validate the value of the $_GET or $_POST input as a boolean.
     *
     */
    private function validateBoolean(): void
    {
    }

    /**
     * Validate the value of the $_GET or $_POST input as a json object.
     *
     */
    private function validateJsonObject(): void
    {
    }

    /**
     * Validate the value of the $_GET or $_POST input as a date.
     *
     */
    private function validateDate(): void
    {
    }
}
```

## Ik voeg een constructor toe aan een class, zodat bij het maken van een object diverse eigenschappen direct een waarde krijgen
_Hieronder is de settings class te zien, deze class wordt gebruikt om de settings van de ValidateGetPostInput class te bepalen. (de class hierboven)_
De library bestaat uit meerdere classes, maar deze class is één van de belangrijkste classes, omdat deze de settings bepaalt voor de validatie van de input.

Hier is te zien dat ik een constructor gebruik met parameters, zodat ik de properties van de class direct een waarde kan geven. Als er geen waarde wordt meegegeven, dan krijgt de property de default waarde.
```php
/**
 * ValidateInputSettings class to store the settings for the validation.
 * 
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2022-12-24
 */
class ValidateInputSettings
{

    /**
     * @var int $input_type The type of input to validate.
     * 0 = $_GET, 
     * 1 = $_POST.
     */
    public int $input_type;
    /**
     * @var bool $required Whether the input is required.
     */
    public bool $required;
    /**
     * @var int $pattern The pattern to validate the input against. 
     * 0 = no pattern, 
     * 1 = validate email.
     */
    public int $pattern;
    /**
     * @var string $regex_pattern The regex pattern to validate the input against.
     */
    public string $regex_pattern;
    /**
     * @var int $data_type The datatype of the input.
     * 0 = string,
     * 1 = integer,
     * 2 = float,
     * 3 = boolean,
     * 4 = json object
     * 5 = date
     */
    public int $data_type;
    /**
     * @var bool $check_min_max Whether to check the minimum and maximum length of the input.
     */
    public bool $check_min_max;
    /**
     * @var int $min The minimum length of the input when the input is a string. Otherwise the minimum value of the input as a number.
     */
    public int $min;
    /**
     * @var int $max The maximum length of the input when the input is a string. Otherwise the maximum value of the input as a number.
     */
    public int $max;
    /**
     * @var bool $trim Whether to trim the input.
     */
    public bool $trim;
    /**
     * @var bool $sanitize Whether to sanitize the input.
     */
    public bool $sanitize;
    /**
     * @var string $date_format Whether to check if the input is a valid date. (Only works with DataType::DATE)
     */
    public string $date_format;

    /**
     * Constructor for the ValidateInputSettings class.
     *
     * @param int $input_type The type of input to validate. 0 = $_GET, 1 = $_POST.
     * @param bool $required Whether the input is required.
     * @param int $pattern The pattern to validate the input against. 0 = no pattern, 1 = validate email, 2 = regex pattern.
     * @param string $regex_pattern The regex pattern to validate the input against, only used when $pattern = 2.
     * @param int $data_type The datatype of the input. 0 = string, 1 = integer, 2 = float, 3 = boolean, 4 = json object, 5 = date.
     * @param bool $check_min_max Whether to check the minimum and maximum length of the input. default value is false.
     * @param int $min The minimum length of the input when the input is a string. Otherwise the minimum value of the input as a number. default value is 0.
     * @param int $max The maximum length of the input when the input is a string. Otherwise the maximum value of the input as a number. default value is 0.
     * @param bool $trim Whether to trim the input. default value is true.
     * @param bool $sanitize Whether to sanitize the input. default value is true.
     * @param string $date_format Whether to check if the input is a valid date. (Only works with DataType::DATE) default value is none.
     */
    public function __construct(
        $input_type = RequestType::GET,
        $required = false,
        $pattern = Pattern::NONE,
        $regex_pattern = "",
        $data_type = DataType::STRING,
        $check_min_max = false,
        $min = 0,
        $max = 0,
        $trim = true,
        $sanitize = true,
        $date_format = DateFormat::NONE
    ) {
        $this->input_type = $input_type;
        $this->required = $required;
        $this->pattern = $pattern;
        $this->regex_pattern = $regex_pattern;
        $this->data_type = $data_type;
        $this->check_min_max = $check_min_max;
        $this->min = $min;
        $this->max = $max;
        $this->trim = $trim;
        $this->sanitize = $sanitize;
        $this->date_format = $date_format;
    }
}
```

## Ik maak objecten van een zelfgemaakte class en gebruik de proprties en methods van die class
_In het voorbeeld hieronder staat een 'prebuilt' class hier worden twee objecten gemaakt van de bovenstaande classes._

Dit omdat er vaak dezelfde eisen aan een input zitten en het handig is om deze eisen in een class te zetten, zodat je deze eisen niet steeds opnieuw hoeft te schrijven.

In dit voorbeeld heb ik een class voor het valideren van een integer.
```php
/**
 * ValidateNumber class to set the settings for the validation.
 * This class is used to validate a number.
 * 
 * - The value must be a number.
 * - The request type is GET. (this can be changed to POST)
 * - The value is required. (this can be changed)
 * - The value must be at least -2147483648. (this can be changed)
 * - The value can be at most 2147483647. (this can be changed)
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateNumber extends ValidateGetPostInput
{
    public function __construct($key, $request_type = RequestType::GET, $required = true, $min = -2147483648, $max = 2147483647)
    {
        $settings = new ValidateInputSettings();
        $settings->input_type = $request_type;
        $settings->required = $required;
        $settings->data_type = DataType::INTEGER;
        $settings->check_min_max = true;
        $settings->min = $min;
        $settings->max = $max;
        parent::__construct($key, $settings);
    }
}

```

Hier staat hoe de class gebruikt moet worden.
```php

$number; {
    $_number = new ValidateNumber("number"); // Deze class zoekt voor de key "number" in de $_GET array. dus $_GET["number"].
    $errors += $_number->validate(); // Deze functie valideert de input en geeft een array aan errors terug, als er geen errors zijn is de array leeg.
    $number = $_number->getValue(); // Deze functie geeft de input terug.
}

```

## Ik maak gebruik van public, private en/of protected om eigenschappen en methods van een class van buitenaf te beschermen
Zoals bij [dit kopje](#ik-ontwerp-in-php-een-class-met-properties-en-methods) te zien is maak ik gebruik van public en private.

Daarnaast gebruik ik ook abstract classes om ervoor te zorgen dat de code leesbaarder wordt.

Het voordeel van deze classes is dat je direct the properties en methods kan gebruiken zonder dat je de class eerst hoeft te defineren.

```php
abstract class DataType
{
    const STRING = 0;
    const INTEGER = 1;
    const FLOAT = 2;
    const BOOLEAN = 3;
    const JSON_OBJECT = 4;
    const DATE = 5;
}

abstract class RequestType
{
    const GET = 0;
    const POST = 1;
}
```

## Ik maak een child-class die eigenschappen en methods overerft van de parent-class
Deze class overtreft de eigenschappen van de parent class. (ValidateNumber)
Het is hier bijvoorbeeld zo dat de minimum waarde -1 is en de maximum waarde 2147483647.

```php

/**
 * ValidateID class to set the settings for the validation.
 * This class is used to validate an ID.
 * 
 * - The request type is GET. (this can be changed to POST)
 * - The value is required. (this can be changed)
 * - The ID must be a number.
 * - The ID must be at least -1.
 * - The ID can be at most 2147483647.
 *
 * @author  Jesse Soeteman
 * @version 1.0
 * @since   2023-01-18
 */
class ValidateID extends ValidateNumber
{
    public function __construct($key, $request_type = RequestType::GET, $required = true)
    {
        parent::__construct($key, $request_type, $required, -1, 2147483647);
    }
}
```

## Ik voeg meerdere objecten toe aan een sessie en lees deze daarna weer op de juiste manier uit.
_In dit voorbeeld maak ik geen gebruik van de library._
Ik maak gebruik van de $_SESSION array om data op te slaan. Deze data kan ik dan weer ophalen.

### Script 1:
```php
session_start();

class User {
    public $username;
    public $name;
    public $email;
    private $id;

    public function __construct($username, $name, $email, $id) {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }
}

// Create a new user
$user = new User("username", "name", "email", 1);

// Get the username
echo json_encode($user);

// Save the user to the session
$_SESSION["user"] = serialize($user);
```

### Script 2:
```php
session_start();

class User {
    public $username;
    public $name;
    public $email;
    private $id;

    public function __construct($username, $name, $email, $id) {
        $this->username = $username;
        $this->name = $name;
        $this->email = $email;
        $this->id = $id;
    }
}

// check if the user is logged in
if (isset($_SESSION["user"])) {
    // Get the user from the session
    $user = unserialize($_SESSION["user"]);
    // Get the username
    echo json_encode($user);
} else {
    echo json_encode("Not logged in");
}
```
