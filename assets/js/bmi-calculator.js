;(function(){
var form=document.getElementById('bmiForm');
if(!form) return;
var unitInputs=[].slice.call(form.querySelectorAll('input[name="unit"]'));
var metricEls=[].slice.call(form.querySelectorAll('.metric'));
var imperialEls=[].slice.call(form.querySelectorAll('.imperial'));
var heightCm=document.getElementById('heightCm');
var weightKg=document.getElementById('weightKg');
var heightFt=document.getElementById('heightFt');
var heightIn=document.getElementById('heightIn');
var weightLb=document.getElementById('weightLb');
var btn=document.getElementById('calcBtn');
var bmiValue=document.getElementById('bmiValue');
var bmiBadge=document.getElementById('bmiBadge');
var rangeMin=document.getElementById('rangeMin');
var rangeMax=document.getElementById('rangeMax');
var needleTop=document.getElementById('needleTop');
var needleBottom=document.getElementById('needleBottom');
function showUnit(u){var isMetric=u==='metric';metricEls.forEach(function(el){el.style.display=isMetric?'flex':'none'});imperialEls.forEach(function(el){el.style.display=isMetric?'none':'flex'})}
unitInputs.forEach(function(r){r.addEventListener('change',function(){showUnit(r.value)})});
showUnit('metric');
function clamp(n,min,max){return Math.max(min,Math.min(max,n))}
function classInfo(b){if(b<18.5) return {label:'Underweight',cls:'badge-under'};if(b<25) return {label:'Normal',cls:'badge-normal'};if(b<30) return {label:'Overweight',cls:'badge-over'};return {label:'Obesity',cls:'badge-obese'}}
function calc(){var unit=form.querySelector('input[name="unit"]:checked').value;var hM=0;var wKg=0;if(unit==='metric'){var hc=parseFloat(heightCm.value);var wk=parseFloat(weightKg.value);if(!hc||!wk) return;hM=hc/100;wKg=wk}else{var hf=parseFloat(heightFt.value);var hi=parseFloat(heightIn.value);var wl=parseFloat(weightLb.value);if(!hf&&hf!==0||(!wl&&wl!==0)) return;hi=hi||0;var inches=hf*12+hi;hM=inches*0.0254;wKg=wl*0.453592}if(hM<=0||wKg<=0) return;var bmi=wKg/(hM*hM);var val=bmi.toFixed(1);bmiValue.textContent=val;var info=classInfo(bmi);if(bmiBadge){bmiBadge.textContent=info.label;['badge-under','badge-normal','badge-over','badge-obese'].forEach(function(c){bmiBadge.classList.remove(c)});bmiBadge.classList.add(info.cls)}var minW=(18.5*hM*hM).toFixed(1);var maxW=(24.9*hM*hM).toFixed(1);rangeMin.textContent=minW+' kg';rangeMax.textContent=maxW+' kg';var p=clamp((bmi-10)/(40-10)*100,0,100);if(needleTop) needleTop.style.left=p+'%';if(needleBottom) needleBottom.style.left=p+'%'}
btn.addEventListener('click',calc);
['input','change'].forEach(function(ev){[heightCm,weightKg,heightFt,heightIn,weightLb].forEach(function(el){if(el) el.addEventListener(ev,function(){})})});
})();