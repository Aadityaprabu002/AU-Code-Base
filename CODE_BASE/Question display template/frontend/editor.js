var editor = ace.edit(document.getElementById("editor"),{
    mode:"",
    value:"Select a language",
    theme:"ace/theme/github",
  
});
editor.setTheme("ace/theme/github");
// editor.renderer.setScrollMargin(0, 0, 0, 0);
document.getElementById('editor').style.fontSize='20px';

// enable autocompletion, snippets, min & max lines
editor.setOptions({
    minLines:20,
    maxLines:20,
    
    // autoScrollEditorIntoView: true,
    enableBasicAutocompletion: true,
    enableSnippets: true,
    enableLiveAutocompletion: false,
    tabSize:5, 
    printMarginColumn: 70,
});
editor.setScrollSpeed(2);
function changeTheme(theme){
    switch(theme){
        case 'Dark':
            editor.setTheme("ace/theme/twilight");
            break;
        case 'Light':
            editor.setTheme("ace/theme/github");
            break;
    }
}

function changeLang(e){
  
    var selectedValue = e["lang"];
    var code = 0;
    if("code" in e){
        code = e["code"];
    }
    switch(selectedValue){
        case 'C':
            editor.session.setMode("ace/mode/c_cpp");
            if(code){
                editor.setValue(code);
            }else{
                editor.setValue(`#include <stdio.h>
int main() {
    printf("Hello World!");
    return 0;
}`);
            }
            break;
        case 'CPP':
            editor.session.setMode("ace/mode/c_cpp");
            if(code){
                editor.setValue(code);
            }else{
            editor.setValue(`#include <iostream>
int main() {
    std::cout << "Hello World!";
    return 0;
}`);
            }
            break;
        case 'JAVA':
            editor.session.setMode("ace/mode/java");
            if(code){
                editor.setValue(code);
            }else{
            editor.setValue(
                            `import java.util.*;
import java.lang.*;
import java.io.*;
class main {
    public static void main(String[] args) {
        System.out.println("Hello, World!");
    }
}`
            );
        }
            break;
        case 'PYTHON':
            editor.session.setMode("ace/mode/python");
            if(code){
                editor.setValue(code);
            }else{
              editor.setValue("print('hello world')");
            }
            break;
        default:
            editor.session.setMode("");
            editor.setValue("Select a Language");
            break;

    }
}
