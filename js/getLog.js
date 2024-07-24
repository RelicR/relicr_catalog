function getLogScreen()
{
    if(!document.getElementById("reg-log-screen"))
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) {
                document.body.innerHTML += this.responseText;
                setTimeout(() => { document.getElementById("reg-log-screen").style = ""; }, 100);
            }
        };
        xmlHttp.open("POST", "login.php", true);
        xmlHttp.send();
    }
}