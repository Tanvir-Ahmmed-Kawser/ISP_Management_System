function searchData(){

let q=document.getElementById("search").value;

fetch("../api/contents/search.php?q="+q)
.then(res=>res.json())
.then(data=>{

let html="<table border='1'><tr><th>Title</th><th>Description</th></tr>";

data.forEach(i=>{
html+=`<tr><td>${i.title}</td><td>${i.description}</td></tr>`;
});

html+="</table>";

document.getElementById("result").innerHTML=html;

});
}