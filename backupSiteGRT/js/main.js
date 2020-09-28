$(document).ready(function(){
    
    var imgItems = $('.slider li').length; //Número de slides --
    var imgPos = 1;
    
        //Agregando paginación --
//AQUÍ SE CAMBIA EL ESTILO DE CÍRCULO DEL SLIDE
        for(i = 1; i <=imgItems; i++){
            $('.pagination').append('<li><span class="fas fa-circle"></span></li>');
        }
        //Agregando paginación --
        
    
    $('.slider li').hide(); //Ocultamos todos los slides
    $('.slider li:first').show(); //Mostramos el primer slide
//AQUÍ SE CAMBIA EL COLOR DEL PRIMER CÍRCULO DEL SLIDE    
    $('.pagination li:first').css({'color':'#EB6419'}); //Damos estilos al primer item de la paginación
    
    //Ejecutamos todas las funciones
    
    $('.pagination li').click(pagination);
    $('.right span').click(nextSlider);
    $('.left span').click(prevSlider);
    
    setInterval (function(){
        nextSlider();
    }, 8000);
    
    
    //Funciones ------------------------------
    
    function pagination(){
        
        var paginationPos = $(this).index() + 1; //Posición de la paginación seleccionada
        
        $('.slider li').hide(); //Ocultamos todos los slides
        $('.slider li:nth-child('+ paginationPos +')').fadeIn(); //Mostramos el slide seleccionado
        
        //Dándole estilos a la paginación seleccionada 
 //AQUÍ SE CAMBIA EL COLOR DE LOS CÍRCULOS DEL SLIDE      
        $('.pagination li').css({'color':'#fff'});
        $(this).css({'color':'#EB6419'});
        
        imgPos = paginationPos;
    }
    
    
    function nextSlider(){
        
        if(imgPos >= imgItems){imgPos = 1;}
        else {imgPos++;}
        
        $('.pagination li').css({'color': '#fff'});
        $('.pagination li:nth-child('+ imgPos +')').css({'color': '#EB6419'});
        
        $('.slider li').hide(); //Ocultamos todos los slides
        $('.slider li:nth-child('+ imgPos +')').fadeIn(); //Mostramos el slide seleccionado
    }
    
    function prevSlider(){
        
        if(imgPos <= 1){imgPos = imgItems;}
        else {imgPos--;}
        
        $('.pagination li').css({'color': '#fff'});
        $('.pagination li:nth-child('+ imgPos +')').css({'color': '#EB6419'});
        
        $('.slider li').hide(); //Ocultamos todos los slides
        $('.slider li:nth-child('+ imgPos +')').fadeIn(); //Mostramos el slide seleccionado
    }
    
});