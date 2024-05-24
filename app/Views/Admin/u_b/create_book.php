<?= $this->include('Admin\layout\_main_layout.php'); ?>


<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Thêm sách </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="book">Quản lý sách</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm sách</li>
                    

                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" action="book_store" method="POST">
                        <!-- Phần báo lỗi dành cho: redirect()->to('book_create')->withInput()->with('errors', $this->validator->getErrors()); -->
                        <?php if(session()->has('errors')) : ?>
                            <div class="alert alert-danger">
                                <?php foreach (session('errors') as $error) : ?>
                                    <p><?= $error ?></p>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        <!--  -->
                            <div class="form-group row">
                                <label for="ProductName" class="col-sm-3 col-form-label">Tên sách</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Nhập tên sách" value="<?= isset($updatedate) ? $updatedate['ProductName'] : ''; ?>">
                                    <?php if(isset($validate) && $validate->hasError('ProductName')) : ?>
                                        <div class="form-control form-text text-error-2"><?= $validate->getError('ProductName'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Description" class="col-sm-3 col-form-label">Mô tả</label>
                                <div class="col-sm-9">
                                    <textarea class="form-control" id="Description" name="Description" rows="3" placeholder="Nhập mô tả sách"><?= isset($updatedate) ? $updatedate['Description'] : ''; ?></textarea>
                                    <?php if(isset($validate) && $validate->hasError('Description')) : ?>
                                        <div class="form-control form-text text-error-2"><?= $validate->getError('Description'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Price" class="col-sm-3 col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Price" name="Price" placeholder="Nhập giá sách"  value="<?= isset($updatedate) ? $updatedate['Price'] : ''; ?>">
                                    <?php if(isset($validate) && $validate->hasError('Price')) : ?>
                                        <div class="form-control form-text text-error-2"><?= $validate->getError('Price'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Category" class="col-sm-3 col-form-label">Danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Category" name="Category" placeholder="Nhập danh mục sách"  value="<?= isset($updatedate) ? $updatedate['Category'] : ''; ?>">
                                    <?php if(isset($validate) && $validate->hasError('Category')) : ?>
                                        <div class="form-control form-text text-error-2"><?= $validate->getError('Category'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Brand" class="col-sm-3 col-form-label">Thương hiệu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="Brand" name="Brand" placeholder="Nhập thương hiệu sách"  value="<?= isset($updatedate) ? $updatedate['Brand'] : ''; ?>">
                                    <?php if(isset($validate) && $validate->hasError('Brand')) : ?>
                                        <div class="form-control form-text text-error-2"><?= $validate->getError('Brand'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="QuantityInStock" class="col-sm-3 col-form-label">Số lượng</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="QuantityInStock" name="QuantityInStock" placeholder="Nhập số lượng sách"  value="<?= isset($updatedate) ? $updatedate['QuantityInStock'] : ''; ?>">
                                    <?php if(isset($validate) && $validate->hasError('QuantityInStock')) : ?>
                                        <div class="form-control form-text text-error-2"><?= $validate->getError('QuantityInStock'); ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>


                            
                            <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include('Admin\layout\footer.php'); ?>
