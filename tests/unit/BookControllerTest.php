<?php


use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\ControllerTestTrait;
use CodeIgniter\Test\DatabaseTestTrait;

class BookControllerTest extends CIUnitTestCase
{
    use ControllerTestTrait;
    use DatabaseTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase();
    }
    protected function tearDown(): void
    {
        parent::tearDown();
    }
    public function testIndex()
    {
        $result = $this->controller('App\Controllers\BookController')
                        ->execute('index');

        $this->assertTrue($result->isOK());
    }

    public function testCreate()
    {
        $result = $this->controller('App\Controllers\BookController')
                        ->execute('create');

        $this->assertTrue($result->isOK());
    }

    public function testStore()
    {
        $data = [
            'ProductName' => 'Test Book',
            'Description' => 'This is a test book',
            'Price' => 10.99,
            'Category' => 'Test Category',
            'Brand' => 'Test Brand',
            'QuantityInStock' => 100
        ];

        $request = service('request')->withMethod('post')->withBody(http_build_query($data));

        $result = $this->withRequest($request)
                        ->controller('App\Controllers\BookController')
                        ->execute('store');

        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $result);
    }

    public function testEdit()
    {
        $result = $this->controller('App\Controllers\BookController')
                        ->execute('edit', ['1']);

        $this->assertTrue($result->isOK());
    }

    public function testUpdate()
    {
        $data = [
            'id' => 1,
            'ProductName' => 'Updated Book Name',
            'Description' => 'Updated Book Description',
            'Price' => 19.99,
            'Category' => 'Updated Category',
            'Brand' => 'Updated Brand',
            'QuantityInStock' => 50
        ];

        $request = service('request')->withMethod('post')->withBody(http_build_query($data));

        $result = $this->withRequest($request)
                        ->controller('App\Controllers\BookController')
                        ->execute('update_book');

        $this->assertInstanceOf(\CodeIgniter\HTTP\RedirectResponse::class, $result);
    }

    public function testDelete()
    {
        $request = service('request')->withMethod('post')->withBody(http_build_query(['id' => 1]));

        $result = $this->withRequest($request)
                        ->controller('App\Controllers\BookController')
                        ->execute('delete');

        $this->assertEquals('Success!', $result->getBody());
    }
}
