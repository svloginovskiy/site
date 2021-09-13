function initElement() {
    let rateDiv = document.getElementById('rateDiv');
    let rateUpDiv = document.getElementById('rateUpDiv');
    let rateDownDiv = document.getElementById('rateDownDiv');
    let ratingDiv = document.getElementById('rating');
    let rateUpIcon = rateUpDiv.firstElementChild;
    let rateDownIcon = rateDownDiv.firstElementChild;
    let initialRating = parseInt(ratingDiv.textContent);
    let rateUpDivClicked = rateUpIcon.classList.contains('bi-arrow-up-square-fill');
    let rateDownDivClicked = rateDownIcon.classList.contains('bi-arrow-down-square-fill');
    console.log(rateUpDivClicked);
    console.log(rateDownDivClicked);
    rateUpDiv.addEventListener('click', function (e) {
        rateUpDivClicked = !rateUpDivClicked;
        rateDownDivClicked = rateUpDivClicked ? false : rateDownDivClicked;
        let upXhr = new XMLHttpRequest();
        let curPath = (new URL(document.URL)).pathname;
        upXhr.open('POST', curPath + '/upvote', true);
        upXhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        upXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        upXhr.onreadystatechange = function () {
            if(upXhr.readyState == 4 && upXhr.status == 200) {
                ratingDiv.textContent = upXhr.responseText;
            }
        };
        upXhr.send();
    });
    rateDownDiv.addEventListener('click', function (e) {
        rateDownDivClicked = !rateDownDivClicked;
        rateUpDivClicked = rateDownDivClicked ? false : rateUpDivClicked;
        let curPath = (new URL(document.URL)).pathname;
        let downXhr = new XMLHttpRequest();
        downXhr.open('POST', curPath + '/downvote' , true);
        downXhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        downXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        downXhr.onreadystatechange = function () {
            if(downXhr.readyState == 4 && downXhr.status == 200) {
                ratingDiv.textContent = downXhr.responseText;
            }
        };
        downXhr.send();
    });
    rateDiv.addEventListener('click', function (e) {

        if (rateUpDivClicked) {
            rateUpIcon.classList.remove('bi-arrow-up-square');
            rateUpIcon.classList.add('bi-arrow-up-square-fill');
        } else {
            rateUpIcon.classList.remove('bi-arrow-up-square-fill');
            rateUpIcon.classList.add('bi-arrow-up-square');
        }
        if (rateDownDivClicked) {
            rateDownIcon.classList.remove('bi-arrow-down-square');
            rateDownIcon.classList.add('bi-arrow-down-square-fill');
        } else {
            rateDownIcon.classList.remove('bi-arrow-down-square-fill');
            rateDownIcon.classList.add('bi-arrow-down-square');
        }
    });

}



