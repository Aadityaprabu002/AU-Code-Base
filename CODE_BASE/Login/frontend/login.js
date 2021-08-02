function checkFor(email, password, remMe, fn) {
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            // console.log(xhttp.responseText);
            fn(xhttp.responseText);
        }
    }
    const POSTVALUE = "email=" + email + "&password=" + password + "&rem=" + remMe;
    xhttp.open("POST", "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Login/backend/login.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.send(POSTVALUE);

}
function submitIfValid(email, password, remMe) {
    return new Promise(resolve => {
        checkFor(email, password, remMe, resolve);
    });
}
async function validateForm() {
    const re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    let errMesg = document.getElementById('err-output');
    const email = document.getElementById('user-email').value;
    const password = document.getElementById('user-pwd').value;
    const remMe = document.getElementById('remember-me-switch').checked;
    errMesg.innerHTML = '';
    if (!re.test(email) || (password == "")) {
        errMesg.innerHTML = "Enter a valid email address or password";
        errMesg.style.color = "RED";
        return ;
    }
    let res;
    !await submitIfValid(email, password, remMe).then(value => res = JSON.parse(value));
    if(!res[0]){
        errMesg.innerHTML = "Enter a valid email address or password";
        errMesg.style.color = "RED";
    }
    else {
        window.location = res[1];
    }
    return;

}