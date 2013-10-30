<h1><a href=index.php><?php echo site; ?></a></h1>

<form action="index.php" method="GET">
    <input type="hidden" name="v" value="poem" />
    <input type="hidden" name="view" value="featuredpoem" />
    <input type="submit" value="Add new Poem" />
</form>
<br/>
<a href="index.php?v=poem&view=randompoemview&xx=randomPoem&e=0">View Random Poem</a>
<h2>Selected Poem View</h2>

<table>
    <?php
    $poem_content = get_poem($data, $_GET["e"]);
    ?>
    <tr><td class="Title"><b><?php echo "Title:  " . $poem_content[0]; ?></b></td></tr>
    <tr><td class="Author"><b><?php echo "Author:  " . $poem_content[1]; ?></b></td></tr>
    <tr><td class="Poem"> <?php echo nl2br($poem_content[2]); ?></td></tr>
    <tr><td class="Rating"> <b>This poem is:</b>
            <?php
            $count = 0;
            for ($i = 0; $i < round($poem_content[3], 0, PHP_ROUND_HALF_DOWN); $i++) {
                $count++;
                echo '<img src="./images/star_yellow.gif" height="18" width="18">';
            }
            if ($poem_content[3] - $count != 0) {
                echo '<img src="./images/star_half.gif" height="18" width="18">';
            }
            ?></td></tr>
</table>

<br />

<span id="Status">Rate This Poem</span>
<span id="Saved">Thanks!</span>

<div id="ratepoem" title="<b>Rate This Poem</b>">
    <a onclick="rateThisPoem(this)" id="_1" title="<?php echo $poem_content[0]; ?>" name="1" onmouseover="rating(this)" onmouseout="notHover(this)"></a>
    <a onclick="rateThisPoem(this)" id="_2" title="<?php echo $poem_content[0]; ?>" name="2" onmouseover="rating(this)" onmouseout="notHover(this)"></a>
    <a onclick="rateThisPoem(this)" id="_3" title="<?php echo $poem_content[0]; ?>" name="3" onmouseover="rating(this)" onmouseout="notHover(this)"></a>
    <a onclick="rateThisPoem(this)" id="_4" title="<?php echo $poem_content[0]; ?>" name="4" onmouseover="rating(this)" onmouseout="notHover(this)"></a>
    <a onclick="rateThisPoem(this)" id="_5" title="<?php echo $poem_content[0]; ?>" name="5" onmouseover="rating(this)" onmouseout="notHover(this)"></a>
</div>

<style type="text/css">
    #Status{float:left; clear:both; width:100%; height:20px;}
    #ratepoem{float:left; clear:both; width:100%; height:auto; padding:0px; margin:0px;}
    #ratepoem li{float:left;list-style:none;}
    #ratepoem li a:hover,
    #ratepoem .on{background:url(images/star_yellow.gif) no-repeat;}
    #ratepoem a{float:left;background:url(images/star_gray.gif) no-repeat;width:25px; height:25px;}
    #Saved{display:none;}
    .saved{color:red; }
</style>

<script type="text/javascript">
        var starNumber;	// number of stars
        var clicked;
        var preValue;
        var rated;

        //Image Stars
        function rating(num) {
            starNumber = 0;	// Isthe maximum number of stars
            for (n = 0; n < num.parentNode.childNodes.length; n++) {
                if (num.parentNode.childNodes[n].nodeName == "A") {
                    starNumber++;
                }
            }

            if (!rated) {
                s = num.id.replace("_", ''); // Get the selected star
                a = 0;
                for (i = 1; i <= starNumber; i++) {
                    if (i <= s) {
                        document.getElementById("_" + i).className = "on";
                        document.getElementById("Status").innerHTML = num.title;
                        clicked = a + 1;
                        a++;
                    } else {
                        document.getElementById("_" + i).className = "";
                    }
                }
            }
        }

        //Not hover on stars
        function notHover(thePoem) {
            if (!rated) {
                if (!preValue) {
                    for (i = 1; i <= starNumber; i++) {
                        document.getElementById("_" + i).className = "";
                        document.getElementById("Status").innerHTML = thePoem.parentNode.title;
                    }
                } else {
                    rating(preValue);
                    document.getElementById("Status").innerHTML = document.getElementById("Saved").innerHTML;
                }
            }
        }

        //Rate poem
        function rateThisPoem(thePoem) {
            if (!rated) {
                //document.getElementById("Status").innerHTML = document.getElementById("Saved").innerHTML + " :: " + thePoem.title;
                preValue = thePoem;
                rated = 1;
                recordRate(thePoem);
                rating(thePoem);
            }
        }

        // Send the rating information
        function recordRate(rate) {
            form = document.createElement('form');
            form.setAttribute('method', 'GET');
            form.setAttribute('action', "index.php?v=poem");
            myvar = document.createElement('input');
            myvar.setAttribute('name', 'xx');
            myvar.setAttribute('type', 'hidden');
            myvar.setAttribute('value', 'updateRate');
            myvar2 = document.createElement('input');
            myvar2.setAttribute('name', 'rate');
            myvar2.setAttribute('type', 'hidden');
            myvar2.setAttribute('value', rate.name);
            myvar3 = document.createElement('input');
            myvar3.setAttribute('name', 'title');
            myvar3.setAttribute('type', 'hidden');
            myvar3.setAttribute('value', rate.title);
            form.appendChild(myvar);
            form.appendChild(myvar2);
            form.appendChild(myvar3);
            document.body.appendChild(form);
            form.submit();
            alert("Your rating was: " + rate.name);
        }
</script>

<b class="listTitle">10 Most Recent Submitted Poems</b><Br/>
<?php
$recentpoems = $dataM;
for ($i = 0; $i < count($recentpoems); $i++) {
    echo $recentpoems[$i] . "<BR/>";
}
?>
<BR/>
<b class="listTitle">10 Favorite Poems</b><Br/>
<?php
$favpoems = $dataFav;
for ($i = 0; $i < count($favpoems); $i++) {
    echo $favpoems[$i] . "<BR/>";
}
?>