var sticky = document.getElementById("navbar").offsetTop;
window.onscroll  = function myFunction() {
    console.log(sticky);
    if (window.scrollY > sticky) navbar.classList.add("sticky");
    else navbar.classList.remove("sticky");

}