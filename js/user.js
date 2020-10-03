//  navbar toggle here!
const selectElement = (element) => {
    return document.querySelector(element);
};
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

let menuToggler = selectElement('.menu-toggle');
let body = selectElement('body');
let header = selectElement('header');

menuToggler.addEventListener('click', function() {
    body.classList.toggle('open');
    header.classList.toggle('sticky');
// bugs to be fixed || reverted no more bugs
});

const tabBtn = document.querySelector('.nav ul li');
const tab = document.querySelectorAll('.tab');

function tabs(panelIndex){
    tab.forEach(function(node) {
        node.style.display = 'none';
    });
    tab[panelIndex].style.display = 'block';
    //
    tab[panelIndex].style.borderBottom = '3px solid rgba(288, 0, 70, .9)';

    const selectElementAll = (element) => {
        return document.querySelectorAll(element);
    };
    let el = selectElementAll('.ul li');
    for (let i = 0; i < el.length; i++){
        el[i].onclick = function() {
            let c = 0;
            while (c < el.length) {
                el[c++].classList.remove('active');
            }
            el[i].classList.add('active');
        };
    }
}
tabs(0);

// Bio data

let bio = document.querySelector('.bio');

function bioText() {
    bio.oldText = bio.innerText;
    bio.innerText = bio.innerText.substring(0, 100) + "...";
    bio.innerHTML += "&nbsp;" + `<span onclick='addLength()' id='see-more-bio'>See more</span>`;
}
bioText();

function addLength(){
    bio.innerHTML = bio.oldText;
    bio.innerHTML += "&nbsp;" + `<span onclick='bioText()' id='see-less-bio'>See less</span>`;
}

///////////////////////////////////////


// for (let i = 0; i < el.length; i++){
//     el[i].onclick = function() {
//         let c = 0;
//         while (c < el.length) {
//             el[c++].classList.remove('active');
//         }
//         el[i].classList.add('active');
//     };
// }
