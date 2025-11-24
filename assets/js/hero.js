(function(){
var s=document.querySelector('.hero-slider');
if(!s) return;
var t=s.querySelector('.hero-track');
var slides=[].slice.call(t.children);
var dots=[].slice.call(s.querySelectorAll('.hero-dots .dot'));
var prev=s.querySelector('.hero-prev');
var next=s.querySelector('.hero-next');
var i=0;var interval=5000;var timer=null;
function go(n){i=(n+slides.length)%slides.length;t.style.setProperty('--index', i);slides.forEach(function(el,idx){el.classList.toggle('active', idx===i)});dots.forEach(function(d,idx){d.classList.toggle('active', idx===i);d.setAttribute('aria-selected', idx===i?'true':'false')})}
function start(){if(window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;stop();timer=setInterval(function(){go(i+1)}, interval)}
function stop(){if(timer){clearInterval(timer);timer=null}}
dots.forEach(function(d,idx){d.addEventListener('click', function(){go(idx);start()})});
s.addEventListener('mouseenter', stop);
s.addEventListener('mouseleave', start);
if(prev) prev.addEventListener('click', function(){go(i-1);start()});
if(next) next.addEventListener('click', function(){go(i+1);start()});
document.addEventListener('visibilitychange', function(){if(document.visibilityState==='hidden') stop(); else start()});
go(0);start();
})();