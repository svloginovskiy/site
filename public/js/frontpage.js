function handleSelect() {
    let select = document.getElementsByTagName('select')[0];
    if (select.value === 'time') {
        location.href='/';
    } else if (select.value ==='rating') {
        location.href='/top';
    }
}