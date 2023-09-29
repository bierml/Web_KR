function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
var btn1 = document.querySelector('input[type=submit][value=Добавить]');
var btn2 = document.querySelector('input[type=submit][value=Загрузить]');
var btn3 = document.querySelector('input[type=submit][value=Удалить]');
btn1.onclick = function() {
 	setCookie('OnAdd',1,30,"/");
};
btn2.onclick = function() {
  	setCookie('OnLoad',1,30,"/");
};
btn3.onclick = function() {
  	setCookie('OnDelete',1,30,"/");
};
