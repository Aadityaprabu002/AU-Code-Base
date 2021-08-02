String.prototype.format = function() {
    a = this;
    for (k in arguments) {
      a = a.replace("{" + k + "}", arguments[k])
    }
    return a;
  }


var btn = document.querySelector(".custom-input-checkbox");
var customInput = false;
var tableValue = false;
btn.addEventListener("change",function(){
    if(this.checked){
        let ta = document.createElement('textarea');
        ta.setAttribute('cols','30');
        ta.setAttribute('rows','10');
        ta.setAttribute('id','user-inp');
        let e = document.querySelector('.checkbox-wrapper');
        e.prepend(ta);
        customInput = true;
    }
    else{
        let e = document.querySelector('.checkbox-wrapper');
        e.removeChild(e.firstChild);
        customInput = false;
    }
});


function createTableHeading_With_col_scope(text){
    var th = document.createElement("th");
    th.setAttribute("scope","col");
    th.appendChild(document.createTextNode(text));
    return th;
}
function createTableHeading_With_row_scope(text){
    var th = document.createElement("th");
    th.setAttribute("scope","row");
    th.appendChild(document.createTextNode(text));
    return th;
}
function createTableData_WithTextarea(text,colspan = 1){
    var td = document.createElement("td");
    td.setAttribute("colspan",colspan);
    var ta = document.createElement("textarea"); 
    ta.setAttribute("rows","1");
    ta.setAttribute("cols","20");
    ta.innerHTML = text;
    var btn = document.createElement("button");
    btn.setAttribute("class","btn view-more-btn")
    var link = 'data:text/plain;base64,'+btoa(text);
    var func = `debugBase64("{0}")`.format(link);
    btn.setAttribute("onclick",func);
    btn.innerText="view more";
    td.appendChild(ta); 
    td.appendChild(btn);
    return td; 
}
function createTableData_WithText(text,colspan = 1){
    var td = document.createElement("td");
    td.setAttribute("colspan",colspan);
    td.appendChild(document.createTextNode(text));
    return td;
}

