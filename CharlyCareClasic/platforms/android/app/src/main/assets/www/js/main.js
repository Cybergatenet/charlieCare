
window.addEventListener("scroll", () => {
    let header = document.querySelector("header")
    header.classList.toggle("sticky", window.scrollY > 10)
})


// Animations starts here   ||  Navbar here
const selectElement = function (element){
    return document.querySelector(element);
};

let menuToggler = selectElement('.menu-toggle');
let body = selectElement('body');
let header = selectElement('header');

menuToggler.addEventListener('click', function() {
    body.classList.toggle('open');
    header.classList.toggle('sticky');
// bugs to be fixed || reverted no more bugs
});

// NavBar items active class
const selectElementAll = (element) => {
    return document.querySelectorAll(element);
};
let nav = selectElementAll('.nav-link');
for (let i = 0; i < nav.length; i++){
    nav[i].onclick = function() {
        let c = 0;
        while (c < nav.length) {
            nav[c++].classList.remove('active');
        }
        nav[i].classList.add('active');
    };
}

// Scroll reveal libray animation
window.sr = ScrollReveal();

sr.reveal('.animate-left', {
    origin: 'left',
    duration: 1000,
    distance: '25rem',
    delay: 300
});

sr.reveal('.animate-right', {
    origin: 'right',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

sr.reveal('.animate-top', {
    origin: 'top',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

sr.reveal('.animate-bottom', {
    origin: 'bottom',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

//  Animations ends here