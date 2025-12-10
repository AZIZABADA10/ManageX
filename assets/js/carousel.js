const slides = document.querySelector('.slides');
const slide = document.querySelectorAll('.slide');
let index = 0;


document.getElementById('next').onclick = ()=>{
    index = (index + 1) % slide.length;
    updateCarousel();
}


document.getElementById('prev').onclick = ()=>{
    index = (index - 1 + slide.length) % slide.length;
    updateCarousel();
}

function updateCarousel() {
    slides.style.transform = `translateX(-${index * 100}%)`;
}

setInterval(() => {
    index = (index + 1) % slide.length;
    updateCarousel();
}, 3000); 
