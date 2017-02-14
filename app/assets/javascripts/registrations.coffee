jQuery ->
  readURL = (input) ->
    if input.files and input.files[0]
      reader = new FileReader

      reader.onload = (e) ->
        $('#image_input_preview').attr 'src', e.target.result
        return

      reader.readAsDataURL input.files[0]
    return

  $('#image_input').change ->
    readURL this
    return

  $('#image_input_preview').click ->
    $('#image_input').click()
