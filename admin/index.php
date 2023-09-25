﻿<?php
require('../carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;

?>


<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
  <div class="box round first grid">
    <h2> Thống kê đơn hàng
      <?php echo Carbon::now('Asia/Ho_Chi_Minh') ?>
    </h2>
    <div class="block">
      <div class="col-md-3">
        Từ ngày <input class="form-control date_from" type="text" id="datepicker_from"></p>
      </div>
      <div class="col-md-3">
        Tới ngày: <input class="form-control date_to" type="text" id="datepicker_to"></p>
      </div>
      <div> <input type="button" value="Lọc theo ngày" class="btn btn-success btn-locngay"> </div>
      <div class="col-md-3">
        Lọc theo : <span id="text-date"></span>
        <select class="form-control select-thongke">
          <option>--Lọc theo---</option>
          <option value="7ngay">--Lọc theo 7 ngày---</option>
          <option value="30ngay">--Lọc theo 30 ngày...--</option>
          <option value="90ngay">--Lọc theo 90 ngày---</option>
          <option value="365ngay">--Lọc theo 1 năm---</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div id="myfirstchart" style="height: 250px;"></div>
      </div>
    </div>
  </div>
</div>
<style></style>
<?php include 'inc/footer.php'; ?>