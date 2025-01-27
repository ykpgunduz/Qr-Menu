let debounceTimeout;

function debouncedSearch() {
    clearTimeout(debounceTimeout);
    showClearButton();
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

$(document).ready(function() {
    // AJAX URL'ini meta tag'den alıyoruz
    const addToCartUrl = $('meta[name="add-to-cart-url"]').attr('content');

    $('.add-to-cart-form').on('submit', function(event) {
        event.preventDefault();

        var form = $(this);
        var productId = form.data('product-id');
        var tableNumber = form.data('table-number');
        var button = form.find('.btn-add-cart');
        var counter = $(`#counter-${productId}`);
        var removeBtn = form.find('.remove-btn');
        var currentCount = parseInt(counter.text()) || 0;

        button.addClass('loading');
        button.prop('disabled', true);

        $.ajax({
            url: addToCartUrl,
            type: 'POST',
            data: {
                product_id: productId,
                table: tableNumber,
                quantity: 1,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                currentCount++;
                counter.text(currentCount).show();
                removeBtn.show();
                showToast('success', 'Ürün eklendi.');
            },
            error: function(xhr) {
                let errorMessage = 'Bir hata oluştu';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                showToast('error', errorMessage);
            },
            complete: function() {
                button.removeClass('loading');
                button.prop('disabled', false);
            }
        });
    });
});

function decreaseQuantity(productId) {
    const counter = $(`#counter-${productId}`);
    const removeBtn = $(`.add-to-cart-form[data-product-id="${productId}"] .remove-btn`);
    const tableNumber = $(`.add-to-cart-form[data-product-id="${productId}"]`).data('table-number');
    let currentCount = parseInt(counter.text());

    $.ajax({
        url: '/cart/decrease/' + productId,
        type: 'POST',
        data: {
            table: tableNumber,
            quantity: 1,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            currentCount--;

            if (currentCount <= 0) {
                counter.hide();
                removeBtn.hide();
                counter.text(0);
            } else {
                counter.text(currentCount);
            }

            showToast('warning', 'Ürün çıkarıldı.');
        },
        error: function(xhr) {
            let errorMessage = 'Bir hata oluştu';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            showToast('error', errorMessage);
        }
    });
}

function updateProductUI(productId, increment = true) {
    const actionsDiv = $(`#actions-${productId}`);
    const addBtn = actionsDiv.find('.add-btn');
    const quantityControls = actionsDiv.find('.quantity-controls');
    const quantityBadge = actionsDiv.find('.quantity-badge');

    let quantity = parseInt(quantityBadge.text() || 0);

    if (increment) {
        quantity++;
    } else {
        quantity--;
    }

    if (quantity > 0) {
        addBtn.hide();
        quantityControls.show();
        quantityBadge.text(quantity);
    } else {
        addBtn.show();
        quantityControls.hide();
    }
}

function removeFromCart(productId) {
    // Sepetten ürün silme AJAX isteği
    $.ajax({
        url: '/cart/remove', // Bu endpoint'i backend'de oluşturmanız gerekecek
        type: 'POST',
        data: {
            product_id: productId,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            updateProductUI(productId, false);
            $('#success-message').text('Ürün sepetten çıkarıldı').show();
            setTimeout(function() {
                $('#success-message').fadeOut();
            }, 3000);
        },
        error: function(xhr, status, error) {
            $('#error-message').text('Bir hata oluştu!').show();
            setTimeout(function() {
                $('#error-message').fadeOut();
            }, 3000);
        }
    });
}

// AJAX error handler'ı güncelliyoruz
$.ajaxSetup({
    error: function(xhr, status, error) {
        if (xhr.status === 419) { // CSRF token hatası
            showToast('error', 'Oturum süreniz doldu. Lütfen sayfayı yenileyiniz.');
        } else {
            showToast('error', 'Bir hata oluştu. Lütfen tekrar deneyiniz.');
        }
    }
});

// Yeni toast mesaj sistemi
function showToast(type, message) {
    // Önce eski toast'ları temizle
    $('.toast-message').remove();

    // Yeni toast oluştur
    const toast = $(`
        <div class="toast-message toast-${type}">
            <div class="toast-content">
                <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-exclamation-circle'}"></i>
                <span>${message}</span>
            </div>
        </div>
    `);

    // Toast'u ekle ve animasyonla göster
    $('body').append(toast);
    setTimeout(() => toast.addClass('show'), 100);

    // 3 saniye sonra kaldır
    setTimeout(() => {
        toast.removeClass('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Arama çubuğu temizleme fonksiyonları
function showClearButton() {
    const searchInput = document.getElementById("search-bar");
    const clearButton = document.querySelector(".clear-search");

    if (searchInput.value.length > 0) {
        clearButton.style.display = "block";
    } else {
        clearButton.style.display = "none";
    }
}

function clearSearch() {
    const searchInput = document.getElementById("search-bar");
    searchInput.value = "";
    showClearButton();
    searchProducts(); // Mevcut arama fonksiyonunu çağır
    searchInput.focus(); // Input'a tekrar odaklan
}

function showProductDetails(productId) {
    $.ajax({
        url: `/product/${productId}`,
        type: 'GET',
        success: function(response) {
            $('#productDetailContent').html(response);
            $('#productDetailModal').modal('show');
        },
        error: function() {
            showToast('error', 'Ürün detayları yüklenemedi.');
        }
    });
}
