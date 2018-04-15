        function addFields(){
            // Number of inputs to create
            var number = document.getElementById("member").value;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("inputs");
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=0;i<number;i++){
                // Append a node with a random text
                container.appendChild(document.createTextNode("المادة " + (i+1)));
                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.placeholder = "الكمية";
                input.name = "member" + i;
                input.className="form-control"
                container.appendChild(input);

                var input2 = document.createElement("input");
                input2.type = "text";
                input2.placeholder = "السعر";
                input2.className="form-control";
                input2.name = "member" + i;
                container.appendChild(input2);

                var input3 = document.createElement("input");
                input3.type = "text";
                input3.placeholder = "السعر";
                input3.className="form-control";
                input3.name = "member" + i;
                container.appendChild(input3);

                // Append a line break 
                container.appendChild(document.createElement("br"));
            }
        }


        $(function (){
            'use strict';
        
        
        
             $('[placeholder]').focus(function (){
                 
                
                 $(this).attr('data-text' , $(this).attr('placeholder'));
                $(this).attr('placeholder' , '')
            }).blur(function (){
                $(this).attr('placeholder' , $(this).attr('data-text')); 
            }); 


        
        
        

        
            // Confirm Delete
            $(".confirm").click(function(){
                return confirm("Are You Sure ?");
        
            });
        
        

            // Live Preview 
        
            $('.live-name').keyup(function(){
        
                $('.live-preview .name-emp').text($(this).val());
        
            });
            $('.live-address').keyup(function(){
        
                $('.live-preview .address').text($(this).val());
        
            });
            $('.live-phone').keyup(function(){
        
                $('.live-preview .phone').text($(this).val());
        
            });
            $('.live-salary').keyup(function(){
        
                $('.live-preview .salary').text($(this).val());
        
            });
        
        
            
        });
        


