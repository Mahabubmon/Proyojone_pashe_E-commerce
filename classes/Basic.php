<?php
abstract class Basic
{
    public function sanitize($var, $type)
    {
        $filter = false;
        switch ($type) {
            case 'email':
                $var = substr($var, 0, 254);
                $filter = FILTER_VALIDATE_EMAIL;
                break;
            case 'int':
                $filter = FILTER_VALIDATE_INT;
                break;
            case 'boolean':
                $filter = FILTER_VALIDATE_BOOLEAN;
                break;
            case 'ip':
                $filter = FILTER_VALIDATE_IP;
                break;
            case 'url':
                $filter = FILTER_VALIDATE_URL;
                break;
            case 'string':
            default:
                $filter = FILTER_SANITIZE_STRING;
                break;

        }
        return $filter = trim(filter_var($var, $filter));
    }
}



?>