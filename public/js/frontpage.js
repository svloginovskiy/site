function handleSelect() {
    let select = document.getElementsByTagName('select')[0];
    if (select.value === 'time') {
        location.href='/';
    } else if (select.value ==='rating') {
        location.href='/top';
    }
}

function handleCheckbox() {
    let checkBoxes = document.getElementsByClassName('categoriesCheckBox');
    let filterQuery = '';
    Array.from(checkBoxes).forEach((ch) => {
        if(ch.checked) {
            filterQuery += ch.value + '&';
        }
    })
    filterQuery = filterQuery.slice(0, -1);
    if (filterQuery.length !== 0) {
        document.cookie=`categories=${filterQuery}; samesite=strict`;
    } else {
        document.cookie='categories=; max-age=-1';
    }
    document.location.reload(true);
}