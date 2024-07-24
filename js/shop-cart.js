function addToCart(button, amount)
{
    const data = new FormData();
    data.append("id", button.value);
    data.append("amount", amount);
    // console.log(button.value);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            //let answer = this.responseText == "ok" ? alert("Необходимо войти, чтобы использовать корзину") : "1";
            if(this.responseText == "unauth")
            {
                alert("Чтобы добавлять в корзину, нужно авторизоваться.");
                return 0;
            }
            let answer = this.responseText == "ok" ? "Добавлено в корзину" : "Превышено максимальное количество товара";
            alert(answer);
            // console.log(this.responseText);
            //alert(answer);
            //return answer;
        }
    };
    xmlHttp.open("POST", "add-to-cart.php", true);
    xmlHttp.send(data);
}
