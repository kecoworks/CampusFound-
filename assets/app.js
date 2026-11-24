document.addEventListener('DOMContentLoaded',()=>{
  const toggle=document.querySelector('.menu-toggle');
  const nav=document.querySelector('.main-nav');
  if(toggle&&nav) toggle.addEventListener('click',()=>{nav.classList.toggle('open');toggle.setAttribute('aria-expanded',nav.classList.contains('open'));});
  const fileInput=document.querySelector('input[type=file]');
  if(fileInput) fileInput.addEventListener('change',()=>{
    const file=fileInput.files[0];
    if(file&&file.size>5*1024*1024){alert('Image must be smaller than 5 MB.');fileInput.value='';}
  });
  document.querySelectorAll('.notice').forEach(n=>{setTimeout(()=>n.classList.add('notice-fade'),5000);});
});
