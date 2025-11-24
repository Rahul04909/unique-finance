<?php
?>
<section class="brands">
  <link rel="stylesheet" href="assets/css/brands.css">
  <div class="brands-container">
    <h3 class="brands-heading">Group Brands</h3>
    <div class="brands-ticker" aria-label="Group brands">
      <div class="brands-track">
        <span class="brand"><img src="assets/img/brands/hdfc-bank-logo.png" alt="HDFC Bank Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/sbi-bank-logo.svg" alt="SBI Bank Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/hsbc-bank-logo.svg" alt="HSBC Bank Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/mufg-union-bank-logo.svg" alt="MUFG Union Bank Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/lic-logo.svg" alt="LIC Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/icici-bank-logo.svg" alt="ICICI Bank Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/Bajaj-Finserv-logo.svg" alt="Bajaj Finserv Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/kotak-mahindra-group-logo.svg" alt="Kotak Mahindra Group Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/bank-of-baroda-logo.svg" alt="Bank of Baroda Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/bank-of-america-logo.svg" alt="Bank of America Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/union-bank-of-india-logo.svg" alt="Union Bank of India Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/punjab-national-bank-logo.svg" alt="Punjab National Bank Logo" class="brand-img"></span>
        <span class="brand"><img src="assets/img/brands/Axis-bank-logo.svg" alt="Axis Bank Logo" class="brand-img"></span>
      </div>
    </div>
  </div>
  <script>
  (function(){
    var t=document.querySelector('.brands-track');
    if(!t) return;
    var pause=false;
    var ticker=document.querySelector('.brands-ticker');
    if(ticker){ticker.addEventListener('mouseenter',function(){t.style.animationPlayState='paused'});ticker.addEventListener('mouseleave',function(){t.style.animationPlayState='running'})}
  })();
  </script>
</section>