function showOutput(result){
  var e = document.querySelector(".output-area-wrapper");
  var c = document.querySelector(".output-container");
  c.removeChild(c.firstChild);
    if(tableValue){
        e.removeChild(e.lastElementChild);
      
    }else{
        tableValue = true;
    }
    obj = JSON.parse(result);


    console.log(obj);

    if("samplecase" in obj["result"] && "realcase" in obj["result"])
    {
        
        var count = 0;
        var errflag = 0;
        var pos = 0;
        obj["result"]["samplecase"].forEach((val,key)=>{
            if(val["status"]==0){
                errflag = 1;
                if(!pos){
                    pos = key;
                }
            }
        });
        obj["result"]["realcase"].forEach((val,key)=>{
            if(val["status"]==0){
                errflag = 1;  
            }
        });

        if(errflag){
             
            var c = document.querySelector(".output-container");
            var div = document.createElement("div");
            div.appendChild(document.createTextNode("CODE FAILED :("));
            c.insertBefore(div, c.firstChild);

            var err = obj["result"]["samplecase"][pos];
            var table = document.createElement("table");
            table.setAttribute("class","table");
           
            var thead = document.createElement("thead");
            thead.setAttribute("class","thead-dark");
            var tr = document.createElement("tr");
            tr.appendChild(createTableHeading_With_col_scope("Testcase"));
            tr.appendChild(createTableHeading_With_col_scope("Stderr"));
            tr.appendChild(createTableHeading_With_col_scope("Result"))
            thead.appendChild(tr);
            var tbody = document.createElement('tbody');
            tr = document.createElement("tr");
            tr.appendChild(createTableData_WithText(1));
            tr.appendChild(createTableData_WithTextarea(err["message"]));
            tr.appendChild(createTableData_WithText("Failure"));
            tbody.appendChild(tr);
            table.appendChild(thead);
            table.appendChild(tbody);
            e.appendChild(table);

        }
        else{
            if((obj["passed"])){
                var c = document.querySelector(".output-container");
                var div = document.createElement("div");
                div.appendChild(document.createTextNode("CODE PASSED :)"));
                c.insertBefore(div, c.firstChild);
            }else{
                var c = document.querySelector(".output-container");
                var div = document.createElement("div");
                div.appendChild(document.createTextNode("CODE FAILED :( BUT RAN!"));
                c.insertBefore(div, c.firstChild);
            }
            

            var table = document.createElement("table");
            table.setAttribute("class","table");
           
            var thead = document.createElement("thead");
            thead.setAttribute("class","thead-dark");
    
            var tr = document.createElement("tr");
            tr.appendChild(createTableHeading_With_col_scope("Test case"));
            tr.appendChild(createTableHeading_With_col_scope("Stdin"));
            tr.appendChild(createTableHeading_With_col_scope("Expected"));
            tr.appendChild(createTableHeading_With_col_scope("Stdout"));
            tr.appendChild(createTableHeading_With_col_scope("Result"));
            thead.appendChild(tr);
            var tbody = document.createElement('tbody');
            obj["result"]["samplecase"].forEach((val,key) =>
            {
                    var tr = document.createElement('tr');
                    tr.appendChild(createTableHeading_With_row_scope(key+1));
                    tr.appendChild(createTableData_WithTextarea(val["input"]));
                    tr.appendChild(createTableData_WithTextarea(val["expected"]));
                    tr.appendChild(createTableData_WithTextarea(val["message"]));
                    let str;
                    if(val["codematch"]){
                        str = "Success";
                    }else{
                        str = "Failed";
                    }
                    tr.appendChild(createTableData_WithText(str));
                    tbody.appendChild(tr);
                    count = key+1;  
            });      
            obj["result"]["realcase"].forEach((val,key) =>
            {  
                    var tr = document.createElement('tr');       
                    tr.appendChild(createTableHeading_With_row_scope(count+key+1));
                    tr.appendChild(createTableData_WithText("Hidden test case",colspan=3));    
                    let str;
                    if(val["codematch"]){
                        str = "Success";
                    }else{
                        str = "Failed";
                    }
                    tr.appendChild(createTableData_WithText(str));
                    tbody.appendChild(tr);

            });
            table.appendChild(thead);
            table.appendChild(tbody);
            e.appendChild(table);
        }
    }
    else
    {
             

                obj["result"]["custominput"].forEach((val,key) =>
                {
                        var table = document.createElement("table");
                        table.setAttribute("class","table");    
                        var thead = document.createElement("thead");
                        thead.setAttribute("class","thead-dark");
                        var tbody = document.createElement('tbody');
                        tr = document.createElement("tr");

                        if(val["status"]==0){

                            var c = document.querySelector(".output-container");
                            var div = document.createElement("div");
                            div.appendChild(document.createTextNode("CODE FAILED :("));
                            c.insertBefore(div, c.firstChild);
                            
                        tr.appendChild(createTableHeading_With_col_scope("Custom input"));
                        tr.appendChild(createTableHeading_With_col_scope("Stderr"));
                        tr.appendChild(createTableHeading_With_col_scope("Result"));
                        thead.appendChild(tr);
        
                        tr = document.createElement('tr');
                        tr.appendChild(createTableData_WithText(1));
                        tr.appendChild(createTableData_WithTextarea(val["message"]))
                        tr.appendChild(createTableData_WithText("Failed"))
                        tbody.appendChild(tr);


                        table.appendChild(thead);
                        table.appendChild(tbody);
                        e.appendChild(table);
                    }
                    else
                    {
                        var c = document.querySelector(".output-container");
                        var div = document.createElement("div");
                        div.appendChild(document.createTextNode("CODE PASSED :)"));
                        c.insertBefore(div, c.firstChild);
                        
                        tr.appendChild(createTableHeading_With_col_scope("Custom input"));
                        tr.appendChild(createTableHeading_With_col_scope("Stdin"));
                        tr.appendChild(createTableHeading_With_col_scope("Stdout"));
                        tr.appendChild(createTableHeading_With_col_scope("Result"));
                        thead.appendChild(tr);
        
                        tr = document.createElement('tr');
                        tr.appendChild(createTableHeading_With_row_scope(key+1));
                        tr.appendChild(createTableData_WithTextarea(val["input"]));
                        tr.appendChild(createTableData_WithTextarea(val["message"]));
                        let str;
                        if(val["status"]){
                            str = "Success";
                        }else{
                            str = "Failed";
                        }
                        tr.appendChild(createTableData_WithText(str));
                        tbody.appendChild(tr);

                        table.appendChild(thead);
                        table.appendChild(tbody);
                        e.appendChild(table);
                    }
                });
    }
}

async function runCode() {
    await new Promise(resolve => {
       getresult(resolve);
    }).then(
        (result) => showOutput(result)
    );
    
 }

function getresult(fn){
    if(document.getElementById("lang-select").value == "NONE"){
        alert("Select a Language!!!");
        return;
    }
    else{
        const xhttp = new XMLHttpRequest();
        xhttp.timeout =10000;
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("loader").style.display = "none";
                document.querySelector(".output-area-wrapper").style.display = "";
                fn(this.responseText);
            }
            else{
        
                document.querySelector(".output-area-wrapper").style.display = "none";
                document.getElementById("loader").style.display = "";
            
            }
        };
        xhttp.ontimeout = function (err) {
            document.querySelector(".output-area-wrapper").innerHTML = "Time out :(";
          };

        var form = new FormData();
        form.append('language',encodeURIComponent(document.getElementById("lang-select").value));
        form.append('code',encodeURIComponent(editor.getValue().replace(/%20/, "+")));
        if(customInput){
            form.append('custom-input',encodeURIComponent(document.getElementById("user-inp").value).replace(/%20/, "+"));
          
            form.append('case','1');
        }else{
        
            form.append('case','0');
           
        }
    
        xhttp.open("POST", "http://localhost/AU_CODING_PLATFORM/Compiler_Scipts/compiler.php", true);
        xhttp.send(form);
     
    }
}

function debugBase64(base64URL){
    var win = window.open();
    win.document.write('<iframe src="' + base64URL  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
}
