document.getElementById('sendButton').addEventListener('click', function() {
    const form = document.getElementById('myForm'); 
    const formData = new FormData(form);
    const sendButton = document.getElementById('sendButton');
    let balanceElement = document.getElementById("balance");

    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(response => {
        return response.json(); 
    })
    .then(data => {
        window.winningNumber = data.number; 
        window.winningColor = data.color;
        window.balance = data.balance;

        setTimeout(() => {
            balanceElement.textContent = `Balance: `+ parseFloat(window.balance).toFixed(2) + ` $`;
        }, 10700);

        console.log(`Number ${window.winningNumber}, Color ${window.winningColor}`);
        
        return spin_promise(window.winningColor, window.winningNumber);
    })
    .then(() => {        
        let container = document.getElementById("bets-container"); 
        let colorBeted = document.createElement("div");
        colorBeted.setAttribute("class", "color-beted " + window.winningColor[0]);
        colorBeted.innerHTML = window.winningNumber;
        container.appendChild(colorBeted);
        })
});