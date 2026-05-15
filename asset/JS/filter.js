function filterData(){

let category = document.getElementById("cat").value;
let subcategory = document.getElementById("sub").value;

fetch("../api/contents/filter.php?category="+category+"&subcategory="+subcategory)
.then(res => res.json())
.then(data => {

let html = `
<table border="1">
<tr>
<th>Title</th>
<th>Description</th>
<th>Download</th>
</tr>
`;

data.forEach(item => {
html += `
<tr>
<td>${item.title}</td>
<td>${item.description}</td>
<td><a href="../files/${item.file_path}">Download</a></td>
</tr>
`;
});

html += `</table>`;

document.getElementById("result").innerHTML = html;

});
}