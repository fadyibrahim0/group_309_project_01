<?php

class  Validation 
{
    public $validationRules = [];
    public $errors          = [];

    // string field rules
    const F_REQUIRED    = "required";
    const F_EMAIL       = "email";
    const F_STRING      = "string";
    const F_NUMBER      = "number";

    const F_MOBILE_EG   = "mobile_eg";

    // array field rules
    const F_MIN         = "min";
    const F_MAX         = "max";
    const F_IN          = "in";
    const F_SAME        = "same";

    public function __construct(Array $validationRules)
    {
        $this->validationRules = $validationRules;
    }

    // loop on validation rules
    public function validate()
    {
        foreach ($this->validationRules as $name => $rules) {
            foreach($rules as $rule)
            {
                $arrRule = explode(":",$rule);
                if(!strpos($rule,":"))
                {
                    $this->validStringField($name,$rule);
                }
                if(count($arrRule) > 1 )
                {
                    $this->validArrayField($name,$arrRule);
                }
            }

        }
        return $this;
    }

    
    private function validStringField($name,$rule)
    {
        switch ($rule) {
            case self::F_REQUIRED:
                $this->requiredFiled($name);
                break;
            case self::F_EMAIL:
                $this->emailFiled($name);
                break;
            case self::F_STRING:
                $this->stringFiled($name);
                break;
            case self::F_NUMBER:
                $this->numberFiled($name);
                break;
        }
    }


    private function validArrayField($name,$rule)
    {
        switch ($rule[0]) {
            case self::F_MIN:
                $this->minFiled($name,$rule);
                break;
            case self::F_MAX:
                $this->maxFiled($name,$rule);
                break;
            case self::F_SAME:
                $this->sameFiled($name,$rule);
                break;
            case self::F_IN:
                $this->inArrayFiled($name,$rule);
                break;
        }
    }


    /*
    * Begin String Rules Validation Function
    */

    private function requiredFiled($name)
    {
        if(!empty($this->sanitizeField($name)))
        {
            return true;
        }
        else 
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field is required ";
        }
    }


    private function emailFiled($name)
    {
        if(!filter_var($this->sanitizeField($name),FILTER_VALIDATE_EMAIL))
        {
            $this->errors[] = "{$name} field must be a valid email";
        }
    }


    private function stringFiled($name)
    {
        if(!preg_match('/^[a-zA-Z0-9 .]*$/',$this->sanitizeField($name)))
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field must be a string";
        }

    }


    private function numberFiled($name)
    {
        if(!preg_match('/^[0-9]+$/',$this->sanitizeField($name)))
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field must be a number";
        }
    }

    /*
    * End String Rules Validation Function
    */



    private function minFiled($name,$rule)
    {
        if(strlen($this->sanitizeField($name)) < $rule[1])
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field must be greater than  {$rule[1]}";
        }
    } 

    private function maxFiled($name,$rule)
    {
        if(strlen($this->sanitizeField($name)) > $rule[1])
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field must be less than  {$rule[1]}";
        }
    } 

    private function sameFiled($name,$rule)
    {
        if($this->sanitizeField($name) !== $this->sanitizeField($rule[1]))
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field must be equal  {$rule[1]}";
        }
    } 

    private function inArrayFiled($name,$rule)
    {
        $array = explode(',',str_replace(["'", " "], "", $rule[1]));
        if(! in_array($this->sanitizeField($name),$array) )
        {
            $name= ucfirst(str_replace('_',' ', $name));
            $this->errors[] = "{$name} field not valid";
        }
    }



    /**
     * Start Helper Function
     */
    
    private function sanitizeField($name)
    {
        return htmlspecialchars(htmlentities(trim($_REQUEST[$name])));
    }

    public function check()
    {
        // if(empty($this->errors)) {
        //     return true;
        // } else {
        //     return false;
        // }

        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

}