;(function(){
var f=document.getElementById('homeLoanForm');
if(!f) return;
var mobile=f.querySelector('#mobile');
if(mobile){mobile.addEventListener('input',function(){this.value=this.value.replace(/[^0-9]/g,'').slice(0,10)})}
})();
;(function(){
var form=document.getElementById('emiForm');
if(!form) return;
var amount=document.getElementById('emiAmount');
var rate=document.getElementById('emiRate');
var years=document.getElementById('emiYears');
var income=document.getElementById('emiIncome');
var btn=document.getElementById('emiCalcBtn');
var emiValue=document.getElementById('emiValue');
var totalPayable=document.getElementById('totalPayable');
var principalVal=document.getElementById('principalVal');
var interestVal=document.getElementById('interestVal');
var emiBadge=document.getElementById('emiBadge');
var needleTop=document.getElementById('emiNeedleTop');
var needleBottom=document.getElementById('emiNeedleBottom');
function n(v){var x=parseFloat(v);return isNaN(x)?0:x}
function fmtINR(val){var x=Math.round(val);return '₹'+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',')}
function clamp(nv,min,max){return Math.max(min,Math.min(max,nv))}
function badgeByRatio(r){if(r<=0.25) return {label:'Low',cls:'badge-under'};if(r<=0.4) return {label:'Okay',cls:'badge-normal'};if(r<=0.6) return {label:'High',cls:'badge-over'};return {label:'Very High',cls:'badge-very'}}
function calc(){var P=n(amount.value);var R=n(rate.value);var Y=n(years.value);if(P<=0||R<=0||Y<=0) return;var rm=R/12/100;var nMonths=Y*12;var pow=Math.pow(1+rm,nMonths);var emi=P*rm*pow/(pow-1);var total=emi*nMonths;var interest=total-P;emiValue.textContent=fmtINR(emi);totalPayable.textContent=fmtINR(total);principalVal.textContent=fmtINR(P);interestVal.textContent=fmtINR(interest);var inc=n(income.value);var ratio=inc>0? emi/inc : 0.35;var info=badgeByRatio(ratio);emiBadge.textContent=info.label;['badge-under','badge-normal','badge-over','badge-very'].forEach(function(c){emiBadge.classList.remove(c)});emiBadge.classList.add(info.cls);var p=clamp(ratio*100,0,100);if(needleTop) needleTop.style.left=p+'%';if(needleBottom) needleBottom.style.left=p+'%';var ratioText=inc>0? Math.round(ratio*100)+'%' : '—';var rEl=document.getElementById('emiIncomeRatio');if(rEl) rEl.textContent=ratioText}
btn.addEventListener('click',calc);
})();