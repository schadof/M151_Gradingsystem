<?php
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Note</th><th>Wertung</th><th>Beschreibung</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["question"] . " name='q" . $x . "'</td>";
        echo "<td>" . $row["answer"] . " name='a" . $x . "'</td>";
        echo "<td>" . $row["worth"] . " name='w" . $x . "'</td>";
        echo "<td><label>mark</label></td>";
        $x++;
    }
    echo "<tr><td class='add'><input type='text' class='textbox' name='q" . $x . "'></td>";
    echo "<td class='add'><input type='text' class='textbox' name='a" . $x . "'></td>";
    echo "<td class='add'><input type='number' name='w" . $x . "'></td>";
    echo "</table>";
}

}
echo "<script>"
    . "function attachCheckboxHandlers() {"
    //loading all elements with class name point
    . "var tops = document.getElementsByClassName('point');"
    //loop runs while there are elements by from class point
    . "for (var i=0, len=tops.length; i<len; i++) {"
    . "if ( tops[i].type === 'checkbox' ) {"
    //when checkbox with nr. i is checked run updateTotal
    . "tops[i].onclick = updateTotal;"
    . "}"
    . "}"
    . "}"
    . "function updateTotal(e) {"
    . "var form = this.form;"
    //setting content from val to label f_result
    . "var val = parseFloat( document.getElementById('f_result').textContent );"
    //if checked
    . "if ( this.checked ) {"
    //calculating points
    . "val += parseFloat(this.value);"
    //printing points
    . "document.getElementById('f_result').innerHTML = val;"
    //calculating mark
    . "document.getElementById('mark').innerHTML = Math.round((val*5/" . $total . "+1) * 100) / 100;"
    . "}"
    //if unchecked
    . "else {"
    . "val -= parseFloat(this.value);"
    . "document.getElementById('f_result').innerHTML = val;"
    . "document.getElementById('mark').innerHTML = Math.round((val*5/" . $total . "+1) * 100) / 100;"
    . "}"
    . "}"
    . "</script>";
}
echo "<script>attachCheckboxHandlers();</script>";
?>
