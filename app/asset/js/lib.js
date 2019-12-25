function validate(label, input, text, color) {
    let text2 = gElement(label);
    let input2 = gElement(input);
    text2.innerHTML = text;
    text2.style.color = color;
    input2.style.cssText = "box-shadow: 0px 0px 2px " + color;
}