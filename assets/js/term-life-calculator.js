;(function(){
var form=document.getElementById('tlcForm');
if(!form) return;
var age=document.getElementById('age');
var retireAge=document.getElementById('retireAge');
var income=document.getElementById('income');
var expenses=document.getElementById('expenses');
var loans=document.getElementById('loans');
var savings=document.getElementById('savings');
var btn=document.getElementById('tlcCalcBtn');
var sumAssured=document.getElementById('sumAssured');
var adequacyBadge=document.getElementById('adequacyBadge');
var rangeMinSa=document.getElementById('rangeMinSa');
var rangeMaxSa=document.getElementById('rangeMaxSa');
var premiumValue=document.getElementById('premiumValue');
var needleTop=document.getElementById('tlcNeedleTop');
var needleBottom=document.getElementById('tlcNeedleBottom');
function n(v){var x=parseFloat(v);return isNaN(x)?0:x}
function clamp(nv,min,max){return Math.max(min,Math.min(max,nv))}
function fmtINR(val){var x=Math.round(val);return '₹'+x.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',')}
function adequacyClass(r){if(r<10) return {label:'Low',cls:'badge-under'};if(r<20) return {label:'Adequate',cls:'badge-normal'};if(r<25) return {label:'High',cls:'badge-over'};return {label:'Very High',cls:'badge-very'}}
function ratePerLakh(a){if(a<=30) return 120; if(a<=40) return 160; if(a<=50) return 240; return 350}
function calc(){var a=n(age.value);var ra=n(retireAge.value);var inc=n(income.value);var exp=n(expenses.value);var ln=n(loans.value);var sv=n(savings.value);if(a<=0||ra<=a||inc<=0) return;var years=ra-a;var base=inc*years;var adjust=ln-sv;var suggested=Math.max(base+adjust,0);var min=suggested*0.8;var max=suggested*1.2;sumAssured.textContent=fmtINR(suggested);rangeMinSa.textContent=fmtINR(min);rangeMaxSa.textContent=fmtINR(max);var ratio=inc>0? (suggested/(inc*1.0)) : 0;var info=adequacyClass(ratio);adequacyBadge.textContent=info.label;['badge-under','badge-normal','badge-over','badge-very'].forEach(function(c){adequacyBadge.classList.remove(c)});adequacyBadge.classList.add(info.cls);var p=inc>0? clamp((suggested/(inc*25))*100,0,100):0;if(needleTop) needleTop.style.left=p+'%';if(needleBottom) needleBottom.style.left=p+'%';var perLakh=ratePerLakh(a);var annual=(suggested/100000)*perLakh;var monthly=annual/12;premiumValue.textContent=fmtINR(monthly)}
btn.addEventListener('click',calc);
['input','change'].forEach(function(ev){[age,retireAge,income,expenses,loans,savings].forEach(function(el){if(el) el.addEventListener(ev,function(){})})});
})();