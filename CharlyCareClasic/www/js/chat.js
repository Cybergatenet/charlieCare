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
            allList[i].setAttribute('onclick', '_selectElement(this)');
        }
    }else{
        searchWrapper.classList.remove('active'); // hide auto complete box
    }
}
function _selectElement(element){
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

// chat responsiveness 
const userClick = document.querySelector('#userIcon');
const conversations = document.querySelectorAll('.conversation');
const conversationList = document.querySelector('#conversation-list');
const newMsgContainer = document.querySelector('#new-message-container');
const chatMsgList = document.querySelector('#chat-message-list');
const chatForm = document.querySelector('#chat-form');

userClick.addEventListener('click', () => {
    // chatMsgList.style.background = "red";
    if(chatMsgList.style.display != "none"){
        chatMsgList.style.display = 'none';
        chatForm.style.display = 'none';
        conversationList.style.display = 'block';
        newMsgContainer.style.display = 'grid';
    }
});

conversations.forEach((conversation, index) => {
    conversation.addEventListener('click', () => {
        // console.log(conversation);
        if(conversationList.style.display != "none"){
            chatMsgList.style.display = 'inline-flex';
            chatForm.style.display = 'grid';
            conversationList.style.display = 'none';
            newMsgContainer.style.display = 'none';
        }
    });
});

               /////     ///       ///       ////    ////////////// 
            ///     ///  ///       ///     ///  ///       ///
        ///              ///       ///    ///   ///       ///
        ///              /////////////   ///////////      ///
        ///              ///       ///  ///      ///      ///
         ///       //    ///       /// ///       ///      ///
          /////////      ///       //////        ///      ///

$(document).ready(() => {
   $('#sendData').click((e) => { // if e.target.keycode == 13
    e.preventDefault();
      /* Get from elements values */
    let msgData = $('#msgdata').val();
    // msgData.serialize;
    // console.log(msgData)
    $.ajax({
            url: "../server/chatMsg.php",
            type: "post",
            data: msgData,
            success: function (response) {
                console.log(response);
                return;
                $('.chat-message-text').html(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            }
        });
   });
});