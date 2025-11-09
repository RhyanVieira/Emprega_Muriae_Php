function aplicarMascaraCelular(element) {
    if (!element) return;

    element.addEventListener("input", function(e) {
        let value = e.target.value.replace(/\D/g, "");
        if (value.length > 11) value = value.slice(0, 11);

        if (value.length > 6) {
            e.target.value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
        } else if (value.length > 2) {
            e.target.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
        } else {
            e.target.value = value;
        }
    });
}

function aplicarMascaraCEP(element) {
    if (!element) return;

    element.addEventListener("input", function(e) {
        let value = e.target.value.replace(/\D/g, "");
        if (value.length > 8) value = value.slice(0, 8);

        if (value.length > 5) {
            e.target.value = value.slice(0, 5) + "-" + value.slice(5);
        } else {
            e.target.value = value;
        }
    });
}
