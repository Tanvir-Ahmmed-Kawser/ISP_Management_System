let btnProfile = document.getElementById('viewProfile');
btnProfile.addEventListener('click', function(){
    window.location.href = "../../view/profile.php";
});
document.getElementById('btnAddModerator').addEventListener('click', function(){
    window.location.href = '../../view/register.php';
});
document.getElementById('btnUpload').addEventListener('click', function(){
    window.location.href = '../../view/admin/addContent.php';
});
document.getElementById('btnViewAll').addEventListener('click', function(){
    window.location.href = '../../view/admin/manageContents.php';
});