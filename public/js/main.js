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
