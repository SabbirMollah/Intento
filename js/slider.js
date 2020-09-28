function findOutputForSlider(el) {
    var idVal = el.id;
    outputs = document.getElementsByTagName('output');
    for( var i = 0; i < outputs.length; i++ ) {
      if (outputs[i].htmlFor == idVal)
        return outputs[i];
    }
 }
 
 var sliders = document.querySelectorAll( 'input[type="range"].slider' );
 [].forEach.call( sliders, function ( slider ) {
   var output = findOutputForSlider( slider );
   if ( output ) {
     slider.addEventListener( 'input', function( event ) {
       output.value = event.target.value;
     } );
   }
 } );