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
            alert("Something went wrong");
            console.error("AJAX error", xhr.status, xhr.statusText, xhr.responseText);
        }
    };

    xhr.send(data);
}