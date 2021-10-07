<?php

use App\Db;
use App\Env;
use App\ProductRepository;
use App\Validation;
use PHPUnit\Framework\TestCase;

class ProductRepositoryTest extends TestCase
{
    protected $cart;

    protected function setUp(): void
    {
        
        (new Env(__DIR__ . '/.env.test'));
        $this->repo = new ProductRepository();
        $this->validation = new Validation();
        $this->db = new Db();
        $this->db->resetDb();
    }


   



     /** @test */
    //  public function test_create()
    //  {
    //      // setup
    //     $correctData = [
    //         "name" => "table",
    //         "price" => 100.0,
    //         "prop_name" => "Dimensions",
    //         "prop_unit" => "HxWxL",
    //         "type_id" => 2,
    //         "prop_content" => "24x45x15"
    //     ];
    //     $nameRequired = $correctData;
    //     unset($nameRequired['name']);
    //     $priceNumber =$correctData;
    //     $priceNumber['price'] = '120';
    //     $unkownType =$correctData;
    //     $unkownType['type_id'] = 200; 
        
    //     // dd($correctData);
    //      //Do somthing
    //      $correctData = $this->repo->create($correctData);
    //      $nameRequired = $this->repo->create($nameRequired);
    //      $priceNumber = $this->repo->create($priceNumber);
    //      $unkownType = $this->repo->create($unkownType);
 
    //      //make assertions
    //      $this->assertEquals($nameRequired, "name is required");
    //      $this->assertEquals($priceNumber, "price must be number");
    //      $this->assertEquals($unkownType, "you have been passed unexisted type id");
    //  }

      /** @test */
    public function test_fetch_all()
    {
        // setup
        $result = [
                "name" => "table",
                "price" => 100.0,
                "prop_name" => "Dimensions",
                "prop_unit" => "HxWxL",
                "type_id" => 2,
                "prop_content" => "24x45x15"
        ];

        //Do somthing
        $product = $this->repo->create($result);
        $response = $this->repo->fetchAll();
        //make assertions
        unset($result['type_id']);
        foreach(array_keys($result)  as $key){
            $this->assertEquals($response[0][$key], $result[$key]);
        }
    }


    public function test_get_types()
    {
        $types = [
            [
                "id" => 1,
                "name" => "DVD"
            ],
              [
                "id" => 2,
                "name" => "FURNITURE"
              ],
              [
                "id" => 3,
                "name" => "BOOK"
            ],
        ];
        $response = $this->repo->getTypes();

        $this->assertEquals($response, $types);
    }


}
