<?php

namespace App\Rules;

use DOMDocument;
use Illuminate\Contracts\Validation\Rule;

class ValidXsd implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        libxml_use_internal_errors(true);

        $objDom = new DOMDocument;

        $objDom->load($value);

        $schemaPeople = $objDom->schemaValidate(app_path('Rules/people.xsd'));
        $schemaShipOrders = $objDom->schemaValidate(app_path('Rules/shiporders.xsd'));

        if (!$schemaPeople AND !$schemaShipOrders) {
            $arrayAllErrors = libxml_get_errors();
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'XML em formato inválido.';
    }
}
