function initElement() {
    let postCards = document.querySelectorAll('.postCard');
    postCards.forEach(function (postCard,) {
        postCard.addEventListener('click', function () {
            let link = (postCard.getElementsByTagName('a'))[0];
            link.click();
        });
        postCard.addEventListener('mouseover', function () {
            postCard.classList.toggle('shadow');
            postCard.classList.toggle('shadow-lg');
        });
        postCard.addEventListener('mouseout', function () {
            postCard.classList.toggle('shadow');
            postCard.classList.toggle('shadow-lg');
        })
    });

}



