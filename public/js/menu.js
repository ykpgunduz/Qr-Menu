let debounceTimeout;

function debouncedSearch() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        searchProducts();
    }, 300);
}

function searchProducts() {
    const input = document.getElementById("search-bar").value.toLowerCase();
    const menuItems = document.querySelectorAll(".menu-item");
    const categories = document.querySelectorAll(".tab-pane");

    const categoryCount = {};

    menuItems.forEach(item => {
        item.style.display = "none";
    });

    let totalVisibleItems = 0;

    menuItems.forEach(item => {
        const title = item.querySelector("h3").textContent.toLowerCase();
        const description = item.querySelector("p")?.textContent.toLowerCase() || '';
        const categoryId = item.closest(".tab-pane").getAttribute("id");

        if (title.includes(input) || description.includes(input)) {
            item.style.display = "block";
            totalVisibleItems++;

            if (!categoryCount[categoryId]) {
                categoryCount[categoryId] = 0;
            }
            categoryCount[categoryId]++;
        }
    });

    const mostMatchedCategory = Object.keys(categoryCount).reduce((a, b) => categoryCount[a] > categoryCount[b] ? a : b, null);

    categories.forEach(category => {
        if (category.getAttribute("id") === mostMatchedCategory) {
            category.style.display = "block";
            category.classList.add("active", "show");
        } else {
            category.style.display = "none";
            category.classList.remove("active", "show");
        }
    });

    const resultCount = document.getElementById('result-count');
    resultCount.textContent = `${totalVisibleItems} sonuç bulundu`;
    resultCount.style.display = totalVisibleItems > 0 ? "block" : "none";
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
