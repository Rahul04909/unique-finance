(function(){
var s=document.querySelector('.calc-slider');
if(!s) return;
var t=s.querySelector('.calc-track');
var groups=[].slice.call(t.children);
var dots=[].slice.call(s.querySelectorAll('.calc-dots .dot'));
var prev=s.querySelector('.calc-prev');
var next=s.querySelector('.calc-next');
var i=0;
function go(n){i=(n+groups.length)%groups.length;t.style.setProperty('--calc-index', i);groups.forEach(function(el,idx){el.classList.toggle('active', idx===i)});dots.forEach(function(d,idx){d.classList.toggle('active', idx===i);d.setAttribute('aria-selected', idx===i?'true':'false')})}
dots.forEach(function(d,idx){d.addEventListener('click', function(){go(idx)})});
if(prev) prev.addEventListener('click', function(){go(i-1)});
if(next) next.addEventListener('click', function(){go(i+1)});
go(0);
})();