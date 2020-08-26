<?php

namespace App\Modules;

class Validator {


    public $params;
    /**
     * InputValidation constructor.
     *
     * @param array $inputs
     * @param array $params Parameters used to validate the inputs entry
     *
     */
    public function __construct(array $params, array $inputs)
    {
        $this->params = $params;
    }

    /**
     * Validate a request through given params
     *
     * @param array $inputs
     * @param array $params
     *
     * @return boolean
     */

    /**
     * DEV NOTES
     * Validation array :
     *
        $validation = [
            "email" => "email",
        ];

     */
    public static function validate(array $params, array $inputs){

        foreach($inputs as $key => $input){
            if(array_key_exists($key, $params) === true){
                $lookedType = $params[$key];
                if(self::validateType($input, $lookedType) === false)
                    return false;
            }
        }
        return true;

    }

    /**
     *
     * Check is $var type match $type
     *
     * @param string $var
     * @param string $type
     *
     * @return boolean
     *
     */
    private static function validateType(string $var, string $type){

        switch ($type){
            case "email":
                $validation = (filter_var($var, FILTER_VALIDATE_EMAIL) !== false);
                break;
            case "boolean":
                $validation = (filter_var($var, FILTER_VALIDATE_BOOLEAN) !== false);
                break;
            case "int":
                $validation = (filter_var($var, FILTER_VALIDATE_INT) !== false);
                break;
            default:
                $validation = false;
                break;
        }
        return $validation;

    }

}