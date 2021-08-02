console.log('script ready!');
var award_options = document.querySelector(".award-options");
var btns = document.querySelectorAll(".badge-container");
var award_list = [];
var despCount = 1;
var testCaseCount = 0;
var picCount = 0;

addCase();

btns.forEach((btn, idx) => {
    btn.setAttribute("role", "button");
    btn.setAttribute("aria-pressed", "false");
    btn.setAttribute("tabindex", "0");
    btn.setAttribute("style","width:50px; height:50px;");
  });

award_options.addEventListener("keydown", e => {
    if (e.key === "" || e.key === "Enter" || e.key === "Spacebar") {
        toggleBtn(e.target);
    }
});

function toggleBtn(ele) {
    award_list.push(ele.getAttribute("value"));
    let awards = document.querySelector("#Qaward");
    awards.setAttribute("value",award_list);
    var e = document.querySelector(".selected-awards");
    let div = document.createElement('div');
    div.setAttribute("class","selected-content")
    let t = ele.parentNode;
    t.remove();
    div.appendChild(ele);
    e.appendChild(div);
}





function clearAll(){
    award_list = [];
    var e1 = document.querySelector(".selected-awards");
    var e2 = document.querySelector(".award-options");
    
    var child = e1.lastElementChild; 
    while (child) {
            let div = document.createElement('div');
            div.setAttribute("class","content");
            div.appendChild(child.querySelector(".badge-container"));
            e2.appendChild(div);
            e1.removeChild(child);
            child = e1.lastElementChild;
    }
}


function addCase(){
 
    var e = document.querySelector(".test-cases");
    var div = document.createElement('div');
    div.setAttribute("class","testcase");
    div.setAttribute("data-value",testCaseCount+1);


    let p = document.createElement('p');
    let text = document.createTextNode('Test case #'+ parseInt(testCaseCount+1));
    p.appendChild(text);
    div.appendChild(p);


    let ta = document.createElement('textarea');
    ta.setAttribute("cols","20");
    ta.setAttribute("rows","1");   
    ta.setAttribute("name","Qtestcase["+testCaseCount+"][0]");
    ta.setAttribute("id","Qtestcase");
    ta.innerHTML = "input";
    div.appendChild(ta);

    ta = NaN;
    ta = document.createElement('textarea');
    ta.setAttribute("cols","20");
    ta.setAttribute("rows","1");   
    ta.setAttribute("name","Qtestcase["+testCaseCount+"][1]");
    ta.setAttribute("id","Qtestcase");
    ta.innerHTML = "output";
    div.appendChild(ta);

    let label = document.createElement('label');
    text = document.createTextNode('Sample case:');
    label .appendChild(text);
    label.setAttribute("for","samplecase_checkbox");
    div.appendChild(label);

    let inp = document.createElement('input');
    inp.setAttribute("type","checkbox");
    inp.setAttribute("value",0);
    inp.setAttribute("name","Qtestcase["+testCaseCount+"][samplecase]")
    inp.setAttribute("class","form-check-input")
    inp.setAttribute("id","samplecase_checkbox");
    inp.addEventListener('change',function(){
            if(this.checked){
                this.value = 1;
            }
            else{
                this.value = 0;
            }
    })
    div.appendChild(inp);
    e.append(div);
    testCaseCount++;
}
function deleteCase(){
    if(testCaseCount<2) return;
    --testCaseCount;
    var e = document.querySelector(".test-cases");
    e.removeChild(e.lastElementChild);

}

function addDesp(){
    var e = document.querySelector(".desp-list");
    let ta = document.createElement('textarea');
    ta.setAttribute("cols","30");
    ta.setAttribute("rows","10");
    ta.setAttribute("name","Qdescription[]");
    ta.setAttribute("id", "Qdescription");
    let p = document.createElement('p');
    let text = document.createTextNode('Description #'+ ++despCount);
    p.appendChild(text);
    e.appendChild(p);
    e.appendChild(ta);
}
function deleteDesp(){
    if(despCount<2) return;
    --despCount;
    var e = document.querySelector(".desp-list");
    e.removeChild(e.lastElementChild);
    e.removeChild(e.lastElementChild);
}

function addPic(){
    var e = document.querySelector(".pic-list");
    var inp = document.createElement('input');
    inp.setAttribute("name","Qpicture[]");
    inp.setAttribute("id","Qpicture");
    inp.setAttribute("type","file");
    inp.setAttribute("hidden",null);
    inp.setAttribute("accept","image/*")
    inp.click();
    inp.onchange = function(event){
        var file = event.target.files; 
        if(file.length > 0){
            var fileReader = new FileReader();
            fileReader.onload = function(event){
                var p = document.createElement('p');
                let text = document.createTextNode('Image #'+ ++picCount);
                p.appendChild(text);
                var img = document.createElement('img');
                img.setAttribute("src",event.target.result);
                img.setAttribute("width","200");
                e.appendChild(p);
                e.appendChild(img);
            }
            fileReader.readAsDataURL(file[0]);
        }
    }
    e.appendChild(inp);
    

}
function deletePic(){
    if(picCount<1) return;
    --picCount;
    var e = document.querySelector(".pic-list");
    e.removeChild(e.lastElementChild);
    e.removeChild(e.lastElementChild);
    e.removeChild(e.lastElementChild);
}

function deleteAllNodes(e){
    var child = e.lastElementChild; 
    while (child) {
            e.removeChild(child);
            child = e.lastElementChild;
    }
}
function validate(){
    var e = document.querySelector(".err_status");
    deleteAllNodes(e);
    var Qname = document.querySelector("#Qname");
    var Qdescription = document.querySelectorAll("#Qdescription");
    var Qpicture = document.querySelectorAll("#Qpicture");
    var Qaward = document.querySelector("#Qaward");
    var Qtestcase = document.querySelectorAll("#Qtestcase");
    var Qaward = document.querySelector("#Qaward");
    var ERRFLAG = 0;
    if(Qname.value.length < 6){
        let text = document.createTextNode("Invalid question name");
        let p = document.createElement('p');
        p.appendChild(text);
        e.appendChild(p);
        ERRFLAG++;
    }
    if(Qaward.value.length == 0){
        let text = document.createTextNode("Select awards for the question");
        let p = document.createElement('p');
        p.appendChild(text);
        e.appendChild(p);
        ERRFLAG++;
    }
  
    for(var i=0;i<Qdescription.length;i++){
        if(Qdescription[i].value.length < 10){
            let text = document.createTextNode("Invalid description");
            let p = document.createElement('p');
            p.appendChild(text);
            e.appendChild(p);
            ERRFLAG++;
            break;
        }
        else{
            Qdescription[i].value.replace(/\r?\n/g,"\\n");
        }
    }

    for(var i=0;i<Qtestcase.length;i++){
        if(Qtestcase[i].value.length == 0){
            let text = document.createTextNode("Invalid test case");
            let p = document.createElement('p');
            p.appendChild(text);
            e.appendChild(p);
            ERRFLAG++;
            break;
        }
        else{
            Qtestcase[i].value.replace(/\r?\n/g,"\\n");
        }
    }
    if(! ERRFLAG){
        var form = document.querySelector("#Qform");
        form.submit();
    }

}