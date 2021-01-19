let buttons = document.querySelectorAll('.amounts > *');
buttons.forEach(item => {
    item.addEventListener('click', event => {
        buttons.forEach(item => {
            item.classList.remove("selected");
        });
        item.classList.add("selected");
        if (item.hasAttribute("amount")) {
            document.getElementById("amount").value = item.getAttribute("amount");
        }
    })
})
let input = document.getElementById("custom")
input.addEventListener('change', event => {
    document.getElementById("amount").value = input.value;
});

const form = document.forms['donate-form']
form.addEventListener('submit', e => {
    e.preventDefault()
    let number = "1236568380";
    let total = "100";
    let reference = new Date().getUTCMilliseconds().toString();
    let msg = "Tack för din donation. Ref.nummer: " + reference;
    let editcode = "0";
    let size = "200x200";
    let color = "255-255-255";
    let bgcolor = "0-0-0";
    let format = "svg";
    let data = `C${number};${total};${msg};${editcode}`;

    fetch(`https://api.qrserver.com/v1/create-qr-code?data=${data}&size=${size}&bgcolor=${bgcolor}&color=${color}&format=${format}`)
        .then(response => response.blob())
        .then(image => response(image))
        .catch((error) => {
            console.error('Error:', error);
        });
})

function response(image) {
    let urlCreator = window.URL || window.webkitURL;
    let imageUrl = urlCreator.createObjectURL(image);
    document.getElementById("qr").src = imageUrl;
    document.getElementById("pay").remove();
    document.getElementById("confirm").style.display = "block";
}