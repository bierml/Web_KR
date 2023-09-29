function CheckReg() {
	var login = document.forms[0].login.value;
	var password = document.forms[0].password.value;
	var passwordconf = document.forms[0].passwordconf.value;
	var check = new RegExp("[^a-zA-Z0-9]");
	if (login == "" || password == "" || passwordconf == "")
	{
		document.querySelector('.msg').textContent = "Все поля должны быть заполнены!";
		return false;
	}
	if (login.length < 5 || login.length > 20 || password.length < 5 || password.length > 20) {
		document.querySelector('.msg').textContent = "Длина логина/пароля должна быть от 5 до 20 символов!";
		return false;		
	}
	if (check.test(login) == true || check.test(password) == true){
		document.querySelector('.msg').textContent = "В логине/пароле могут быть использованы только латинские буквы и цифры!";
		return false;		
	}
	if (password != passwordconf)
	{
		document.querySelector('.msg').textContent = "Пароль и подтверждение пароля не совпадают!";
		return false;
	}
	return true;
}
