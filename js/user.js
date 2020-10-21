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
});
///////     Navber End 

$(function(){
    $('.navs .ul li').click(function(){
        $(this).addClass('active').siblings().removeClass('active');
    });
});

const tabBtn = document.querySelectorAll('.navs .ul li');
const tab = document.querySelectorAll('.tab');
// let el = selectElementAll('.ul li');

function tabs(panelIndex){
    //  for (let i = 0; i < tabBtn.length; i++){
    //     tabBtn[i].ondblclick = function() {
    //         let c = 0;
    //         while (c < tabBtn.length) {
    //             tabBtn[c++].classList.remove('active');
    //         }
    //         tabBtn[i].classList.add('active');
    //     };
    // }

    tab.forEach(function(node) {
        node.style.display = 'none';
    });
    tab[panelIndex].style.display = 'block';
    //
    tab[panelIndex].style.borderBottom = '3px solid rgba(288, 0, 70, .9)';

}
tabs(0);
// tabs(2);

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

// /////////////////////////////////////
// image preview code here
const wrapper = document.querySelector(".img_wrapper");
const fileName = document.querySelector(".file-name");
const cancelBtn = document.querySelector("#cancel-btn");
const defaultBtn = document.querySelector("#default-btn");
const customBtn = document.querySelector("#custom-btn");
const img = document.querySelector("img");
let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\9\0\.\%\+\~\_ ]+$/;
function defaultBtnActive(event){
    // event.preventDefault();
    defaultBtn.click();
}

defaultBtn.addEventListener("change", function(){
    const file = this.files[0];
    if(file){
        const reader = new FileReader();
        console.log(reader);
        reader.onload = function(){
        const result = reader.result;
        img.src = result;
        wrapper.classList.add("active");
    }
    cancelBtn.addEventListener("click", function(){
        img.src = "";
        wrapper.classList.remove("active");
    });
    reader.readAsDataURL(file);
    }
    if(this.value){
        let valueStore = this.value.match(regExp);
        fileName.textContent = valueStore;
    }
});