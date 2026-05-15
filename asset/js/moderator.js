function uploadCheck(){

    let form = document.getElementById("contentForm");
    let data = new FormData(form);

    fetch("../../controller/Moderator/add_content_check.php",{
        method:"POST",
        body:data
    })
    .then(res => res.json())
    .then(res => {

        alert(res.message);

        if(res.success){
            form.submit();
        }
    })
    .catch(err => {
        alert("Something went wrong");
        console.log(err);
    });
}