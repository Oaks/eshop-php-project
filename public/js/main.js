/* Cart */
$('body').on('click', '.add-to-cart-link', function(e) {
  e.preventDefault(); // Отменить переход по ссылке, если таковая имеется

  var id = $(this).data('id'),
      qty = $('.quantity input').val() ? $('.quantity input').val() : 1,
      mod = $('.available select').val();

  $.ajax({
    url: 'cart/add',
    type: 'GET',
    data: {id: id, qty: qty, mod: mod},
    success: function(res) {
      showCart(res);
    },
    error: function() {
      alert('Ошибка! Повторите позже');
    }
  });

})

function showCart(cart) {
  // Обновить модальное окно корзины
  if ($.trim(cart) == '<h3>Корзина пуста</h3>') {
    // Скрыть кнопки "Оформить заказ" и "Очистить корзину".
    $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
  } else {
    $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
  }
    $('#cart .modal-body').html(cart);
    $('#cart ').modal();
  // Обновить цену при иконке "корзина"
  if ($('.cart-sum').text()) {
    $('.simpleCart_total').html($('.cart-sum').text());
  } else {
    $('.simpleCart_total').html('Empty Cart');
  }
};

function getCart() {
  $.ajax({
    url: 'cart/show',
    type: 'GET',
    success: function(res) {
      showCart(res);
    },
    error: function() {
      alert('Ошибка! Повторите позже');
    }
  });
}

$('#cart .modal-body').on('click', '.del-item', function() {
  var id = $(this).data('id');
  $.ajax({
    url: 'cart/delete',
    type: 'GET',
    data: {id: id},

    success: function(res) {
      showCart(res);
    },
    error: function() {
      alert('Ошибка! Повторите позже');
    }
  });
})

/* Cart */

$('#currency').change( function() {
  window.location = 'currency/change?curr='  + $(this).val();
});

$('.available select').on('change', function() {
  var val = $(this).val();
  var color =$(this).find('option').filter(':selected').data('title');
  var price =$(this).find('option').filter(':selected').data('price');
  var basePrice = $('#base-price').data('base');
  if (price) {
    $('#base-price').text(symbolLeft + price + symbolRight);
  } else {
    $('#base-price').text(symbolLeft + basePrice + symbolRight);
  }
})
