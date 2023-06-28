<?php

namespace App\Interfaces;

interface HasUnusedAttributeToRetrieve
{
    // get attribute and filter the unused attributes
    public function getAttributeWithoutUnusedAttributes();
}
