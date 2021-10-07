<?php

use App\Validation;
use PHPUnit\Framework\TestCase;

class ValidationTest extends TestCase
{
    protected $cart;

    protected function setUp(): void
    {
        $this->validation = new Validation();
    }

    
    /** @test */
    public function test_required()
    {
        // setup
        $rules = [
            ['name' => 'required'],
        ];
        $wrongData = ['test' => 'test value'];
        $correctData = ['name' => 'test name'];

        //Do somthing
        $nameError = $this->validation::validationHelper($rules, $wrongData);
        $noError = $this->validation::validationHelper($rules, $correctData);
        
        //make assertions
        $this->assertEquals($noError, "");
        $this->assertEquals($nameError, "name is required");
    }

    /** @test */
    public function test_number()
    {
        // setup
        $rules = [
            ['price' => 'number'],
        ];
        $wrongData = ['price' => '120'];
        $correctIntData = ['price' =>120];
        $correctDoubleData = ['price' =>120.2];

        //Do somthing
        $priceError = $this->validation::validationHelper($rules, $wrongData);
        $noErrorWithInt = $this->validation::validationHelper($rules, $correctIntData);
        $noErrorWithDouble = $this->validation::validationHelper($rules, $correctDoubleData);
        
        //make assertions
        $this->assertEquals($priceError, "price must be number");
        $this->assertEquals($noErrorWithInt, "");
        $this->assertEquals($noErrorWithDouble, "");
    }
    /** @test */
    public function test_int()
    {
        // setup
        $rules = [
            ['type_id' => 'int'],
        ];
        $wrongDataWithString = ['type_id' => '1'];
        $wrongDataWithDouble = ['type_id' => 1.2];
        $correctData = ['type_id' => 1];
        $correctData = ['type_id' => 1];
        $errMsg = "type_id must be integer";

        //Do somthing
        $typeErrorWithString = $this->validation::validationHelper($rules, $wrongDataWithString);
        $typeErrorWithDouble = $this->validation::validationHelper($rules, $wrongDataWithDouble);
        $noError = $this->validation::validationHelper($rules, $correctData);
        
        //make assertions
        $this->assertEquals($typeErrorWithDouble, $errMsg);
        $this->assertEquals($typeErrorWithString, $errMsg);
        $this->assertEquals($noError, "");
    }
    /** @test */
    public function test_string()
    {
        // setup
        $rules = [
            ['name' => 'string'],
        ];
        $wrongData = ['name' => 12];
        $correctData = ['name' => 'test name'];

        //Do somthing
        $nameError = $this->validation::validationHelper($rules, $wrongData);
        $noError = $this->validation::validationHelper($rules, $correctData);
        
        //make assertions
        $this->assertEquals($nameError, "name must be string");
        $this->assertEquals($noError, "");
    }
}
