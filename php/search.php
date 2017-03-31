<?php include("include_header.php");?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="js/input_method.js"></script>
<main class="cd-main-content">
        <div class="cd-scrolling-bg cd-color-2">
            <div class="cd-container">
                <h1 class="clr1 gapBelow">ಹುಡುಕಾಟ</h1>
<?php

include("connect.php");
require_once("common.php");

?>
                <div class="archive_search">
                    <form method="get" action="search-result.php">
                        <table>
                            <tr>
                                <td class="left"><label for="textfield2" class="titlespan">ಲೇಖನಗಳು</label></td>
                                <td class="right"><input name="title" type="text" class="titlespan wide" id="textfield2" maxlength="150"/></td>
                            </tr>
                            <tr>
                                <td class="left"><label for="autocomplete" class="titlespan">ಲೇಖಕರು</label></td>
                                <td class="right"><input name="author" type="text" class="titlespan wide" id="autocomplete" maxlength="150" />
<?php

$query_ac = "select * from author order by authorname";
$result_ac = $db->query($query_ac);
$num_rows_ac = $result_ac ? $result_ac->num_rows : 0;
echo "<script type=\"text/javascript\">$( \"#autocomplete\" ).autocomplete({source: [ ";
$source_ac = '';
if($num_rows_ac > 0)
{
    for($i=1;$i<=$num_rows_ac;$i++)
    {
        $row_ac = $result_ac->fetch_assoc();
        $source_ac = $source_ac . ', '. '"' . $row_ac['authorname'] . '"';
    }
    $source_ac = preg_replace("/^\, /", "", $source_ac);
}

echo $source_ac . ']});</script></td>';
echo '</tr>';
if($result_ac){$result_ac->free();}

?>

                            <tr>
                                <td class="left"><label class="titlespan">ಸ್ಥಿರ ಶೀರ್ಷಿಕೆಗಳು</label></td>
                                <td class="right">
                                    <select name="featid" class="titlespan wide">
                                        <option value="">&nbsp;</option>

<?php

$query = "select * from feature where feat_name != '' order by feat_name";
$result = $db->query($query);
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
    for($i=1;$i<=$num_rows;$i++)
    {
        $row = $result->fetch_assoc();

        $feat_name=$row['feat_name'];
        $featid=$row['featid'];
        echo "<option value=\"$featid\">" . $feat_name . "</option>";
    }
}

if($result){$result->free();}

?>

                                    </select>
                                </td>
                            </tr>

<!--
                            <tr>
                                <td class="left"><label for="textfield3" class="titlespan">ಪದಗಳು</label></td>
                                <td class="right"><input name="text" type="text" class="titlespan wide" id="textfield3" maxlength="150"/></td>
                            </tr>
-->
                            <tr>
                                <td class="left">&nbsp;</td>
                                <td class="right">
                                    <input name="searchform" type="submit" class="clr1 med" id="button_search" value="ಹುಡುಕಿ"/>
                                    <input name="resetform" type="reset" class="clr1 med" id="button_reset" value="ಅಳಿಸಿ"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div> <!-- cd-container -->
        </div> <!-- cd-scrolling-bg -->
    </main> <!-- cd-main-content -->
<?php include("include_footer.php");?>
