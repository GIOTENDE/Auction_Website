function sortName() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;
    // Make a loop that will continue until
    // no switching has been done
    while (switching) {
        // Start by saying that no switching is done
        switching = false;
        rows = table.getElementsByTagName("TR");
        // Loop through table rows
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching
            shouldSwitch = false;
            // get two rows and compare
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            // Check if the two rows should switch places
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                // If so, mark as a switch and break the loop:
                shouldSwitch= true;
                break;
            }
        }
        if (shouldSwitch) {
            // If switch was marked then do it and break
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function filterCategory() {
var input, filter, table, tr, td, i;
input = document.getElementById("condition");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("TR");

// loop through the table rows and eliminate
// the ones that don't match the condition

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("TD")[4];
        if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }

}

function sortReservePrice(value) {
    var table, rows, switching, i, x, y, shouldSwitch, x1, x2;
    table = document.getElementById("myTable");
    switching = true;

    if (value == "High to Low") {
        while (switching) {
            // Start by saying that no switching is done
            switching = false;
            rows = table.getElementsByTagName("TR");
            // Loop through table rows
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching
                shouldSwitch = false;
                // get two rows and compare
                x = rows[i].getElementsByTagName("TD")[5];
                y = rows[i + 1].getElementsByTagName("TD")[5];
                // Check if the two rows should switch places
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If switch was marked then do it and break
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    } else if (value == "Low to High") {
        while (switching) {
            // Start by saying that no switching is done
            switching = false;
            rows = table.getElementsByTagName("TR");
            // Loop through table rows
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching
                shouldSwitch = false;
                // get two rows and compare
                x = rows[i].getElementsByTagName("TD")[5];
                y = rows[i + 1].getElementsByTagName("TD")[5];
                // Check if the two rows should switch places
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If switch was marked then do it and break
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

}

function sortHighestBid(value) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;

    if (value == "High to Low") {
        while (switching) {
            // Start by saying that no switching is done
            switching = false;
            rows = table.getElementsByTagName("TR");
            // Loop through table rows
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching
                shouldSwitch = false;
                // get two rows and compare
                x = rows[i].getElementsByTagName("TD")[6];
                y = rows[i + 1].getElementsByTagName("TD")[6];
                // Check if the two rows should switch places
                if (Number(x.innerHTML) < Number(y.innerHTML)) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If switch was marked then do it and break
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    } else if (value == "Low to High") {
        while (switching) {
            // Start by saying that no switching is done
            switching = false;
            rows = table.getElementsByTagName("TR");
            // Loop through table rows
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching
                shouldSwitch = false;
                // get two rows and compare
                x = rows[i].getElementsByTagName("TD")[6];
                y = rows[i + 1].getElementsByTagName("TD")[6];
                // Check if the two rows should switch places
                if (Number(x.innerHTML) > Number(y.innerHTML)) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If switch was marked then do it and break
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

}

function endingSoon(value) {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("myTable");
    switching = true;

    if (value == "Ending soonest") {
        while (switching) {
            // Start by saying that no switching is done
            switching = false;
            rows = table.getElementsByTagName("TR");
            // Loop through table rows
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching
                shouldSwitch = false;
                // get two rows and compare
                x = rows[i].getElementsByTagName("TD")[3];
                y = rows[i + 1].getElementsByTagName("TD")[3];
                // Check if the two rows should switch places
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If switch was marked then do it and break
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    } else if (value == "Ending latest") {
        while (switching) {
            // Start by saying that no switching is done
            switching = false;
            rows = table.getElementsByTagName("TR");
            // Loop through table rows
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching
                shouldSwitch = false;
                // get two rows and compare
                x = rows[i].getElementsByTagName("TD")[3];
                y = rows[i + 1].getElementsByTagName("TD")[3];
                // Check if the two rows should switch places
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch= true;
                    break;
                }
            }
            if (shouldSwitch) {
                // If switch was marked then do it and break
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }

}