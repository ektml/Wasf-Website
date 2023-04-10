$(document).ready(function(){



  $("#category").on("change",function(){

  
    var id  =  $(this).val();

   $.ajax({
    url: "freelancer/getservice/"+id,
    method: 'GET',
    dataType: 'JSON',
    contentType: false,
    cache: false,
    processData: false,
    success:function(response)
    {
        // if(response !=null){

        //     var row = '<option';
        //     row += 'value ='+response.id+'</th>';
        //     row += '>'+response.title+'</td>';
        // row += '</option>';
        // }
        // else{
        //     var row="<option value=''> no data </option>"
        // }
       
        // $("#service").append(row);
        console.log(response);
        
    },
    error: function(response) {
    }

   })



  });






})