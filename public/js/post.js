function initElement() {
    let rateDiv = document.getElementById('rateDiv');
    let rateUpDiv = document.getElementById('rateUpDiv');
    let rateUpDivClicked = false;
    let rateDownDivClicked = false;
    let rateDownDiv = document.getElementById('rateDownDiv');
    let ratingDiv = document.getElementById('rating');
    let initialRating = parseInt(ratingDiv.textContent);
    rateUpDiv.addEventListener('click', function (e) {
        rateUpDivClicked = !rateUpDivClicked;
        rateDownDivClicked = rateUpDivClicked ? false : rateDownDivClicked;
    });
    rateDownDiv.addEventListener('click', function (e) {
        rateDownDivClicked = !rateDownDivClicked;
        rateUpDivClicked = rateDownDivClicked ? false : rateUpDivClicked;
    });
    rateDiv.addEventListener('click', function (e) {
        let rateUpIcon = rateUpDiv.firstElementChild;
        let rateDownIcon = rateDownDiv.firstElementChild;

        if (rateUpDivClicked) {
            rateUpIcon.classList.remove('bi-arrow-up-square');
            rateUpIcon.classList.add('bi-arrow-up-square-fill');
            ratingDiv.textContent = (initialRating + 1).toString();
        } else {
            rateUpIcon.classList.remove('bi-arrow-up-square-fill');
            rateUpIcon.classList.add('bi-arrow-up-square');
            ratingDiv.textContent = (initialRating).toString();
        }
        if (rateDownDivClicked) {
            rateDownIcon.classList.remove('bi-arrow-down-square');
            rateDownIcon.classList.add('bi-arrow-down-square-fill');
            ratingDiv.textContent = (initialRating - 1).toString();
        } else {
            rateDownIcon.classList.remove('bi-arrow-down-square-fill');
            rateDownIcon.classList.add('bi-arrow-down-square');
        }
    });
    document.addEventListener('visibilitychange', function () {
        let navigator = new Navigator();
       if (document.visibilityState === 'hidden') {
           navigator.sendBeacon();
       }
    });
}



