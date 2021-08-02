const ERROR = {
   1: "Enter a valid name",
   2: "dwad",
   3: "Invalid email address.",
   4: "Password doesn't match.",
   5: "Invalid email or password.",
   6: "Password should be greater than 8 characters.",
   7: "Username can only contain alphabets and number and should be greate than 4 characters",
   8: "Email already taken",
   9: "Username already taken"
}
function getERROR(key) {
   return ERROR[key];
}
function parseBoolToInt(VALUE) {
   return VALUE ? 1 : 0;
}

function check_for_availability(CASE, VALUE) {
   return new Promise(resolve => {
      isUnique(CASE, VALUE, resolve);
   });
}

function isUnique(TYPE, value, fn) {
   const xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
         fn(parseInt(xhttp.responseText) == 1);
      }
   }
   let POSTVALUE = "";
   switch (TYPE) {
      case 1:
         POSTVALUE = "case=" + TYPE + "&email=" + value;
         break;
      case 2:
         POSTVALUE = "case=" + TYPE + "&user-name=" + value;
         break;
   }
   xhttp.open("POST", "http://localhost/AU_CODING_PLATFORM/CODE_BASE/Sign%20up/backend/signup.php", true);
   xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
   xhttp.send(POSTVALUE);
}


function checkStrength() {
   const np = document.getElementById('new-password').value;
   let err = document.getElementById('hint-new-password');
   const strongPassword = new RegExp('(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{8,})');
   const mediumPassword = new RegExp('((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[^A-Za-z0-9])(?=.{6,}))|((?=.*[a-z])(?=.*[A-Z])(?=.*[^A-Za-z0-9])(?=.{8,}))');
   if (np == "") {
      err.innerHTML = "Tip: Use special Characters, Numbers and Different cases.";
      err.style.setProperty("color", "#868e96", "important");
   }
   else if (np.length < 8) {
      err.style.setProperty("color", "RED", "important");
      err.innerHTML = getERROR(6);
   }
   else if (strongPassword.test(np)) {
      err.style.setProperty("color", "GREEN", "important");
      err.innerHTML = "Strong";
   }
   else if (mediumPassword.test(np)) {
      err.style.setProperty("color", "rgb(197, 130, 5)", "important");
      err.innerHTML = "Medium";
   }
   else {
      err.style.setProperty("color", "RED", "important");
      err.innerHTML = "Weak";
   }
   return;
}
function isPasswordMatching() {
   const np = document.getElementById('new-password').value;
   const cp = document.getElementById('confirm-password').value;
   let err = document.getElementById('hint-confirm-password');

   if (np == "" && cp == "") {
      err.innerHTML = "";
   }
   else if (cp != np) {
      err.innerHTML = "Password doesn't match!";
      err.style.setProperty("color", "red", "important");
   }
   else {
      err.innerHTML = "Password match!";
      err.style.setProperty("color", "green", "important");
      return true
   }
   return false;
}
function isEmpty() {
   const np = document.getElementById('new-password').value;
   let err = document.getElementById('hint-new-password');

   if (np == "") {
      err.innerHTML = getERROR(6);
      err.style.setProperty("color", "RED", "important");
      return true;
   }
   err.innerHTML = "";
   return false;

}


function validateName(name) {
   const letters = /^[A-Za-z]+$/;
   let err = document.getElementById("hint-name");
   if (!letters.test(name) || name.length < 6) {
      err.innerHTML = getERROR(1);
      err.style.setProperty("color", "red", "important");
      return true;
   }
   err.innerHTML = "";
   return false;
}
async function validateUsername(username) {
   const letters = /^[0-9a-zA-Z]+$/;
   let err = document.getElementById("hint-username");
   if (!letters.test(username) || username.length < 5) {
      err.innerHTML = getERROR(7);
      err.style.setProperty("color", "red", "important");
      return true;
   }
   err.innerHTML = "";
   let FLAG = false;
   await check_for_availability(2, username).then(value => FLAG = value);
   if (FLAG) {
      err.innerHTML = getERROR(9);
      err.style.setProperty("color", "RED", "important");
   }
   return FLAG;

}
async function validateEmail(email) {
   const emailFormat = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
   let err = document.getElementById('hint-email');
   if (!emailFormat.test(email)) {
      err.innerHTML = getERROR(3);
      err.style.setProperty("color", "RED", "important");
      return true;
   }
   err.innerHTML = "";
   let FLAG = false;
   await check_for_availability(1, email).then(value => FLAG = value);
   if (FLAG) {
      err.innerHTML = getERROR(8);
      err.style.setProperty("color", "RED", "important");
   }
   return FLAG;
}

function isURL(str) {

   var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
   '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
   '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
   '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
   '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
   '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
   return pattern.test(str);
  
}

function is_url(str,c)
{

  if(str == "") return true;
  var pattern = new RegExp('^(https?:\\/\\/)?'+ // protocol
   '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|'+ // domain name
   '((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
   '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
   '(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
   '(\\#[-a-z\\d_]*)?$','i'); // fragment locator
   var flag =  pattern.test(str);
 
  
  if(!flag){
         if(c == 'g'){
            document.getElementById("hint-github").innerHTML = "Invalid link";
         }else{
            document.getElementById("hint-twitter").innerHTML = "Invalid link";
         }
      }else{
         if(c == 'g'){
            document.getElementById("hint-github").innerHTML = "";
         }else{
            document.getElementById("hint-twitter").innerHTML = "";
         }
      }
      return flag;
     

}
function bioValidate(s){
  
   if(s==""){
      return true;
   }
   if(s.length > 40){
      document.getElementById("hint-bio").innerHTML = "";
      return true;
   }else{
      document.getElementById("hint-bio").innerHTML = "Invalid bio";
      return false;
   }
}
async function validateForm() {
   let ERRFLAG = 0;
   const fname = document.getElementById('fname').value.trim();
   const lname = document.getElementById('lname').value.trim();
   const email = document.getElementById('email').value.trim();
   const username = document.getElementById('username').value.trim();
   const bio = document.getElementById('bio').value;
   const github = document.getElementById('github').value;
   const twitter = document.getElementById('twitter').value;
   
   ERRFLAG += parseBoolToInt(!is_url(github,'g'));
   ERRFLAG += parseBoolToInt(!is_url(twitter,'t'));
   ERRFLAG += parseBoolToInt(!bioValidate(bio));
   ERRFLAG += parseBoolToInt(isEmpty() || !isPasswordMatching());
   ERRFLAG += parseBoolToInt(validateName(fname + lname));
   ERRFLAG += parseBoolToInt(await validateUsername(username));
   ERRFLAG += parseBoolToInt(await validateEmail(email));
   
   if (ERRFLAG == 0) {
      console.log('PASSED!');
      document.getElementById('sign-up').submit();
   }else{
      console.log(ERRFLAG);
   }
}