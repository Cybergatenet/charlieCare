// Getting all varialbes
const searchWrapper = document.querySelector('#search-container');
const inputBox = searchWrapper.querySelector('input'); 
const suggBox = searchWrapper.querySelector('.autocom-box'); 

// listening to a key press event
inputBox.onkeyup = (e) => {
    // console.log(e.target.value);
    let userData = e.target.value;
    let empyArray = [];
    if(userData){
        empyArray = suggestions.filter((data) => {
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());
        });
        // console.log(empyArray);
        empyArray = empyArray.map((data) => {
            return data = `<li>${data}</li>`;
        });
        console.log(empyArray);
        searchWrapper.classList.add('active'); // show auto complete box
        showSuggestions(empyArray);
        let allList = suggBox.querySelectorAll('li');
        for(let i = 0; i < allList.length; i++){
            // adding onclick attribute to all the li
            allList[i].setAttribute('onclick', 'selectElement(this)');
        }
    }else{
        searchWrapper.classList.remove('active'); // hide auto complete box
    }
}
function selectElement(element){
    let selectUserData = element.textContent;
    // console.log(selectUserData);
    inputBox.value = selectUserData; // adding user data into the search box
    searchWrapper.classList.remove('active'); // hide auto complete box
}

function showSuggestions(list){
    let listData;
    if(!list.length){
        userData = inputBox.value;
        listData = `<li>${userData}</li>`;
    }else{
        listData = list.join('');
    }
    suggBox.innerHTML = listData;
}