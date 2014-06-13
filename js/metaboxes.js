jQuery(function($) {
  var $textbox = $('.steps-textbox'),
      field, fieldLocation, fieldInput,
      getField = function(e) {
        if ($(e.target).hasClass('add-headline')) {
          return $(e.target).closest('td').find('.custom_repeatable li:last').clone(true);
        } else { return null; }
      },
      setIndex = function(name, n) {
        var b = name.indexOf('[') + 1,
            e = name.indexOf(']'),
            start = name.slice(0, b),
            end = name.slice(e);
        return start + n + end;
      };
  
  $('.form-table td').click(function(e) {
    field = getField(e);
    if (field == null || field == '') return false;
    fieldLocation = $(e.target).closest('td').find('.custom_repeatable li:last');
    fieldInput = field.children().eq(1);

    fieldInput.val('').attr('name', function(index,name) {
      var n = $('.custom_repeatable li').length;
      return setIndex(name, n); 
    });

    field.insertAfter(fieldLocation, $(this).closest('td'));
    return false;
  });
   
  $('.repeatable-remove').click(function(){
      var pClass = $(this).parent().attr('class');
      if ($('.'+pClass).length > 1) { $(this).parent().remove(); }
      return false;
  });
  
  $('.custom_repeatable').sortable({
      opacity: 0.6,
      revert: true,
      cursor: 'move',
      handle: '.sort',
      deactivate: function() {
        $('.custom_repeatable li').each(function(i,e) {
          $(e).children().eq(1).attr('name', function(index,name) {
            return setIndex(name, i); 
          });
        });
      }
  });

  $textbox.prev('span.hndle').css({
    margin: '30px 5px 0 0',
    float: 'left'
  });

  $textbox.next('a.repeatable-remove').css('margin', '30px 0 0 5px');
});