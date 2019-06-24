<br>
<!-- <form method="post" action="/math"> -->
    <label for="val1">Первое число</label><br>
    <input type="text" name="val1" id="val1"><br>
    
    <label for="val1">Второе число</label><br>
    <input type="text" name="val2" id="val2"><br>

    <input type="submit" class="add" id="add" value="+">
    <input type="submit" class="dim" id="dim" value="-">
    <input type="submit" class="mult" id="mult" value="*">
    <input type="submit" class="div" id="div" value="/"><br>

    <!-- <button class="action"> = </button> -->
    <label for="val3">Результат</label><br>
    <input type="text" id="val3" value="">
<!-- </form> -->

<script>
    $(document).ready(function(){
        $(".add").on('click', function(){
            let operand1 = $("#val1").val();
            let operand2 = $("#val2").val();
            let operation = "+";
            
            $.ajax({
                url: "../math2",
                type: "POST",
                dataType: "json",
                data: {
                    operand1: operand1,
                    operand2: operand2,
                    operation: operation
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    $('#val3').val(answer.result);
                }
            })
        })

        $(".dim").on('click', function(){
            let operand1 = $("#val1").val();
            let operand2 = $("#val2").val();
            let operation = "-";
            
            $.ajax({
                url: "../math2",
                type: "POST",
                dataType: "json",
                data: {
                    operand1: operand1,
                    operand2: operand2,
                    operation: operation
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    $('#val3').val(answer.result);
                }
            })
        })

        $(".mult").on('click', function(){
            let operand1 = $("#val1").val();
            let operand2 = $("#val2").val();
            let operation = "*";
            
            $.ajax({
                url: "../math2",
                type: "POST",
                dataType: "json",
                data: {
                    operand1: operand1,
                    operand2: operand2,
                    operation: operation
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    $('#val3').val(answer.result);
                }
            })
        })

        $(".div").on('click', function(){
            let operand1 = $("#val1").val();
            let operand2 = $("#val2").val();
            let operation = "/";
            
            $.ajax({
                url: "../math2",
                type: "POST",
                dataType: "json",
                data: {
                    operand1: operand1,
                    operand2: operand2,
                    operation: operation
                },
                error: function() {console.log("ajax error");},
                success: function(answer){
                    $('#val3').val(answer.result);
                }
            })
        })
    })

</script>