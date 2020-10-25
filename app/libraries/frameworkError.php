<?php
/**
 * Created by PhpStorm.
 * User: bryan
 * Date: 12/7/2017
 * Time: 6:41 PM
 */

class frameworkError extends Exception {
    public function __construct($message = "Something bad happened, sorry about that.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
        
        $this->message ="Marketplace encountered an error in line $this->line of $this->file: ".$this->message;
    }

}
