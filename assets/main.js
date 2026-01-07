// Update cart badge
function updateCartBadge(count) {
    var badge = $('.cart-badge');
    if (count > 0) {
        if (badge.length) {
            badge.text(count);
        } else {
            $('.nav-link.position-relative').append('<span class="cart-badge">' + count + '</span>');
        }
    } else {
        badge.remove();
    }
}

// Show alert message
function showAlert(type, message) {
    var alert = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
        message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>');

    $('.container').first().prepend(alert);

    setTimeout(function () {
        alert.alert('close');
    }, 3000);
}

// Format currency
function formatCurrency(amount) {
    return 'Rp ' + parseInt(amount).toLocaleString('id-ID');
}