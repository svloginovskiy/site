function initElement() {
    let postCards = document.querySelectorAll('.postCard');
    let articles = document.getElementsByTagName('article');
    Array.from(articles).forEach(function (article) {
        article.addEventListener('click', function () {
            let link = (article.getElementsByTagName('a'))[0];
            link.click();
        });
    });
    postCards.forEach(function (postCard) {
        postCard.addEventListener('mouseover', function () {
            postCard.classList.toggle('shadow');
            postCard.classList.toggle('shadow-lg');
        });
        postCard.addEventListener('mouseout', function () {
            postCard.classList.toggle('shadow');
            postCard.classList.toggle('shadow-lg');
        });

        let rateDiv = postCard.getElementsByClassName('rateDiv')[0];
        let rateUpDiv = postCard.getElementsByClassName('rateUpDiv')[0];
        let rateDownDiv = postCard.getElementsByClassName('rateDownDiv')[0];
        let ratingDiv = postCard.getElementsByClassName('rating')[0];
        if (rateUpDiv != null && rateDownDiv != null) {
            let rateUpIcon = rateUpDiv.firstElementChild;
            let rateDownIcon = rateDownDiv.firstElementChild;

            let rateUpDivClicked = rateUpIcon.classList.contains('bi-arrow-up-square-fill');
            let rateDownDivClicked = rateDownIcon.classList.contains('bi-arrow-down-square-fill');

            rateUpDiv.addEventListener('click', function (e) {
                rateUpDivClicked = !rateUpDivClicked;
                rateDownDivClicked = rateUpDivClicked ? false : rateDownDivClicked;
                let upXhr = new XMLHttpRequest();
                let curPath = (new URL(document.URL)).pathname;
                upXhr.open('POST', '/posts/' + postCard.id + '/upvote', true);
                upXhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                upXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                upXhr.onreadystatechange = function () {
                    if (upXhr.readyState == 4 && upXhr.status == 200) {
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
                downXhr.open('POST', '/posts/' + postCard.id + '/downvote', true);
                downXhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                downXhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                downXhr.onreadystatechange = function () {
                    if (downXhr.readyState == 4 && downXhr.status == 200) {
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

        let rateUpDivDisabled = postCard.getElementsByClassName('rateUpDivDisabled')[0];
        let rateDownDivDisabled = postCard.getElementsByClassName('rateDownDivDisabled')[0];
        if (rateUpDivDisabled != null && rateDownDivDisabled != null) {
            rateUpDivDisabled.addEventListener('click', function (e) {
                location.href = "/login";
            });
            rateDownDivDisabled.addEventListener('click', function (e) {
                location.href = "/login";
            });
        }
    });

}
function categoryLink(ev) {
    location.href='';
}