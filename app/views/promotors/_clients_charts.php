<h1 class="stats-title">Nowi klienci</h1>

<div class="l2-tabs-box">
  <div class="l2-tab-1 l2-tab-active">
    Klienci w danym miesiącu
  </div>
  <div class="l2-tab-2 l2-tab-inactive">
    Klienci w bieżącym roku
  </div>
  <div class="l2-tab-3 l2-tab-inactive">
    Klienci w okresie
  </div>
</div>

<div class="l2-tab-content l2-tab-1-content">

  <h3>Nowi klienci w miesiącu 
  <select class="clients_month" name="clients_month">
    <?php
      for ($i=1; $i <= date("m"); $i++) { ?>
        <option value="<?= $i ?>" <?php if ($i==date("m")) { echo "selected=selected"; } ?>>
          <?= PolishMonthName::NAMES[$i] ?>
        </option>
      <?php }
    ?>
  </select>
  <?= date("Y") ?> roku</h3>
  <div id="clients_in_month_chart" data-promotorid="<?= $promotor->id ?>"></div>
    
</div>

<div class="l2-tab-content l2-tab-2-content">

  <h3>Nowi klienci w ujęciu rocznym:</h3>
  <div id="clients_in_year_chart" data-promotorid="<?= $promotor->id ?>"></div>

</div>

<div class="l2-tab-content l2-tab-3-content">

  <h3>
    Nowi klienci od 
    <input type="text" id="clients_date_from" class="datepick" name="clients_date_from" value="<?= date('Y-m-d', strtotime("-1 week")) ?>"> 
    do 
    <input type="text" id="clients_date_to" class="datepick" name="clients_date_to" value="<?= date('Y-m-d') ?>">
    :
  </h3>
  <div id="clients_in_range_chart" data-promotorid="<?= $promotor->id ?>"></div>

</div>

<br /><br /><br />

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInMonth.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInYear.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInRange.js"></script>
