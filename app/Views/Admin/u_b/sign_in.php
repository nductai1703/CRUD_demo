
<?= $this->include('Admin\layout\header.php'); ?>
<div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="../../assets/images/book.svg">
                  <h4>Quản trị sách</h4>
                </div>
                <h6 class="font-weight-light">Đăng nhập để tiếp tục.</h6>
                <?php if (session()->getFlashdata('loginfail') != NULL) : ?>
                    <div class="form-control form-text text-error-2"><?= session()->getFlashdata('loginfail'); ?></div>
                <?php endif; ?>
                <form class="pt-3" action="/check_login_f" method="post">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" name="username" value="<?= isset($loginCheck) ? $loginCheck['username'] : ''; ?>">
                    <?php if(isset($validate) && $validate->hasError('username')) : ?>
                        <div class="form-control form-text text-error-2"><?= $validate->getError('username'); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password" value="<?= isset($loginCheck) ? $loginCheck['password'] : ''; ?>">
                    <?php if(isset($validate) && $validate->hasError('password')) : ?>
                        <div class="form-control form-text text-error-2"><?= $validate->getError('password'); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="">Đăng nhập</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="#" class="auth-link text-black">Quên mật khẩu?</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Bạn chưa có tài khoản? <a href="/sign_up" class="text-primary">Đăng kí ngay</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
<?= $this->include('Admin\layout\footer.php'); ?>
