function amountAdd(input, amount, price)
{
    //console.log(input.value);
    //return 0;
    if(input.value > amount)
    {
        input.value = amount;
        //console.log(input.value);
        //console.log(amount);
        alert("Превышено максимальное количество товара");
        return 0;
    }
    //console.log(input.getAttribute("max"));
    const totW = document.querySelector("#total-worth");
    const totA = document.querySelector("#total-amount");
    const iId =  input.getAttribute("name").match(/\d+/)[0].toString();
    const data = new FormData();
    data.append("id", iId);
    data.append("amount", input.getAttribute("max"));
    data.append("curValue", input.value);
    // console.log(input.value);
    var xmlHttp = new XMLHttpRequest();

    if(input.value <= 0)
    {
        input.value = 0;
        const itName = document.getElementById(`${iId}-name`);
        // console.log(itName);
        // console.log(iId);
        xmlHttp.onreadystatechange = function() 
        {
            //alert("responded with" + this.readyState.toString());
            if (this.readyState == 4 && this.status == 200) {
                let answer = this.responseText == "unauth" ? alert("Необходимо войти, чтобы использовать корзину") : Number(this.responseText);
                
                if(answer != "unauth")
                {
                    totA.innerText = `Количество позиций: ${ Number(totA.innerText.match(/\b\d+/)) - Number(answer) }`;
                    totW.innerText = `Общая стоимость: ${ Number(totW.innerText.match(/\b\d+/)) - (Number(price) * Number(answer) ) }₽`;
                    alert(`Товар "${ itName.innerText }" удалён из корзины`);
                    document.getElementById(iId).remove();
                    if(document.getElementsByClassName("shop-cart-item").length == 0)
                    {
                        document.getElementsByClassName("shop-cart-container")[0].remove();
                        let emptyCart = document.createElement("h3");
                        emptyCart.style = "display:inline";
                        emptyCart.innerText = "Корзина пуста...";
                        document.getElementsByClassName("shop-cart")[0].prepend(emptyCart);
                    }
                    //alert(`Общая стоимость: ${ Number(totW.innerText.match(/\b\d+/))+Number(price) }₽`);
                }
            }
        };
        xmlHttp.open("POST", "rm-from-cart.php", true);
        xmlHttp.send(data);
        return 0;
    }

    xmlHttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText)
            let answer = this.responseText == "0" ? alert("Превышено максимальное количество товара") : this.responseText;
            //alert("responded with" + this.responseText.toString());
            if(answer != "ok" && answer != "0")
            {
                totA.innerText = `Количество позиций: ${ Number(totA.innerText.match(/\b\d+/)) - Number(answer) }`;
                totW.innerText = `Общая стоимость: ${ Number(totW.innerText.match(/\b\d+/)) - (Number(price) * Number(answer)) }₽`;
            }
            //if(answer != "ok")
            //{
                //console.log(`Стоимость была: ${Number(totW.innerText.match(/\b\d+/))}\n`);
                //totW.innerText = `Общая стоимость: ${ Number(totW.innerText.match(/\b\d+/)) - (Number(price) * Number(answer)) }₽`;
                // console.log(`Стоимость стала: ${Number(totW.innerText.match(/\b\d+/))}\n`);
                // console.log(`Цена: ${Number(price)}\n`);
                // console.log(`Разница кол-ва: ${Number(answer)}\n`);
                // console.log(`Разница стоимости должжна быть: ${(Number(price) * Number(answer))}\n`);
                //alert(`Общая стоимость: ${ Number(totW.innerText.match(/\b\d+/))+Number(price) }₽`);
            //}
        }
    };
    xmlHttp.open("POST", "add-to-cart.php", true);
    xmlHttp.send(data);
}

function setOrder()
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) {
            //alert(this.responseText);
            let answer = this.responseText == "ok" ? alert("Заказ оформлен") : alert("Необходимо войти, чтобы использовать корзину");
            answer;
            setTimeout(() => { window.location.href = "./profile.php"; }, 500);
        }
    };
    xmlHttp.open("POST", "./vendor/proc-order.php", true);
    xmlHttp.send();
}