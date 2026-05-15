document.getElementById("category").addEventListener("change",function(){

fetch("../api/contents/get_subcategories.php?category_id="+this.value)
.then(res=>res.json())
.then(data=>{

let html="";

data.forEach(i=>{
html+=`<option value="${i.id}">${i.name}</option>`;
});

document.getElementById("subcategory").innerHTML=html;

});
});