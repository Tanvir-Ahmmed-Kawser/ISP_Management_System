let btnUpload = document.getElementById('btnUpload');

btnUpload.addEventListener('click', function(event){
    let title = document.getElementById('title');
    let description = document.getElementById('description');
    let category = document.getElementById('category');
    let file = document.getElementById('file');
    let fileName = file.value.toLowerCase();

    if(title.value.trim() == ''){
        alert('Please enter a valid title');
        title.focus();
        event.preventDefault();
        return;
    }

    if(description.value.trim() == ''){
        alert('Please enter description');
        description.focus();
        event.preventDefault();
        return;
    }

    if(category.value == ''){
        alert('Please select category');
        category.focus();
        event.preventDefault();
        return;
    }

    if(fileName == ''){
        alert('Please choose a file!');
        file.focus();
        event.preventDefault();
        return;
    }

    if(
        !fileName.endsWith(".jpg") && !fileName.endsWith(".jpeg") && !fileName.endsWith(".png") &&
        !fileName.endsWith(".pdf") && !fileName.endsWith(".mp4") && !fileName.endsWith(".exe")
    ){

        alert('Only JPG, PNG, MP4, EXE and PDF files are allowed!');
        file.focus();
        event.preventDefault();
        return;
    }

    alert('Content upload successful!');

});