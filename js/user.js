function _$(element){
    return document.querySelectorAll(element);
}
// let el = _$('.ul li');
// for (let i = 0; i < el.length; i++){
//     el[i].onclick = function() {
//         let c = 0;
//         while (c < el.length) {
//             el[c++].className = 'user';
//         }
//         el[i].className = 'user active';
//     };
// }
///////////////////////////////////////
// let lis = _$('.nav .ul li');
// lis.forEach(li => {
//     // console.log(li.siblings);
//     li.addEventListener('click', () => {
//         if(li.classList.contains('active')){
            
//             li.classList.remove('active');
//         }else{

//             li.classList.add('active');
//         }
//     })
//     // console.log('removing class');
//     // li[0].classList.add('active');
// })

// _$('.nav .ul li').addEventListener('click', (lis) => {
    
//     $(this).addClass("active").siblings().removeClass("active");
//     console.log($(this));
// });
// try some thing new
    // const ul = document.querySelector('.ul');
    // ul.addEventListener('click', (e) => {
    //     const li = ul.getElementsByTagName('li');
    //     for(let i = 0; i < li.length; i++){
    //         let ticked = li[i];
    //         if(ticked.classList.contains('active')){
    //             ticked.classList.remove('active');
    //         }else{
    //             ticked.classList.add('active');
    //         }
    //     }
    // })

// try some thing new

const tabBtn = document.querySelector('.nav ul li');
const tab = document.querySelectorAll('.tab');

function tabs(panelIndex){
    tab.forEach(function(node) {
        node.style.display = 'none';
    });
    tab[panelIndex].style.display = 'block';
    // tab[panelIndex].style.boxShadow = '0px -3px 0px rgba(288, 0, 70, .9) inset';
    tabBtn[panelIndex].style.borderBottom = '3px solid rgba(288, 0, 70, .9)';
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
