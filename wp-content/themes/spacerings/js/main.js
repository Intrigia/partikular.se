document.querySelector(".searchbox__wrap input[type=search]").setAttribute("placeholder", "Vad vill du läsa idag?");

function opensubcategories(el) {
  submenuquery = document.querySelector("." + el.parentElement.id + " .sub-menu");
  if (submenuquery.style.height !== "auto") {
    submenuquery.style.height = "auto";
  } else {
    submenuquery.style.height = "0";
  }
}

hasClass = document.getElementsByClassName("non-clickable-link");
if (hasClass.length > 0) {
  for (var i=0; i < hasClass.length; i++) {
    maincategoryel = document.querySelector("." + hasClass[i].id + " a");
    maincategoryel.removeAttribute("href");
    maincategoryel.setAttribute("onclick", "opensubcategories(this)");
  }
}

var mobilemenu_isopen = false;
function openmenu() {
  if (mobilemenu_isopen) {
    //IF MENU IS OPEN, CLOSE IT
    document.querySelector(".sciencemag__mobile__menu").style.width = "0";
    document.querySelector(".mobile__menu__blur").style.display = "none";
    document.querySelector(".site-branding").style.display = "block";
    document.querySelector(".header_right_container").style.right = "1em";
    document.getElementById("page").style.marginRight = "0";
    document.getElementById("page").style.marginLeft = "0";
    mobilemenu_isopen = false;

    // Hamburger button animation
    document.querySelector(".sciencemag__hamburger__icon").style.transform = "rotate(0deg)";
    document.getElementById("top_line").style.top = "10.5px";
    document.getElementById("middle_line").style.opacity = "1";
    document.getElementById("bottom_line").style.opacity = "1";
    document.getElementById("cross_line").style.top = "50px";
  } else {
    //IF MENU IS CLOSED; OPEN IT
    var windowwidth = window.innerWidth;
    var menuelement = document.querySelector(".sciencemag__mobile__menu");
    var pageelement = document.getElementById("page");
    var cont = document.querySelector(".header_right_container");
    document.querySelector(".site-branding").style.display = "none";
    if (windowwidth <= 515) {
      menuelement.style.width = "75vw";
      pageelement.style.marginRight = "75vw";
      pageelement.style.marginLeft = "-75vw";
      cont.style.right = "calc(1em + 75vw)";
    } else if (windowwidth <= 715) {
      menuelement.style.width = "60vw";
      pageelement.style.marginRight = "60vw";
      pageelement.style.marginLeft = "-60vw";
      cont.style.right = "calc(1em + 60vw)";
    } else if (windowwidth <= 985) {
      menuelement.style.width = "400px";
      pageelement.style.marginRight = "400px";
      pageelement.style.marginLeft = "-400px";
      cont.style.right = "calc(1em + 400px)";
    } else if (windowwidth > 985) {
      menuelement.style.width = "410px";
      pageelement.style.marginRight = "410px";
      pageelement.style.marginLeft = "-410px";
      cont.style.right = "calc(1em + 410px)";
    } else {
      console.log("Could not read window width")
    }

    document.querySelector(".mobile__menu__blur").style.display = "block";
    mobilemenu_isopen = true;

    // Hamburger button animation
    document.querySelector(".sciencemag__hamburger__icon").style.transform = "rotate(45deg)";
    document.getElementById("top_line").style.top = "18px";
    document.getElementById("middle_line").style.opacity = "0";
    document.getElementById("bottom_line").style.opacity = "0";
    document.getElementById("cross_line").style.top = "7px";
  }
}
var searchwindow_isopen = false;
function OpenSearchWindow() {
  if (searchwindow_isopen) {
    document.querySelector(".sciencemag__search__wrap").style.height = "0";
    document.querySelector(".searchbox__wrap").style.display = "none";
    document.querySelector(".sciencemag__navbar__search").innerHTML = "Sök";
    searchwindow_isopen = false;
  } else {
    document.querySelector(".sciencemag__search__wrap").style.height = "70px";
    document.querySelector(".sciencemag__navbar__search").innerHTML = "Stäng";
    setTimeout(function () {
      document.querySelector(".searchbox__wrap").style.display = "block";
    }, 200);
    searchwindow_isopen = true;
  }
}