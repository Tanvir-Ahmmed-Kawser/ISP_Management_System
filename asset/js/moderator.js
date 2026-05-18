function uploadCheck(){

    let form = document.getElementById("contentForm");
    let data = new FormData(form);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "../../controller/Moderator/add_content_check.php", true);

    xhr.onreadystatechange = function(){
        if(xhr.readyState !== 4) return;

        if(xhr.status === 200){
            try {
                let res = JSON.parse(xhr.responseText);
                alert(res.message);

                if(res.success){
                    form.submit();
                }
            } catch(e) {
                alert("Invalid server response.");
                console.error(e, xhr.responseText);
            }
        } else {
            alert("Something went wrong !!!");
            console.error("AJAX error", xhr.status, xhr.statusText, xhr.responseText);
        }
    };

    xhr.send(data);
}

function updateStatus(id, status){
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '../../controller/update_request_status.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function(){
        if(xhr.readyState !== 4) return;

        if(xhr.status === 200){
            try {
                let response = JSON.parse(xhr.responseText);
                if(response.success){
                    let statusCell = document.getElementById('status-' + id);
                    if(statusCell){
                        statusCell.textContent = status;
                    }
                } else {
                    alert(response.message || 'Unable to update request status.');
                }
            } catch(e) {
                alert('Invalid server response.');
                console.error(e, xhr.responseText);
            }
        } else {
            alert('Could not update request status.');
            console.error('AJAX error', xhr.status, xhr.statusText);
        }
    };

    xhr.send('id=' + encodeURIComponent(id) + '&status=' + encodeURIComponent(status));
}

function initModeratorAjax(){
    let deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(function(form){
        form.addEventListener('submit', function(event){
            event.preventDefault();

            if (!confirm('Are you sure you want to delete this content?')) {
                return;
            }

            let formData = new FormData(form);
            formData.append('ajax', '1');

            let xhr = new XMLHttpRequest();
            xhr.open('POST', form.action, true);

            xhr.onreadystatechange = function(){
                if(xhr.readyState !== 4) return;

                if(xhr.status === 200){
                    try {
                        let res = JSON.parse(xhr.responseText);
                        if(res.success){
                            let id = formData.get('id');
                            let row = document.getElementById('content-row-' + id);
                            if(row){
                                row.remove();
                            }
                            alert(res.message);
                        } else {
                            alert(res.message || 'Delete failed.');
                        }
                    } catch(e) {
                        alert('Invalid server response.');
                        console.error(e, xhr.responseText);
                    }
                } else {
                    alert('Something went wrong while deleting content.');
                    console.error('AJAX error', xhr.status, xhr.statusText);
                }
            };

            xhr.send(formData);
        });
    });
}

document.addEventListener('DOMContentLoaded', initModeratorAjax);