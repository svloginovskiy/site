function initElement() {
    let postCards = document.querySelectorAll('.postCard');
    postCards.forEach(function (postCard,) {
        postCard.addEventListener('click', function () {
            let link = (postCard.getElementsByTagName('a'))[0];
            link.click();
        });
    });

}



