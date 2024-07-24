function changeScreen(btn)
{
    const regScreen = document.querySelector("#reg-screen");
    const logScreen = document.querySelector("#log-screen");
    if(btn.id == "switch-to-log")
    {
        regScreen.toggleAttribute("style");
        regScreen.setAttribute("style", "translate: 100%");
        setTimeout(() => { 
            regScreen.style += "; display: none";
            logScreen.style = "translate: -100%";
        }, 500);
        setTimeout(() => { 
            logScreen.style = "";
        }, 550);
    }
    else
    {
        logScreen.setAttribute("style", "translate: -100%");
        setTimeout(() => { 
            logScreen.style += "; display: none";
            regScreen.style = "translate: 100%";
        }, 500);
        setTimeout(() => { 
            regScreen.setAttribute("style", "");
            // regScreen.style = "";
        }, 550);
    }
}

function closeLogReg() 
{
    const logRegScreen = document.getElementById("reg-log-screen");
    logRegScreen.style = "translate: -50% -200%";
    setTimeout(() => { logRegScreen.remove(); }, 550);
}