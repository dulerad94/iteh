/**
 * Created by Dusan on 10.11.2016..
 */

$("document").ready(function() {
    $("#aranzmani").click(function(){
        getData();
    });
});

function getData(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("response").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "form.php", true);
        xhttp.send();
}


