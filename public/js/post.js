function initElement()
{
    let rateUpIcon = document.getElementById('rateUpIcon');
    let rateUpIconClicked = false;
    let rateDownIcon = document.getElementById('rateDownIcon');
    rateUpIcon.addEventListener('click', function (e) {
        rateUpIconClicked = !rateUpIconClicked;
        if (rateUpIconClicked) {
            var svg = this.firstChild;
            alert(svg);

        }
    });
    rateDownIcon.onclick = rateDown;
}

function rateUp(event)
{

}

function rateDown(event)
{

}

