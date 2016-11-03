<h3>Nowi klienci</h3>
<div id="clients_charts">
  <ul>
    <li id="clients_first_tab"><a href="#clients_in_month_tab">Klienci w danym miesiącu</a></li>
    <li id="clients_second_tab"><a href="#clients_in_year_tab">Klienci w bieżącym roku</a></li>
    <li id="clients_third_tab"><a href="#clients_in_range_tab">Klienci w okresie</a></li>
  </ul>

  <div id="clients_in_month_tab">

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

  <div id="clients_in_year_tab">

    <h3>Nowi klienci w ujęciu rocznym:</h3>
    <div id="clients_in_year_chart" data-promotorid="<?= $promotor->id ?>"></div>

  </div>

  <div id="clients_in_range_tab">

    <h3>
      Nowi klienci od 
      <input type="text" id="clients_date_from" class="date" name="clients_date_from" value="<?= date('Y-m-d', strtotime("-1 week")) ?>"> 
      do 
      <input type="text" id="clients_date_to" class="date" name="clients_date_to" value="<?= date('Y-m-d') ?>">
      :
    </h3>
    <div id="clients_in_range_chart" data-promotorid="<?= $promotor->id ?>"></div>

  </div>

</div>

<br /><br /><br />

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInMonth.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInYear.js"></script>

<script type="text/javascript" src="/assets/javascript/promotorNewClientsInRange.js"></script>
