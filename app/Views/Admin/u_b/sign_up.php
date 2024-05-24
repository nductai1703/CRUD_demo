
<?= $this->include('Admin\layout\header.php'); ?>
<div class="container-fluid page-body-wrapper full-page-wrapper">
  
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="../../assets/images/book.svg">
                </div>
                <h6 class="font-weight-light">Đăng kí dễ dàng. Chỉ với với vài bước</h6>
                <?php if (session()->getFlashdata('alert') != NULL) : ?>
                    <div class="form-control form-text <?= session()->getFlashdata('alert_type') == 'fail' ? 'text-error-3' : 'text-success'; ?>">
                        <?= session()->getFlashdata('alert'); ?>
                    </div>
                <?php endif; ?>

                <form class="pt-3" method="post" action="check_register">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username" name="username" value="<?= isset($register) ? $register['username'] : ''; ?>">
                    <?php if(isset($validate) && $validate->hasError('username')) : ?>
                        <div class="form-control form-text text-error-2"><?= $validate->getError('username'); ?></div>
                    <?php endif; ?>
                </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email" value="<?= isset($register) ? $register['email'] : ''; ?>">
                    <?php if(isset($validate) && $validate->hasError('email')) : ?>
                        <div class="form-control form-text text-error-2"><?= $validate->getError('email'); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" value="<?= isset($register) ? $register['password'] : ''; ?>">
                    <?php if(isset($validate) && $validate->hasError('password')) : ?>
                        <div class="form-control form-text text-error-2"><?= $validate->getError('password'); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Repassword" name="repassword" value="<?= isset($register) ? $register['repassword'] : ''; ?>">
                    <?php if(isset($validate) && $validate->hasError('repassword')) : ?>
                        <div class="form-control form-text text-error-2"><?= $validate->getError('repassword'); ?></div>
                    <?php endif; ?>
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" >Đăng kí</button>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Bạn đã có tài khoản? <a href="/sign_in" class="text-primary">Đăng nhập</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
<?= $this->include('Admin\layout\footer.php'); ?>
