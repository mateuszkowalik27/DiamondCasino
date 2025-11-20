document.getElementById('dateBirth').addEventListener('input', function () {
    let char = this.value.replace(/\D/g, "");

    if (char.length > 2) {
        char = char.slice(0,2) + "-" + char.slice(2);
    }
    if (char.length > 5) {
        char = char.slice(0,5) + "-" + char.slice(5);
    }

    this.value = char;
});