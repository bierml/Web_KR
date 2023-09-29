/*jshint esversion: 6 */
const link1 = document.querySelector('.cl1'),
link2 = document.querySelector('.cl2'),
link3 = document.querySelector('.cl3'),
link4 = document.querySelector('.cl4'),
link5 = document.querySelector('.cl5'),
frame  = document.querySelector('.cl6');
link1.addEventListener('click', e => {
  	frame.src = "mainpage.php";
});
link2.addEventListener('click', e => {
  	frame.src = "allart.php";
});
link3.addEventListener('click', e => {
  	frame.src = "enter.html";
});
link4.addEventListener('click', e => {
  	frame.src = "register.html";
});
link5.addEventListener('click', e => {
  	frame.src = "artedit.php";
});
