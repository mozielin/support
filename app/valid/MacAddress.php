<?php
class MacAddress
{
    public function validation($field, $value, $params)
    {    	    	
    	$reg = "/^(?:[0-9a-fA-F]{2}[:;.]?){6}$/";

        if(preg_match($reg,$value))
        	return true;        	
        else
        	return false;
        
    }
}