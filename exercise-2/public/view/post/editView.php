<?= __Include('layout.header') ?>
    <div class="card m-t-20">
        <div class="card-header">
            Sửa User
        </div>
        <div class="card-body card-block">
            <div class="container-fluid">
                <form action="<?= PATH . 'post/post-edit/' . $data['data']['id'] ?>" method="post">
                    <?= __Include('post._form', $data) ?>
                </form>
<!--                <form action="--><?php //= PATH . 'post/post-edit/' . $data['id'] ?><!--" method="post">-->
<!--                    --><?php //= __Include('post._form', $data) ?>
<!--                </form>-->
            </div>
        </div>
    </div>

<?= __Include('layout.footer') ?>