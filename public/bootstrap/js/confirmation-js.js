  console.log('Bootstrap ' + $.fn.tooltip.Constructor.VERSION);
  console.log('Bootstrap Confirmation ' + $.fn.confirmation.Constructor.VERSION);

  $('[data-toggle=confirmation]').confirmation({
    rootSelector: '[data-toggle=confirmation]',
    container: 'body'
  });
  $('[data-toggle=confirmation-singleton]').confirmation({
    rootSelector: '[data-toggle=confirmation-singleton]',
    container: 'body'
  });
  $('[data-toggle=confirmation-popout]').confirmation({
    rootSelector: '[data-toggle=confirmation-popout]',
    container: 'body'
  });

  $('#confirmation-delegate').confirmation({
    selector: 'button'
  });

  var currency = '';
  $('#custom-confirmation').confirmation({
    rootSelector: '#custom-confirmation',
    container: 'body',
    title: null,
    onConfirm: function(currency) {
      var pid = $(this).attr('data-id');
      var vurl = $(this).attr('url');

      //window.location = "{ url('/edit') }"
      //window.location.href = "{{ route('admin.users.edit', $v_id) }}";
      //window.location.href = 'admin/articles/';
    },
    buttons: [
      {
        class: 'btn btn-default',
        icon: 'glyphicon glyphicon-duplicate',
        value: 'Duplicar'
      },
      {
        class: 'btn btn-primary',
        icon: 'glyphicon glyphicon-download-alt',
        value: 'Descargar'
      },
      {
        class: 'btn btn-warning',
        icon: 'glyphicon glyphicon-barcode',
        value: 'Generar código'
      },
      {
        class: 'btn btn-default',
        icon: 'glyphicon glyphicon-remove',
        cancel: true
      }
    ]
  });

  $('#custom-confirmation-links').confirmation({
    rootSelector: '#custom-confirmation-link',
    container: 'body',
    title: null,
    buttons: [
      {
        label: 'Twitter',
        attr: {
          href: 'https://google.com'
        }
      },
      {
        label: 'Facebook',
        attr: {
          href: 'https://facebook.com'
        }
      },
      {
        label: 'Pinterest',
        attr: {
          href: 'https://pinterest.com'
        }
      }
    ]
  });
