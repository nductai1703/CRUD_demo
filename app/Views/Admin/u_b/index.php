
<?= $this->include('Admin\layout\_main_layout.php'); ?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Quản lí sách </h3>
            <a href="book_create" class="btn btn-primary btn-sm">Thêm sách</a>
        </div>
        <?php if (session()->has('success')) : ?>
            <div id="success-alert" class="alert alert-success" role="alert">
                <?= session('success') ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bảng thông tin sách</h4>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Mô tả</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th>Thương hiệu</th>
                                    <th>Số lượng trong kho</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($books as $book): ?>
                                    <tr id="t-<?= $book['id']; ?>">
                                        <td><?= $book['id'] ?></td>
                                        <td><?= $book['ProductName'] ?></td>
                                        <td style="word-wrap: break-word; white-space: pre-line;" title="<?= $book['Description'] ?>">
                                            <?= $book['Description'] ?>
                                        </td>
                                        <td><?= $book['Price'] ?></td>
                                        <td><?= $book['Category'] ?></td>
                                        <td><?= $book['Brand'] ?></td>
                                        <td><?= $book['QuantityInStock'] ?></td>
                                        <td>
                                            <a href="book_edit/<?= urlencode(base64_encode($book['id'])); ?>" class="btn btn-info btn-sm">Sửa</a>
                                        </td>
                                        <td>
                                            <button type="button" onclick="remove(<?= $book['id']; ?>);" class="btn btn-danger btn-sm">Xóa</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('Admin\layout\footer.php'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function() {
            $('#success-alert').fadeOut('fast');
        }, 3000);
    });
</script>


<script type="text/javascript">
    function remove(id){
        if(confirm('Are you sure you want to delete this data?')){
            $.ajax({
                url : "book_delete",
                data: {id : id},
                type: "POST",
                dataType: "JSON",
                beforeSend:function(){$('#ajax_loader').show();},
                success: function(data){
                    $('#ajax_loader').hide();
                    alert(data);
                    $('#t-'+id).remove();
                },
                error: function (jqXHR, textStatus, errorThrown){
                    alert('Error deleting data');
                }
            });
        }
    }
</script>