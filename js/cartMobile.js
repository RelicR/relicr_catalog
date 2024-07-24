window.onload = setTimeout(() => { setForMobile(); }, 200);
function setForMobile()
{
    //console.log(1);
    const uAg = navigator.userAgent.toLowerCase().search(/iphone|android|mobile|ipad/);
    //console.log(uAg);
    // console.log(navigator.userAgent.toLowerCase().search(/iphone|android|mobile|ipad/));
    if(uAg == -1) { 
        return 0; 
    };
    const shopCart = document.getElementsByClassName("shop-cart")[0];
    const ordInf = document.getElementsByClassName("shop-cart-order-info")[0];
    // console.log(ordInf);
    // console.log(shopCart);
    ordInf.classList.add("mobile");
    shopCart.classList.add("mobile");
    //return mobileOrder();
}

// function mobileOrder()
// {
//     const element = document.getElementById("navbar-header");
//     const ordInf = document.getElementsByClassName("shop-cart-order-info")[0];
//     // console.log("123");
//     // console.log(ordInf);
//     var observ = new IntersectionObserver(function(entries){
//         if(entries[0].intersectionRatio === 0)
//         {
//             console.log(entries[0]);
//             ordInf.style = "";
//         }
//         else if(entries[0].intersectionRatio === 1)
//         {
//             console.log(entries[0]);
//             ordInf.style = "opacity: 0.8";
//         }
//     });
//     observ.observe(element);
// }