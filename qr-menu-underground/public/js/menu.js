let debounceTimeout;

function debouncedSearch() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        searchProducts();
    }, 300); // Gecikme süresini optimize ettim.
}

function searchProducts() {
    const input = document.getElementById("search-bar").value.toLowerCase();
    const menuItems = document.querySelectorAll(".menu-item");

    let visibleItems = 0;

    menuItems.forEach(item => {
        const title = item.querySelector("h3").textContent.toLowerCase();
        const description = item.querySelector("p")?.textContent.toLowerCase() || '';

        if (title.includes(input) || description.includes(input)) {
            item.style.display = "block"; // Ürünleri göster
            visibleItems++;
        } else {
            item.style.display = "none"; // Ürünleri gizle
        }
    });

    const resultCount = document.getElementById('result-count');
    resultCount.textContent = `${visibleItems} sonuç bulundu`;
    resultCount.style.display = visibleItems > 0 ? "block" : "none";
}

function plus(btn) {
    let myInput = btn.parentElement.querySelector('input[type="number"]');
    let id = btn.getAttribute("id");
    let min = myInput.getAttribute("min");
    let max = myInput.getAttribute("max");
    let step = myInput.getAttribute("step");
    let val = myInput.getAttribute("value");
    let calcStep = (step * 1);
    let newValue = parseInt(val) + calcStep;

    if (newValue >= min && newValue <= max) {
        myInput.setAttribute("value", newValue);
    }
}

function minus(btn) {
    let myInput = btn.parentElement.querySelector('input[type="number"]');
    let id = btn.getAttribute("id");
    let min = myInput.getAttribute("min");
    let max = myInput.getAttribute("max");
    let step = myInput.getAttribute("step");
    let val = myInput.getAttribute("value");
    let calcStep = (step * -1);
    let newValue = parseInt(val) + calcStep;

    if (newValue >= min && newValue <= max) {
        myInput.setAttribute("value", newValue);
    }
}
