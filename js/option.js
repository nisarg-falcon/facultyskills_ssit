$(document).ready(function () {
    var Request = new XMLHttpRequest();
    Request.open('GET','http://127.0.0.1/Code/php/json/department.json');
    Request.onload = function(){
        var data = JSON.parse(Request.responseText);
        render(data);
    }
    Request.send();
    function render(ourdata){
    for(var i=0;i<ourdata.length;i++){
        document.form1.select1[i] = new Option(ourdata[i].branch_name,ourdata[i].branch_name);
    } 
}   
    var Request2 = new XMLHttpRequest();
    Request2.open('GET','http://127.0.0.1/Code/php/json/designation.json');
    Request2.onload = function(){
        var data1 = JSON.parse(Request2.responseText);
        renderhtml(data1);
    }
    Request2.send();
    function renderhtml(ourdata1){
        for(var i=0;i<ourdata1.length;i++){
            document.form1.select2[i] = new Option(ourdata1[i].designation_name,ourdata1[i].designation_name);
            document.form2.select2[i] = new Option(ourdata1[i].designation_name,ourdata1[i].designation_name);
        } 
    }     
});