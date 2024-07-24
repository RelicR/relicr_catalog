const forbiddenSymbols = "«»\"'`\x20";

function checkForbid(input)
{
    if(input.value.match(/[«»\"'`\x20]/))
    {
        //console.log(input.value.match(/[«»\"'`\x20]/).length);
        input.classList.add("invalid");
        return false;
    }
    //console.log(input.value.match(/[«»\"'`\x20]/));
    input.classList.remove("invalid");
    return true;
}

function checkValid(input)
{
    const regBtn = document.querySelector(".reg-btn");
    let inputs = new Array();
    inputs = [document.querySelector("#reg-login"), document.querySelector("#reg-pass"), document.querySelector("#reg-pass-rep")];
    if(!checkForbid(input) > 0)
    {
        alert("Введённые данные содержат запрещённые символы");
        return 0;
    }
    switch(input.id)
    {
        case "reg-login":
            if(input.value.length < 3)
            {
                input.classList.add("invalid");
            }
            else
            {
                input.classList.remove("invalid");
            }
            break;
        case "reg-pass":
            let passRepInput = document.querySelector("#reg-pass-rep");
            if(input.value.length < 8)
            {
                input.classList.add("invalid");
            }
            else
            {
                input.classList.remove("invalid");
            }
            if(passRepInput.value != input.value)
            {
                passRepInput.classList.add("invalid");
            }
            else
            {
                passRepInput.classList.remove("invalid");
            }
            break;
        case "reg-pass-rep":
            let passInput = document.querySelector("#reg-pass");
            if(input.value != passInput.value)
            {
                input.classList.add("invalid");
            }
            else
            {
                input.classList.remove("invalid");
            }
            break;
        default:
            break;
    }
    var filledInputs = 0;
    for(let i = 0; i < 3; i++)
    {
        filledInputs += inputs[i].value.length > 0 && inputs[i].classList.value.indexOf("invalid") == -1;
    }
    if (filledInputs == 3 && document.getElementsByClassName("invalid").length == 0)
    {
        regBtn.removeAttribute("disabled");
    }
    else
    {
        regBtn.setAttribute("disabled", "disabled");
    }
}

function checkValidLog()
{
    const logBtn = document.querySelector(".log-btn");
    let inputs = new Array();
    inputs = [document.querySelector("#log-login"), document.querySelector("#log-pass")];
    const forbis = !checkForbid(inputs[0]) + !checkForbid(inputs[1]);
    var filledInputs = 0;
    for(let i = 0; i < 2; i++)
    {
        filledInputs += inputs[i].value.length > 0 && inputs[i].classList.value.indexOf("invalid") == -1;
    }

    if(forbis > 0)
    {
        alert("Введённые данные содержат запрещённые символы");
        return 0;
    }

    if (filledInputs == 2)
    {
        logBtn.removeAttribute("disabled");
    }
    else
    {
        logBtn.setAttribute("disabled", "disabled");
    }
}