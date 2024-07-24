function choice(select)
{
    if(select.value == "Выход")
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) {
                alert("Вы вышли из аккаунта");
                window.location.href = "./";
                return 0;
            }
        };
        xmlHttp.open("POST", "./vendor/log-out.php", true);
        xmlHttp.send();
    }
    else
    {
        window.location.href = "./profile.php";
    }
}