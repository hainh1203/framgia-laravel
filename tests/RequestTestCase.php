<?php

namespace Tests;

abstract class RequestTestCase extends TestCase
{
    /**
     * The Request rules
     *
     * @var array
     */
    protected $rules;

    /**
     * The Illuminate validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $this->validator = $this->app['validator'];
    }

    /**
     * Determine if the data passes the validation rules.
     *
     * @param array $data
     * @return bool
     */
    protected function validate($data)
    {
        $validator = $this->validator->make($data, $this->rules);
        return $validator->passes();
    }

    /**
     * Get the field validator
     *
     * @param string $field
     * @param mixed $value
     * @return \Illuminate\Validation\Validator
     */
    protected function getFieldValidator($field, $value)
    {
        $rule = $this->rules[$field];
        $dotPos = strrpos($field, '.');
        if ($dotPos !== false) {
            $field = substr($field, $dotPos + 1);
        }
        return $this->validator->make(
            [$field => $value],
            [$field => $rule]
        );
    }

    /**
     * Determine if the data passes the field validation rules.
     *
     * @param string $field
     * @param mixed $value
     * @return bool
     */
    protected function validateField($field, $value)
    {
        return $this->getFieldValidator($field, $value)->passes();
    }
}
