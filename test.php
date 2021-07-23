


<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names..">

<ul id="myUL">
    <li><a href="#">Adele</a></li>
    <li><a href="#">Agnes</a></li>

    <li><a href="#">Billy</a></li>
    <li><a href="#">Bob</a></li>

    <li><a href="#">Calvin</a></li>
    <li><a href="#">Christina</a></li>
    <li><a href="#">Cindy</a></li>
</ul>



<script>
    function myFunction() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('myInput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>





<body>
    <form name="asfasf" action="#" onsubmit="required()">
        <ul>
            <li><input type='text' name ='ghefa'/></li>
            <li><input type="submit" name="submit" value="Submit" /></li>
        </ul>
    </form>
</body>



<script>
function required()
{
var empt = document.forms["asfasf"]["ghefa"].value;
if (empt == "")
{
alert("Please input a Value");
return false;
}
else
{
alert('Code has accepted : you can try another');
return true;
}
}
</script>