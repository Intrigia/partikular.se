document.querySelector(".searchbox__wrap input[type=search]").setAttribute("placeholder", "Vad vill du läsa idag?");

//COOKIES BAR
if (localStorage.getItem('cookiebanner') !== 'visad') {
  document.querySelector('.sciencemag__cookie__notice__wrapper').style.display = "grid";
  document.querySelector('.sciencemag__mobile__menu').classList.add("cookie__banner__mobile__menu");
  document.querySelector('.sciencemag__navigation').classList.add("cookie__banner__navigation");
  localStorage.setItem('cookiebanner', 'visad');
}
function closecookiebanner() {
  document.querySelector('.sciencemag__cookie__notice__wrapper').style.display = "none";
  document.querySelector('.sciencemag__mobile__menu').classList.remove("cookie__banner__mobile__menu");
  document.querySelector('.sciencemag__navigation').classList.remove("cookie__banner__navigation");
}

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


// NEWSLETTER SIGNUP MODAL
var newslettertimer = setInterval(checkmodal, 40000);

function checkmodal() {
  if (localStorage.getItem('newslettermodal') !== 'visad') {
    document.getElementById('nyhetsbrev__modal').classList.add("modal__screen__settings");
    localStorage.setItem('newslettermodal', 'visad');
  }
}
function closenewslettermodal() {
  document.getElementById('nyhetsbrev__modal').classList.remove("modal__screen__settings");
}

// DONATE MODAL
function donatemodal(button) {
  if (button.id == "prefooter__donate__button") {
    document.getElementById('donate__button__click__modal').style.display = "block";
  } else if (button.id == "modal__topright__close") {
    document.getElementById('donate__button__click__modal').style.display = "none";
  }
}
function zoomin(button) {
	if (button.innerHTML == "Förstora") {
		document.querySelector('.donation__footer span').classList.add("black__font");
		document.querySelector('.donation__footer span:last-child').classList.add("black__font");
		document.querySelector('.donation__header span:last-child').classList.add("black__font");
		document.querySelector('.sciencemag__donation__modal').classList.add("black__background");
		document.querySelector('.sciencemag__donation__modal .modal__close').style.display = "none";
		button.innerHTML = 'Ångra';
		button.style.marginTop = "20px";
    button.style.cursor = "zoom-out";
	} else if (button.innerHTML == "Ångra") {
		document.querySelector('.donation__footer span').classList.remove("black__font");
		document.querySelector('.donation__footer span:last-child').classList.remove("black__font");
		document.querySelector('.donation__header span:last-child').classList.remove("black__font");
		document.querySelector('.sciencemag__donation__modal').classList.remove("black__background");
		document.querySelector('.sciencemag__donation__modal .modal__close').style.display = "block";
		button.innerHTML = 'Förstora';
		button.style.marginTop = "0";
    button.style.cursor = "zoom-in";
	}
}
