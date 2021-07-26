
function openForm(id) {
  document.getElementById(id).style.display = "block";
}

function closeForm(id) {
  document.getElementById(id).style.display = "none";
}


function openNav() {
  document.getElementById("sidepanel").style.width = "100px";
}

function closeNav() {
  document.getElementById("sidepanel").style.width = "0";
}


function openList(id) {
  document.getElementById(id).style.height = "78%";
}

function closeList(id) {
  document.getElementById(id).style.height = "0";
}

function openBtn() {
  var elements = document.getElementsByName("meniu_btn");
for (var i = 0; i < elements.length; i++) {
 elements[i].style.right = "10px";
}
}

function closeBtn() {
  var elements = document.getElementsByName("meniu_btn");
for (var i = 0; i < elements.length; i++) {
 elements[i].style.right = "-70px";
}
}