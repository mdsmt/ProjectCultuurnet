###
 *
 *  jQuery Modals by Gary Hepting
 *  
 *  Open source under the MIT License. 
 *
 *  Copyright © 2013 Gary Hepting. All rights reserved.
 *
###

(($) ->

  # setup iframe modal
  if $('div#iframeModal').length < 1
    $('body').append('<div class="iframe modal" id="iframeModal"><iframe marginheight="0" marginwidth="0" frameborder="0"></iframe></div>')
    $('div#iframeModal').prepend('<i class="close icon-remove"></i>').prepend('<i class="fullscreen icon-resize-full"></i>')
  $('a.modal').each ->
    $(this).attr('data-url',$(this).attr('href'))
    $(this).attr('href','#iframeModal')
  # bind external modal links to iframe modal
  $('a.modal').on "click", (e) ->
    $('div#iframeModal iframe').replaceWith('<iframe marginheight="0" marginwidth="0" frameborder="0" width="100%" height="100%" src="'+$(this).attr('data-url')+'"></iframe>')
    e.preventDefault()
    false

  elems = []
  $.fn.modal = ->

    @each ->
      $(this).not('#iframeModal').wrapInner('<div class="modal-content"></div>')
      $(this).prepend('<i class="close icon-remove"></i>').prepend('<i class="fullscreen icon-resize-full"></i>').appendTo('body')
      # bind each modal link to a modal
      $this = $(this)
      $('[href=#'+$(this).attr('id')+']').on "click", (e) ->
        modals.open($(this).attr('href'), $(this).hasClass('fullscreen'))
        e.preventDefault()
        return false

    # close button
    $('div.modal .close').on "click", ->
      modals.close()
    # fullscreen button
    $('div.modal .fullscreen').on "click", ->
      modals.fullscreen($(this).parent('div.modal'))

  modals = (->

    # ready state
    $('body').addClass('modal-ready')
    
    # create overlay
    if $("#overlay").length < 1
      $('body').append('<div id="overlay"></div>')
    
    # bind overlay to close
    $('#overlay, div.modal .close').bind "click", (e) ->
      close()

    open = (elem, fullscreen) ->
      # bind esc key
      $(window).bind "keydown", (e) ->
        keyCode = (if (e.which) then e.which else e.keyCode)
        if keyCode is 27
          close()
      $(elem).addClass("active")
      unless $(elem).hasClass('iframe')
        $(elem).css
          width: 'auto',
          height: 'auto'
        $(elem).css
          height: $(elem).outerHeight()
      $(elem).css
        top: '50%',
        left: '50%',
        'margin-top': ($(elem).outerHeight() / -2) + 'px',
        'margin-left': ($(elem).outerWidth() / -2) + 'px'
      setTimeout ->
        $('body').addClass("modal-active")
      , 0
      setTimeout ->
        $('body').removeClass('modal-ready')
      , 400
      if fullscreen
        modals.fullscreen(elem)
      return

    close = ->
      modal = $('div.modal.active')
      $(window).unbind "keydown"
      $('body').removeClass("modal-active").addClass('modal-ready')
      if modal.hasClass('iframe')
        $('div#iframeModal iframe').replaceWith('<iframe marginheight="0" marginwidth="0" frameborder="0"></iframe>')
        modal.css
          width: '80%',
          height: '80%'
      else
        modal.css
          width: 'auto',
          height: 'auto'
      modal.css
        top: '10%',
        left: '10%',
        'max-width': '80%',
        'max-height': '80%',
        'margin-top': 0,
        'margin-left': 0
      modal.removeClass("active").removeClass("fullscreen")
      $('i.fullscreen', modal).removeClass('icon-resize-small').addClass('icon-resize-full')
      return

    fullscreen = (elem) ->
      if $('div.modal.active').hasClass('fullscreen')
        $('div.modal i.fullscreen').removeClass('icon-resize-small').addClass('icon-resize-full')
        if $('div.modal.active').hasClass('iframe')
          $('div.modal.active').css
            width: '80%',
            height: '80%'
        else
          $('div.modal.active').css
            width: 'auto',
            height: 'auto'
          $('div.modal.active').css
            height: $('div.modal.active').outerHeight()
        $('div.modal.active').removeClass('fullscreen').css
          'max-width': '80%',
          'max-height': '80%'
        $('div.modal.active').delay(100).css
          top: '50%',
          left: '50%',
          'margin-top': ($('div.modal.active').outerHeight() / -2) + 'px',
          'margin-left': ($('div.modal.active').outerWidth() / -2) + 'px'
      else
        $('div.modal i.fullscreen').addClass('icon-resize-small').removeClass('icon-resize-full')
        $('div.modal.active').addClass('fullscreen').css
          top: 0,
          left: 0,
          'margin-top': 0,
          'margin-left': 0,
          width: '100%',
          height: '100%',
          'max-width': '100%',
          'max-height': '100%'
      return

    open: open
    close: close
    fullscreen: fullscreen
  )()

  $(window).resize ->
    $('div.modal.active').each ->
      unless $(this).hasClass('fullscreen')
        $(this).removeClass('active').css(
          top: '50%',
          left: '50%',
          'margin-top': ($(this).outerHeight() / -2) + 'px',
          'margin-left': ($(this).outerWidth() / -2) + 'px'
        ).addClass('active')
        unless $(this).hasClass('iframe')
          $(this).css
            height: 'auto'
          $(this).css
            height: $(this).outerHeight()


) jQuery
