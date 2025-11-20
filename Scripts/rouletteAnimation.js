// Scripts/roulette.js

// 💡 Definicje globalne, używane w event listenerze w roulette.php
let winningNumber = null;
let winningColor = null;

function rand (min, max) {
    return Math.floor(Math.random() * (max - min)) + min;
}

var wrap, colors;
var pallete = [
    "g0", "r32", "b15", "r19", "b4", "r21", "b2", "r25",
    "b17", "r34", "b6", "r27", "b13", "r36", "b11",
    "r30", "b8", "r23", "b10", "r5", "b24", "r16",
    "b33", "r1", "b20", "r14", "b31", "r9", "b22",
    "r18", "b29", "r7", "b28", "r12", "b35", "r3", "b26"
];
var green = [0];
var red = [1, 3, 5, 7, 9, 12, 14, 16, 18, 19, 21, 23, 25, 27, 30, 32, 34, 36];
var black = [2, 4, 6, 8, 10, 11, 13, 15, 17, 20, 22, 24, 26, 28, 29, 31, 33, 35];
var width = 100;

wrap = document.querySelector('.roulette-container .wrap');

function spin_promise (color, number) {
    return new Promise((resolve) => {
        let index, pixels, circles;

        let colorPrefix = color[0]; 
        
        index = pallete.indexOf(colorPrefix + "" + number);
        
        pixels = width * (index + 1);
        circles = 2960 * 10;

        pixels -= 80;
        pixels = rand(pixels + 2, pixels + 79);
        pixels += circles;
        pixels *= -1;

        wrap.style.transition = "background-position 10s cubic-bezier(0.1, 0.5, 0.1, 1)";
        wrap.style.backgroundPosition = ((pixels + (wrap.offsetWidth / 2)) + "") + "px";

        setTimeout(() => {
            wrap.style.transition = "none";
            let pos = (((pixels * -1) - circles) * -1) + (wrap.offsetWidth / 2);
            wrap.style.backgroundPosition = String(pos) + "px";
            
            setTimeout(() => {
                wrap.style.transition = "background-position 10s";
                resolve();
            }, 510);

        }, 10000 + 700);
    });
}