$(document).ready(function(){


    $('#loader').html("<img class='upload-listener' src='assets/img/loader.gif'>"); 

    $('form').submit(function() {
        $('#loader').html("<img class='upload-listener ' src='assets/img/save_loader.gif'>"); 

    });
	$('form').change(function() {
	  $('#loader').empty();
	  var p_prc  = $('#product_price').val();
	  var p_ctg  = $('#product_category').val();
      var p_qty  = $('#product_qty').val();
      $('#price').html("<p id='price'>"+"Price:  $" +p_prc + "</p>"); 
      $('#category').html("<p id='category'>"+"category: "+ p_ctg + "</p>");  
      $('#qty').html("<p id='qty'>"+"QTY: "+ p_qty + "</p>");  
         
	});
    $("#product_name").keyup(function(){
        $('#loader').empty();
        var p_name = $('#product_name').val();
        $('#title').html("<p id='title'>"+ p_name + "</p>");    
        
    });

    $("#product_description").keyup(function(){
        $('#loader').empty();
        var p_dsc  = $('#product_description').val();
        $('#description').html("<p id='description'>"+ p_dsc + "</p>");
    });

    $("#product_image").on('change',function(){
        $('#loader').empty();
        var html =''
        $("#preview").empty();
        for(var i=0;i<this.files.length;++i){
            var reader = new FileReader();
                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo('#img-preview');
                   
                }
                reader.readAsDataURL(this.files[i]);
        }
        $('#preview-inner').find('img:first')
    });


        
 
});
