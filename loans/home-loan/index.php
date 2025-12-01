<?php
$scheme = (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO']) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] : (((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443)) ? 'https' : 'http');
$host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
$script = isset($_SERVER['SCRIPT_NAME']) ? str_replace('\\','/', $_SERVER['SCRIPT_NAME']) : '/';
$dir = rtrim(dirname($script), '/');
$basePath = ($dir === '/' || $dir === '.') ? '/' : ($dir . '/');
$origin = $scheme . '://' . $host;
$canonical = $origin . $basePath;
$seoTitle = 'Home Loan - Apply Online';
$seoBrand = 'Unique Finance Group';
$fullTitle = $seoTitle.' - '.$seoBrand;
$seoDescription = 'Apply for a home loan online. Compare benefits and submit your details securely. Mobile responsive, easy and quick form.';
$ogImagePath = '/assets/img/hero/personal-loan-upto-50-lakhs.png';
$ogImage = $origin . $ogImagePath;
$submitted = isset($_GET['success']);
$error = isset($_GET['error']) ? $_GET['error'] : '';
$successMsg = 'Your home loan request has been submitted.';
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta name="theme-color" content="#0b46c1">
  <meta property="og:title" content="<?php echo htmlspecialchars($fullTitle, ENT_QUOTES); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($seoDescription, ENT_QUOTES); ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?php echo htmlspecialchars($canonical, ENT_QUOTES); ?>">
  <meta property="og:site_name" content="<?php echo htmlspecialchars($seoBrand, ENT_QUOTES); ?>">
  <meta property="og:locale" content="en_US">
  <meta property="og:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
  <link rel="stylesheet" href="../../assets/css/home-loan.css">
  <script defer src="../../assets/js/home-loan.js"></script>
</head>
<body>
  <?php include __DIR__.'/../../includes/header.php'; ?>
  <section class="hl">
    <div class="hl-container">
      <div class="hl-hero">
        <div class="hero-copy">
          <h1>Home Loan</h1>
          <p>Finance your dream home with flexible tenure, competitive rates, and a seamless online application.</p>
          <ul class="hero-points">
            <li>Loan amounts up to ₹5 Cr</li>
            <li>Tenure up to 30 years</li>
            <li>Fast approvals and doorstep assistance</li>
          </ul>
        </div>
      </div>
      <div class="hl-grid">
        <div class="hl-form">
          <div class="card">
            <div class="card-title">Apply for Home Loan</div>
            <?php if($error): ?><div class="alert alert-error"><?php echo htmlspecialchars($error, ENT_QUOTES); ?></div><?php endif; ?>
            <?php if($submitted && !$error): ?><div class="alert alert-success"><?php echo htmlspecialchars($successMsg, ENT_QUOTES); ?></div><?php endif; ?>
            <form method="post" id="homeLoanForm" action="../../insert-db/home-loan-insert.php" novalidate>
              <div class="fields">
                <div class="field-group">
                  <label for="name">Full name</label>
                  <input type="text" id="name" name="name" required value="<?php echo isset($name)?htmlspecialchars($name,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="mobile">Mobile</label>
                  <input type="tel" id="mobile" name="mobile" required inputmode="numeric" pattern="[0-9]{10}" placeholder="9876543210" value="<?php echo isset($mobile)?htmlspecialchars($mobile,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" name="email" required value="<?php echo isset($email)?htmlspecialchars($email,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="city">City</label>
                  <input type="text" id="city" name="city" required value="<?php echo isset($city)?htmlspecialchars($city,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="employment">Employment</label>
                  <select id="employment" name="employment">
                    <option value="Salaried" <?php echo (isset($employment)&&$employment==='Salaried')?'selected':''; ?>>Salaried</option>
                    <option value="Self-employed" <?php echo (isset($employment)&&$employment==='Self-employed')?'selected':''; ?>>Self-employed</option>
                  </select>
                </div>
                <div class="field-group">
                  <label for="income">Monthly income (₹)</label>
                  <input type="number" id="income" name="income" min="10000" step="100" inputmode="decimal" placeholder="50000" value="<?php echo isset($income)?htmlspecialchars($income,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="property_value">Property value (₹)</label>
                  <input type="number" id="property_value" name="property_value" min="100000" step="1000" inputmode="decimal" placeholder="5000000" value="<?php echo isset($property_value)?htmlspecialchars($property_value,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="loan_amount">Loan amount (₹)</label>
                  <input type="number" id="loan_amount" name="loan_amount" min="100000" step="1000" inputmode="decimal" placeholder="3500000" value="<?php echo isset($loan_amount)?htmlspecialchars($loan_amount,ENT_QUOTES):''; ?>">
                </div>
                <div class="field-group">
                  <label for="tenure_years">Tenure (years)</label>
                  <input type="number" id="tenure_years" name="tenure_years" min="1" max="30" step="1" inputmode="numeric" placeholder="20" value="<?php echo isset($tenure_years)?htmlspecialchars($tenure_years,ENT_QUOTES):''; ?>">
                </div>
              </div>
              <button type="submit" class="btn">Apply Now</button>
            </form>
          </div>
        </div>
        <div class="hl-info">
          <div class="card">
            <div class="card-title">Benefits</div>
            <ul class="list">
              <li>Competitive rates with quick turnaround</li>
              <li>Flexible repayment options</li>
              <li>Balance transfer and top‑up facility</li>
              <li>Transparent charges and minimal paperwork</li>
            </ul>
            <div class="cta-block">
              <div>Need help choosing the right plan?</div>
              <a class="btn btn-secondary" href="#homeLoanForm">Talk to an expert</a>
            </div>
          </div>
        </div>
      </div>
      <section class="hl-ad">
        <div class="ad-card">
          <img src="../../assets/img/hero/personal-loan-upto-50-lakhs.png" alt="Home Loan Offers" class="ad-img">
          <div class="ad-overlay">
            <div class="ad-text">Special Home Loan Offers</div>
            <a class="btn btn-secondary" href="#homeLoanForm">Apply Now</a>
          </div>
        </div>
      </section>
      <section class="hl-charges">
        <h2>Home Loan Charges & Fees</h2>
        <div class="charges-grid">
          <article class="charge-card">
            <div class="charge-name">Processing fees</div>
            <div class="charge-desc">One‑time, non‑refundable fee payable post approval; varies by lender and scheme.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Prepayment charges</div>
            <div class="charge-desc">Penalty if the loan is repaid before tenure completion; policy depends on lender and rate type.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Conversion fees</div>
            <div class="charge-desc">Charged when switching to a different scheme to lower interest for the existing loan.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Cheque dishonour charges</div>
            <div class="charge-desc">Fee when a cheque is returned due to insufficient funds.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">External opinion fees</div>
            <div class="charge-desc">If consulting a lawyer or valuator, the fee is paid directly to the expert, not the lender.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Home insurance</div>
            <div class="charge-desc">Premium paid to the insurer during the term to keep the policy active throughout loan tenure.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Default charges</div>
            <div class="charge-desc">Penalty on delayed payments for EMIs or Pre‑EMIs; varies across lenders.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Incidental charges</div>
            <div class="charge-desc">Expenses incurred by the lender to recover dues from a borrower who missed payments.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Statutory/regulatory charges</div>
            <div class="charge-desc">Costs related to CERSAI, Memorandum of Entry and Deposit, and stamp duty.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Photocopy of documents</div>
            <div class="charge-desc">Fee payable to the lender for copies of loan documents for personal needs.</div>
          </article>
          <article class="charge-card">
            <div class="charge-name">Change in loan term</div>
            <div class="charge-desc">Nominal fee if you request a change in tenure during repayment.</div>
          </article>
        </div>
      </section>
      <section class="hl-emi">
        <h2>Home Loan EMI Calculator</h2>
        <div class="emi-grid">
          <div class="card emi-form">
            <div class="card-title">Calculate EMI</div>
            <form id="emiForm" novalidate>
              <div class="fields">
                <div class="field-group">
                  <label for="emiAmount">Loan amount (₹)</label>
                  <input type="number" id="emiAmount" min="100000" step="1000" inputmode="decimal" placeholder="3500000">
                </div>
                <div class="field-group">
                  <label for="emiRate">Interest rate (% p.a.)</label>
                  <input type="number" id="emiRate" min="6" max="18" step="0.1" inputmode="decimal" placeholder="8.5">
                </div>
                <div class="field-group">
                  <label for="emiYears">Tenure (years)</label>
                  <input type="number" id="emiYears" min="1" max="30" step="1" inputmode="numeric" placeholder="20">
                </div>
                <div class="field-group">
                  <label for="emiIncome">Monthly income (optional)</label>
                  <input type="number" id="emiIncome" min="0" step="100" inputmode="decimal" placeholder="80000">
                </div>
              </div>
              <button type="button" class="btn" id="emiCalcBtn">Calculate EMI</button>
            </form>
          </div>
          <div class="card emi-result" aria-live="polite">
            <div class="card-title">Your EMI</div>
            <div class="result-top">
              <div class="result-main">
                <div class="result-value" id="emiValue">₹0</div>
                <span class="result-badge badge-under" id="emiBadge">Low</span>
              </div>
              <div class="result-range">
                <div>Total payable</div>
                <div class="range-values" id="totalPayable">—</div>
              </div>
            </div>
            <div class="gauge">
              <div class="indicator indicator-top" id="emiNeedleTop"></div>
              <div class="gauge-track">
                <span class="seg seg1">Low</span>
                <span class="seg seg2">Okay</span>
                <span class="seg seg3">High</span>
                <span class="seg seg4">Very High</span>
              </div>
              <div class="indicator indicator-bottom" id="emiNeedleBottom"></div>
            </div>
            <div class="emi-break">
              <div class="break-item">
                <div>Principal</div>
                <div class="break-val" id="principalVal">—</div>
              </div>
              <div class="break-item">
                <div>Interest</div>
                <div class="break-val" id="interestVal">—</div>
              </div>
              <div class="break-item">
                <div>EMI/Income</div>
                <div class="break-val" id="emiIncomeRatio">—</div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="hl-elig">
        <div class="card">
          <div class="card-title">Home Loan Eligibility</div>
          <table class="elig-table">
            <thead>
              <tr>
                <th>Eligibility Criteria</th>
                <th>Requirement</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Age</td>
                <td>Minimum Age: 18 years and Maximum Age: 70 years</td>
              </tr>
              <tr>
                <td>Resident Type</td>
                <td>
                  <span class="chip">Resident Indian</span>
                  <span class="chip">Non-Resident India (NRI)</span>
                  <span class="chip">Person of Indian Origin (PIO)</span>
                </td>
              </tr>
              <tr>
                <td>Employment</td>
                <td>
                  <span class="chip">Salaried</span>
                  <span class="chip">Self-employed</span>
                </td>
              </tr>
              <tr>
                <td>Net Annual Income</td>
                <td>At least Rs.5–6 lakh depending on the type of employment</td>
              </tr>
              <tr>
                <td>Residence</td>
                <td>
                  <span class="chip">Permanent residence</span>
                  <span class="chip">Rented residence with ≥1 year at address</span>
                </td>
              </tr>
              <tr>
                <td>Credit score</td>
                <td>A good credit score of at least 750 or more obtained from a recognised credit bureau</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <section class="hl-nri">
        <div class="card">
          <div class="card-title">Documents Required from all Non-Resident Indians (NRIs) Applicants</div>
          <table class="nri-table">
            <thead>
              <tr>
                <th>Identity Proof (any one)</th>
                <th>Residence Proof (any one)</th>
                <th>Other Documents</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td data-label="Identity Proof (any one)">
                  <ul class="ticks">
                    <li>PAN</li>
                    <li>Valid Passport</li>
                    <li>Driver's License</li>
                    <li>Employer Identity Card</li>
                    <li>Voter ID Card</li>
                    <li>Aadhaar Card</li>
                  </ul>
                </td>
                <td data-label="Residence Proof (any one)">
                  <ul class="ticks">
                    <li>Telephone bill</li>
                    <li>Electricity bill</li>
                    <li>Water bill</li>
                    <li>Piped Gas bill</li>
                    <li>Proof of residence indicating the applicant's current overseas address</li>
                  </ul>
                </td>
                <td data-label="Other Documents">
                  <ul class="ticks">
                    <li>Attested copy of the applicant's/co-applicants'/guarantor's valid passport and visa</li>
                    <li>If employed in Merchant Navy: Copy of Continuous Discharge Certificate (CDC)</li>
                    <li>PIO Card issued by the Government of India (if applicant/co-applicant is a PIO)</li>
                    <li>Completed loan application form with three passport size photographs of applicant and co-applicants</li>
                    <li>Attestation acceptable by:
                      <ul class="ticks">
                        <li>Indian Embassy/Consulate</li>
                        <li>Overseas Notary Public</li>
                        <li>FOs/Representative Offices</li>
                        <li>Officials of Branch/Sourcing Units based in India</li>
                      </ul>
                    </li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>
      <section class="hl-offers">
        <h2>Top Housing Loan Schemes & Offers</h2>
        <div class="offer-grid">
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="Kotak Mahindra Bank logo" title="Kotak Mahindra Bank" src="../../assets/img/brands/kotak-mahindra-group-logo.svg"/>
              <div class="bank-name">Kotak Mahindra Bank</div>
              <div class="bank-tag">Best for Low-Interest Rate</div>
            </div>
            <ul class="offer-list">
              <li>Low interest from 7.99% p.a.</li>
              <li>Processing fee up to 0.50% of loan</li>
              <li>Tenure up to 25 years</li>
              <li>Zero prepayment charges</li>
              <li>Balance transfer with top‑up available</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="Canara Bank logo" title="Canara Bank" src="../../assets/img/brands/Canara_Bank_Logo.svg"/>
              <div class="bank-name">Canara Bank Housing Loan</div>
              <div class="bank-tag">Best Interest Rate for Women</div>
            </div>
            <ul class="offer-list">
              <li>Interest from 7.40% to 10.20% p.a.</li>
              <li>Tenure up to 30 years or age 70</li>
              <li>Processing fee up to 0.50% of loan</li>
              <li>Purchase or construction of house/flat</li>
              <li>Zero prepayment charges</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="Axis Bank logo" title="Axis Bank" src="../../assets/img/brands/Axis-bank-logo.svg"/>
              <div class="bank-name">Axis Bank Home Loan</div>
              <div class="bank-tag">Best for Salaried Employees</div>
            </div>
            <ul class="offer-list">
              <li>Interest from 8.35% p.a.</li>
              <li>Loan ₹3 lakh to ₹5 crore</li>
              <li>Tenure up to 30 years</li>
              <li>Processing fee up to 1% of loan</li>
              <li>No prepayment/foreclosure charges</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="HDFC Bank logo" title="HDFC Reach Home Loans" src="../../assets/img/brands/hdfc-bank-logo.png"/>
              <div class="bank-name">HDFC Reach Home Loans</div>
              <div class="bank-tag">For self‑employed or salaried</div>
            </div>
            <ul class="offer-list">
              <li>Interest from 7.90% to 13.20% p.a.</li>
              <li>Flexible tenure up to 30 years</li>
              <li>Processing fee 2% of loan</li>
              <li>Minimal documentation; min income ₹2 lakh p.a.</li>
              <li>Add woman co‑owner for lower rates</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="SBI logo" title="SBI Privilege Home Loan" src="../../assets/img/brands/sbi-bank-logo.svg"/>
              <div class="bank-name">SBI Privilege Home Loan</div>
              <div class="bank-tag">For Government Employees</div>
            </div>
            <ul class="offer-list">
              <li>Zero processing fee</li>
              <li>Tenure up to 30 years</li>
              <li>Reduced rates for women borrowers</li>
              <li>Interest concession with checkoff</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="Punjab National Bank logo" title="PNB HFL Plot Loan" src="../../assets/img/brands/punjab-national-bank-logo.svg"/>
              <div class="bank-name">PNB HFL Plot Loan</div>
              <div class="bank-tag">Best for Plot and Construction</div>
            </div>
            <ul class="offer-list">
              <li>Rates from 9.25% p.a.</li>
              <li>Tenure up to 30 years</li>
              <li>Processing fee up to 0.5%</li>
              <li>Loan enhancement for escalating costs</li>
              <li>Quick application and approval</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="SBI logo" title="SBI Realty Home Loan" src="../../assets/img/brands/sbi-bank-logo.svg"/>
              <div class="bank-name">SBI Realty Home Loan</div>
              <div class="bank-tag">Best for Land Purchase</div>
            </div>
            <ul class="offer-list">
              <li>Rates from 7.50% p.a.</li>
              <li>Maximum tenure ten years</li>
              <li>Processing fee up to 0.35%</li>
              <li>Maximum loan up to ₹15 crore</li>
              <li>Concession for women borrowers</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="SBI logo" title="SBI Smart Home Top-Up Loan" src="../../assets/img/brands/sbi-bank-logo.svg"/>
              <div class="bank-name">SBI Smart Home Top‑Up Loan</div>
              <div class="bank-tag">Best Top Up home loan</div>
            </div>
            <ul class="offer-list">
              <li>Rates from 7.50% to 10.75% p.a.</li>
              <li>Processing fee ₹2,000 + GST (min) to ₹10,000 + GST (max)</li>
              <li>Overdraft for loans above ₹20 lakh</li>
              <li>Tenure up to 30 years</li>
              <li>No prepayment penalty</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="Union Bank of India logo" title="Union Awas Home Loan" src="../../assets/img/brands/union-bank-of-india-logo.svg"/>
              <div class="bank-name">Union Awas Home Loan</div>
              <div class="bank-tag">Best for Low Credit Score</div>
            </div>
            <ul class="offer-list">
              <li>Interest from 7.45% p.a.</li>
              <li>Moratorium up to 3 years for construction/purchase</li>
              <li>Tenure up to 30 years</li>
              <li>Seasonal repayment options for agriculturists</li>
              <li>Open to certain employees/agriculturists with income caps</li>
            </ul>
          </article>
          <article class="offer-card">
            <div class="offer-head">
              <img class="bank-logo" loading="lazy" decoding="async" width="64" height="64" alt="Punjab National Bank logo" title="Punjab National Bank" src="../../assets/img/brands/punjab-national-bank-logo.svg"/>
              <div class="bank-name">Punjab National Bank</div>
              <div class="bank-tag">Best for Low-Interest Rate</div>
            </div>
            <ul class="offer-list">
              <li>Interest from 8.25% p.a.</li>
              <li>Processing fee up to 0.35% of loan</li>
              <li>Tenure up to 30 years</li>
              <li>Loans up to ₹100 lakh</li>
              <li>Plot loans also offered</li>
            </ul>
          </article>
        </div>
        <script type="application/ld+json">
        <?php echo json_encode([
          '@context' => 'https://schema.org',
          '@type' => 'ItemList',
          'name' => 'Top Housing Loan Schemes & Offers',
          'itemListElement' => [
            ['@type' => 'ListItem','position'=>1,'name'=>'Kotak Mahindra Bank','description'=>'Low-interest rates from 7.99% p.a., tenure up to 25 years, zero prepayment'],
            ['@type' => 'ListItem','position'=>2,'name'=>'Canara Bank Housing Loan','description'=>'Interest from 7.40% p.a., tenure up to 30 years, women benefits'],
            ['@type' => 'ListItem','position'=>3,'name'=>'Axis Bank Home Loan','description'=>'Interest from 8.35% p.a., ₹3 lakh to ₹5 crore, tenure up to 30 years'],
            ['@type' => 'ListItem','position'=>4,'name'=>'HDFC Reach Home Loans','description'=>'Interest from 7.90% to 13.20% p.a., flexible tenure, minimal docs'],
            ['@type' => 'ListItem','position'=>5,'name'=>'SBI Privilege Home Loan','description'=>'Zero processing fee, reduced rates for women, tenure up to 30 years'],
            ['@type' => 'ListItem','position'=>6,'name'=>'PNB HFL Plot Loan','description'=>'Rates from 9.25% p.a., tenure up to 30 years, enhancement available'],
            ['@type' => 'ListItem','position'=>7,'name'=>'SBI Realty Home Loan','description'=>'Rates from 7.50% p.a., tenure ten years, loan up to ₹15 crore'],
            ['@type' => 'ListItem','position'=>8,'name'=>'SBI Smart Home Top‑Up Loan','description'=>'Rates from 7.50% to 10.75% p.a., overdraft facility, tenure up to 30 years'],
            ['@type' => 'ListItem','position'=>9,'name'=>'Union Awas Home Loan','description'=>'Interest from 7.45% p.a., moratorium, tenure up to 30 years'],
            ['@type' => 'ListItem','position'=>10,'name'=>'Punjab National Bank','description'=>'Rates from 8.25% p.a., tenure up to 30 years, loans up to ₹100 lakh']
          ]
        ], JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE); ?>
        </script>
      </section>
      <section class="hl-faq">
        <h2>Home Loan FAQs</h2>
        <div class="faq-list">
          <details>
            <summary>What documents are needed?</summary>
            <div>Address and identity proof, income proof, property documents, bank statements.</div>
          </details>
          <details>
            <summary>How is eligibility calculated?</summary>
            <div>Primarily based on income, existing liabilities, credit profile, property value, and tenure.</div>
          </details>
          <details>
            <summary>Can I prepay without penalty?</summary>
            <div>Policies vary by lender; many allow part‑prepayment with minimal or no charges on floating rate loans.</div>
          </details>
          <details>
            <summary>What is a home loan?</summary>
            <div>A home loan is a secured loan to buy a residential property. It can be used for ready houses, apartments, or under‑construction units and is offered by banks and NBFCs.</div>
          </details>
          <details>
            <summary>Which is the best bank for home loan?</summary>
            <div>Compare lenders on interest rate, LTV, processing fees, and tenure. Use a home loan EMI calculator to estimate EMI before applying.</div>
          </details>
          <details>
            <summary>How long does it take to get a home loan sanctioned?</summary>
            <div>Usually 3–4 weeks, depending on document verification and property evaluation.</div>
          </details>
          <details>
            <summary>Which factors determine my home loan eligibility?</summary>
            <div>Age, annual income, occupation stability, resident type, co‑applicants, credit score, and ongoing loans influence eligibility.</div>
          </details>
          <details>
            <summary>What is the difference between fixed and floating rate?</summary>
            <div>Fixed rate remains constant through the tenure. Floating rate changes with RBI policy rates, so EMIs can increase or decrease over time.</div>
          </details>
          <details>
            <summary>Can I prepay my outstanding home loan amount?</summary>
            <div>Yes. Floating‑rate loans typically have no prepayment fee; fixed‑rate loans may charge up to ~2% as penalty.</div>
          </details>
          <details>
            <summary>Can I avail tax deductions on my home loan?</summary>
            <div>Section 80C allows deductions up to ₹1.5 lakh on principal; Section 24 allows up to ₹2 lakh on interest annually, subject to conditions.</div>
          </details>
          <details>
            <summary>Who can be a co‑applicant?</summary>
            <div>Immediate family members such as spouse, parents, or major children.</div>
          </details>
          <details>
            <summary>What is Pre‑EMI?</summary>
            <div>Interest paid on the partially disbursed amount until full disbursement; regular EMI begins after full disbursal.</div>
          </details>
          <details>
            <summary>Can I switch from fixed to floating rate?</summary>
            <div>Yes, by paying a conversion fee as per lender policy.</div>
          </details>
          <details>
            <summary>When does my loan repayment period begin?</summary>
            <div>After full disbursement. Pre‑EMI is payable monthly on partial disbursals until full disbursal.</div>
          </details>
          <details>
            <summary>Can I take two home loans at the same time?</summary>
            <div>Yes, if you qualify for multiple EMIs. Tax treatment may differ and property status (self‑occupied or let‑out) must be declared.</div>
          </details>
          <details>
            <summary>Can I get 100% financing?</summary>
            <div>No. Lenders finance up to a set percentage of property value and require margin contribution from the borrower.</div>
          </details>
          <details>
            <summary>Does a personal loan affect home loan eligibility?</summary>
            <div>Yes. Existing loans reduce eligible EMI capacity and can impact approval or sanctioned amount.</div>
          </details>
          <details>
            <summary>Can I buy a house with two loans?</summary>
            <div>No. Two home loans for the same property is not permitted and is treated as fraudulent.</div>
          </details>
          <details>
            <summary>How do joint home loans work?</summary>
            <div>Add a co‑applicant (spouse, parents, immediate family) to improve eligibility; both share repayment responsibility.</div>
          </details>
        </div>
      </section>
    </div>
  </section>
  <?php include __DIR__.'/../loans-footer.php'; ?>
</body>
</html>
