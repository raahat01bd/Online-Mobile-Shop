<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to </title>
    <style>
        /* Basic Reset */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: radial-gradient(circle,rgb(5, 33, 161),rgba(0,16,85,1));
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #fff;
            overflow: hidden;
        }

        /* H1 Styling */
        h1 {
            font-size: 4.25rem;
            text-align: center;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 3px;
            background: linear-gradient(90deg,rgb(131, 7, 233), #ff8c00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textGlow 3s ease-in-out infinite alternate;
        }

        /* Line Under H1 */
        h1::after {
            content: "";
            position: absolute;
            display: block;
            width: 0;
            height: 4px;
            background:rgb(187, 0, 255);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            animation: underline 2s ease-in-out forwards 1s;
        }

        /* Keyframes for Underline Animation */
        @keyframes underline {
            from {
                width: 0;
            }
            to {
                width: 80%;
            }
        }
    </style>
</head>
<body>
    <h1>Welcome to  <?php echo $_settings->info('name') ?></h1>
</body>
</html>
<hr>
<div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-blue elevation-1"><i class="fas fa-mobile-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Stocks</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
                    $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
                    echo number_format($inv - $sales);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-th-list"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Orders</span>
                <span class="info-box-number">
                  <?php 
                    $pending = $conn->query("SELECT sum(id) as total FROM `orders` where status = '0' ")->fetch_assoc()['total'];
                    echo number_format($pending);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Sales Today</span>
                <span class="info-box-number">
                <?php 
                    $sales = $conn->query("SELECT sum(amount) as total FROM `orders` where date(date_created) = '".date('Y-m-d')."' ")->fetch_assoc()['total'];
                    echo number_format($sales);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
<div class="container">
  <?php 
    $files = array();
      $fopen = scandir(base_app.'uploads/banner');
      foreach($fopen as $fname){
        if(in_array($fname,array('.','..')))
          continue;
        $files[]= validate_image('uploads/banner/'.$fname);
      }
  ?>
  <div id="tourCarousel"  class="carousel slide" data-ride="carousel" data-interval="3000">
      <div class="carousel-inner h-100">
          <?php foreach($files as $k => $img): ?>
          <div class="carousel-item  h-100 <?php echo $k == 0? 'active': '' ?>">
              <img class="d-block w-100  h-100" style="object-fit:contain" src="<?php echo $img ?>" alt="">
          </div>
          <?php endforeach; ?>
      </div>
      <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
  </div>
</div>
