function _$(element){
    return document.querySelectorAll(element);
}
// let test = _$('.nav .ul li');
// // console.log(test.length);
// for(let i = 0; i < test.length; i++){
//     // console.log(test[i]);
//     test[i].addEventListener('click', () =>{
//         this.classList.add('active');
//     })
// }
$('.nav .ul li').addEventListener('click', () => {
    $(this).addClass("active").siblings().removeClass("active");

    console.log(this.target);
});

const tabBtn = document.querySelector('.nav ul li');
const tab = document.querySelectorAll('.tab');

function tabs(panelIndex){
    tab.forEach(function(node) {
        node.style.display = 'none';
    });
    tab[panelIndex].style.display = 'block';
}
tabs(0);

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
