    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Заказ &numero; <?=$order['id'];?>
      </h1>
      <ol class="breadcrumb">
      <li><a href="<?=ADMIN?>"><i class="fa fa-dashboard"></i>Главная</a></li>
      <li class="active">Список заказов</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-body">
              <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <tbody>
                  <tr >
                    <td>Заказ</td>
                    <td><?=$order['id']?></td>
                  </tr>
                  <tr >
                    <td>Статус</td>
                    <td><?=$order['status']?></td>
                  </tr>
                  <tr >
                    <td>Покупатель</td>
                    <td><?=$order['name']?></td>
                  </tr>
                  <tr >
                    <td>Сумма</td>
                    <td><?=$order['sum']?> <?=$order['currency']?></td>
                  </tr>
                  <tr >
                    <td>Комментарии</td>
                    <td><?=$order['notes']?></td>
                  </tr>
                </tbody>
              </table>
              </div>
            </div>
          </div>
          <h3>Детали заказа</h3>
          <div class="box">
            <div class="box-body">
              <div class="table-responsive">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Наименование</th>
                      <th>Кол-во</th>
                      <th>Цена</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($order_products as $product): ?>
                      <tr>
                        <td><?=$product->product_id?></td>
                        <td><?=$product->title?></td>
                        <td><?=$product->qty?></td>
                        <td><?=$product->price?></td>
                      </tr>
                    <?php endforeach; ?>
                    <tr class="active">
                      <td colspan="3">
                        <b>Итого:</b>
                      </td>
                      <td><?=$order['sum']?> <?=$order['currency']?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

