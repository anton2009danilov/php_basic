<br>
<form method="post" action="/math">

    <input type="text" name="operand1" value=<?=$operand1?>>
    <select name="operation">
        <option><?=$operation?></option>
        <option value="+">+</option>
        <option value="-">-</option>
        <option value="*">*</option>
        <option value="/">/</option>
    </select>
    <input type="text" name="operand2" value=<?=$operand2?>>
    <input type="submit" value="=">
    <!-- <button class="action"> = </button> -->
    <input type="text" id="val3" value="<?=$result?>">

</form>

