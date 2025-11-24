<?php
?>
<section class="services">
  <link rel="stylesheet" href="assets/css/services.css">
  <div class="srv-container">
    <div class="srv-grid" aria-label="Services">
      <?php
      $defaultIcon = 'savings-account.gif';
      $iconDirFs = __DIR__ . '/../assets/img/services/';
      $items=[
        ['title'=>'Savings Account','ribbon'=>'0% GST on All Plans','class'=>'ribbon-green','icon'=>'savings-account-icon.gif'],
        ['title'=>'Current Account','ribbon'=>'0% GST on All Plans','class'=>'ribbon-green','icon'=>'business-account.gif'],
        ['title'=>'Business Account','ribbon'=>'In‑Built Life Cover','class'=>'ribbon-cyan','icon'=>'business-account-icon.gif'],
        ['title'=>'Home Loans','ribbon'=>'Lowest Price Guarantee','class'=>'ribbon-blue','icon'=>'home-loans.gif'],
        ['title'=>'Business Loans','ribbon'=>'Upto 85% Discount','class'=>'ribbon-green','icon'=>'business-loan.gif'],
        ['title'=>'SME/MSME Loans','ribbon'=>'Upto 25% Discount','class'=>'ribbon-green','icon'=>'sme-msme-loans.gif'],
        ['title'=>'Credit Cards','ribbon'=>'Upto 25% Discount','class'=>'ribbon-green','icon'=>'credit-cards.gif'],
        ['title'=>'Property Loans','ribbon'=>'Upto 20% Cheaper','class'=>'ribbon-green','icon'=>'property-loans.gif'],
        ['title'=>'Loan for Schools','ribbon'=>'Upto 65% Discount','class'=>'ribbon-green','icon'=>'school-loans.gif'],
        ['title'=>'Personal Loan','ribbon'=>'Lowest Price Guarantee','class'=>'ribbon-blue','icon'=>'personal-loan.gif'],
        ['title'=>'Special Loans Above ₹ 30 Crore','ribbon'=>'Return of Premium','class'=>'ribbon-cyan','icon'=>'special-loans-upto-30cr.gif'],
        ['title'=>'Two Wheeler Loans','ribbon'=>'100% Guaranteed','class'=>'ribbon-orange','icon'=>'two-wheller-loan.gif'],
        ['title'=>'Four Wheeler Loans','ribbon'=>'Premium Waiver','class'=>'ribbon-pink','icon'=>'four-wheller-loans.gif'],
        ['title'=>'Education Loans','ribbon'=>'Long‑term','class'=>'ribbon-blue','icon'=>'education-loans.gif'],
        ['title'=>'Gold Loan','ribbon'=>'Upto 65% Discount','class'=>'ribbon-green','icon'=>'gold-loan.gif'],
        ['title'=>'Mudra Loan','ribbon'=>'Upto 65% Discount','class'=>'ribbon-green','icon'=>'mudra-loan.gif'],
        ['title'=>'GIC','ribbon'=>'Upto 25% Discount','class'=>'ribbon-green','icon'=>'GIC.gif']
      ];
      foreach($items as $s){
        $iconFile = isset($s['icon']) ? $s['icon'] : $defaultIcon;
        if(!@is_string($iconFile) || !@file_exists($iconDirFs.$iconFile)) { $iconFile = $defaultIcon; }
        $iconSrc = 'assets/img/services/'.$iconFile;
      ?>
      <article class="srv-card">
        <a class="srv-card-link" href="#" aria-label="<?php echo htmlspecialchars($s['title'], ENT_QUOTES); ?>">
          <?php if(!empty($s['ribbon'])){ ?><div class="srv-ribbon <?php echo $s['class']; ?>"><?php echo $s['ribbon']; ?></div><?php } ?>
          <div class="srv-icon">
            <img class="srv-icon-img" src="<?php echo $iconSrc; ?>" alt="<?php echo htmlspecialchars($s['title'], ENT_QUOTES); ?>">
          </div>
          <h3 class="srv-title"><?php echo $s['title']; ?></h3>
        </a>
      </article>
      <?php } ?>
    </div>
  </div>
</section>