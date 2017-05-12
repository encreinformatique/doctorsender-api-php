<?php

namespace EncreInformatique\DoctorSenderApi\Endpoints;

class Endpoint
{
    public function __call($method, $args)
    {
        if (!method_exists($this, $method)) {
            throw new \Exception("The method does not exist.");
        }

        return $this->{$method}($args);
    }
}
