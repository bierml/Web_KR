/*jshint esversion: 9 */
const link6 = document.querySelector('.cl7');
link6.addEventListener('click', e => {
  	deleteCookie("auth_user");
	location.reload();
});
function setCookie(name, value, options = {}) {

  options = {
    path: '/',
  };

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let updatedCookie = encodeURIComponent(name) + "=" + encodeURIComponent(value);

  for (let optionKey in options) {
    if (options.hasOwnProperty(optionKey))
    {
        updatedCookie += "; " + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += "=" + optionValue;
        }
    }
  }

  document.cookie = updatedCookie;
}
function deleteCookie(name) {
  setCookie(name, "", {
    'max-age': -1
  });
}
