let debounceTimeout;

function debouncedSearch() {
    clearTimeout(debounceTimeout);
    debounceTimeout = setTimeout(() => {
        searchProducts();
    }, 300);
}

function searchProducts() {
    const input = document.getElementById("search-bar").value.toLowerCase().trim();
    const menuItems = document.querySelectorAll(".menu-item");
    const categories = document.querySelectorAll(".tab-pane");
    const categoryPills = document.querySelectorAll('.nav-pills .nav-item a');

    const categoryCount = {};
    let totalVisibleItems = 0;

    // Önce tüm menü öğelerini gizle
    menuItems.forEach(item => {
        const parentForm = item.closest('form');
        if (parentForm) {
            parentForm.style.display = "none";
        }
    });

    // Her menü öğesini kontrol et
    menuItems.forEach(item => {
        const title = item.querySelector("h3").textContent.toLowerCase();
        const parentForm = item.closest('form');
        const categoryId = item.closest(".tab-pane").getAttribute("id");

        if (title.includes(input)) {
            if (parentForm) {
                parentForm.style.display = "block";
            }
            totalVisibleItems++;

            if (!categoryCount[categoryId]) {
                categoryCount[categoryId] = 0;
            }
            categoryCount[categoryId]++;
        }
    });

    // En çok eşleşen kategoriyi bul ve göster
    const mostMatchedCategory = Object.entries(categoryCount)
        .reduce((max, current) => current[1] > max[1] ? current : max, ['', 0])[0];

    categories.forEach(category => {
        const categoryId = category.getAttribute("id");
        if (input === '') {
            // Arama boşsa ilk kategoriyi göster
            if (categoryId === 'tab-1') {
                category.classList.add("show", "active");
            } else {
                category.classList.remove("show", "active");
            }
        } else {
            if (categoryId === mostMatchedCategory) {
                category.classList.add("show", "active");
                // İlgili kategori sekmesini aktif et
                categoryPills.forEach(pill => {
                    if (pill.getAttribute('href') === '#' + categoryId) {
                        pill.classList.add('active');
                    } else {
                        pill.classList.remove('active');
                    }
                });
            } else {
                category.classList.remove("show", "active");
            }
        }
    });

    // Sonuç sayısını güncelle
    const resultCount = document.getElementById('result-count');
    if (input === '') {
        resultCount.style.display = "none";
    } else {
        resultCount.textContent = `${totalVisibleItems} sonuç bulundu`;
        resultCount.style.display = totalVisibleItems > 0 ? "block" : "none";
    }
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
