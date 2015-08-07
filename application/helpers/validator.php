<php

function checkLength(str, length) {
    return strlen(str) >= length;
}

function checkEmail(str) {
    return filter_var(str, FILTER_VALIDATE_EMAIL);
}
