<?php

namespace App\Controllers;

use App\Models\User;

class Usercontroller extends BaseController
{

    public function sign_up(){
        return view('admin/u_b/sign_up');
    }

    public function sign_in(){
        return view('admin/u_b/sign_in');
    }

    public function check_login(){

        $userModel = new User();

        $rules = [
            'username' => 'required|max_length[255]|regex_match[/^[a-z0-9]+$/]',
            'password' => 'required|min_length[8]'
        ];

        $errors = [
            'username' => [
                'required' => 'Vui lòng nhập tên người dùng.',
                'regex_match' => 'Tên người dùng chỉ được chứa chữ cái thường và số, không có dấu cách và không có chữ hoa.'
            ],
            'password' => [
                'required' => 'Vui lòng nhập mật khẩu.',
                'min_length' => 'Mật khẩu phải chứa ít nhất 8 ký tự.'
            ],
        ];
        $datacheck = array(
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'),
        );
        if(!$this->validate($rules, $errors)){
            $data = array(
                'loginCheck' =>  $datacheck,
                'validate' =>  $this->validator
            );
            session()->setFlashdata('alert', 'Đăng nhập thất bại!');
            session()->setFlashdata('alert_type', 'fail');
            return view('admin/u_b/sign_in', $data);
        }
        else{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userInfo = $userModel->get_by_username($username);

            if($userInfo == null){
                session()->setFlashdata('loginfail', 'Tên người dùng không chính xác!');
                return redirect()->to('/sign_in');
            }
            if($password == $userInfo->pass){
                return redirect()->to('/book');
            }else{
                session()->setFlashdata('loginfail', 'Mật khẩu không chính xác!');
                $data = array(
                    'loginCheck' =>  $datacheck,
                    'validate' =>  $this->validator
                );
                return view('admin/u_b/sign_in', $data);
            }
        }
    }

    public function check_reg(){
        $reg = new User();
        $rules = [
            'username' => 'required|is_unique[users.username]|max_length[255]|regex_match[/^[a-z0-9]+$/]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[8]',
            'repassword' => 'matches[password]'
        ];
        $errors = [
            'username' => [
                'required' => 'Vui lòng nhập tên người dùng.',
                'is_unique' => 'Tên người dùng đã được sử dụng.',
                'regex_match' => 'Tên người dùng chỉ được chứa chữ cái thường và số, không có dấu cách và không có chữ hoa.'
            ],
            'email' => [
                'required' => 'Vui lòng nhập địa chỉ email.',
                'valid_email' => 'Vui lòng nhập địa chỉ email hợp lệ.',
                'is_unique' => 'Địa chỉ email đã được sử dụng.',
                'valid_email' => 'Địa chỉ email phải chứa ký tự "@".'
            ],
            'password' => [
                'required' => 'Vui lòng nhập mật khẩu.',
                'min_length' => 'Mật khẩu phải chứa ít nhất 8 ký tự.'
            ],
            'repassword' => [
                'matches' => 'Mật khẩu nhập lại không khớp với mật khẩu.' // Thông báo lỗi cho repass nếu không khớp
            ]
        ];

        $data = array(
            'username'  =>     $this->request->getPost('username'),
            'email'      =>     $this->request->getPost('email'),
            'password'   =>     $this->request->getPost('password'),
            'repassword' =>     $this->request->getPost('repassword'),
        );
        $data1 = array(
            'username'  =>     $this->request->getPost('username'),
            'email'      =>     $this->request->getPost('email'),
            'pass'   =>     $this->request->getPost('password'),
        );
        if (!$this->validate($rules, $errors)) {
            $display = array(
                'register' => $data,
                'validate' => $this->validator
            );
            
            session()->setFlashdata('alert', 'Register fail!');
            session()->setFlashdata('alert_type', 'fail');
            return view('admin/u_b/sign_up', $display);
        }else{
            $reg->save($data1);
            session()->setFlashdata('alert', 'Register success!');
            session()->setFlashdata('alert_type', 'success');
            return redirect()->to('book');
        }
    }
}
