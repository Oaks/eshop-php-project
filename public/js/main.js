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

  function showCart(cart) {
    if ($.trim(cart) == '<h3>Корзина пуста</h3>') {
      // Скрыть кнопки "Оформить заказ" и "Очистить корзину".
      $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
      $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
      $('#cart .modal-body').html(cart);
      $('#cart ').modal();

    }
  };
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
