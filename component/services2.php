<?php
?>
<section class="services2">
  <link rel="stylesheet" href="assets/css/services2.css">
  <div class="srv2-container">
    <h3 class="srv2-heading">Credit Score & Bill Payments <span class="srv2-badge">Bharat Connect</span></h3>
    <div class="srv2-grid">
      <?php
      $defaultIcon = 'savings-account.gif';
      $iconDirFs = __DIR__ . '/../assets/img/services/';
      $pay=[
        ['title'=>'Credit Score','icon'=>'credit-score.gif'],
        ['title'=>'Credit Health Report','icon'=>'credit-health-report.gif'],
        ['title'=>'Health Insurance','icon'=>'health-insurance.gif'],
        ['title'=>'Credit Card Bill','icon'=>'credit-card-bill.gif'],
        ['title'=>'Loan Repayment','icon'=>'loan-repayment.gif'],
        ['title'=>'Mobile Recharge','ribbon'=>'Coming Soon','class'=>'ribbon-green','icon'=>'mobile-recharge.gif'],
        ['title'=>'Electricity Bill Payment','ribbon'=>'Coming Soon','class'=>'ribbon-green','icon'=>'electricity-bill-payment.gif'],
        ['title'=>'Warehouse Loans','icon'=>'warehouse-loans.gif']
      ]; foreach($pay as $p){
        $iconFile = isset($p['icon']) ? $p['icon'] : $defaultIcon;
        if(!@is_string($iconFile) || !@file_exists($iconDirFs.$iconFile)) { $iconFile = $defaultIcon; }
        $iconSrc = 'assets/img/services/'.$iconFile;
      ?>
      <article class="srv2-card">
        <?php if(!empty($p['ribbon'])){ ?><div class="srv2-ribbon <?php echo isset($p['class'])?$p['class']:''; ?>"><?php echo $p['ribbon']; ?></div><?php } ?>
        <div class="srv2-icon">
          <img class="srv2-icon-img" src="<?php echo $iconSrc; ?>" alt="<?php echo htmlspecialchars($p['title'], ENT_QUOTES); ?>">
        </div>
        <div class="srv2-title"><?php echo $p['title']; ?></div>
      </article>
      <?php } ?>
    </div>

    <h3 class="srv2-heading">Investment & Insurance Products</h3>
    <div class="srv2-grid">
      <?php $prod=[
        ['title'=>'Banquet Hall Loans','sub'=>'','ribbon'=>'','class'=>'ribbon-green','icon'=>'banquet-hall-loans.gif'],
        ['title'=>'Fixed Deposits','sub'=>'Earn up to 8.05%','ribbon'=>'','class'=>'ribbon-green','icon'=>'fix-deposits.gif'],
        ['title'=>'Bike Insurance','icon'=>'bike-insurance.gif'],
        ['title'=>'National Pension Scheme','icon'=>'national-pension-scheme.gif'],
        ['title'=>'Health Insurance','ribbon'=>'0% GST','class'=>'ribbon-green','icon'=>'health-insurance.gif'],
        ['title'=>'Term Life Insurance','ribbon'=>'0% GST','class'=>'ribbon-green','icon'=>'term-life-insurance.gif'],
        ['title'=>'Car Insurance','ribbon'=>'Lowest Price','class'=>'ribbon-blue','icon'=>'car-insurance.gif'],
        ['title'=>'All Insurance Products','icon'=>'all-insurance.gif']
      ]; foreach($prod as $p){
        $iconFile = isset($p['icon']) ? $p['icon'] : $defaultIcon;
        if(!@is_string($iconFile) || !@file_exists($iconDirFs.$iconFile)) { $iconFile = $defaultIcon; }
        $iconSrc = 'assets/img/services/'.$iconFile;
      ?>
      <article class="srv2-card">
        <?php if(!empty($p['ribbon'])){ ?><div class="srv2-ribbon <?php echo isset($p['class'])?$p['class']:''; ?>"><?php echo $p['ribbon']; ?></div><?php } ?>
        <div class="srv2-icon">
          <img class="srv2-icon-img" src="<?php echo $iconSrc; ?>" alt="<?php echo htmlspecialchars($p['title'], ENT_QUOTES); ?>">
        </div>
        <div class="srv2-title"><?php echo $p['title']; ?></div>
        <?php if(!empty($p['sub'])){ ?><div class="srv2-sub"><?php echo $p['sub']; ?></div><?php } ?>
      </article>
      <?php } ?>
    </div>
  </div>
</section>