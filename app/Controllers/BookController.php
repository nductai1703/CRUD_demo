<?php

namespace App\Controllers;

use App\Models\Book;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class BookController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $books = new Book();
        $lst = $books->get_all();

        $lst_array = [];
        foreach ($lst as $item) {
            $lst_array[] = (array) $item;
        }

        return view('admin/u_b/index', ['books' => $lst_array]);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        return view('admin/u_b/create_book');
    }

    public function store()
{
    $productName = $this->request->getPost('ProductName');
    $description = $this->request->getPost('Description');
    $price = $this->request->getPost('Price');
    $category = $this->request->getPost('Category');
    $brand = $this->request->getPost('Brand');
    $quantityinStock = $this->request->getPost('QuantityInStock');

    $rules = [
        'ProductName' => 'required|min_length[3]|max_length[255]|is_unique[books.ProductName]',
        'Description' => 'required',
        'Price' => 'required|numeric|greater_than[0]',
        'Category' => 'required',
        'Brand' => 'required',
        'QuantityInStock' => 'required|numeric|greater_than[0]',
    ];

    $errors = [
        'ProductName' => [
            'required' => 'Vui lòng nhập tên sản phẩm.',
            'min_length' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
            'max_length' => 'Tên sản phẩm không được dài quá 255 ký tự.',
            'is_unique' => 'Tên sản phẩm này đã tồn tại.',
        ],
        'Description' => [
            'required' => 'Vui lòng nhập mô tả.',
        ],
        'Price' => [
            'required' => 'Vui lòng nhập giá.',
            'numeric' => 'Giá phải là số.',
            'greater_than' => 'Giá phải lớn hơn 0.',
        ],
        'Category' => [
            'required' => 'Vui lòng nhập danh mục.',
        ],
        'Brand' => [
            'required' => 'Vui lòng nhập thương hiệu.',
        ],
        'QuantityInStock' => [
            'required' => 'Vui lòng nhập số lượng.',
            'numeric' => 'Số lượng phải là số.',
            'greater_than' => 'Số lượng phải lớn hơn 0.',
        ],
    ];

    if (!$this->validate($rules, $errors)) {
        // Nếu dữ liệu không hợp lệ, trả về view create_book với thông tin dữ liệu và thông báo lỗi
        $data = [
            'ProductName' => $productName,
            'Description' => $description,
            'Price' => $price,
            'Category' => $category,
            'Brand' => $brand,
            'QuantityInStock' => $quantityinStock,
        ];
        $display = [
            'validate' => $this->validator,
            'updatedate' => $data
        ];
        return view('admin/u_b/create_book', $display);
    } else {
        // Dữ liệu hợp lệ, tiến hành lưu vào cơ sở dữ liệu
        $data = [
            'ProductName' => $productName,
            'Description' => $description,
            'Price' => $price,
            'Category' => $category,
            'Brand' => $brand,
            'QuantityInStock' => $quantityinStock,
        ];

        $book = new Book();

        if ($book->insert($data)) {
            return redirect()->to('book')->with('success', 'Thêm sách thành công.');
        } else {
            return redirect()->to('book_create')->withInput()->with('error', 'Thêm sách thất bại. Vui lòng thử lại.');
        }
    }
}

    




    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $book_id = base64_decode($id);

        $bookModel = new Book();

        $bookByID = $bookModel->get_by_id($book_id);
        
        $data = array(
            "id" => $bookByID ->id,
            "ProductName" => $bookByID ->ProductName,
            "Description" => $bookByID ->Description,
            "Price" => $bookByID ->Price,
            "Category" => $bookByID ->Category,
            "Brand" => $bookByID ->Brand,
            "QuantityInStock" => $bookByID ->QuantityInStock,
        );
        $display = array(
            'updatedate' => $data,
        );

        return view('admin/u_b/edit_book', $display);
    }
    

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update_book()
    {
        $update_id = $this->request->getPost('id');
        $book_update = new Book();
    
        $rules = [
            'ProductName' => 'required|min_length[3]|max_length[255]|is_unique[books.ProductName]',
            'Description' => 'required',
            'Price' => 'required|numeric|greater_than[0]',
            'Category' => 'required',
            'Brand' => 'required',
            'QuantityInStock' => 'required|numeric|greater_than[0]',
        ];
    
        $errors = [
            'ProductName' => [
                'required' => 'Vui lòng nhập tên sản phẩm.',
                'min_length' => 'Tên sản phẩm phải có ít nhất 3 ký tự.',
                'max_length' => 'Tên sản phẩm không được dài quá 255 ký tự.',
                'is_unique' => 'Tên sản phẩm này đã tồn tại.',
            ],
            'Description' => [
                'required' => 'Vui lòng nhập mô tả.',
            ],
            'Price' => [
                'required' => 'Vui lòng nhập giá.',
                'numeric' => 'Giá phải là số.',
                'greater_than' => 'Giá phải lớn hơn 0.',
            ],
            'Category' => [
                'required' => 'Vui lòng nhập danh mục.',
            ],
            'Brand' => [
                'required' => 'Vui lòng nhập thương hiệu.',
            ],
            'QuantityInStock' => [
                'required' => 'Vui lòng nhập số lượng.',
                'numeric' => 'Số lượng phải là số.',
                'greater_than' => 'Số lượng phải lớn hơn 0.',
            ],
        ];

        // Lấy dữ liệu từ POST request
        $id = $this->request->getPost('id');
        $productName = $this->request->getPost('ProductName');
        $description = $this->request->getPost('Description');
        $price = $this->request->getPost('Price');
        $category = $this->request->getPost('Category');
        $brand = $this->request->getPost('Brand');
        $quantityinStock = $this->request->getPost('QuantityInStock');
    
        // Tạo một mảng dữ liệu chứa thông tin của sách
        $data = [
            'id' => $id,
            'ProductName' => $productName,
            'Description' => $description,
            'Price' => $price,
            'Category' => $category,
            'Brand' => $brand,
            'QuantityInStock' => $quantityinStock,
        ];

    
        if (!$this->validate($rules, $errors)) {
            // Nếu dữ liệu không hợp lệ, trả về view edit_book với thông tin dữ liệu và thông báo lỗi
            $display = [
                'updatedate' => $data,
                'validate' => $this->validator
            ];
            return view('admin/u_b/edit_book', $display);
        } else {
            // Dữ liệu hợp lệ, tiến hành cập nhật dữ liệu vào cơ sở dữ liệu
            $book_update->update($update_id, $data); 
            return redirect()->to('/book')->with('success', 'Cập nhật sách thành công.');
        }
    }
    
    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $book_id = $this->request->getPost('id');
        $bookModel = new Book();
        $bookModel->delete($book_id);
        echo json_encode('Success!');
    }
}
