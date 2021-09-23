function initElement() {
    let deleteButtons = document.querySelectorAll('.deleteButton');
    deleteButtons.forEach(function (deleteButton) {
        deleteButton.addEventListener('click', function() {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '/admin/posts/' + deleteButton.id + '/delete', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.location.reload(true);
                }

            };
            xhr.send();
        });
    });

    let editButtons = document.querySelectorAll('.editButton');
    let lastEditButtonId = 0;
    editButtons.forEach(function (editButton) {
        editButton.addEventListener('click', function()
        {
            lastEditButtonId = editButton.id;
        });
    });
    let saveButton = document.querySelectorAll('.saveButton')[0];
    let select = document.getElementsByTagName('select')[0];
    saveButton.addEventListener('click', function() {
        let xhr = new XMLHttpRequest();
        let params = 'role=' + select.value;
        xhr.open('POST', '/admin/users/' + lastEditButtonId + '/edit', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.location.reload(true);
            }
        };
        xhr.send(params);
    });

}