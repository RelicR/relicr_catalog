window.onload = setTimeout(() => { fixFooter(); }, 200);
function fixFooter()
{
    if(document.body.scrollHeight == window.innerHeight)
    {
        //console.log(document.body.scrollHeight);
        document.querySelector("footer").setAttribute("style", "position: fixed;bottom: 0px;");
    }
}