<h1><a href=index.php><?php echo site; ?></a></h1>
<h2>Add New Poem</h2>
<form id="addNewPoem" name="addPoem" onsubmit="return validate();"
      action="index.php?v=poem" id="addPoem" method="POST" >
    <input type="hidden" name="xx" value="addPoem" />
    Title:<br /> <input type="text" name="title"/><br />
    Author:<br /> <input type="text" name="author"/><br />
    Poem:<br />
    <textarea rows="6" cols="50" name="poem"></textarea>
    <br />
    <input type="submit" value="Submit">
</form>

<script type="text/javascript">
    function validate() {
        var title = document.forms["addPoem"]["title"].value;
        var author = document.forms["addPoem"]["author"].value;
        var poem = document.forms["addPoem"]["poem"].value.split("\n");
        if ((title.length > 30) || (title.length == 0)) {
            alert("Title Length must be more than 0\n\
 or less than 30 characters!");
            return false; // keep form from submitting
        }
        if ((author.length > 30) || (author.length == 0)) {
            alert("Author name must be more than 0 or\n\
 less than 30 characters!");
            return false; // keep form from submitting
        }
        if ((poem.length) != 5) {
            alert("A Poem need to have 5 lines");
            return false; // keep form from submitting
        }
        for (var i = 0; i < poem.length; i++) {
            var str = poem[i];
            if ((str.length > 40)) {
                alert("A poem cannot have a line with less\n\
 than 0 or more than 30 characters");
                return false; // keep form from submitting
            }
        }
        return true;
    }
</script>

