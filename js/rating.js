    // Initial Ratings
    const ratings = 4.7;
    // Total Stars
    const starsTotal = 5;
    const reviewDownload = document.querySelector('#reviewDownload');
    const reviewRate = document.querySelector('#reviewRate');
    const rated = document.querySelector('#rated');
    // let sendData;
    
    function countInc(){
        let incValue = parseInt(reviewDownload.innerHTML);
        let sendData = incValue + 1;
        $.ajax({
            type: 'POST',
            url: 'server/rating.php',
            data: {name: sendData},
            cache: false,
            success: function(res)
            {	
                // console.log(res);
                reviewDownload.innerHTML = res;
            },
            error: function(xhr, status, error){
                // console.log(xhr);
            }
        });
    }    
    $.ajax({
        type: 'GET',
        url: 'server/rating.php',
        success: function(res)
        {	
            reviewDownload.innerHTML = res;
        }
    });
    // ?????????????????????????????????????????????/////////////////////////////
    // RATING THIS BOOK HERE
    function ratebook(){
        let rateValue = parseInt(reviewRate.innerHTML);
        let rateData = rateValue + 1;
        $.ajax({
            type: 'POST',
            url: 'server/ratingBook.php',
            data: {name: rateData},
            cache: false,
            success: function(res)
            {	
                // console.log(res);
                reviewRate.innerHTML = res;
            },
            error: function(xhr, status, error){
                // console.log(xhr);
            }
        });
    }    
    $.ajax({
        type: 'GET',
        url: 'server/ratingBook.php',
        success: function(res)
        {	
            reviewRate.innerHTML = res;
            // let obj = jQuery.parseJSON(res);
            // $.each(obj, function(key, value){
                // alert(key);
                // alert(value.download);
            // })
        }
    });
    $.ajax({
        type: 'GET',
        url: 'server/getrating.php',
        success: function(res)
        {	
            rated.innerHTML = res;
        }
    });
    // // Get percentage
    //     const starPercentage = (ratings[rating] / starsTotal) * 100;
    // //     // Round to nearest 10
    //     const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`;
 
    

    // Run getRatings when DOM loads
    // document.addEventListener('DOMContentLoaded', getRatings);

    // // Form Elements
    // const ratingControl = document.getElementById('rating-control');
    // const submitRate = document.getElementById('rate');
    // if(ratingControl.value == ''){
    //     submitRate.disabled = true;
    // }else{
    //     ratingControl.addEventListener('change', () => {
    //         submitRate.disabled = false;
    //     })
    // }

    // // Product select change
    // productSelect.addEventListener('change', (e) => {
    // product = e.target.value;
    // // Enable rating control
    // ratingControl.disabled = false;
    // ratingControl.value = ratings[product];
    // });

    // // Rating control change
    // ratingControl.addEventListener('blur', (e) => {
    // const rating = e.target.value;

    // // Make sure 5 or under
    // if (rating > 5) {
    //     alert('Please rate 1 - 5');
    //     return;
    // }

    // // Change rating
    // ratings[product] = rating;

    // getRatings();
    // });

    // // Get ratings
    // function getRatings() {
    // for (let rating in ratings) {
    //     // Get percentage
    //     const starPercentage = (ratings[rating] / starsTotal) * 100;

    //     // Round to nearest 10
    //     const starPercentageRounded = `${Math.round(starPercentage / 10) * 10}%`;

    //     // Set width of stars-inner to percentage
    //     document.querySelector(`.${rating} .stars-inner`).style.width = starPercentageRounded;

    //     // Add number rating
    //     document.querySelector(`.${rating} .number-rating`).innerHTML = ratings[rating];
    //     }
    // }